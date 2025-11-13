@extends('layout.app')
@section('title', 'Edit Profile')
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
					<h4>Edit <span class="">Profile</span></h4>
				</div>
				@if(session('success'))
				    <div class="alert alert-success" id="successMessage">
				        {{ session('success') }}
				    </div>

				    <script>
				        setTimeout(function() {
				            let message = document.getElementById('successMessage');
				            if (message) {
				                message.style.display = 'none';
				            }
				        }, 5000); // 5000 ms = 5 seconds
				    </script>
				@endif
				<p>Please note, you will not be able to change your email address which was used for registration. In case you need help, please contact us.</p>
				<form class="standard-form-rules pb-0" action="{{ route('profile.update') }}" method="POST" id="address-add-form">
					@csrf
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="sta-form-group">
								<input type="text" id="contact_name" name="name" class="" value="{{$profileDeatils->name}}" placeholder="Full Name" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12">
							<div class="sta-form-group">
								<input type="email" id="contact_name" name="email" class="" value="{{$profileDeatils->email}}" placeholder="Email Address" disabled required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12">
							<div class="sta-form-group">
								<input type="text" id="contact_name" name="phone" class="callnoinput" value="{{$profileDeatils->mobile}}" placeholder="Mobile Numbers">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12">
							<div class="sta-form-group">
								<input type="text" id="tin_num" name="tin_num" class="" value="{{$profileDeatils->tin_num ?? ''}}" placeholder="Your TIN (optional)">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12">
							<div class="sta-form-group">
								<input type="text" id="vrn_num" name="vrn_num" class="" value="{{$profileDeatils->vrn_num ?? ''}}" placeholder="Your VRN (optional)">
							</div>
						</div>
						<!-- <div class="col-lg-6 col-md-6 col-12">	
							<div class="sta-form-group">
								<input type="text" id="contact_name" name="contact_name" data-toggle="datepicker" class="" value="" placeholder="Date of Birth" data-date-format="mm/dd/yyyy">
							</div>
						</div> -->
						<div class="col-md-6 col-12">
							<div class="sta-form-group mb-3">
								<div class="password-confirm">
									<!-- <input type="checkbox" value="confirmpass" name="confirmpass" id="confirmpass">
									<label class="newsletter-sub-label" for="confirmpass">I confirm, I want to make these changes.</label> -->
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="sta-form-group">
								<button type="submit" class="general-button blackbutton mt-3 mb-0">
									<i class="material-symbols-outlined">save</i>Save Settings</button></div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
