<?php

namespace Modules\GeneralSetting\Http\Controllers\Api;

use Exception;
use App\Traits\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Otp\Entities\OtpConfiguration;
use Illuminate\Contracts\Support\Renderable;
use Modules\Shipping\Entities\PickupLocation;
use Modules\Shipping\Entities\ShippingMethod;
use Illuminate\Validation\ValidationException;
use Modules\GeneralSetting\Entities\GeneralSetting;
use Modules\Language\Repositories\LanguageRepository;
use Modules\GeneralSetting\Repositories\CurrencyRepository;
use Modules\GeneralSetting\Transformers\OTPConfigurationResource;

/**
* @group General Setting
*
* APIs for General Setting
*/
class GeneralSettingController extends Controller
{
    use Otp;

    protected $languageRepo;

    public function __construct(LanguageRepository $languageRepo)
    {
        $this->languageRepo = $languageRepo;
    }

    /**
     * Settings info
     * @response{
     *      "settings": [
     *           {
     *               "site_title": "Amaz cart",
     *               "company_name": "Amaz cart",
     *               "country_name": "BD",
     *               "zip_code": "1200",
     *               "address": "Panthapath",
     *               "phone": "0187595662",
     *               "email": "amazcart@spondonit.com",
     *               "currency_symbol": "$",
     *               "logo": "uploads/settings/6127358234608.png",
     *               "favicon": "uploads/settings/6127304e2f2b6.png",
     *               "currency_code": "USD",
     *               "copyright_text": "Copyright © 2019 - 2020 All rights reserved | This application is made by <a href=\"https://codecanyon.net/user/codethemes\">Codethemes</a>",
     *               "language_code": "en"
     *           }
     *       ],
     *       "msg": "success"
     * }
     */
    public function index(){
        $settings = GeneralSetting::select('site_title', 'company_name','country_name', 'zip_code','address','phone','email','currency_symbol','currency_symbol_position','logo','favicon','currency_code','copyright_text','language_code','country_id','state_id','city_id')->first();
        $currencyRepo = new CurrencyRepository();
        $currencies = $currencyRepo->getActiveAll();
        $languages = $this->languageRepo->getActiveAll();
        $vendorType = 'single';
        $otp_configuration = null;
        $pickup_locations = null;
        $free_shipping = null;
        if(isModuleActive('Otp')){
            $otp_config = OtpConfiguration::whereIn('key', ['code_validation_time', 'otp_activation_for_seller', 'otp_activation_for_customer', 'otp_activation_for_order','order_otp_on_verified_customer','order_cancel_limit_on_verified_customer','otp_on_login','otp_on_password_reset', 'login_with_otp_only'])->get();
            
            $login_with_otp_only = $otp_config->where('key', 'login_with_otp_only')->first();
            if($login_with_otp_only && $login_with_otp_only->value == 0){
                $otp_on_login = $otp_config->where('key', 'otp_on_login')->first();
                if($otp_on_login){
                    $otp_on_login->value = 0;
                }
            }

            $otp_configuration = OTPConfigurationResource::collection($otp_config);
        }
        if(isModuleActive('MultiVendor')){
            $vendorType = 'multi';
        }else{
            $free_shipping = ShippingMethod::where('request_by_user', 1)->where('id', '>', 1)->where('cost', 0)->orderBy('minimum_shopping')->first();
            $pickup_locations = PickupLocation::select(['id','pickup_location','name','email','phone','address','address_2','city_id','state_id','country_id','pin_code','status','is_default'])->where('created_by', 1)->where('status', 1)->get();
        }

        $modules = [
            'MultiVendor' => isModuleActive('MultiVendor'),
            'OTP' => isModuleActive('Otp'),
            'AmazonS3' => isModuleActive('AmazonS3'),
            'Affiliate' => isModuleActive('Affiliate'),
            'Bkash' => isModuleActive('Bkash'),
            'SslCommerz' => isModuleActive('SslCommerz'),
            'MercadoPago' => isModuleActive('MercadoPago'),
            'Tabby' => isModuleActive('Tabby'),
            'ShipRocket' => isModuleActive('ShipRocket'),
            'Lead' => isModuleActive('Lead'),
            'GoldPrice' => isModuleActive('GoldPrice'),
            'WholeSale' => isModuleActive('WholeSale'),
            'GoogleMerchantCenter' => isModuleActive('GoogleMerchantCenter'),
            'StorageCDN' => isModuleActive('StorageCDN'),
            'INTShipping' => isModuleActive('INTShipping'),
            'FrontendMultiLang' => isModuleActive('FrontendMultiLang'),
            'ClubPoint' => isModuleActive('ClubPoint'),
            'POS' => isModuleActive('POS'),
            'AuctionProducts' => isModuleActive('AuctionProducts'),
            'CheckPincode' => isModuleActive('CheckPincode'),
            // 'Tabby' => isModuleActive('Tabby'),
        ];

        return response()->json([
            'settings' => $settings,
            'currencies' => $currencies,
            'languages' => $languages,
            'vendorType' => $vendorType,
            'otp_configuration' => $otp_configuration,
            'pickup_locations' => $pickup_locations,
            'free_shipping' => $free_shipping,
            'modules' => $modules,
            'msg' => trans('app.Success')
        ]);
    }

    /**
     * Languages
     * @response{
     *      "languages": [
     *           {
     *               "id": 3,
     *               "code": "ar",
     *               "name": "Arabic",
     *               "native": "العربية",
     *               "rtl": 1,
     *               "status": 1,
     *               "json_exist": 0,
     *               "created_at": null,
     *               "updated_at": null
     *           },
     *           {
     *               "id": 5,
     *               "code": "az",
     *               "name": "Azerbaijani",
     *               "native": "Azərbaycanca / آذربايجان",
     *               "rtl": 0,
     *               "status": 1,
     *               "json_exist": 0,
     *               "created_at": null,
     *               "updated_at": "2021-09-08T10:40:27.000000Z"
     *           },
     *           {
     *               "id": 9,
     *               "code": "bn",
     *               "name": "Bengali",
     *               "native": "বাংলা",
     *               "rtl": 0,
     *               "status": 1,
     *               "json_exist": 0,
     *               "created_at": null,
     *               "updated_at": "2021-09-09T11:21:10.000000Z"
     *           },
     *           {
     *               "id": 19,
     *               "code": "en",
     *               "name": "English",
     *               "native": "English",
     *               "rtl": 0,
     *               "status": 1,
     *               "json_exist": 0,
     *               "created_at": null,
     *               "updated_at": "2021-09-09T10:11:04.000000Z"
     *           }
     *       ],
     *       "msg": "success"
     * }
     */

    public function getActiveLanguages(){
        $languages = $this->languageRepo->getActiveAll();
        return response()->json([
            'languages' => $languages,
            'msg' => trans('app.Success')
        ]);
    }

