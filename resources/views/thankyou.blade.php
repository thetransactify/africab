@extends('layout.app')
@section('title', 'Checkout')
@section('content')
<div class="content-area">
<!-- Banner Area -->
<div class="page-headers smaller">
<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-6 col-12">
				<h1>Order Status</h1>
			</div>
			<div class="col-md-6 col-12">
				<ul class="ph-breadcrumbs-list">
					<li><a href="{{url('index')}}">Home</a></li>
					<li><a href="{{url('my-account')}}" class="active">Order Status</a></li>
				</ul>
			</div>			
			
		</div>
	</div>
</div>

<!-- Order Status Page -->

<div class="order-status-page">
	<div class="container">
	<div class="row justify-content-center">
				<div class="col-md-6 col-12 text-center">
<span class="material-symbols-rounded osp-icon">
inventory
</span>
				<h1 class="success">Confirmed.. We have captured your order!</h1>
				<h3>Your Order No. {{$OrderItems->order_number}}</h3>
				<p>We have received your order, We have sent an email and sms confirming your order. Incase you haven't received order email in your inbox, wait for upto 15 minutes or please check your spam folder.</p>
				</div>
				<div class="col-12">
					<div class="main-title centered mt-5 pb-2">
					<h4>Account <span>Quick Links</span></h4>
				</div>
				</div>
				<div class="col-12" >
				<ul class="thank-you-links">
					<li class=""><a href="{{url('my-account')}}"><i class="las la-desktop"></i></a>Dashboard</li>
					<li class=""><a href="{{url('order-history')}}"><i class="las la-history"></i></a>History</li>
					<li class=""><a href="{{url('my-wishlist')}}"><i class="las la-heart"></i></a>Wishlist</li>
				</ul>
				</div>
				
				</div>
			</div>

</div>


</div>
@endsection