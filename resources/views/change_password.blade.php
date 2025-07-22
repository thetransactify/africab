@extends('layout.app')
@section('title', 'Change Password')
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
							<h4>Change <span class="">Password</span></h4>
						</div>
						@if (session('status'))
                            <div class="alert alert-success text-center mb-3">
                                {{ session('status') }}
                            </div>
                            @endif

		                @if ($errors->has('email'))
		                    <div class="alert alert-danger text-center mb-3">
		                        {{ $errors->first('email') }}
		                    </div>
		                @endif
						<p>Please note, password instructions will be sent on the registered email. Please only toggle the button below if you wish to reset the password now.</p>
						<form class="standard-form-rules pb-0" action="{{ route('client.password.email') }}" method="POST" id="address-add-form">
							@csrf
							<div class="row">
								<div class="col-12">

									<div class="sta-form-group my-3">
										<div class="password-confirm">
											<input type="checkbox" value="confirmpass" name="confirmpass" id="confirmpass" required>	
											 <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{$email}}"required hidden>

											<label class="newsletter-sub-label" for="confirmpass">I confirm, I want to reset my password.
											</label></div></div>

										</div>

										<div class="col-12">
											<div class="sta-form-group">
												<button type="submit" class="general-button blackbutton mt-3 mb-0">
													<i class="material-symbols-outlined">send</i>Send Instructions</button></div>
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
