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
						<li><a href="{{url('index')}}">Home</a></li>
						<li><a href="{{url('my-account')}}" class="active">My Account</a></li>
					</ul>
				</div>	
			</div>
		</div>
	</div>
<!-- Success Message -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Validation Errors -->
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif	

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
						@foreach($addressDetails as $list)	
							<div class="col-md-6 col-12">
								<div class="address-single">
									<h5>
									@if($list['label'] == 1)
				                        Home Address
				                    @elseif($list['label'] == 2)
				                        Office Address
				                    @elseif($list['label'] == 3)
				                        Other Address
				                    @endif
					                </h5>
									<p><b>{{ $list['name'] }}</b></p>
									<p>{{ $list['home_address'] ?? '-' }}<br>
									<p>{{ $list['office_address'] ?? '-' }}<br>
									<p>{{ $list['other_address'] ?? '-' }}<br>
									Pincode : {{ $list['pincode'] ?? '-' }}</p>
									<p>Mobile : {{ $list['mobile_no'] }} </p>
									<ul class="general-button-list small-v no-text redbutton my-0">
										<li class=""><a href="{{ route('address.delete', Crypt::encrypt($list['id'])) }}" onclick="return confirm('Are you sure delete?')"><i class="material-symbols-outlined">delete</i>Delete</a></li>
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
  
<script>
    setTimeout(function() {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
            alert.style.display = 'none';
        });
    }, 5000);
</script>
@endsection