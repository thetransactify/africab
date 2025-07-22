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
                                        <div class="row mb-2 py-md-3 align-items-center border-style-01">
                                            <div class="col-md-auto col-3">
                                            <div class="card colorBox cal-card">
                                            <p class="text-primary lead text-white font-weight-medium text-center p-2 mb-0">09<small class="text-small d-block">June</small><small class="text-small d-block">2021</small></p>
                                            
                                            </div>
                                            </div>
                                            <div class="col-md-6 col-9">
                                                <a href="#">
                                                <p class="list-item-heading mb-2 font-weight-bold">HBT5000<span class="badge badge-pill top-pos badge-theme-1 text-uppercase">New</span></p>
                                                <p class="mb-1 text-small font-weight-bolder">Lime and Mint Mojito 750ml and more</p>
                                                <p class="list-item-heading mb-0 font-weight-bold"><small class="font-weight-bold ">TsH</small> 855.00</p>
                                                <div class="pr-4 d-block">
                                                    <p class="text-extra-small mb-0 line-height-2">Orderd by - John Smith</p>
                                                    <p class="text-extra-small mb-0 line-height-2">Txn ID - 5e57984b0cf79d47aa6d</p>
                                                </div>
                                                
                                                </a>
                                                </div>
                                                <div class="col-md-auto col-12 text-right">
                                                    <a href="Dashboard.Orders.Details.html" class="las la-pen btn btn-secondary mx-1 my-3" title="Manage Order"></a>
                                                    <a href="Pages.Misc.Invoice.Standalone.html" target="_blank" class="las la-print btn btn-secondary mx-1 my-3" title="Print Order"></a>
                                                </div>
                                            </div>
                                    <div class="row mb-2 py-md-3 align-items-center border-style-01">
                                            <div class="col-md-auto col-3">
                                            <div class="card colorBox cal-card">
                                            <p class="text-primary lead text-white font-weight-medium text-center p-2 mb-0">09<small class="text-small d-block">June</small><small class="text-small d-block">2021</small></p>
                                            </div>
                                            </div>
                                            <div class="col-md-6 col-9">
                                                <a href="#">
                                                <p class="list-item-heading mb-2 font-weight-bold">HBT4999<span class="badge badge-pill top-pos badge-theme-1 text-uppercase">Packed</span></p>
                                                <p class="mb-1 text-small font-weight-bolder">Lime and Mint Mojito 750ml and more</p>
                                                <p class="list-item-heading mb-0 font-weight-bold"><small class="font-weight-bold ">TsH</small> 780.00</p>
                                                <div class="pr-4 d-block">
                                                    <p class="text-extra-small mb-0 line-height-2">Orderd by - John Smith</p>
                                                    <p class="text-extra-small mb-0 line-height-2">Txn ID - 5e57984b0cf79d47aa6d</p>
                                                </div>
                                                
                                                </a>
                                                </div>
                                                <div class="col-md-auto col-12 text-right">
                                                    <a href="Dashboard.Orders.Details.html" class="las la-pen btn btn-secondary mx-1 my-3" title="Manage Order"></a>
                                                    <a href="Pages.Misc.Invoice.Standalone.html" target="_blank" class="las la-print btn btn-secondary mx-1 my-3" title="Print Order"></a>
                                                </div>
                                            </div>  
                                    <div class="row mb-2 py-md-3 align-items-center border-style-01">
                                            <div class="col-md-auto col-3">
                                            <div class="card colorBox cal-card">
                                            <p class="text-primary lead text-white font-weight-medium text-center p-2 mb-0">09<small class="text-small d-block">June</small><small class="text-small d-block">2021</small></p>
                                            </div>
                                            </div>
                                            <div class="col-md-6 col-9">
                                                <a href="#">
                                                <p class="list-item-heading mb-2 font-weight-bold">HBT4998<span class="badge badge-pill top-pos badge-theme-1 text-uppercase">Shipped</span></p>
                                                <p class="mb-1 text-small font-weight-bolder">Lime and Mint Mojito 750ml and more</p>
                                                <p class="list-item-heading mb-0 font-weight-bold"><small class="font-weight-bold ">TsH</small> 975.00</p>
                                                <div class="pr-4 d-block">
                                                    <p class="text-extra-small mb-0 line-height-2">Orderd by - John Smith</p>
                                                    <p class="text-extra-small mb-0 line-height-2">Txn ID - 5e57984b0cf79d47aa6d</p>
                                                </div>
                                                
                                                </a>
                                                </div>
                                                <div class="col-md-auto col-12 text-right">
                                                    <a href="Dashboard.Orders.Details.html" class="las la-pen btn btn-secondary mx-1 my-3" title="Manage Order"></a>
                                                    <a href="Pages.Misc.Invoice.Standalone.html" target="_blank" class="las la-print btn btn-secondary mx-1 my-3" title="Print Order"></a>
                                                </div>
                                            </div>                                      
                                    <div class="row mb-2 py-md-3 align-items-center border-style-01">
                                            <div class="col-md-auto col-3">
                                            <div class="card colorBox cal-card">
                                            <p class="text-primary lead text-white font-weight-medium text-center p-2 mb-0">09<small class="text-small d-block">June</small><small class="text-small d-block">2021</small></p>
                                            </div>
                                            </div>
                                            <div class="col-md-6 col-9">
                                                <a href="#">
                                                <p class="list-item-heading mb-2 font-weight-bold">HBT4997<span class="badge badge-pill top-pos badge-theme-1 text-uppercase">Delivered</span></p>
                                                <p class="mb-1 text-small font-weight-bolder">Lime and Mint Mojito 750ml and more</p>
                                                <p class="list-item-heading mb-0 font-weight-bold"><small class="font-weight-bold ">TsH</small> 700.00</p>
                                                <div class="pr-4 d-block">
                                                    <p class="text-extra-small mb-0 line-height-2">Orderd by - John Smith</p>
                                                    <p class="text-extra-small mb-0 line-height-2">Txn ID - 5e57984b0cf79d47aa6d</p>
                                                </div>
                                                
                                                </a>
                                                </div>
                                                <div class="col-md-auto col-12 text-right">
                                                    <a href="Dashboard.Orders.Details.html" class="las la-pen btn btn-secondary mx-1 my-3" title="Manage Order"></a>
                                                    <a href="Pages.Misc.Invoice.Standalone.html" target="_blank" class="las la-print btn btn-secondary mx-1 my-3" title="Print Order"></a>
                                                </div>
                                            </div>                                      
                                        <div class="row mb-2 py-md-3 align-items-center border-style-01">
                                            <div class="col-md-auto col-3">
                                            <div class="card colorBox cal-card">
                                            <p class="text-primary lead text-white font-weight-medium text-center p-2 mb-0">09<small class="text-small d-block">June</small><small class="text-small d-block">2021</small></p>
                                            </div>
                                            </div>
                                            <div class="col-md-6 col-9">
                                                <a href="#">
                                                <p class="list-item-heading mb-0 font-weight-bold">HBT4996<span class="badge badge-pill top-pos badge-theme-1 text-uppercase">Delivered</span></p>
                                                <p class="mb-1 text-small font-weight-bolder">Lime and Mint Mojito 750ml and more</p>
                                                <p class="list-item-heading mb-0 font-weight-bold"><small class="font-weight-bold ">TsH</small> 700.00</p>
                                                <div class="pr-4 d-block">
                                                    <p class="text-extra-small mb-0 line-height-2">Orderd by - John Smith</p>
                                                    <p class="text-extra-small mb-0 line-height-2">Txn ID - 5e57984b0cf79d47aa6d</p>
                                                </div>
                                                
                                                </a>
                                                </div>
                                                <div class="col-md-auto col-12 text-right">
                                                    <a href="Dashboard.Orders.Details.html" class="las la-pen btn btn-secondary mx-1 my-3" title="Manage Order"></a>
                                                    <a href="Pages.Misc.Invoice.Standalone.html" target="_blank" class="las la-print btn btn-secondary mx-1 my-3" title="Print Order"></a>
                                                </div>
                                            </div>                                      
                                            <div class="row mb-2 py-md-3 align-items-center border-style-01">
                                            <div class="col-md-auto col-3">
                                            <div class="card colorBox cal-card">
                                            <p class="text-primary lead text-white font-weight-medium text-center p-2 mb-0">09<small class="text-small d-block">June</small><small class="text-small d-block">2021</small></p>
                                            </div>
                                            </div>
                                            <div class="col-md-6 col-9">
                                                <a href="#">
                                                <p class="list-item-heading mb-0 font-weight-bold">HBT4995<span class="badge badge-pill top-pos badge-theme-1 text-uppercase">Delivered</span></p>
                                                <p class="mb-1 text-small font-weight-bolder">Lime and Mint Mojito 750ml and more</p>
                                                <p class="list-item-heading mb-0 font-weight-bold"><small class="font-weight-bold ">TsH</small> 700.00</p>
                                                <div class="pr-4 d-block">
                                                    <p class="text-extra-small mb-0 line-height-2">Orderd by - John Smith</p>
                                                    <p class="text-extra-small mb-0 line-height-2">Txn ID - 5e57984b0cf79d47aa6d</p>
                                                </div>
                                                
                                                </a>
                                                </div>
                                                <div class="col-md-auto col-12 text-right">
                                                    <a href="Dashboard.Orders.Details.html" class="las la-pen btn btn-secondary mx-1 my-3" title="Manage Order"></a>
                                                    <a href="Pages.Misc.Invoice.Standalone.html" target="_blank" class="las la-print btn btn-secondary mx-1 my-3" title="Print Order"></a>
                                                </div>
                                            </div>
                                            <div class="row mb-2 py-md-3 align-items-center border-style-01">
                                            <div class="col-md-auto col-3">
                                            <div class="card colorBox cal-card">
                                            <p class="text-primary lead text-white font-weight-medium text-center p-2 mb-0">09<small class="text-small d-block">June</small><small class="text-small d-block">2021</small></p>
                                            </div>
                                            </div>
                                            <div class="col-md-6 col-9">
                                                <a href="#">
                                                <p class="list-item-heading mb-0 font-weight-bold">HBT4995<span class="badge badge-pill top-pos badge-theme-1 text-uppercase">Delivered</span></p>
                                                <p class="mb-1 text-small font-weight-bolder">Lime and Mint Mojito 750ml and more</p>
                                                <p class="list-item-heading mb-0 font-weight-bold"><small class="font-weight-bold ">TsH</small> 700.00</p>
                                                <div class="pr-4 d-block">
                                                    <p class="text-extra-small mb-0 line-height-2">Orderd by - John Smith</p>
                                                    <p class="text-extra-small mb-0 line-height-2">Txn ID - 5e57984b0cf79d47aa6d</p>
                                                </div>
                                                
                                                </a>
                                                </div>
                                                <div class="col-md-auto col-12 text-right">
                                                    <a href="Dashboard.Orders.Details.html" class="las la-pen btn btn-secondary mx-1 my-3" title="Manage Order"></a>
                                                    <a href="Pages.Misc.Invoice.Standalone.html" target="_blank" class="las la-print btn btn-secondary mx-1 my-3" title="Print Order"></a>
                                                </div>
                                            </div>
                                            <div class="row mb-2 py-md-3 align-items-center border-style-01">
                                            <div class="col-md-auto col-3">
                                            <div class="card colorBox cal-card">
                                            <p class="text-primary lead text-white font-weight-medium text-center p-2 mb-0">09<small class="text-small d-block">June</small><small class="text-small d-block">2021</small></p>
                                            </div>
                                            </div>
                                            <div class="col-md-6 col-9">
                                                <a href="#">
                                                <p class="list-item-heading mb-0 font-weight-bold">HBT49964<span class="badge badge-pill top-pos badge-theme-1 text-uppercase">Delivered</span></p>
                                                <p class="mb-1 text-small font-weight-bolder">Lime and Mint Mojito 750ml and more</p>
                                                <p class="list-item-heading mb-0 font-weight-bold"><small class="font-weight-bold ">TsH</small> 700.00</p>
                                                <div class="pr-4 d-block">
                                                    <p class="text-extra-small mb-0 line-height-2">Orderd by - John Smith</p>
                                                    <p class="text-extra-small mb-0 line-height-2">Txn ID - 5e57984b0cf79d47aa6d</p>
                                                </div>
                                                
                                                </a>
                                                </div>
                                                <div class="col-md-auto col-12 text-right">
                                                    <a href="Dashboard.Orders.Details.html" class="las la-pen btn btn-secondary mx-1 my-3" title="Manage Order"></a>
                                                    <a href="Pages.Misc.Invoice.Standalone.html" target="_blank" class="las la-print btn btn-secondary mx-1 my-3" title="Print Order"></a>
                                                </div>
                                            </div>
                                            <div class="row mb-2 py-md-3 align-items-center border-style-01">
                                            <div class="col-md-auto col-3">
                                            <div class="card colorBox cal-card">
                                            <p class="text-primary lead text-white font-weight-medium text-center p-2 mb-0">09<small class="text-small d-block">June</small><small class="text-small d-block">2021</small></p>
                                            </div>
                                            </div>
                                            <div class="col-md-6 col-9">
                                                <a href="#">
                                                <p class="list-item-heading mb-0 font-weight-bold">HBT4993<span class="badge badge-pill top-pos badge-theme-1 text-uppercase">Delivered</span></p>
                                                <p class="mb-1 text-small font-weight-bolder">Lime and Mint Mojito 750ml and more</p>
                                                <p class="list-item-heading mb-0 font-weight-bold"><small class="font-weight-bold ">TsH</small> 700.00</p>
                                                <div class="pr-4 d-block">
                                                    <p class="text-extra-small mb-0 line-height-2">Orderd by - John Smith</p>
                                                    <p class="text-extra-small mb-0 line-height-2">Txn ID - 5e57984b0cf79d47aa6d</p>
                                                </div>
                                                
                                                </a>
                                                </div>
                                                <div class="col-md-auto col-12 text-right">
                                                    <a href="Dashboard.Orders.Details.html" class="las la-pen btn btn-secondary mx-1 my-3" title="Manage Order"></a>
                                                    <a href="Pages.Misc.Invoice.Standalone.html" target="_blank" class="las la-print btn btn-secondary mx-1 my-3" title="Print Order"></a>
                                                </div>
                                            </div>
                                            <div class="row mb-2 py-md-3 align-items-center border-style-01">
                                            <div class="col-md-auto col-3">
                                            <div class="card colorBox cal-card">
                                            <p class="text-primary lead text-white font-weight-medium text-center p-2 mb-0">09<small class="text-small d-block">June</small><small class="text-small d-block">2021</small></p>
                                            </div>
                                            </div>
                                            <div class="col-md-6 col-9">
                                                <a href="#">
                                                <p class="list-item-heading mb-0 font-weight-bold">HBT4992<span class="badge badge-pill top-pos badge-theme-1 text-uppercase">Delivered</span></p>
                                                <p class="mb-1 text-small font-weight-bolder">Lime and Mint Mojito 750ml and more</p>
                                                <p class="list-item-heading mb-0 font-weight-bold"><small class="font-weight-bold ">TsH</small> 700.00</p>
                                                <div class="pr-4 d-block">
                                                    <p class="text-extra-small mb-0 line-height-2">Orderd by - John Smith</p>
                                                    <p class="text-extra-small mb-0 line-height-2">Txn ID - 5e57984b0cf79d47aa6d</p>
                                                </div>
                                                
                                                </a>
                                                </div>
                                                <div class="col-md-auto col-12 text-right">
                                                    <a href="Dashboard.Orders.Details.html" class="las la-pen btn btn-secondary mx-1 my-3" title="Manage Order"></a>
                                                    <a href="Pages.Misc.Invoice.Standalone.html" target="_blank" class="las la-print btn btn-secondary mx-1 my-3" title="Print Order"></a>
                                                </div>
                                            </div>
                                            <div class="row mb-2 py-md-3 align-items-center border-style-01">
                                            <div class="col-md-auto col-3">
                                            <div class="card colorBox cal-card">
                                            <p class="text-primary lead text-white font-weight-medium text-center p-2 mb-0">09<small class="text-small d-block">June</small><small class="text-small d-block">2021</small></p>
                                            </div>
                                            </div>
                                            <div class="col-md-6 col-9">
                                                <a href="#">
                                                <p class="list-item-heading mb-0 font-weight-bold">HBT4991<span class="badge badge-pill top-pos badge-theme-1 text-uppercase">Delivered</span></p>
                                                <p class="mb-1 text-small font-weight-bolder">Lime and Mint Mojito 750ml and more</p>
                                                <p class="list-item-heading mb-0 font-weight-bold"><small class="font-weight-bold ">TsH</small> 700.00</p>
                                                <div class="pr-4 d-block">
                                                    <p class="text-extra-small mb-0 line-height-2">Orderd by - John Smith</p>
                                                    <p class="text-extra-small mb-0 line-height-2">Txn ID - 5e57984b0cf79d47aa6d</p>
                                                </div>
                                                
                                                </a>
                                                </div>
                                                <div class="col-md-auto col-12 text-right">
                                                    <a href="Dashboard.Orders.Details.html" class="las la-pen btn btn-secondary mx-1 my-3" title="Manage Order"></a>
                                                    <a href="Pages.Misc.Invoice.Standalone.html" target="_blank" class="las la-print btn btn-secondary mx-1 my-3" title="Print Order"></a>
                                                </div>
                                            </div>
                                            
                                        
                                        </div></div>
                            </div></div>
                            
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
                                    <h3 class="lead color-theme-1 mb-1 value">9</h3>
                                    
                                </div>
                            </div>
                            </div>
                            <div class="col-6 col-md-4 mb-5">
                            <div class="card">
                            
                                <div class="card-body justify-content-between align-items-center">
                                    <p class="mb-1 font-weight-bold">Pending Orders</p>
                                    <h3 class="lead color-theme-1 mb-1 value">19</h3>
                                    
                                </div>
                            </div>
                            </div>
                            <div class="col-12 col-md-4 mb-5">
                            <div class="card">
                            
                                <div class="card-body justify-content-between align-items-center">
                                    <p class="mb-1 font-weight-bold">Completed Orders</p>
                                    <h3 class="lead color-theme-1 mb-1 value">219</h3>
                                    
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
                            <h3 class="lead color-theme-1 mb-1 value"><small class="font-weight-bold ">TsH</small>1,610</h3>
                            <p class="mb-0 font-weight-bold"><small class="d-block">* Resets daily.</small></p>
                            
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6 mb-5">
                    <div class="card">
                        
                        <div class="card-body justify-content-between align-items-center">
                            <p class="mb-1 font-weight-bold">Monthly Sales</p>
                            <h3 class="lead color-theme-1 mb-1 value"><small class="font-weight-bold ">TsH</small>31,610</h3>
                            <p class="mb-0 font-weight-bold"><small class="d-block">For the Month of June 2020</small></p>
                            
                        </div>
                    </div>
                </div>                
                <div class="col-12 mb-5">
                    <div class="card">
                        
                        <div class="card-body justify-content-between align-items-center">
                            <p class="mb-1 font-weight-bold">Total Sales Value</p>
                            <h3 class="lead color-theme-1 mb-1 value"><small class="font-weight-bold ">TsH</small>12,31,610</h3>
                            <p class="mb-0 font-weight-bold"><small class="d-block">Aggretated Value of all Pending & Completed Orders</small></p>
                            
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
                                        <th scope="col">View Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Sriram V</th>
                                        <td>vsriram803@gmail.com</td>
                                        <td>9790847467</td>
                                        <td><a href="javascript:void(0)" data-toggle="modal" data-target="#customerDetails" class="las la-eye btn btn-secondary mx-1"></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Rishab Sharma</th>
                                        <td>rishab@rishabsharma.in</td>
                                        <td>9999020548</td>
                                        <td><a href="javascript:void(0)" data-toggle="modal" data-target="#customerDetails" class="las la-eye btn btn-secondary mx-1"></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Akhil</th>
                                        <td>akhilnayak93@gmail.com</td>
                                        <td>9480723193</td>
                                        <td><a href="javascript:void(0)" data-toggle="modal" data-target="#customerDetails" class="las la-eye btn btn-secondary mx-1"></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Sriram V</th>
                                        <td>vsriram803@gmail.com</td>
                                        <td>9790847467</td>
                                        <td><a href="javascript:void(0)" data-toggle="modal" data-target="#customerDetails" class="las la-eye btn btn-secondary mx-1"></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Rishab Sharma</th>
                                        <td>rishab@rishabsharma.in</td>
                                        <td>9999020548</td>
                                        <td><a href="javascript:void(0)" data-toggle="modal" data-target="#customerDetails" class="las la-eye btn btn-secondary mx-1"></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Akhil</th>
                                        <td>akhilnayak93@gmail.com</td>
                                        <td>9480723193</td>
                                        <td><a href="javascript:void(0)" data-toggle="modal" data-target="#customerDetails" class="las la-eye btn btn-secondary mx-1"></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Sriram V</th>
                                        <td>vsriram803@gmail.com</td>
                                        <td>9790847467</td>
                                        <td><a href="javascript:void(0)" data-toggle="modal" data-target="#customerDetails" class="las la-eye btn btn-secondary mx-1"></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Rishab Sharma</th>
                                        <td>rishab@rishabsharma.in</td>
                                        <td>9999020548</td>
                                        <td><a href="javascript:void(0)" data-toggle="modal" data-target="#customerDetails" class="las la-eye btn btn-secondary mx-1"></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Akhil</th>
                                        <td>akhilnayak93@gmail.com</td>
                                        <td>9480723193</td>
                                        <td><a href="javascript:void(0)" data-toggle="modal" data-target="#customerDetails" class="las la-eye btn btn-secondary mx-1"></a></td>
                                    </tr>
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
                                    <h3 class="lead color-theme-1 mb-1 value">12</h3>
                                    
                                </div>
                            </div>
                            </div>
                            <div class="col-12 mb-5">
                            <div class="card">
                            
                                <div class="card-body justify-content-between align-items-center">
                                    <p class="mb-1 font-weight-bold">Monthly New Users</p>
                                    <h3 class="lead color-theme-1 mb-1 value">81</h3>
                                    
                                </div>
                            </div>
                            </div>
                            <div class="col-12 mb-5">
                            <div class="card">
                            
                                <div class="card-body justify-content-between align-items-center">
                                    <p class="mb-1 font-weight-bold">Total Users</p>
                                    <h3 class="lead color-theme-1 mb-1 value">2796</h3>
                                    
                                </div>
                            </div>
                            </div>
                            
                        </div>
                            
                            </div>
                
                </div>              
                </div>
                
            </div>
@endsection
