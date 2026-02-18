<?php

namespace Modules\OrderManage\Repositories;

use App\Models\User;
use Modules\OrderManage\Entities\DeliveryProcess;
use Carbon\Carbon;
use Modules\GeneralSetting\Entities\NotificationSetting;
use Modules\GeneralSetting\Entities\UserNotificationSetting;

class DeliveryProcessRepository
{
    public function getAll()
    {
        return DeliveryProcess::all();
    }

    public function save($data)
    {
        $deliveryProcess = new DeliveryProcess();
        $deliveryProcess->fill($data)->save();
        $notificationSetting = NotificationSetting::create([
            'event' => $deliveryProcess->name,
            'delivery_process_id' => $deliveryProcess->id,
            'type' => 'system',
            'message' => $deliveryProcess->name,
            'user_access_status' => 0
        ]);
        $users = User::all();
        foreach ($users as $user) {
            UserNotificationSetting::create([
                'user_id' => $user->id,
                'notification_setting_id' => $notificationSetting->id,
                'type' => 'system'

            ]);
        }
    }

    public function update($data, $id)
    {
        $deliveryProcess = DeliveryProcess::findOrFail($id);
        
        // Handle multi-language data
        $name = $data['name'];
        $description = $data['description'];
        
        // If name and description are arrays (multi-language), keep as is
        // If they are strings (single language), wrap in array format if needed
        if (is_array($name) && is_array($description)) {
            $updateData = [
                'name' => $name,
                'description' => $description
            ];
        } else {
            // Single language mode
            $updateData = [
                'name' => $name,
                'description' => $description
            ];
        }
        
        $deliveryProcess->update($updateData);
        
        // Update notification setting with the first language name or string name
        $eventName = is_array($name) ? reset($name) : $name;
        NotificationSetting::where('delivery_process_id',$deliveryProcess->id)->update([
            'event' => $eventName,
        ]);
    }

    public function delete($id)
    {
        $process =  DeliveryProcess::find($id);
        if($process){
            $notificationSetting = NotificationSetting::where('delivery_process_id', $id)->pluck('id')->toArray();
            $user_notification_setting = UserNotificationSetting::whereIn('notification_setting_id', $notificationSetting)->pluck('id')->toArray();
            NotificationSetting::destroy($notificationSetting);
            UserNotificationSetting::destroy($user_notification_setting);
            $process->delete();
            return true;
        }
        return false;
    }
}
