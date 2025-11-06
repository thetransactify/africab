@extends('layout.app')
@section('title', 'Login')
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
				<button type="button" class="general-button blackbutton mb-4" onclick="location.href='{{url('/register')}}';">
						Not Registered Yet?</button>
				</div>

				<div class="main-title py-4 pt-2">
					<h4>Welcome, <span class="">Please Login</span></h4>
				</div>
				 @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show message-alert" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show message-alert" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
				<form class="standard-form-rules p-0"  method="POST" action="{{url('/clientlogins')}}" id="address-add-form">
                    @csrf
							<div class="sta-form-group">
									<input type="email" id="contact_name"  name="email" class="" value="" placeholder="Email Address"> 
								</div>
								<div class="sta-form-group">
									<input type="password" id="contact_name" name="password" class="" value="" placeholder="Password"> 
								</div>
									<div class="sta-form-group">
												<ul class="general-button-list my-0">
									<li>

							<button type="submit" class="redbutton mt-3 mb-0">
						    <i class="material-symbols-outlined">login</i>Login to Account</button></li>
									<li><button type="button" class="blackbutton mt-3 mb-0" onclick="location.href='{{ url('/user/change-password') }}';">
						<i class="material-symbols-outlined">help</i>Reset Password</button></li>
									</ul></div>

                            </form>
				</div>
			</div>
		</div>
	</div>

</div>


</div>
@endsection