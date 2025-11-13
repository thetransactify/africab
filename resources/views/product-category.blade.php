@extends('layout.app')
@section('title', 'Product')
@section('content')
@php
	$currentCategorySlug = $categorySlug ?? request()->route('slug');
@endphp
<div class="content-area">
<style>
.pab-list .add-to-checkout-form {
	display: inline;
}
.pab-list .add-to-checkout-form .add-to-checkout-btn {
	display: flex;
	align-items: center;
	justify-content: center;
	padding: 0;
	color: inherit;
	text-decoration: none;
}
.pab-list .add-to-checkout-form .add-to-checkout-btn:hover {
	color: #d93025;
}
</style>

<!-- Banner Area -->
<div class="page-headers">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-6 col-12">
				<h1>{{ $category->name }}</h1>
			</div>
			<div class="col-md-6 col-12">
					<ul class="ph-breadcrumbs-list">
					<li><a href="{{url('/index')}}">Home</a></li>
					<li><a href="#" class="active">{{ $category->name }}</a></li>
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

<!-- Products List -->
<div class="product-list-area">	
	<div class="container-fluid">
	
	<div class="row justify-content-start align-items-center product-settings">
	<div class="col-4">
	<ul class="grid-settings">
			<li><a href="javascript:void(0);" class="grid-4 active"><i class="material-symbols-outlined">background_grid_small</i></a></li>
			<li><a href="javascript:void(0);" class="grid-3"><i class="material-symbols-outlined">grid_on</i></a></li>
			<li class="mobile-only"><a href="javascript:void(0);" class="grid-2 active"><i class="material-symbols-outlined">window</i></a></li>
			<li class="mobile-only"><a href="javascript:void(0);" class="grid-1"><span></span></a></li>
				</ul>
	</div>
	<div class="col-8 d-flex justify-content-end align-items-center gap-3">
	<form class="standard-form-rules product-sorter mb-0">
				<p>Sort By:</p>
				<select>
					<option>Show All</option>
					<option>Show Bestsellers</option>
					<option>Show On Sale</option>
					<option>Show New Launch</option>
					<option>Name (A -Z)</option>
					<option>Name (Z -A)</option>
					<option>Price (Low - High)</option>
					<option>Price (High - Low)</option>
				</select>
			</form>
			<a href="{{ route('checkout.get') }}" class="general-button redbutton">Proceed to checkout</a>
	</div>
	
	</div>
	<div class="row justify-content-start sub-cat-list">
		<div class="col-12">
			<ul class="cat-subs">
				<li class="label"><span>Available Varieties :</span></li>
				<li><a href="#" class="active" data-subcategory="all">All</a></li>
				@if(!empty($subcategoriesList))
				@foreach($subcategoriesList as $list)
				<li><a href="#" data-subcategory="{{ $list['name'] }}">{{$list['name']}}</a></li>
				@endforeach
				@else
				<li class="no-sub"><span>Not Available</span></li>
				@endif
			</ul>
		</div>
	</div>
	
	<div class="row product-list justify-content-start">
		@foreach($productsList as $listname)
			<div class="col-lg-3 col-md-4 col-6 each-item" data-subcategory="{{ $listname['SubCategories'] }}">
				<div class="prd-item">
					<figure onclick="location.href = '{{ url('product/'.\Illuminate\Support\Str::slug($listname['productname']) . '/' . $listname['code']) }}';">
						<span class="prd-tag new">New</span>
						<img src="{{$listname['product_image']}}" />
						<ul class="pab-list">
							<li><a href="{{ route('wishlist.add', $listname['id']) }}"><i class="material-symbols-outlined fav">heart_plus</i></a></li>
							<li><a href="{{ url('product/'.\Illuminate\Support\Str::slug($listname['productname']) . '/' . $listname['code']) }}"><span class="material-symbols-rounded">open_in_new</span></a></li>
							<li>
								<form action="{{ route('product-category.add-to-cart', ['slug' => $currentCategorySlug, 'product' => $listname['id']]) }}" method="POST" class="add-to-checkout-form">
									@csrf
									<a href="#" class="add-to-checkout-btn" aria-label="Add to checkout" onclick="event.preventDefault(); event.stopPropagation(); this.closest('form').submit();">
										<i class="material-symbols-outlined shop">add_shopping_cart</i>
									</a>
								</form>
							</li>
						</ul>
					</figure>
				<h3 class="prd-name"><span>{{$listname['productname']}}({{$listname['product_code']}})</span><a href="{{ url('product/'.\Illuminate\Support\Str::slug($listname['productname']) . '/' . $listname['code']) }}">{{$listname['category']}}({{$listname['SubCategories']}})</a></h3>
			<h5 class="prd-price">
				@if(!empty($listname['offer_price']))
				<span class="dc-price"><i>TSh</i>{{$listname['offer_price']}}</span>
				@endif
				<i>TSh</i>{{$listname['product_cost']}}
			</h5>
				</div>	
			</div>	
        @endforeach  
</div>
</div>
</div>


<!-- eCom Features-->
<!-- Recent -->
<div class="browse-category">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-12">
                <div class="main-title">
                    <h1>Recent<span>Views</span></h1>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-12">
                <div class="category-slider">
                    @foreach($recentviewlist as $recentlist)
                    <div class="item">
                    <a href="{{ url('product/'.\Illuminate\Support\Str::slug($recentlist['product_name']) . '/' . $recentlist['code']) }}"><img src="{{ $recentlist['file'] }}" /><span>{{ $recentlist['product_name'] }}</span>
                    </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>	

<div class="ecom-feat-container">
	<div class="container">
		<div class="row justify-content-center">
			<div class="ecom-features">
			<div class="item">
			<div class="ef-item">
				<span class="material-symbols-outlined ef-icon">workspace_premium</span>
				<span><h4>Premium Quality</h4>
				<p>Best grade products made in Tanzania</p></span>
			</div>	
			</div>
			<div class="item">
			<div class="ef-item">
				<span class="material-symbols-outlined ef-icon">local_shipping</span>
				<span><h4>Free Shipping &amp; Returns</h4><p>Free Shipping above 187,650.000 order</p></span>
			</div>
			</div>
			<div class="item">
			<div class="ef-item">
				<span class="material-symbols-outlined ef-icon">payments</span>
				<span><h4>Money Back Guarantee</h4><p>100% refund on cancelled orders*</p></span>
			</div>	
			</div>
						
		</div>
		</div>
		</div>

</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $(".cat-subs a").click(function(e){
        e.preventDefault();

        // remove 'active' class from all
        $(".cat-subs a").removeClass("active");

        // add 'active' to clicked
        $(this).addClass("active");

        var subcat = $(this).data("subcategory");

        $(".product-list .each-item").each(function(){
            if(subcat == "all") {
                $(this).show();
            } else if($(this).data("subcategory") == subcat) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});
</script>
<script>
    setTimeout(function() {
        let msg = document.getElementById('success-message');
        if (msg) {
            msg.style.display = 'none';
        }
    }, 5000);
</script>
@endsection
