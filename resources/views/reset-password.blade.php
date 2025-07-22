@extends('layout.app')
@section('title', 'Reset password')
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
					<li><a href="url('/index')">Home</a></li>
					<li><a href="#" class="active">My Account</a></li>
				</ul>
		</div>	
	</div>
</div>
</div>

<!-- Acounts Page -->

<div class="account-pages">
		<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-5 col-md-6 col-12">
				<div class="dashboard-tab">
				<div class="main-title py-3 pt-2">
					<h4>Set New <span class="red-color">Password</span></h4>
				</div>
				<p>Please make sure you setup a stong and easy to remember password.</p>
				<form class="standard-form-rules p-0" action="{{ route('password.updateClient') }}" method="post" id="address-add-form">
					@csrf
								<div class="sta-form-group">
									<input type="password" id="contact_name" name="password" class="" value="" placeholder="Enter New Password"/> 
								</div>
								<input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ old('email', $email) }}">
								<div class="sta-form-groups">
									<input type="password" id="contact_name" name="password_confirmation" class="" value="" placeholder="Confirm New Password"/> 
								</div>
								<div class="sta-form-group">
									<div class="password-confirm">
										<!-- <input type="checkbox" name="password_confirmation" id="confirmpass"> -->
										</div></div>
								
									<div class="sta-form-group">
												<ul class="general-button-list my-0">
									<li><button type="submit" class="blackbutton mt-3 mb-0">
									<i class="material-symbols-outlined">save</i>Change Password</button></li>
									<li></li>
									</ul></div>
                            </form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection
