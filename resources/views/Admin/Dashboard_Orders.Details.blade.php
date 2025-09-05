@extends('Admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
            <div class="row">
                <div class="col-12">
                    <h1>Order Management</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="Dashboard.Orders.html">Back to Orders</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div> 
            </div>
<div class="row">
                <div class="col-md-4 col-12">
                    <div class="card mb-5 colorBox">
                        <div class="card-body">
                            <h3 class="text-white font-weight-bolder">Order ID: HBT5000</h3>
                            <p class="text-small text-white mb-2"><b>Date:</b> 09/04/2020</p>
                            <p class="text-small text-white mb-2"><b>Txn ID:</b> 28bfc8461ccee944b83b</p>
                            <p class="text-small text-white mb-2"><b>Shipping Method:</b> Standard Shipping Free</p>
                            <p class="text-small text-white mb-2"><b>Order Status:</b> New</p>
                            <a href="javascript:void(0);" data-toggle="modal" data-backdrop="static" data-target="#orderUpdates" class="btn btn-primary mb-1 mt-1 float-right">Manage Updates</a> 
                        </div>
                    </div>
                    <div class="card mb-5">
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
                <div class="col-md-8 col-12">
                    <div class="card mb-5">
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
                            <div class="d-block text-right">
                            <a href="javascript:void(0);" data-toggle="modal" data-backdrop="static" data-target="#orderUpdates" class="btn btn-secondary m-1">Manage Updates</a>
                            <a href="Pages.Misc.Invoice.Standalone.html" target="_blank" class="btn btn-secondary m-1">Print Invoice</a>
                            </div>
                        </div>
                    </div> 
                    <div class="card mb-5">
                        <div class="card-body">
                            <h5 class="font-weight-bold">Update Log</h5>
                            <div class="separator mb-0"></div>
                            <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">09/04/2020</td>
                                        <td>New</td>
                                        <td>We have recieved your order. One of our representative will contact you soon to confirm the order.</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">09/04/2020</td>
                                        <td>Approved</td>
                                        <td>Your order has been approved. We request you to check your email for payment information.</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">09/04/2020</td>
                                        <td>Processing</td>
                                        <td>We have started the production of your order.</td>
                                    </tr>
                                </tbody>
                                
                            </table>
                            </div>
                        </div>
                    </div>               
                </div>  
            
            </div>
@endsection