    public function sendOTPForAPI(Request $request){
        \Log::info('sendOTPForAPI Method Invoked', [
            'ip' => $request->ip(),
            'timestamp' => now()->toDateTimeString(),
            'payload' => $request->except(['password']),
        ]);

        if ($request->has('phone') && !$request->has('email')) {
            $request->merge(['email' => $request->phone]);
        }

        try {
            $request->validate([
                'type' => 'required'
            ]);

            if($request->type == 'otp_on_customer_registration'){
                $request->validate([
                    'code' => ['required', 'numeric', 'digits:6'],
                    'email' => ['required', 'string', 'max:255',],
                    'first_name' => 'required'
                ]);
            }elseif($request->type == 'otp_on_order_with_cod'){
                $request->validate([
                    'code' => ['required', 'numeric', 'digits:6'],
                    'email' => 'required',
                    'name' => 'required',
                    'phone' => 'required'
                ]);
            }
            elseif($request->type == 'otp_on_seller_registration'){
                $request->validate([
                    'code' => ['required', 'numeric', 'digits:6'],
                    'email' => 'required',
                    'name' => 'required',
                    'phone' => 'required'
                ]);
            }
            elseif($request->type == 'otp_on_login' || $request->type == 'login_with_otp_only'){
                if (isModuleActive('Otp') && otp_configuration('login_with_otp_only')) {
                    $request->validate([
                        'code' => ['required', 'numeric', 'digits:6'],
                        'email' => ['required'],
                    ]);
                } elseif (isModuleActive('Otp') && otp_configuration('otp_on_login')) {
                    $request->validate([
                        'code' => ['required', 'numeric', 'digits:6'],
                        'email' => ['required'],
                        'password' => ['required', 'string','min:8']
                    ]);
                } else {
                    \Log::warning('sendOTPForAPI - OTP login requested but both flags are off, use password login', [
                        'login_with_otp_only' => otp_configuration('login_with_otp_only'),
                        'otp_on_login' => otp_configuration('otp_on_login')
                    ]);
                    return response()->json([
                        'msg'  => 'OTP login is not enabled. Please use password login.',
                        'mode' => 'password_login',
                    ], 422);
                }
                
                $user = User::where(function($q) use($request) {
                    $login = $request->email;
                    $q->where('email', $login)
                      ->orWhere('username', $login)
                      ->orWhere('phone', $login);
                    
                    if (!str_starts_with($login, '+')) {
                        $q->orWhere('phone', '+' . $login);
                        if (!str_starts_with($login, '91') && strlen($login) == 10) {
                            $q->orWhere('phone', '+91' . $login);
                        }
                    } else {
                        $q->orWhere('phone', ltrim($login, '+'));
                        if (str_starts_with($login, '+91') && strlen($login) == 13) {
                            $q->orWhere('phone', substr($login, 3));
                        }
                    }
                })
                ->where('is_active', 1)
                ->whereHas('role', function($q){
                    $q->where('type', 'customer');
                })->first();

                if(!$user){
                    \Log::warning('sendOTPForAPI - User not found', ['email' => $request->email]);
                    
                    $message = 'The phone number has not been registered yet. Please register to login.';
                    $errorKey = 'phone';
                    if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                        $message = 'The email has not been registered yet. Please register to login.';
                        $errorKey = 'email';
                    }
                    
                    throw ValidationException::withMessages([
                        $errorKey => [$message]
                    ]);
                }
                $user->update(['verify_code' => $request->code]);

                if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                    $request->merge(['email' => $user->phone]);
                }

                if (!isModuleActive('Otp') || !otp_configuration('login_with_otp_only')) {
                    if(!Hash::check($request->password,$user->password)){
                        \Log::warning('sendOTPForAPI - Password check failed', ['user_id' => $user->id]);
                        throw ValidationException::withMessages([
                            'email' => __('auth.failed')
                        ]);
                    }
                }
            }
            elseif($request->type == 'otp_on_password_reset'){
                $request->validate([
                    'code' => ['required', 'numeric', 'digits:6'],
                    'email' => 'required'
                ]);
                $user = User::where(function($q) use($request) {
                    $login = $request->email;
                    $q->where('email', $login)
                      ->orWhere('username', $login)
                      ->orWhere('phone', $login);
                    
                    if (!str_starts_with($login, '+')) {
                        $q->orWhere('phone', '+' . $login);
                        if (!str_starts_with($login, '91') && strlen($login) == 10) {
                            $q->orWhere('phone', '+91' . $login);
                        }
                    } else {
                        $q->orWhere('phone', ltrim($login, '+'));
                        if (str_starts_with($login, '+91') && strlen($login) == 13) {
                            $q->orWhere('phone', substr($login, 3));
                        }
                    }
                })
                ->where('is_active', 1)
                ->whereHas('role', function($q){
                    $q->where('type', 'customer');
                })->first();
                if(!$user){
                    \Log::warning('sendOTPForAPI - User not found for password reset', ['email' => $request->email]);
                    
                    $message = 'The phone number has not been registered yet. Please register to login.';
                    $errorKey = 'phone';
                    if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                        $message = 'The email has not been registered yet. Please register to login.';
                        $errorKey = 'email';
                    }
                    
                    throw ValidationException::withMessages([
                        $errorKey => [$message]
                    ]);
                }
                $user->update(['verify_code' => $request->code]);

                if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                    $request->merge(['email' => $user->phone]);
                }

            }else{
                \Log::warning('sendOTPForAPI - Invalid type', ['type' => $request->type]);
                throw ValidationException::withMessages([
                    'type' => 'invalid type.'
                ]);
            }

            \Log::info('sendOTPForAPI - Sending OTP', [
                'type' => $request->type,
                'email' => $request->email ?? $request->phone,
                'code' => $request->code
            ]);

            $result = $this->sendOTPFromAPI($request);

            if($result){
                \Log::info('sendOTPForAPI - Success');
                return response()->json([
                    'msg' => trans('app.Success')
                ], 200);
            }else{
                \Log::error('sendOTPForAPI - Failed to send OTP');
                return response()->json([
                    'msg' => trans('app.failed')
                ], 403);
            }
        }catch(\Illuminate\Validation\ValidationException $e){
            \Log::error('sendOTPForAPI - Validation failed', ['errors' => $e->errors()]);
            throw $e;
        }catch(Exception $e){
            \Log::error('sendOTPForAPI - Exception', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return response()->json(['msg' => 'Something went wrong'], 500);
        }
    }
}
