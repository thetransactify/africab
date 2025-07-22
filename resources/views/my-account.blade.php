@extends('layout.app')
@section('title', 'My Account')
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
						<li><a href="#" class="active">My Account</a></li>
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
					<div class="col-xxl-8 col-xl-9 col-lg-10 col-md-10 col-12">
					<div class="dashboard-tab">
					<div class="main-title py-3 pt-2">
						<h4>Latest <span class="">Order</span></h4>
					</div>
					<div class="row">
					<div class="col-md-4 col-12">
					<h5>Order Date:<span>{{$latestorder[0]['order_date']}}</span></h5>
					</div>
					<div class="col-md-4 col-12">
					<h5>Order No:<span>{{$latestorder[0]['order_number']}}</span></h5>
					</div>
					<div class="col-md-4 col-12">
					<h5>Order Status:<span>{{$latestorder[0]['order_status']}}</span></h5>
					</div>
					<div class="col-md-4 col-12">
					<h5>Payment Type:<span>{{$latestorder[0]['payment_method']}}</span></h5>
					</div>
					<!-- <div class="col-md-4 col-12">
					<h5>Txn ID:<span></span></h5>
					</div> -->
					</div>
					<!-- <p>Your order for Colored Shaped Product Name and 1 other items</p> -->
					<div class="table-responsive">
										<table class="table order-meta-table">
											<thead>
												<tr>
													<th>Date</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
											@foreach($Orderhistory as $list)
												<tr>
													<td>{{$list['order_date']}}</td>
													<td><p><b>{{$list['order_status']}}</b></p>.</td>
												</tr>
											@endforeach
											</tbody>
										</table>
								</div>
					    </div>
					</div>
				</div>
			</div>
	    </div>
	</div>
@endsection
