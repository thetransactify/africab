@extends('layout.app')
@section('title', 'Order History')
@section('content')
<div class="content-area">
<!-- Banner Area -->
<div class="page-headers smaller">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-6 col-12">
				<h1>My Account</h1>
			</div>
			<div class="col-md-6 col-12">
				<ul class="ph-breadcrumbs-list">
					<li><a href="{{url('/index')}}">Home</a></li>
					<li><a href="{{url('/my-account')}}" class="active">My Account</a></li>
				</ul>	
			</div>			
			
		</div>
	</div>
	
</div>

<!-- Acounts Page -->

<div class="account-pages">
	<div class="container">
	<div class="row justify-content-center align-items-start">
				<div class="col-12">
				<div class="dashboard-top">
				@include('dashboard-header')
				</div>
				</div>
				</div>
				<div class="row justify-content-center align-items-start">
				<div class="col-lg-2 col-md-2 col-12">
				@include('dashboard-menu')
				</div>
				<div class="col-lg-8 col-md-10 col-12">
				<div class="dashboard-tab">
				<div class="main-title py-3 pt-2">
					<h4>Order <span class="">History</span></h4>
				</div>
				<div class="container-fluid div-tables dash-dt mb-0">
										 <div class="row dt-row dt-head align-items-center">
										 	<div class="col-lg-2 col-sm-3 dt-col">
										 	Date
										 	</div>
										 	<div class="col-lg-3 col-sm-2 dt-col">
										 	Order ID
										 	</div>
										 	<div class="col-lg-3 col-sm-3 dt-col">
										 	Status
										 	</div>
										 	<div class="col-lg-4 col-sm-4 dt-col">
										 	Payment status	
										 	</div>
										 	<div class="col-lg-4 col-sm-4 dt-col">
										    </div>		
										 </div>
									@foreach($Orderhistory as $list)	 
										 <div class="row dt-row dt-body align-items-center">
										 	<div class="col-lg-2 col-sm-3 dt-col">
										 	{{$list['order_date']}}
										 	</div>
										 	<div class="col-lg-3 col-sm-2 dt-col">
										 	{{$list['order_number']}}
										 	</div>
										 	<div class="col-lg-3 col-sm-3 dt-col">
										 	{{$list['order_status']}}
										 	</div>
										 	<div class="col-lg-3 col-sm-3 dt-col">
										 	{{$list['payment']}}
										 	</div>
										 	<div class="col-lg-4 col-sm-4 dt-col">
												<ul class="general-button-list small-v no-text blackbutton my-0">
												<li class=""><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#odmwindow" data-id="{{ $list['id'] }}"><i class="material-symbols-outlined">open_in_new</i>Details</a></li>
												<li class=""><a href="bill-sample.pdf" target="_blank"><i class="material-symbols-outlined">print</i>Print</a></li>
												</ul>
										 	</div>	
										 	
										 </div>
									@endforeach	 		 
								</div>
				            </div>
			            </div>
		            </div>
				</div>
            </div>
        </div>
@endsection
<!-- Order Details Modal Start odmwindow -->    
<!-- =================================================================================================== -->

<div class="modal fade" id="odmwindow" tabindex="-1" aria-labelledby="odmwindowLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      
      <div class="modal-body">
      	<div class="row align-items-center">
           <div class="col-12">
			<a class="close-icon"href="javascript:void(0);" data-bs-dismiss="modal"><i class="la la-times"></i></a>
			<h4><i class="material-symbols-outlined">receipt_long</i>Order <span>Details</span></h4>
		</div>
		</div>
		<div class="row">
           <div class="col-12">
           <div class="dashboard-tab">
				<div class="row">
				<div class="col-md-4 col-12">
				<h5>Order Date:<span>22-08-2022</span></h5>
				</div>
				<div class="col-md-4 col-12">
				<h5>Order No:<span>1615141312111009</span></h5>
				</div>
				<div class="col-md-4 col-12">
				<h5>Order Status:<span>Shipped</span></h5>
				</div>
				<div class="col-md-4 col-12">
				<h5>Payment Type:<span>Online - RazorPay</span></h5>
				</div>
				<div class="col-md-4 col-12">
				<h5>Txn ID:<span>d0b855c2dd4f752c13d2</span></h5>
				</div>
				</div>
				<p>Your order for Colored Shaped Product Name and 1 other items</p>
				<div class="table-responsive">
									<table class="table order-meta-table">
										<thead>
											<tr>
												<th>Date</th>
												<th>Status</th>
												<th>Description</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>22-08-2022</td>
												<td>Processing</td>
												<td>Your order has being recieved.</td>
											</tr>
											<tr>
												<td>22-08-2022</td>
												<td>Packed</td>
												<td>Your order has been packed and ready to be shipped.</td>
											</tr>
											<tr>
												<td>22-08-2022</td>
												<td>Shipped</td>
												<td>Your order has been shipped. Your AWB No. 12345679890</td>
											</tr>
										</tbody>
									</table></div>
				<div class="modal-footer">
      <a href="bill-sample.pdf" target="_blank" class="general-button redbutton mb-3"><i class="material-symbols-outlined">print</i>Print</a> 
	  </div>					
				</div>
           
           </div>
          </div>
      </div> 
      </div>            
    </div>
  </div>
</div> 