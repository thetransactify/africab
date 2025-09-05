@extends('Admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
            <div class="row">
                <div class="col-12">
                    <h1>Dashboard Ecommerce</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">    
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
                <div class="col-lg-12 col-xl-12">
                    
                    <div class="row">
                        <div class="col-12 col-md-6 mb-5 order-md-2">
                            <div class="card">
                                <div class="position-absolute card-top-buttons">
                                    <button class="btn btn-header-light icon-button">
                                    <i class="simple-icon-refresh"></i></button>
                                </div>
                                <div class="card-body">
    <h5 class="card-title">Recent Orders</h5>
    <div class="scroll dashboard-list-with-thumbs">

        @foreach($orderlists as $order)
        <div class="row mb-2 py-md-3 align-items-center border-style-01">
            
            {{-- Date Box --}}
            <div class="col-md-auto col-3">
                <div class="card colorBox cal-card">
                    <p class="text-primary lead text-white font-weight-medium text-center p-2 mb-0">
                        {{ \Carbon\Carbon::parse($order['created_at'])->format('d') }}
                        <small class="text-small d-block">
                            {{ \Carbon\Carbon::parse($order['created_at'])->format('M') }}
                        </small>
                        <small class="text-small d-block">
                            {{ \Carbon\Carbon::parse($order['created_at'])->format('Y') }}
                        </small>
                    </p>
                </div>
            </div>

            {{-- Order Info --}}
            <div class="col-md-6 col-9">
                <a href="#">
                    <p class="list-item-heading mb-2 font-weight-bold">
                        {{ $order['order_number'] }}
                        <span class="badge badge-pill top-pos badge-theme-1 text-uppercase">
                            {{ $order['order_status'] }}
                        </span>
                    </p>
                    <p class="mb-1 text-small font-weight-bolder">
                        {{ $order['product_name'] }}
                    </p>
                    <p class="list-item-heading mb-0 font-weight-bold">
                        <small class="font-weight-bold">Tsh</small> {{ number_format($order['amount'], 2) }}
                    </p>
                    <div class="pr-4 d-block">
                        <p class="text-extra-small mb-0 line-height-2">
                            Ordered by - {{ $order['customer_name'] }}
                        </p>
                        <p class="text-extra-small mb-0 line-height-2">
                            Txn ID - {{ $order['order_group'] }}
                        </p>
                    </div>
                </a>
            </div>

            {{-- Actions --}}
            <div class="col-md-auto col-12 text-right">
                <a href="{{ route('Dashboard-Orders', $order['id']) }}" class="las la-pen btn btn-secondary mx-1 my-3" title="Manage Order"></a>
                <a href="" target="_blank" class="las la-print btn btn-secondary mx-1 my-3" title="Print Order"></a>
            </div>

        </div>
        @endforeach

    </div>
</div>
</div>

                        </div>
                            
                        <div class="col-12 col-md-6 mb-2 order-md-1">
                        <div class="row">
                        <div class="col-12 mb-3">
                        <div class="py-2 px-3">
                            <h4 class="mb-0 font-weight-bold">Sales Summary</h4>
                        </div>
                        </div>
                        </div>
                        <div class="row sortable">
                            <div class="col-6 col-md-4 mb-5">
                            <div class="card">
                            
                                <div class="card-body justify-content-between align-items-center">
                                    <p class="mb-1 font-weight-bold">New Orders</p>
                                    <h3 class="lead color-theme-1 mb-1 value">{{$newOrders}}</h3>
                                    
                                </div>
                            </div>
                            </div>
                            <div class="col-6 col-md-4 mb-5">
                            <div class="card">
                            
                                <div class="card-body justify-content-between align-items-center">
                                    <p class="mb-1 font-weight-bold">Pending Orders</p>
                                    <h3 class="lead color-theme-1 mb-1 value">{{$pendingOrders}}</h3>
                                    
                                </div>
                            </div>
                            </div>
                            <div class="col-12 col-md-4 mb-5">
                            <div class="card">
                            
                                <div class="card-body justify-content-between align-items-center">
                                    <p class="mb-1 font-weight-bold">Completed Orders</p>
                                    <h3 class="lead color-theme-1 mb-1 value">{{$completedOrders}}</h3>
                                    
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-12 mb-3">
                        <div class="py-2 px-3">
                            <h4 class="mb-0 font-weight-bold">Revenue Summary</h4>
                        </div>
                        </div>
                        </div>                      
                        <div class="row sortable">
                <div class="col-6 col-md-6 mb-5">
                    <div class="card">
                        
                        <div class="card-body justify-content-between align-items-center">
                        <p class="mb-1 font-weight-bold">Daily Sales</p>
                            <h3 class="lead color-theme-1 mb-1 value"><small class="font-weight-bold ">TsH</small>{{$dailySales}}</h3>
                            <p class="mb-0 font-weight-bold"><small class="d-block">* Resets daily.</small></p>
                            
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6 mb-5">
                    <div class="card">
                        
                        <div class="card-body justify-content-between align-items-center">
                            <p class="mb-1 font-weight-bold">Monthly Sales</p>
                            <h3 class="lead color-theme-1 mb-1 value"><small class="font-weight-bold ">TsH</small>{{$monthlySales}}</h3>
                            <p class="mb-0 font-weight-bold"><small class="d-block"></small></p>
                            
                        </div>
                    </div>
                </div>                
                <div class="col-12 mb-5">
                    <div class="card">
                        
                        <div class="card-body justify-content-between align-items-center">
                            <p class="mb-1 font-weight-bold">Total Sales Value</p>
                            <h3 class="lead color-theme-1 mb-1 value"><small class="font-weight-bold ">TsH</small>{{$totalSales}}</h3>
                            <p class="mb-0 font-weight-bold"><small class="d-block">Aggretated Value of all Completed Orders</small></p>
                            
                        </div>
                    </div>
                </div>
                                
                
            </div>
                        </div>
                            
                            </div>
                            
                <div class="row">
                
                <div class="col-12 col-md-9 mb-5">
                            <div class="card">
                                
                                <div class="card-body">
                                    <h5 class="card-title">New Registration</h5>
                                    <div class="table-responsive">
                                    <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Contact</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($todayNewUserslist as $user)    
                                    <tr>
                                        <th scope="row">{{ $user->name }}</th>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->mobile }}</td>
                                     @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No new users this month</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                                </div>
                                    </div>
                            </div></div>
                            <div class="col-12 col-md-3 mb-5">
                            
                            <div class="row sortable">
                            <div class="col-12 mb-5">
                            <div class="card">
                            
                                <div class="card-body justify-content-between align-items-center">
                                    <p class="mb-1 font-weight-bold">Daily New Registration</p>
                                    <h3 class="lead color-theme-1 mb-1 value">{{$todayNewUsers}}</h3>
                                    
                                </div>
                            </div>
                            </div>
                            <div class="col-12 mb-5">
                            <div class="card">
                            
                                <div class="card-body justify-content-between align-items-center">
                                    <p class="mb-1 font-weight-bold">Monthly New Users</p>
                                    <h3 class="lead color-theme-1 mb-1 value">{{$monthlyNewUsers}}</h3>
                                    
                                </div>
                            </div>
                            </div>
                            <div class="col-12 mb-5">
                            <div class="card">
                            
                                <div class="card-body justify-content-between align-items-center">
                                    <p class="mb-1 font-weight-bold">Total Users</p>
                                    <h3 class="lead color-theme-1 mb-1 value">{{$totalUsers}}</h3>
                                    
                                </div>
                            </div>
                            </div>
                            
                        </div>
                            
                            </div>
                
                </div>              
                </div>
                
            </div>
@endsection
