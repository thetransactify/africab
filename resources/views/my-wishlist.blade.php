@extends('layout.app')
@section('title', 'My Wishlist')
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
@if (session('success'))
    <div id="success-message" class="alert alert-success">
        {{ session('success') }}
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
						<h4>My <span class="">Wishlist</span></h4>
					</div>

					<div class="container-fluid div-tables mb-0">
						<div class="row dt-row dt-head">
							<div class="col-lg-10 col-sm-9 dt-col">
								Product
							</div>
							<div class="col-lg-2 col-sm-3 dt-col">
							</div>
						</div>

                    @foreach($wishlistDeatils as $val)
						<div class="row dt-row dt-body align-items-center">
							<div class="col-lg-2 col-sm-3 dt-col table-img">
								<img src="{{ asset('storage/uploads/product/' . $val['file']) }}" />
							</div>
							<div class="col-lg-5 col-sm-5 dt-col">
								<a href="{{ url('product/'.\Illuminate\Support\Str::slug($val['product_name']) . '/' . $val['code']) }}" class="prd-caption">
									<span class="prd-name">{{$val['product_name']}}</span>
									<span>{{$val['cat_name']}}</span>
								</a>
								<p class="prd-price"><span class="dc-price"><i>TSh</i>{{$val['offer']}}</span><i>TSh</i>{{$val['cost']}}</p>

							</div>
							<div class="col-lg-5 col-sm-5 dt-col">
								<ul class="general-button-list small-v no-text blackbutton my-0">
									<li class=""><a href="{{ url('product/'.\Illuminate\Support\Str::slug($val['product_name']) . '/' . $val['code']) }}" ><i class="material-symbols-outlined">add_shopping_cart</i>Add to Cart</a></li>
									<li class=""><a href="{{ route('wishlist.delete', ['id' => $val['ids']]) }}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="material-symbols-outlined">delete</i>Delete</a></li>
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
        let msg = document.getElementById('success-message');
        if (msg) {
            msg.style.display = 'none';
        }
    }, 5000);
</script>
@endsection