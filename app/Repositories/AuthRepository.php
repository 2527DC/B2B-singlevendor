<?php
namespace App\Repositories;

use App\Models\User;
use App\Traits\Notification;
use Illuminate\Support\Facades\Hash;
use Modules\GeneralSetting\Entities\EmailTemplateType;
use Modules\GeneralSetting\Entities\NotificationSetting;
use Modules\GeneralSetting\Entities\UserNotificationSetting;
use Modules\Marketing\Entities\ReferralCodeSetup;
use Modules\Marketing\Entities\ReferralUse;
use Modules\Marketing\Entities\ReferralCode;

class AuthRepository{

    use Notification;

    public function register(array $data)
    {
        $phone = $data['phone'] ?? null;
        $email = $data['email'] ?? null;
    
        // Generate username: prefer phone, fallback to part before @ of email
        $username = $phone ?? ($email ? explode('@', $email)[0] : null);
    
        // ✅ Add store_name, document_type, and document_path to user creation
        $user = User::create([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'] ?? null,
            'username'      => $username,
            'email'         => $email,
            'phone'         => $phone,
            'password'      => Hash::make($data['password']),
            'role_id'       => 4, // customer role
            'currency_id'   => app('general_setting')->currency,
            'lang_code'     => app('general_setting')->language_code,
            'currency_code' => app('general_setting')->currency_code,
            'store_name'    => $data['store_name'] ?? null, // ✅ Add store name
            // 'document_type' => $data['document_type'] ?? null, // ✅ Add document type
            'document'      => $data['document_path'] ?? null, // ✅ Add document path
            'store_image'      => $data['store_image'] ?? null, // ✅ Add document path

        ]);
    
        // User Notification Setting
        (new UserNotificationSetting())->createForRegisterUser($user->id);
    
        // Register Notification
        $notification = NotificationSetting::where('slug', 'register')->first();
        if ($notification) {
            $this->notificationSend($notification->id, $user->id);
        }
    
        // Referral Logic
        if (!empty($data['referral_code'])) {
            $referralData = ReferralCodeSetup::first();
            $referralExist = ReferralCode::where('referral_code', $data['referral_code'])->first();
    
            if ($referralExist) {
                $referralExist->increment('total_used');
    
                ReferralUse::create([
                    'user_id'         => $user->id,
                    'referral_code'   => $data['referral_code'],
                    'discount_amount' => $referralData->amount,
                ]);
            }
        }
    
        return $user;
    }
    public function getRegister(array $user)
    {
        if (!isset($user['phone'])) {
            return false;
        }
    
        $phone = $user['phone'];
    
        $user_exist = User::where('phone', $phone)
            ->where('is_active', 2)
            ->first();
    
        if ($user_exist) {
            $user_exist->update([
                'first_name' => $user['first_name'] ?? null,
                'last_name'  => $user['last_name'] ?? null,
                'username'   => $phone,
                'email'      => null,
                'phone'      => $phone,
                'password'   => Hash::make($user['password']),
                'role_id'    => 4,
                'is_active'  => 1,
            ]);
    
            return $user_exist;
        }
    
        return false;
    }
    

    public function changePassword($user, $data){

        if($user && Hash::check($data['old_password'], $user->password)){

            User::where('id', $user['id'])->update([
                'password' => Hash::make($data['password'])
            ]);
            return true;

        }else{
            return false;
        }
    }

}
