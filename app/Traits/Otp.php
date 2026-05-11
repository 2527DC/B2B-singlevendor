<?php

namespace App\Traits;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Modules\GeneralSetting\Entities\SmsTemplate;

trait Otp
{
    use SendMail, SendSMS;
    public function sendOtp($request, $type = Null)
    {
        \Log::info('Otp Trait - sendOtp Invoked', [
            'email' => $request->email,
            'type' => $type
        ]);

        $code = random_int(100000, 999999);
        $minutes = time() + (otp_configuration('code_validation_time') * 60);
        $validation_time = date('Y-m-d H:i:s', $minutes);
        if ($type == "resend") {
            Session::forget('otp');
            Session::forget('validation_time');
        }
        Session::put('otp', $code);
        Session::put('validation_time', $validation_time);
        Session::forget('code_validation_time');
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            try{
                \Log::info('Otp Trait - Sending OTP by Mail', ['email' => $request->email]);
                return $this->sendOtpByMail($request, $code);
            }catch(Exception $e){
                \Log::error('Otp Trait - Mail Error: ' . $e->getMessage());
            }
        }elseif (preg_match("/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/", $request->email)) {
            $smsTemplete = SmsTemplate::where('type_id', 3)->where('is_active', 1)->first();
            $msg = $smsTemplete->value;
            try{
                \Log::info('Otp Trait - Sending OTP by SMS', ['phone' => $request->email]);
                return $this->sendSMS($request->email, $msg,$request->first_name,'','',$code);
            }catch(Exception $e){
                \Log::error('Otp Trait - SMS Error: ' . $e->getMessage());
            }
        }
    }
    public function sendLoginOtp($request, $type = Null)
    {
        \Log::info('Otp Trait - sendLoginOtp Invoked', [
            'login' => $request->login,
            'type' => $type
        ]);

        $user = User::where('username',$request->login)->orWhere('email', $request->login)->orWhere('phone', $request->login)->first();
        $code = random_int(100000, 999999);
        $minutes = time() + (otp_configuration('code_validation_time') * 60);
        $validation_time = date('Y-m-d H:i:s', $minutes);
        if ($type == "resend") {
            Session::forget('otp');
            Session::forget('validation_time');
        }
        Session::put('otp', $code);
        Session::put('validation_time', $validation_time);
        Session::forget('code_validation_time');
        if (filter_var($request->login, FILTER_VALIDATE_EMAIL)) {
            try{
                \Log::info('Otp Trait - Sending Login OTP by Mail', ['email' => $request->login]);
                return $this->sendLoginOtpByMail($request, $code);
            }catch(Exception $e){
                \Log::error('Otp Trait - Login Mail Error: ' . $e->getMessage());
            }
        }elseif (preg_match("/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/", $request->login)) {
            $smsTemplete = SmsTemplate::where('type_id', 37)->where('is_active', 1)->first();
            $msg = $smsTemplete->value;
            $expiry_time = otp_configuration('code_validation_time');
            try{
                \Log::info('Otp Trait - Sending Login OTP by SMS', ['phone' => $request->login]);
                return $this->sendSMS($request->login, $msg, $user->first_name, '', '', $code, '', $expiry_time);
            }catch(Exception $e){
                \Log::error('Otp Trait - Login SMS Error: ' . $e->getMessage());
            }
        }
    }

    public function sendPasswordResetOtp($request, $type = Null)
    {
        $user = User::where('username',$request->email)->orWhere('email', $request->email)->orWhere('phone', $request->email)->first();
        $code = random_int(100000, 999999);
        $minutes = time() + (otp_configuration('code_validation_time') * 60);
        $validation_time = date('Y-m-d H:i:s', $minutes);
        if ($type == "resend") {
            Session::forget('otp');
            Session::forget('validation_time');
        }
        Session::put('otp', $code);
        Session::put('validation_time', $validation_time);
        Session::forget('code_validation_time');
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            try{
                return $this->sendPasswordResetOtpByMail($request, $code);
            }catch(Exception $e){}
        }elseif (preg_match("/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/", $request->email)) {
            $smsTemplete = SmsTemplate::where('type_id', 38)->where('is_active', 1)->first(); //registration templete
            $msg = $smsTemplete->value;
            try{
                return $this->sendSMS($request->email, $msg,$user->first_name,'','',$code);
            }catch(Exception $e){}
        }
        return redirect()->back();
    }

    public function sendOtpForSeller($request, $type = Null)
    {
        $code = random_int(100000, 999999);
        $minutes = time() + (otp_configuration('code_validation_time') * 60);
        $validation_time = date('Y-m-d H:i:s', $minutes);
        if ($type == "resend") {
            Session::forget('otp');
            Session::forget('validation_time');
        }
        Session::put('otp', $code);
        Session::put('validation_time', $validation_time);
        Session::forget('code_validation_time');
        $emailSend = false;
        $smsSend = false;
        if (Str::contains(otp_configuration('otp_type_registration'), 'email')) {
            try{
                $emailSend = $this->sendOtpByMailForSeller($request, $code);
            }catch(Exception $e){}
        }
        if (Str::contains(otp_configuration('otp_type_registration'), 'sms')) {
            $smsTemplete = SmsTemplate::where('type_id', 35)->where('is_active', 1)->first(); //registration templete
            $msg = $smsTemplete->value;
            try{
                if (preg_match("/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/", $request->phone)) {
                    $smsSend = $this->sendSMS($request->phone, $msg,$request->first_name,'','',$code);
                }
            }catch(Exception $e){}
        }
        if ($emailSend == true || $smsSend == true) {
            return true;
        } else {
            return false;
        }
    }
    public function sendOtpForOrder($request, $type = Null)
    {
        $address = session()->get('infoCompleteOrder');
        $code = random_int(100000, 999999);
        $minutes = time() + (otp_configuration('code_validation_time') * 60);
        $validation_time = date('Y-m-d H:i:s', $minutes);
        if ($type == "resend") {
            Session::forget('otp');
            Session::forget('validation_time');
        }
        Session::put('otp', $code);
        Session::put('validation_time', $validation_time);
        Session::forget('code_validation_time');
        $emailSend = false;
        $smsSend = false;
        if (Str::contains(otp_configuration('otp_type_order'), 'email')) {
            if($type == null){
                 if(auth()->check()){
                    $request->merge(['name' => $address['address']['name']]);
                    $request->merge(['customer_email'=> $address['address']['email']]);
                 }else{
                    $request->merge(['name' =>  $address['address']->name]);
                    $request->merge(['customer_email'=>  $address['address']->email]);
                 }
            }
            try{
                $emailSend = $this->sendOtpByMailForOrder($request, $code);
            }catch(Exception $e){
            }
        }
        if (Str::contains(otp_configuration('otp_type_order'), 'sms')) {
            if(auth()->check()){
                $phone = $address['address']['phone'];
             }else{
                $phone = $address['address']->phone;
             }
            $smsTemplete = SmsTemplate::where('type_id', 36)->where('is_active', 1)->first(); //order confirmation templete
            $msg = $smsTemplete->value;
            try{
                $smsSend = $this->sendSMS($phone, $msg,'','','',$code);
            }catch(Exception $e){
            }
        }
        if ($emailSend == true || $smsSend == true) {
            return true;
        } else {
            return false;
        }
    }
    public function sendOTPFromAPI($request){
        \Log::info('Otp Trait - sendOTPFromAPI Invoked', [
            'type' => $request->type,
            'email' => $request->email ?? $request->phone,
            'code' => $request->code
        ]);

        if($request->type == 'otp_on_customer_registration'){

            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                try{
                    \Log::info('Otp Trait - sendOTPFromAPI - Sending registration OTP by Mail');
                    return $this->sendOtpByMail($request, $request->code);
                }catch(Exception $e){
                    \Log::error('Otp Trait - API Reg Mail Error: ' . $e->getMessage());
                }
            } else {
                $smsTemplete = SmsTemplate::where('type_id', 35)->where('is_active', 1)->first(); //registration templete
                $msg = $smsTemplete->value . $request->code;
                try{
                    \Log::info('Otp Trait - sendOTPFromAPI - Sending registration OTP by SMS');
                    return $this->sendSMS($request->email, $msg,$request->first_name,'','',$request->code);
                }catch(Exception $e){
                    \Log::error('Otp Trait - API Reg SMS Error: ' . $e->getMessage());
                }
            }
        }elseif($request->type == 'otp_on_order_with_cod'){
            $emailSend = false;
            $smsSend = false;
            if (Str::contains(otp_configuration('otp_type_order'), 'email')) {
                $request->merge(['name' => $request->name]);
                $request->merge(['customer_email'=> $request->email]);
                try{
                    \Log::info('Otp Trait - sendOTPFromAPI - Sending order OTP by Mail');
                    $emailSend = $this->sendOtpByMailForOrder($request, $request->code);
                }catch(Exception $e){
                    \Log::error('Otp Trait - API Order Mail Error: ' . $e->getMessage());
                }
            }
            if (Str::contains(otp_configuration('otp_type_order'), 'sms')) {
                $smsTemplete = SmsTemplate::where('type_id', 36)->where('is_active', 1)->first(); //order confirmation templete
                $msg = $smsTemplete->value;
                try{
                    \Log::info('Otp Trait - sendOTPFromAPI - Sending order OTP by SMS');
                    $smsSend = $this->sendSMS($request->phone,$msg,'','','',$request->code);
                }catch(Exception $e){
                    \Log::error('Otp Trait - API Order SMS Error: ' . $e->getMessage());
                }
            }
            if ($emailSend == true || $smsSend == true) {
                return true;
            } else {
                return false;
            }
        }elseif($request->type == 'otp_on_login'){
            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                try{
                    \Log::info('Otp Trait - sendOTPFromAPI - Sending login OTP by Mail');
                    return $this->sendLoginOtpByMail($request, $request->code);
                }catch(Exception $e){
                    \Log::error('Otp Trait - API Login Mail Error: ' . $e->getMessage());
                }
            } else {
                $smsTemplete = SmsTemplate::where('type_id', 37)->where('is_active', 1)->first(); //registration templete
                $msg = $smsTemplete->value;
                try{
                    \Log::info('Otp Trait - sendOTPFromAPI - Sending login OTP by SMS', ['phone' => $request->email]);
                    return $this->sendSMS($request->email,$msg,'','','',$request->code);
                }catch(Exception $e){
                    \Log::error('Otp Trait - API Login SMS Error: ' . $e->getMessage());
                }
            }
        }elseif($request->type == 'otp_on_password_reset'){
            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                try{
                    \Log::info('Otp Trait - sendOTPFromAPI - Sending password reset OTP by Mail');
                    return $this->sendPasswordResetOtpByMail($request, $request->code);
                }catch(Exception $e){
                    \Log::error('Otp Trait - API Reset Mail Error: ' . $e->getMessage());
                }
            } else {
                $smsTemplete = SmsTemplate::where('type_id', 38)->where('is_active', 1)->first(); //registration templete
                $msg = $smsTemplete->value;
                try{
                    \Log::info('Otp Trait - sendOTPFromAPI - Sending password reset OTP by SMS');
                    return $this->sendSMS($request->email, $msg,'','','',$request->code);
                }catch(Exception $e){
                    \Log::error('Otp Trait - API Reset SMS Error: ' . $e->getMessage());
                }
            }
        }elseif($request->type == 'otp_on_seller_registration'){
            $emailSend = false;
            $smsSend = false;
            if (Str::contains(otp_configuration('otp_type_registration'), 'email')) {
                try{
                    \Log::info('Otp Trait - sendOTPFromAPI - Sending seller registration OTP by Mail');
                    $emailSend = $this->sendOtpByMailForSeller($request, $request->code);
                }catch(Exception $e){
                    \Log::error('Otp Trait - API Seller Mail Error: ' . $e->getMessage());
                }
            }
            if (Str::contains(otp_configuration('otp_type_registration'), 'sms')) {
                $smsTemplete = SmsTemplate::where('type_id', 35)->where('is_active', 1)->first(); //registration templete
                $msg = $smsTemplete->value;
                try{
                    \Log::info('Otp Trait - sendOTPFromAPI - Sending seller registration OTP by SMS');
                    $smsSend = $this->sendSMS($request->phone,$msg,$request->first_name,'','',$request->code);
                }catch(Exception $e){
                    \Log::error('Otp Trait - API Seller SMS Error: ' . $e->getMessage());
                }
            }
            if ($emailSend == true || $smsSend == true) {
                return true;
            } else {
                return false;
            }
        }
    }
}
