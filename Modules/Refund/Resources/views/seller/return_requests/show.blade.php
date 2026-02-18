@extends('backEnd.master')
@section('styles')
<style>
    .badge_1 { background: #34D399; color: #fff; padding: 2px 10px; border-radius: 10px; } /* Green - Completed */
    .badge_2 { background: #FBBF24; color: #000; padding: 2px 10px; border-radius: 10px; } /* Yellow - Picked Up/At Warehouse */
    .badge_3 { background: #EF4444; color: #fff; padding: 2px 10px; border-radius: 10px; } /* Red - Cancelled */
    .badge_4 { background: #3B82F6; color: #fff; padding: 2px 10px; border-radius: 10px; } /* Blue - Pending */
    .product_img_div img { width: 50px; height: 50px; object-fit: cover; }
</style>
@endsection
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('refund.return_request') }}: #{{ $returnRequest->id }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="white_box_50px box_shadow_white">
                        <div class="row pb-30 border-bottom">
                            <div class="col-md-6">
                                <h4>{{ __('refund.return_info') }}</h4>
                                <table class="table-borderless">
                                    <tr>
                                        <td><strong>{{ __('refund.return_type') }}</strong></td>
                                        <td>: {{ str_replace('_', ' ', ucfirst($returnRequest->return_type)) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('common.status') }}</strong></td>
                                        <td>: {{ ucfirst($returnRequest->status) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('refund.reason') }}</strong></td>
                                        <td>: {{ $returnRequest->reason ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('common.date') }}</strong></td>
                                        <td>: {{ dateConvert($returnRequest->created_at) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6 text-right">
                                <h4>{{ __('common.order_id') }}: {{ optional($returnRequest->order)->order_number ?? 'N/A' }}</h4>
                            </div>
                        </div>

                        <div class="row mt-30">
                            <div class="col-md-6">
                                <h5>{{ __('defaultTheme.shipping_info') }}</h5>
                                <table class="table-borderless">
                                    @php $address = optional($returnRequest->order)->address; @endphp
                                    <tr>
                                        <td>{{ __('common.name') }}</td>
                                        <td>: {{ $address->shipping_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.email') }}</td>
                                        <td>: {{ $address->shipping_email ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.phone') }}</td>
                                        <td>: {{ $address->shipping_phone ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.address') }}</td>
                                        <td>: {{ $address->shipping_address ?? 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5>{{ __('refund.pick_up_address') }}</h5>
                                <p>{{ $returnRequest->pick_up_address ?? 'Same as shipping address' }}</p>
                            </div>
                        </div>

                        <div class="row mt-30">
                            <div class="col-12 mt-30">
                                <div class="box_header common_table_header">
                                    <h3 class="mb-0">{{ __('common.package') }}: {{ optional($returnRequest->package)->package_code ?? 'N/A' }}</h3>
                                </div>
                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table ">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">{{ __('common.sl') }}</th>
                                                        <th scope="col">{{ __('common.image') }}</th>
                                                        <th scope="col">{{ __('common.name') }}</th>
                                                        <th scope="col">{{ __('common.qty') }}</th>
                                                        <th scope="col">{{ __('common.price') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($returnRequest->package)
                                                        @foreach ($returnRequest->package->products as $key => $package_product)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>
                                                                    <div class="product_img_div">
                                                                        <img src="{{ showImage(optional($package_product->seller_product_sku->product)->thum_img) }}" alt="#">
                                                                    </div>
                                                                </td>
                                                                <td>{{ optional($package_product->seller_product_sku->product)->product_name }}</td>
                                                                <td>{{ $package_product->qty }}</td>
                                                                <td>{{ single_price($package_product->price) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($returnRequest->note)
                            <div class="row mt-30">
                                <div class="col-12">
                                    <h5>{{ __('common.note') }}</h5>
                                    <p>{{ $returnRequest->note }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="white_box p-25 box_shadow_white">
                        <h4 class="mb-15">{{ __('common.action') }}</h4>
                        
                        <div class="primary_input mb-25">
                            <label class="primary_input_label"><strong>{{ __('refund.update_status') }}</strong></label>
                            <select class="primary_select mb-15" id="detail_status">
                                <option value="pending" @if($returnRequest->status == 'pending') selected @endif>{{ __('common.pending') }}</option>
                                <option value="picked_up" @if($returnRequest->status == 'picked_up') selected @endif>{{ __('refund.picked_up') }}</option>
                                <option value="at_warehouse" @if($returnRequest->status == 'at_warehouse') selected @endif>{{ __('refund.at_warehouse') }}</option>
                                <option value="completed" @if($returnRequest->status == 'completed') selected @endif>{{ __('common.completed') }}</option>
                                <option value="cancelled" @if($returnRequest->status == 'cancelled') selected @endif>{{ __('common.cancelled') }}</option>
                            </select>
                            <button type="button" class="primary-btn fix-gr-bg w-100 mt-10" id="update_status_btn">{{ __('common.update') }}</button>
                        </div>

                        <div class="mt-20">
                            <label class="primary_input_label"><strong>{{ __('order.assign_driver') }}</strong></label>
                            <div class="primary_input mb-15">
                                <select class="primary_select mb-15" id="detail_driver_id">
                                    <option value="">Select Driver</option>
                                    @foreach ($drivers as $driver)
                                        <option value="{{ $driver->id }}" @if ($returnRequest->driver_id == $driver->id) selected @endif>
                                            {{ $driver->name }}@if($driver->vehicle_number) - {{$driver->vehicle_number}}@endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button" class="primary-btn fix-gr-bg w-100" id="assign_driver_detail_btn">
                                {{ __('order.assign_driver') }}
                            </button>
                        </div>
                    </div>
                    
                    <div class="white_box p-25 box_shadow_white mt-20">
                        <h4 class="mb-15">{{ __('refund.driver_info') }}</h4>
                        @if($returnRequest->driver)
                            <p><strong>{{ __('common.name') }}:</strong> {{ $returnRequest->driver->name }}</p>
                            <p><strong>{{ __('common.phone') }}:</strong> {{ $returnRequest->driver->phone }}</p>
                        @else
                            <p>{{ __('refund.no_driver_assigned') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push("scripts")
    <script type="text/javascript">
        (function($){
            "use strict";
            $(document).ready(function(){
                $('#assign_driver_detail_btn').on('click', function(){
                    var driverId = $('#detail_driver_id').val();
                    if(driverId == '') driverId = null;
                    var returnId = {{ $returnRequest->id }};

                    var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('meta[name="_token"]').attr('content');
                    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': csrfToken } });
                    $.ajax({
                        url: "{{ route('refund.seller_return_request_assign_driver') }}",
                        method: 'POST',
                        data: { id: returnId, driver_id: driverId },
                        beforeSend: function(){
                            $('#assign_driver_detail_btn').prop('disabled', true);
                        },
                        success: function(res){
                            toastr.success(res.message || 'Driver assigned successfully', 'Success');
                            $('#assign_driver_detail_btn').prop('disabled', false);
                            setTimeout(function(){
                                window.location.reload();
                            }, 1000);
                        },
                        error: function(err){
                            var msg = 'Operation failed';
                            if(err.responseJSON && err.responseJSON.message) {
                                msg = err.responseJSON.message;
                            }
                            toastr.error(msg, 'Error');
                            $('#assign_driver_detail_btn').prop('disabled', false);
                        }
                    });
                });

                $('#update_status_btn').on('click', function(){
                    var status = $('#detail_status').val();
                    var returnId = {{ $returnRequest->id }};

                    var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('meta[name="_token"]').attr('content');
                    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': csrfToken } });
                    $.ajax({
                        url: "{{ route('refund.seller_return_request_update_status') }}",
                        method: 'POST',
                        data: { id: returnId, status: status },
                        beforeSend: function(){
                            $('#update_status_btn').prop('disabled', true);
                        },
                        success: function(res){
                            toastr.success(res.message || 'Status updated successfully', 'Success');
                            $('#update_status_btn').prop('disabled', false);
                            setTimeout(function(){
                                window.location.reload();
                            }, 1000);
                        },
                        error: function(err){
                            var msg = 'Operation failed';
                            if(err.responseJSON && err.responseJSON.message) {
                                msg = err.responseJSON.message;
                            }
                            toastr.error(msg, 'Error');
                            $('#update_status_btn').prop('disabled', false);
                        }
                    });
                });
            });
        })(jQuery);
    </script>
@endpush
