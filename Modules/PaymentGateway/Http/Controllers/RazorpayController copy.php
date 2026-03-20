<?php

namespace Modules\PaymentGateway\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Repositories\OrderRepository;
use \Modules\Wallet\Repositories\WalletRepository;
use Brian2694\Toastr\Facades\Toastr;
use Modules\Account\Repositories\TransactionRepository;
use Modules\Account\Entities\Transaction;
use Modules\FrontendCMS\Entities\SubsciptionPaymentInfo;
use App\Traits\Accounts;
use Carbon\Carbon;
use Modules\UserActivityLog\Traits\LogActivity;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;

class RazorpayController extends Controller
{
    use Accounts;

    public function __construct()
    {
        $this->middleware('maintenance_mode');
    } 

    public function payWithRazorpay()
    {
        return view('paymentgateway::razorPay.index');
    }


    public function payment($data)
    {
        Log::info('Razorpay payment method started', [
            'input' => $data
        ]);
    
        $input = $data;
    
        try {
            $credential = $this->getCredential();
    
            Log::info('Razorpay credentials fetched', [
                'key' => @$credential->perameter_1
            ]);
    
            $api = new Api(
                @$credential->perameter_1,
                @$credential->perameter_2
            );
    
            if (empty($input['razorpay_payment_id'])) {
                Log::warning('Razorpay payment id missing', $input);
                return 'Payment ID missing';
            }
    
            Log::info('Fetching Razorpay payment', [
                'payment_id' => $input['razorpay_payment_id']
            ]);
    
            $payment = $api->payment->fetch($input['razorpay_payment_id']);
    
            Log::info('Razorpay payment fetched', [
                'amount' => $payment['amount'],
                'status' => $payment['status']
            ]);
    
            $response = $api->payment
                ->fetch($input['razorpay_payment_id'])
                ->capture(['amount' => $payment['amount']]);
    
            Log::info('Razorpay payment captured successfully', [
                'response' => $response
            ]);
    
            $return_data = $response['id'];
            $amount = $response['amount'] / 100;
    
            /** ---------------- Wallet Recharge ---------------- */
            if (session()->has('wallet_recharge')) {
                Log::info('Wallet recharge flow started', [
                    'amount' => $amount
                ]);
    
                $walletService = new WalletRepository;
                session()->forget('order_payment');
    
                return $walletService->walletRecharge(
                    $amount,
                    $credential->method->id,
                    $return_data
                );
            }
    
            /** ---------------- Order Payment ---------------- */
            if (session()->has('order_payment')) {
                Log::info('Order payment flow started', [
                    'amount' => $amount
                ]);
    
                $orderPaymentService = new OrderRepository;
                $order_payment = $orderPaymentService->orderPaymentDone(
                    $amount,
                    $credential->method->id,
                    $return_data,
                    auth()->check() ? auth()->user() : null
                );
    
                if ($order_payment === 'failed') {
                    Log::error('Order payment failed', [
                        'txn_id' => $return_data
                    ]);
    
                    Toastr::error('Invalid Payment');
                    return redirect(url('/checkout'));
                }
    
                session()->forget('order_payment');
    
                Log::info('Order payment successful', [
                    'order_payment_id' => $order_payment->id
                ]);
    
                return $order_payment->id;
            }
    
            /** ---------------- Subscription Payment ---------------- */
            if (session()->has('subscription_payment')) {
                Log::info('Subscription payment flow started', [
                    'amount' => $amount
                ]);
    
                $defaultIncomeAccount = $this->defaultIncomeAccount();
                $transactionRepo = new TransactionRepository(new Transaction);
                $seller_subscription = getParentSeller()->SellerSubscriptions;
    
                $transaction = $transactionRepo->makeTransaction(
                    getParentSeller()->first_name . ' - Subscription Payment',
                    'in',
                    'Razor Pay',
                    'subscription_payment',
                    $defaultIncomeAccount,
                    'Subscription Payment',
                    $seller_subscription,
                    $amount,
                    Carbon::now()->format('Y-m-d'),
                    getParentSellerId()
                );
    
                $seller_subscription->update([
                    'last_payment_date' => Carbon::now()->format('Y-m-d')
                ]);
    
                SubsciptionPaymentInfo::create([
                    'transaction_id' => $transaction->id,
                    'txn_id' => $return_data,
                    'seller_id' => getParentSellerId(),
                    'subscription_type' => getParentSeller()->sellerAccount->subscription_type,
                    'commission_type' => optional($seller_subscription->pricing)->name
                ]);
    
                session()->forget('subscription_payment');
    
                Log::info('Subscription payment successful', [
                    'transaction_id' => $transaction->id
                ]);
    
                Toastr::success(__('common.payment_successfully'), __('common.success'));
                return redirect()->route('seller.dashboard');
            }
    
        } catch (\Exception $e) {
    
            Log::error('Razorpay payment exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return $e->getMessage();
        }
    
        Log::info('Payment completed with default redirect');
    
        Toastr::success(
            __('order.payment_successful_your_order_will_be_despatched_in_the_next_48_hours'),
            __('common.success')
        );
    
        return redirect()->route('frontend.welcome');
    }
    

    private function getCredential(){
        $url = explode('?',url()->previous());
        if(isset($url[0]) && $url[0] == url('/checkout')){
            $is_checkout = true;
        }else{
            $is_checkout = false;
        }
        if(session()->has('order_payment') && app('general_setting')->seller_wise_payment && session()->has('seller_for_checkout') && $is_checkout){
            $credential = getPaymentInfoViaSellerId(session()->get('seller_for_checkout'), 'razorpay');
        }else{
            $credential = getPaymentInfoViaSellerId(1, 'razorpay');
        }

        // Fallback to config if database credentials are empty
        if (!$credential || empty($credential->perameter_1)) {
            $credential = (object)[
                'perameter_1' => config('services.razorpay.key'),
                'perameter_2' => config('services.razorpay.secret'),
                'method' => (object)['id' => 6] // Razorpay method ID is 6
            ];
        }

        return $credential;
    }
}
