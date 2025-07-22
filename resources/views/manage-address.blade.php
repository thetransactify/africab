@extends('layout.app')
@section('title', 'My Address')
@section('content')
<div class="content-area">

<!-- Banner Area -->
<div class="page-headers smaller">
	<div class="container-fluid">
	<div class="row align-items-center g-0">
		<div class="col-lg-6 col-md-6 col-12">	
		<h1>My Account</h1>
		</div>
		<div class="col-lg-6 col-md-6 col-12">
		
	<ul class="ph-breadcrumbs-list">
					<li><a href="index.html">Home</a></li>
					<li><a href="page-category.html" class="active">My Account</a></li>
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
					<h4>My <span class="">Addresses</span></h4>
				</div>
				<div class="row align-items-end justify-content-end">
				<div class="col-auto">
						<button type="button" class="general-button blackbutton my-3" data-bs-toggle="modal" data-bs-target="#addWindow">
						<i class="material-symbols-outlined">add</i>New 
						Address</button>
					</div>
								<div class="col-12">
				<p>Manage your delivery and billing address here</p>
				</div>	
				</div>
				<div class="row">
					<div class="col-md-6 col-12">
					<div class="address-single">
				<h5>Home Address</h5>
				<p><b>John Doe Smith</b></p>
				<p>P.O. Box 1234,Chesterfield<br>
				Maharashtra, Mumbai<br>
				Pincode : 400001</p>
				<p>Mobile : +91 - 9876543210</p>
				<ul class="general-button-list small-v no-text redbutton my-0">
				<li class=""><a href="javascript:void(0);" target="_blank"><i class="material-symbols-outlined">delete</i>Delete</a></li>
				</ul>
				</div>
					
					</div>
					<div class="col-md-6 col-12">
					<div class="address-single">
				<h5>Home Address</h5>
				<p><b>John Doe Smith</b></p>
				<p>P.O. Box 1234,Chesterfield<br>
				Maharashtra, Mumbai<br>
				Pincode : 400001</p>
				<p>Mobile : +91 - 9876543210</p>
				<ul class="general-button-list small-v no-text redbutton my-0">
				<li class=""><a href="javascript:void(0);" target="_blank"><i class="material-symbols-outlined">delete</i>Delete</a></li>
				</ul>				
				</div>
					
					</div>					
				</div>

				
				</div>
				</div>
				
				
				</div>
				</div>

</div>


</div>
@endsection