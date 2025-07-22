@extends('layout.app')
@section('title', 'My Account')
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
					<li><a href="{{url('/login')}}">Home</a></li>
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
					<h4>Change/Reset <span class="red-color">Password</span></h4>
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
				<p>Please enter your registered email address with us.</p>
				<form class="standard-form-rules p-0"  action="{{ route('client.password.email') }}" method="post" id="address-add-form">
					@csrf

								<div class="sta-form-group">
									<input type="email" id="contact_name" name="email" class=""  placeholder="Email Address"/> 
								</div>
								<div class="sta-form-group">
									<div class="password-confirm">
										</div></div>
								
									<div class="sta-form-group">
												<ul class="general-button-list my-0">
									<li><button type="submit" class="redbutton mt-3 mb-0" >
						<i class="material-symbols-outlined">send</i>Send Instructions</button></li>
									<li><button type="button" class="blackbutton mt-3 mb-0" onclick="location.href='{{ url('/login') }}';">
						<i class="material-symbols-outlined">backspace</i>Cancel Reset</button></li>
									</ul></div>

                            </form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection
