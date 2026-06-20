@extends('backEnd.master')
@section('mainContent')
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <!-- Header -->
        <div class="row">
            <div class="col-12">
                <div class="box_header common_table_header">
                    <div class="main-title d-flex justify-content-between w-100 align-items-center">
                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('Salesman Dashboard Details') }}</h3>
                        <a href="{{ route('seller.salesmen.index') }}" class="primary-btn radius_30px mr-10 fix-gr-bg">
                            <i class="ti-arrow-left"></i> {{ __('Back to List') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-20">
            <!-- Left Card: Salesman Profile Details -->
            <div class="col-lg-4 col-md-5">
                <div class="white-box p-30 text-center">
                    <div class="profile-avatar mb-20">
                        <div class="avatar-circle d-inline-flex align-items-center justify-content-center text-white rounded-circle" style="width: 80px; height: 80px; font-size: 32px; font-weight: bold; background: linear-gradient(135deg, #7c3aed, #4f46e5) !important;">
                            {{ strtoupper(substr($salesman->name, 0, 2)) }}
                        </div>
                    </div>
                    <h4 class="mb-5 font-weight-bold text-dark">{{ $salesman->name }}</h4>
                    <p class="text-muted mb-15"><i class="ti-id-badge mr-5"></i>ID: {{ $salesman->salesman_id }}</p>
                    <hr>
                    <div class="text-left mt-20">
                        <div class="mb-15 d-flex align-items-center">
                            <span class="btn-sm btn-info text-white rounded mr-10" style="padding: 4px 8px;"><i class="ti-mobile"></i></span>
                            <div>
                                <small class="text-muted d-block">{{ __('Phone Number') }}</small>
                                <span class="text-dark font-weight-bold">{{ $salesman->phone_number }}</span>
                            </div>
                        </div>
                        <div class="mb-15 d-flex align-items-center">
                            <span class="btn-sm btn-success text-white rounded mr-10" style="padding: 4px 8px;"><i class="ti-user"></i></span>
                            <div>
                                <small class="text-muted d-block">{{ __('Total Mapped Customers') }}</small>
                                <span class="text-dark font-weight-bold">{{ $totalCustomersCount }}</span>
                            </div>
                        </div>
                        <div class="mb-15 d-flex align-items-center">
                            <span class="btn-sm btn-warning text-white rounded mr-10" style="padding: 4px 8px;"><i class="ti-shopping-cart"></i></span>
                            <div>
                                <small class="text-muted d-block">{{ __('Total Customer Orders') }}</small>
                                <span class="text-dark font-weight-bold">{{ $totalOrdersCount }}</span>
                            </div>
                        </div>
                        <div class="mb-15 d-flex align-items-center">
                            <span class="btn-sm btn-danger text-white rounded mr-10" style="padding: 4px 8px;"><i class="ti-money"></i></span>
                            <div>
                                <small class="text-muted d-block">{{ __('Total Sales Value') }}</small>
                                <span class="text-dark font-weight-bold">{{ single_price($totalOrderAmount) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Tabs and Listings -->
            <div class="col-lg-8 col-md-7">
                <div class="white-box p-30">
                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs justify-content-start mb-20 custom-tab-style" id="salesmanTabs" role="tablist" style="border-bottom: 2px solid #f1f3f9;">
                        <li class="nav-item">
                            <a class="nav-link active font-weight-bold" id="buyers-tab" data-toggle="tab" href="#buyers" role="tab" aria-controls="buyers" aria-selected="true" style="padding: 12px 20px; border: none; border-bottom: 3px solid transparent; color: #6c757d;">
                                <i class="ti-user mr-5"></i>{{ __('Buyers Mapped') }}
                                <span class="badge badge-pill badge-primary ml-5" style="background: #4f46e5;">{{ $totalCustomersCount }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false" style="padding: 12px 20px; border: none; border-bottom: 3px solid transparent; color: #6c757d;">
                                <i class="ti-shopping-cart mr-5"></i>{{ __('Total Orders') }}
                                <span class="badge badge-pill badge-success ml-5" style="background: #10b981;">{{ $totalOrdersCount }}</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="salesmanTabContent">
                        <!-- Tab 1: Buyers Mapped -->
                        <div class="tab-pane fade show active" id="buyers" role="tabpanel" aria-labelledby="buyers-tab">
                            <div class="QA_section QA_section_heading_custom check_box_table mt-10">
                                <div class="QA_table">
                                    <div class="table-responsive">
                                        <table class="table Crm_table_active3">
                                            <thead>
                                                <tr>
                                                    <th scope="col">{{ __('Store Name') }}</th>
                                                    <th scope="col">{{ __('Phone Number') }}</th>
                                                    <th scope="col" class="text-center">{{ __('Total Orders') }}</th>
                                                    <th scope="col" class="text-right">{{ __('Total Order Value') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($customers as $customer)
                                                <tr>
                                                    <td>
                                                        <strong class="text-dark">{{ $customer->store_name ?: $customer->name }}</strong>
                                                    </td>
                                                    <td>{{ $customer->phone ?: $customer->username }}</td>
                                                    <td class="text-center">
                                                        <span class="badge badge-pill badge-light text-dark font-weight-bold">{{ $customer->total_orders_count }}</span>
                                                    </td>
                                                    <td class="text-right font-weight-bold text-primary">
                                                        {{ single_price($customer->total_orders_value) }}
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted py-30">{{ __('No customers mapped to this salesman.') }}</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 2: Total Orders with Status Filters -->
                        <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                            <!-- Status Summary Cards -->
                            <div class="row mb-25 text-center">
                                <div class="col-lg-3 col-sm-6 mb-10">
                                    <div class="p-15 rounded" style="background: #ecfdf5; border-left: 4px solid #10b981;">
                                        <small class="text-success font-weight-bold d-block mb-5">{{ __('Completed') }}</small>
                                        <h4 class="mb-0 text-success font-weight-bold">{{ $completedOrders->count() }}</h4>
                                        <small class="text-muted">{{ single_price($completedOrders->sum('grand_total')) }}</small>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 mb-10">
                                    <div class="p-15 rounded" style="background: #fef2f2; border-left: 4px solid #ef4444;">
                                        <small class="text-danger font-weight-bold d-block mb-5">{{ __('Cancelled') }}</small>
                                        <h4 class="mb-0 text-danger font-weight-bold">{{ $cancelledOrders->count() }}</h4>
                                        <small class="text-muted">{{ single_price($cancelledOrders->sum('grand_total')) }}</small>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 mb-10">
                                    <div class="p-15 rounded" style="background: #fff7ed; border-left: 4px solid #f97316;">
                                        <small class="text-warning font-weight-bold d-block mb-5">{{ __('RTO') }}</small>
                                        <h4 class="mb-0 text-warning font-weight-bold">{{ $rtoOrders->count() }}</h4>
                                        <small class="text-muted">{{ single_price($rtoOrders->sum('grand_total')) }}</small>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 mb-10">
                                    <div class="p-15 rounded" style="background: #eff6ff; border-left: 4px solid #3b82f6;">
                                        <small class="text-primary font-weight-bold d-block mb-5">{{ __('Pending') }}</small>
                                        <h4 class="mb-0 text-primary font-weight-bold">{{ $pendingOrders->count() }}</h4>
                                        <small class="text-muted">{{ single_price($pendingOrders->sum('grand_total')) }}</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Inner Status Navigation -->
                            <ul class="nav nav-pills justify-content-start mb-20" id="orderStatusPills" role="tablist">
                                <li class="nav-item mr-10">
                                    <a class="nav-link active btn-sm" id="completed-pill" data-toggle="pill" href="#completed-orders" role="tab" aria-controls="completed-orders" aria-selected="true" style="border-radius: 20px; font-weight: 600;">
                                        {{ __('Completed') }} ({{ $completedOrders->count() }})
                                    </a>
                                </li>
                                <li class="nav-item mr-10">
                                    <a class="nav-link btn-sm" id="cancelled-pill" data-toggle="pill" href="#cancelled-orders" role="tab" aria-controls="cancelled-orders" aria-selected="false" style="border-radius: 20px; font-weight: 600;">
                                        {{ __('Cancelled') }} ({{ $cancelledOrders->count() }})
                                    </a>
                                </li>
                                <li class="nav-item mr-10">
                                    <a class="nav-link btn-sm" id="rto-pill" data-toggle="pill" href="#rto-orders" role="tab" aria-controls="rto-orders" aria-selected="false" style="border-radius: 20px; font-weight: 600;">
                                        {{ __('RTO') }} ({{ $rtoOrders->count() }})
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn-sm" id="pending-pill" data-toggle="pill" href="#pending-orders" role="tab" aria-controls="pending-orders" aria-selected="false" style="border-radius: 20px; font-weight: 600;">
                                        {{ __('Pending') }} ({{ $pendingOrders->count() }})
                                    </a>
                                </li>
                            </ul>

                            <!-- Inner Tab Content -->
                            <div class="tab-content" id="orderStatusPillsContent">
                                <!-- Completed -->
                                <div class="tab-pane fade show active" id="completed-orders" role="tabpanel" aria-labelledby="completed-pill">
                                    @include('backEnd.salesman.components.order_table', ['orders' => $completedOrders])
                                </div>

                                <!-- Cancelled -->
                                <div class="tab-pane fade" id="cancelled-orders" role="tabpanel" aria-labelledby="cancelled-pill">
                                    @include('backEnd.salesman.components.order_table', ['orders' => $cancelledOrders])
                                </div>

                                <!-- RTO -->
                                <div class="tab-pane fade" id="rto-orders" role="tabpanel" aria-labelledby="rto-pill">
                                    @include('backEnd.salesman.components.order_table', ['orders' => $rtoOrders])
                                </div>

                                <!-- Pending -->
                                <div class="tab-pane fade" id="pending-orders" role="tabpanel" aria-labelledby="pending-pill">
                                    @include('backEnd.salesman.components.order_table', ['orders' => $pendingOrders])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Custom Styles for active/hover states -->
<style>
    #salesmanTabs .nav-link.active {
        border-bottom: 3px solid #4f46e5 !important;
        color: #4f46e5 !important;
    }
    #salesmanTabs .nav-link:hover {
        color: #4f46e5 !important;
    }
    #orderStatusPills .nav-link {
        background: #f1f3f9;
        color: #4b5563;
    }
    #orderStatusPills .nav-link.active {
        background: #4f46e5 !important;
        color: #fff !important;
    }
</style>
@endsection
