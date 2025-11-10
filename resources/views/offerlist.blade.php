@extends('layout.app')
@section('title', 'Product')
@section('content')
<div class="content-area">

<!-- Banner Area -->
<div class="page-headers">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-6 col-12">
				<h1>{{ $grouped[0]['label'] ?? '' }}</h1>
			</div>
			<div class="col-md-6 col-12">
					<ul class="ph-breadcrumbs-list">
					<li><a href="{{url('/index')}}">Home</a></li>
					<li><a href="#" class="active">{{ $grouped[0]['label'] ?? '' }}</a></li>
				</ul>
			</div>			
			
		</div>
	</div>
</div>


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
	<div class="col-8">
	<form class="standard-form-rules product-sorter">
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
	</div>
	
	</div>
	<div class="row justify-content-start sub-cat-list">
		<div class="col-12">
		</div>
	</div>
	
	<div class="row product-list justify-content-start">
@if (session('success'))
    <div id="success-message" class="alert alert-success">
        {{ session('success') }} <a href="{{ route('MyWishlist.shows') }}">Open wishlist</a>
    </div>
@endif
@if(!empty($grouped) && count($grouped) > 0)
    <div class="row">
        @foreach($grouped as $val)
            @foreach($val['products'] as $listname)
                <div class="col-lg-3 col-md-4 col-6 each-item">
                    <div class="prd-item">
                        @php
                            $productSlug = \Illuminate\Support\Str::slug($listname['listing_name'] ?? 'product');
                            $productCode = $listname['code'] ?? '';
                            $productUrl = $productCode
                                ? url('product/'.$productSlug.'/'.$productCode)
                                : url('product/'.$productSlug);
                            $offerPrice = $listname['offer_price'] ?? null;
                            $categorySlug = !empty($val['label'])
                                ? \Illuminate\Support\Str::slug($val['label'])
                                : null;
                        @endphp
                        <figure onclick="location.href = '{{ $productUrl }}';">
                            <span class="prd-tag new">New</span>

                            {{-- image --}}
                            @if(!empty($listname['gallery']) && count($listname['gallery']) > 0)
                                <img src="{{ asset('storage/uploads/product/' . $listname['gallery'][0]) }}" 
                                     alt="{{ $listname['listing_name'] }}"
                                     class="img-fluid" 
                                     style="object-fit:cover; height:200px; width:100%;">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" 
                                     alt="No Image" 
                                     class="img-fluid" 
                                     style="object-fit:cover; height:200px; width:100%;">
                            @endif

                            {{-- action buttons --}}
                            <ul class="pab-list">
                                <li>
                                    <a href="{{ route('wishlist.add', $listname['id']) }}">
                                        <i class="material-symbols-outlined fav">heart_plus</i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ $productUrl }}">
                                        <span class="material-symbols-rounded">open_in_new</span>
                                    </a>
                                </li>
                               <!--  <li>
                                    @if($categorySlug)
                                    <form action="{{ route('product-category.add-to-cart', ['slug' => $categorySlug, 'product' => $listname['id']]) }}" method="POST" class="quick-cart-form">
                                        @csrf
                                        <a href="#" class="quick-cart-btn" aria-label="Add to checkout" onclick="event.preventDefault(); event.stopPropagation(); this.closest('form').submit();">
                                            <i class="material-symbols-outlined shop">add_shopping_cart</i>
                                        </a>
                                    </form>
                                    @else
                                    <span class="disabled-cart-icon"><i class="material-symbols-outlined shop">add_shopping_cart</i></span>
                                    @endif
                                </li> -->
                            </ul>
                        </figure>

                        {{-- product info --}}
                        <h3 class="prd-name">
                            <span>{{ $listname['listing_name'] }}</span>
                            <a href="{{ $productUrl }}">
                                {{ $listname['listing_name'] }}
                            </a>
                        </h3>
                        <h5 class="prd-price">
                            @if(!empty($offerPrice) && $offerPrice > 0)
                            <span class="dc-price"><i>TSh</i>{{ $offerPrice }}</span>
                            @endif
                            <i>TSh</i>{{ $listname['product_cost'] }}
                        </h5>
                    </div>  
                </div>
            @endforeach
        @endforeach
    </div>
@endif
 
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
                    <a href="{{ url('product/'.\Illuminate\Support\Str::slug($recentlist['product_name'])) }}"><img src="{{ asset('storage/uploads/product/'. $recentlist['file']) }}" /><span>{{ $recentlist['product_name'] }}</span>
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

<script>
    setTimeout(function() {
        let msg = document.getElementById('success-message');
        if (msg) {
            msg.style.display = 'none';
        }
    }, 5000);
</script>
@endsection
