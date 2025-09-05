@extends('Admin.layouts.app')
@section('title', 'Orders')
@section('content')
            <div class="row">
                <div class="col-12">
                    <h1>Order Management</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">    
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
                <div class="col-12 mb-4">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
							<table class="data-table data-table-orders">
							<thead>
                                    <tr>
                                        <th>Order No.</th>
										<th>Order Date</th>
										<th>Customer Name</th>
										<th>Amount</th>
										<th>Txn. ID</th>
										<th>Status</th>
										<th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($ordergroups as $order)
                                    <tr>
                                        <td><a href="{{ route('Dashboard-Orders', $order['order_group']) }}" data-toggle="modal" data-target="#orderDetails" title="Manage Order" title="Go to Order">{{ $order['order_group'] }}</a></td>
                                        <td>{{ $order['created_at'] }}</td>
                                        <td>{{ $order['customer_name'] }}</td>
                                        <td><small class="font-weight-bold ">TsH</small>{{ number_format($order['amount'], 2) }}</td>
                                        <td>{{ $order['txn_id'] }}</td>
                                        <td>{{ $order['order_status'] }}</td>
                                        <td>
                                        <a href="{{ route('Dashboard-Orders', $order['id']) }}"  class="las la-eye btn btn-secondary mx-1 my-3" title="Manage Order"></a>
                                        <a href="Pages.Misc.Invoice.Standalone.html" target="_blank" class="las la-print btn btn-secondary mx-1 my-3" title="Print Order"></a></td>
                                    </tr>
                                @endforeach                                      
								</tbody>
							</table>
							</div>
							</div></div></div>
                
            </div>
<!-- Order Details Modal -->

<div class="modal fade bd-example-modal-lg" id="orderDetails" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Order Summary</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                     <div class="row">
            <div class="col-md-6 col-12">
                <div class="card mb-4 colorBox">
                    <div class="card-body">
                        <h3 class="text-white font-weight-bolder">Order ID: HBT5000</h3>
                        <p class="text-small text-white mb-2">Date: 09/04/2020</p>
                        <p class="text-small text-white mb-2">Txn ID: t5bj8eu98oqn4e5wrkd</p>
                        <p class="text-small text-white mb-2">Shipping Method: Standard Shipping Free</p>
                        <p class="text-small text-white mb-2"><b>Order Status:</b> New</p>
                        <a href="Dashboard.Orders.Details.html" class="btn btn-primary mb-1 mt-1 float-right">Manage Order</a>

                        
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="font-weight-bold">Customer Details</h5>
                        <p class="text-small line-height-2 mb-1"><b>John Doe Smith</b><br>P.O. Box 1234, Chesterfield, New York - 123456, United States</p>
                        <p class="text-small line-height-2 mb-1"><b>Mobile Number:</b> +91-9800000000<br>
                        <b>Email Address :</b> john.smith@gmail.com</p>
                        <a href="Pages.Misc.Invoice.Standalone.html" target="_blank" class="btn btn-secondary mt-1 float-right">Print Invoice</a>
                        <div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="font-weight-bold">Ordered Items</h5>
                        <div class="separator mb-0"></div>
                        <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product Details</th>
                                    <th scope="col">Qty.</th>
                                    <th scope="col">Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Irish Coffee 150ml</td>
                                    <td>1</td>
                                    <td><small class="font-weight-bold ">TsH</small>185.00</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Vanilla Fruit Twist 750ml</td>
                                    <td>1</td>
                                    <td><small class="font-weight-bold ">TsH</small>185.00</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Litchi Crush 750 ml</td>
                                    <td>2</td>
                                    <td><small class="font-weight-bold ">TsH</small>320.00</td>
                                </tr>
                            </tbody>
                            <tfoot class="thead-light">
                                <tr>
                                    <td scope="col" class="text-left font-weight-bolder"></td>
                                    <td colspan="2" scope="col" class="text-left font-weight-bolder">Shipping Rate</td>
                                    <td scope="col"><small class="font-weight-bold ">TsH</small>300.00</td >
                                </tr>
                                <tr>
                                    <td colspan="3" scope="col" class="text-right font-weight-bolder">Grand Total</td>
                                    <td scope="col"><small class="font-weight-bold ">TsH</small>990.00</td >
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                        <a href="Dashboard.Orders.Details.html" class="btn btn-secondary mb-1 mt-1 float-right">Manage Order</a>
                    </div>
                </div>
            </div>              
        </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection