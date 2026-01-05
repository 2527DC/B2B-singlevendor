<?php

namespace App\Traits;
use Exception;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Http;
use \Modules\GeneralSetting\Entities\BusinessSetting;

trait SendSMS
{
    public function sendIndividualSMS($number, $text)
    {
        $apy_key = env('SMS_API_KEY');

        try {
            $soapClient = new \SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
            $paramArray = array(
                'apiKey' => $apy_key,
                'messageText' =>  $text,
                'numberList' => $number,
                'smsType' => "TEXT",
                'maskName' => '',
                'campaignName' => '',
            );
            $value = $soapClient->__call("NumberSms", array($paramArray));
            return $value;
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }


function sendSMS(
    $to,
    $text,
    $to_name = '',
    $user_email = '',
    $order_tracking_number = '',
    $secret_code = '',
    $giftcard = ''
) {
    // 🔁 Replace placeholders
    $text = str_replace("{USER_FIRST_NAME}", $to_name, $text);
    $text = str_replace("{USER_EMAIL}", $user_email, $text);
    $text = str_replace("{ORDER_TRACKING_NUMBER}", $order_tracking_number, $text);
    $text = str_replace("{WEBSITE_NAME}", app('general_setting')->site_title, $text);
    $text = str_replace("{GIFT_CARD_NAME}", $giftcard, $text);
    $text = str_replace("{SECRET_CODE}", $secret_code, $text);

    Log::info('📨 SMS send initiated', [
        'to' => $to,
        'message' => $text,
    ]);

    // =======================
    // 🔵 TWILIO
    // =======================
    if (BusinessSetting::where('type', 'Twillo')->first()->status == 1) {
        try {
            if (!$to) {
                Log::error('❌ Twilio failed: empty phone number');
                return false;
            }

            $client = new Client(env("TWILIO_SID"), env("TWILIO_TOKEN"));

            $message = $client->messages->create($to, [
                'from' => env('VALID_TWILLO_NUMBER'),
                'body' => $text
            ]);

            Log::info('✅ Twilio SMS sent', [
                'sid' => $message->sid,
            ]);

            return true;

        } catch (\Exception $e) {
            Log::error('❌ Twilio SMS failed', [
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    // =======================
    // 🟡 TEXTLOCAL
    // =======================
    elseif (BusinessSetting::where('type', 'TextLocal')->first()->status == 1) {
        try {
            $data = [
                'apikey' => env('TEXT_TO_LOCAL_API_KEY'),
                'numbers' => $to,
                'sender' => env('TEXT_TO_LOCAL_SENDER'),
                'message' => $text,
            ];

            $ch = curl_init('https://api.textlocal.in/send/');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            if ($response === false) {
                Log::error('❌ TextLocal cURL error', [
                    'curl_error' => curl_error($ch),
                    'curl_errno' => curl_errno($ch),
                ]);
                curl_close($ch);
                return false;
            }

            curl_close($ch);

            Log::info('📩 TextLocal raw response', [
                'response' => $response,
            ]);

            $decoded = json_decode($response, true);

            if (isset($decoded['status']) && $decoded['status'] === 'failure') {
                Log::error('❌ TextLocal SMS failed', [
                    'errors' => $decoded['errors'] ?? 'Unknown error',
                ]);
                return false;
            }

            return $response;

        } catch (\Exception $e) {
            Log::error('❌ TextLocal exception', [
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    // =======================
    // 🟢 MSEGAT
    // =======================
    elseif (BusinessSetting::where('type', 'MsegatSMS')->first()->status == 1) {
        try {
            $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
                'apiKey' => env('MSEGAT_API_KEY'),
                'userName' => env('MSEGAT_USER_NAME'),
                'userSender' => env('MSEGAT_USER_SENDER'),
                'numbers' => $to,
                'msg' => $text,
                'msgEncoding' => 'UTF8'
            ])->body();

            Log::info('📩 Msegat raw response', [
                'response' => $response,
            ]);

            $decoded = json_decode($response);

            if (!$decoded || !isset($decoded->code)) {
                Log::error('❌ Msegat invalid response');
                return false;
            }

            if ($decoded->code == '1' || $decoded->code == 'M0000') {
                return true;
            }

            Log::error('❌ Msegat SMS failed', [
                'code' => $decoded->code,
                'message' => $decoded->message ?? null,
            ]);

            return false;

        } catch (\Exception $e) {
            Log::error('❌ Msegat exception', [
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    // =======================
    // 🔴 NO GATEWAY ENABLED
    // =======================
    Log::error('❌ SMS failed: No active SMS gateway configured');
    return false;
}


    // function sendSMS($to, $text,$to_name='',$user_email='',$order_tracking_number = '',$secret_code='',$giftcard ='')
    // {
    //     $text = str_replace("{USER_FIRST_NAME}", $to_name, $text);
    //     $text = str_replace("{USER_EMAIL}",$user_email, $text);
    //     $text = str_replace("{ORDER_TRACKING_NUMBER}", $order_tracking_number, $text);
    //     $text = str_replace("{WEBSITE_NAME}", app('general_setting')->site_title, $text);
    //     $text = str_replace("{GIFT_CARD_NAME}", $giftcard, $text);
    //     $text = str_replace("{SECRET_CODE}", $secret_code, $text);
    //     Log::info($text);
    //     $return = true;
    //     if (BusinessSetting::where('type', 'Twillo')->first()->status == 1) {
    //         if ($to) {
    //             $sid = env("TWILIO_SID"); // Your Account SID from www.twilio.com/console
    //             $token = env("TWILIO_TOKEN"); // Your Auth Token from www.twilio.com/console
    //             $client = new Client($sid, $token);
    //             try {
    //                 $message = $client->messages->create(
    //                     $to, // Text this number
    //                     array(
    //                         'from' => env('VALID_TWILLO_NUMBER'), // From a valid Twilio number
    //                         'body' => $text
    //                     )
    //                 );
    //             } catch (\Exception $e) {
    //                 $return = false;
    //             }
    //         }
    //     }
    //     elseif (BusinessSetting::where('type', 'TextLocal')->first()->status == 1) {
    //         // Account details
    //         $apiKey = urlencode(env('TEXT_TO_LOCAL_API_KEY'));
    //         // Message details
    //         $numbers = array($to);
    //         $sender = urlencode(env('TEXT_TO_LOCAL_SENDER'));
    //         $message = rawurlencode($text);
    //         $numbers = implode(',', $numbers);
    //         // Prepare data for POST request
    //         $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

    //         // Send the POST request with cURL
    //     	$ch = curl_init('https://api.textlocal.in/send/');
    //     	curl_setopt($ch, CURLOPT_POST, true);
    //     	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //     	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     	$response = curl_exec($ch);
    //     	curl_close($ch);
    //         return $response;
    //     }
    //     elseif (BusinessSetting::where('type', 'MsegatSMS')->first()->status == 1) {
    //         $message = rawurlencode($text);
    //     	$data = [
    //             'apiKey' => env('MSEGAT_API_KEY'),
    //             'userName' => env('MSEGAT_USER_NAME'),
    //             'userSender' => env('MSEGAT_USER_SENDER'),
    //             'numbers' => $to,
    //             'msg' => $message,
    //             'msgEncoding' => 'UTF8'
    //         ];
    //         $response = Http::post('https://www.msegat.com/gw/sendsms.php', $data);
    //         $response = $response->body();
    //         if($response){
    //             $response = json_decode($response);
    //             if($response->code == '1' || $response->code == 'M0000'){
    //                 return true;
    //             }
    //             return false;
    //         }
    //         return $response;
    //     }
    //     elseif (BusinessSetting::where('type', 'OtherSmsGateway')->first()->status == 1) {
    //         $sms_settings = smsGatewaySetting();
    //         $response = false;
    //         if(empty($sms_settings['url'])){
    //             Toastr::info(__('common.set_sms_credentials'), __('common.info'));
    //             return $response;
    //         }
    //         $request_data = [
    //             $sms_settings['send_to_parameter_name'] => $to,
    //             $sms_settings['message_parameter_name'] => $text,
    //         ];
    //         if (!empty($sms_settings['parameter_1_key'])) {
    //             $request_data[$sms_settings['parameter_1_key']] = $sms_settings['parameter_1_value'];
    //         }
    //         if (!empty($sms_settings['parameter_2_key'])) {
    //             $request_data[$sms_settings['parameter_2_key']] = $sms_settings['parameter_2_value'];
    //         }
    //         if (!empty($sms_settings['parameter_3_key'])) {
    //             $request_data[$sms_settings['parameter_3_key']] = $sms_settings['parameter_3_value'];
    //         }
    //         if (!empty($sms_settings['parameter_4_key'])) {
    //             $request_data[$sms_settings['parameter_4_key']] = $sms_settings['parameter_4_value'];
    //         }
    //         if (!empty($sms_settings['parameter_5_key'])) {
    //             $request_data[$sms_settings['parameter_5_key']] = $sms_settings['parameter_5_value'];
    //         }
    //         if (!empty($sms_settings['parameter_6_key'])) {
    //             $request_data[$sms_settings['parameter_6_key']] = $sms_settings['parameter_6_value'];
    //         }
    //         if (!empty($sms_settings['parameter_7_key'])) {
    //             $request_data[$sms_settings['parameter_7_key']] = $sms_settings['parameter_7_value'];
    //         }
    //         if (!empty($sms_settings['parameter_8_key'])) {
    //             $request_data[$sms_settings['parameter_8_key']] = $sms_settings['parameter_8_value'];
    //         }
    //         if (!empty($sms_settings['parameter_9_key'])) {
    //             $request_data[$sms_settings['parameter_9_key']] = $sms_settings['parameter_9_value'];
    //         }
    //         if (!empty($sms_settings['parameter_10_key'])) {
    //             $request_data[$sms_settings['parameter_10_key']] = $sms_settings['parameter_10_value'];
    //         }
    //         $params = [];
    //         $user_name = array_search('username',$sms_settings);
    //         $password = array_search('password',$sms_settings);
    //         if($user_name && $password){
    //             $params['auth'] = [
    //                 $request_data[ $sms_settings[$user_name]],
    //                 $request_data[ $sms_settings[$password]],
    //             ];
    //             unset($request_data['username']);
    //             unset($request_data['password']);
    //         }
    //         if(array_key_exists("csms_id",$request_data)){
    //             $request_data["csms_id"] = date('dmY');
    //         }
    //         $params['form_params'] = $request_data;
    //         $client = new \GuzzleHttp\Client();
    //         $method = strtolower($sms_settings['request_method']);
    //         if($method == 'get'){
    //             $response = $client->$method($sms_settings['url'] . '?'. http_build_query($request_data));
    //         }else{
    //             $response = $client->$method($sms_settings['url'],$params);
    //         }
    //         $return = $response;
    //     }else{
    //         $return = false;
    //     }
    //     return $return;
    // }
    
}
