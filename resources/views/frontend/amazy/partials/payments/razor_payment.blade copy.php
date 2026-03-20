<form action="{{route('frontend.order_payment')}}" method="POST" id="razor_form" class="razor_form d-none">
    <input type="hidden" name="method" value="RazorPay">
    <input type="hidden" name="amount" value="{{ ($total_amount - $coupon_am) * 100 }}">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" value="">
    @csrf
    <button type="button" class="d-none" id="razorpay_btn"></button>
</form>

@php
    if(app('general_setting')->seller_wise_payment && session()->has('seller_for_checkout')){
        $credential = getPaymentInfoViaSellerId(session()->get('seller_for_checkout'), 'razorpay');
    }else{
        $credential = getPaymentInfoViaSellerId(1, 'razorpay');
    }
    $razor_key = @$credential->perameter_1 ?: config('services.razorpay.key');
@endphp

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    (function($) {
        "use strict";
        console.log("Razorpay script loaded. Key: {{ $razor_key ? 'Present' : 'Missing' }}");

        $(document).off('click', '#razorpay_btn').on('click', '#razorpay_btn', function(e){
            e.preventDefault();
            console.log("Razorpay hidden button clicked. Opening modal...");
            
            var options = {
                "key": "{{ $razor_key }}",
                "amount": "{{ ($total_amount - $coupon_am) * 100 }}",
                "name": "{{ str_replace('_', ' ', app('general_setting')->company_name) }}",
                "description": "Order Total",
                "image": "{{ showImage(app('general_setting')->favicon) }}",
                "handler": function (response){
                    console.log("Razorpay payment successful. ID: " + response.razorpay_payment_id);
                    $('#razorpay_payment_id').val(response.razorpay_payment_id);
                    $('#razor_form').submit();
                },
                "modal": {
                    "onDismiss": function(){
                        console.log("Razorpay modal dismissed.");
                    }
                },
                "prefill": {
                    "name": "{{ @$address->name }}",
                    "email": "{{ @$address->email }}",
                    "contact": "{{ @$address->phone }}"
                },
                "theme": {
                    "color": "#ff7529"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
        });
    })(jQuery);
</script>
