@extends('layout.app')
@section('title', 'Registration')
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
				<div class="d-flex justify-content-end">
				<button type="button" class="general-button blackbutton mb-4" onclick="location.href='{{url('/login')}}';">
						Registered? Login Here</button>
				</div>
				@if ($errors->any())
				    <div class="alert alert-danger" id="validationErrors">
				        <ul class="mb-0">
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
				<div class="main-title py-3 pt-2">
					<h4>Welcome, <span class="">Register an account</span></h4>
				</div>
				<p>Get to manage your Orders, get special discounts and offers and much more.</p>
				<form class="standard-form-rules p-0" action="{{url('/post-register')}}" method="POST" id="address-add-form">
					@csrf

								<div class="sta-form-group">
									<input type="text" id="contact_name" name="name" class="" value="{{ old('name') }}" placeholder="Full Name"> 
								</div>
								<div class="sta-form-group">
									<input type="email" id="contact_name" name="email" class="" value="{{ old('email') }}" placeholder="Email Address"> 
								</div>
								<div class="sta-form-group">
									<input type="text" id="contact_name" name="phone" class="callnoinput" value="{{ old('phone') }}" placeholder="Mobile Number"> 
								</div>
								<div class="sta-form-group">
									<input type="text" id="tin_num" name="tin_num" class="" value="{{ old('tin_num') }}" placeholder="Your TIN (optional)">
								</div>
								<div class="sta-form-group">
									<input type="text" id="vrn_num" name="vrn_num" class="" value="{{ old('vrn_num') }}" placeholder="Your VRN (optional)">
								</div>
								<div class="sta-form-group">
									<input type="password" id="contact_name" name="password" class="" value="" placeholder="Set a Strong Password"> 
								</div>
								<div class="sta-form-group">
									<div class="password-confirm">
										</div>
									</div>
									<div class="sta-form-group">
												<ul class="general-button-list my-0">
									<li><button type="submit" class="general-button redbutton mt-3 mb-0" >Register Account</button></li>
									<li></li>
									</ul></div>

                            </form>
							

				</div>
			</div>
		</div>
	</div>

</div>


</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    setTimeout(function() {
        $('#validationErrors').fadeOut('slow');
    }, 5000);
</script>

@endsection
