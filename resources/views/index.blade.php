@extends('layout.app')
@section('title', 'Home')
@section('content')
<div class="content-area">

<!-- Banner Area -->
<div class="banner-area">
    <div class="ba-slider">
        @foreach($Homeslider as $slider)
        <div class="item"><img src="{{ asset('storage/uploads/Home/' . $slider->file) }}" /></div>
       @endforeach
    </div>
</div>
<!-- Browse by Category -->
<div class="browse-category">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-12">
                <div class="main-title">
                    <h1>Browse<span>Categories</span></h1>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-12">
                <div class="category-slider">
                    @foreach($Categories as $category)
                    <div class="item">
                    <a href="{{ url('product-category/'.\Illuminate\Support\Str::slug($category->name)) }}"><img src="{{ asset('storage/uploads/category/'. $category->file) }}" /><span>{{ $category->name }}</span>
                    </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@if(!empty($grouped) && count($grouped) > 0)
    <div class="home-advertisement">
        <div class="container-fluid px-0 px-sm-3">
            @foreach($grouped as $val)
                <div class="discount-banner mb-4 p-2 p-sm-3 bg-light rounded">

                    <h2 class="text-danger text-center mb-2 mb-sm-3">{{ $val['label'] }}</h2>
                    
                    @if(isset($val['discount_percentage']))
                        <div class="badge bg-success mb-2 mb-sm-3 fs-6 d-block d-md-inline-block text-center">
                            {{ $val['discount_percentage'] }}% OFF
                        </div>
                    @endif
                    
                    <div class="row g-2 g-sm-3">
                        @foreach($val['products'] as $product)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-2 mb-sm-3">
                                <div class="category-item p-2 p-sm-3 border h-100 d-flex flex-column">
                                    @if(!empty($product['gallery']) && count($product['gallery']) > 0)
                                    <figure onclick="location.href = '{{ url('product/'.\Illuminate\Support\Str::slug($product['listing_name'])) }}';">
                                    <div class="product-gallery mb-2 mb-sm-3 text-center flex-grow-0">
                                        <img src="{{ asset('storage/uploads/product/' . $product['gallery'][0]) }}" 
                                        class="img-fluid rounded mx-auto"
                                        style="max-height: 150px; width: auto; max-width: 100%;"
                                        alt="{{ $product['listing_name'] }}">
                                    </div>
                                    @endif
                                    <h5 class="product-name mb-1 mb-sm-2 fs-6 fs-sm-5">{{ $product['listing_name'] }}</h5>
                                    <div class="price-section mt-auto">
                                        <div class="d-flex align-items-center flex-wrap">
                                            <span class="offer-price fw-bold text-danger fs-6 fs-sm-5 me-1 me-sm-2">
                                               TSh{{ number_format($product['offer_price'], 2) }}
                                            </span>
                                            @if($product['offer_price'] < $product['product_cost'])
                                                <span class="original-price text-muted text-decoration-line-through fs-7 fs-sm-6">
                                                    TSh{{ number_format($product['product_cost'], 2) }}
                                                </span>
                                            @endif
                                        </div> 
                                        @php
                                            $discount = 0;
                                            if($product['product_cost'] > 0) {
                                                $discount = (($product['product_cost'] - $product['offer_price']) / $product['product_cost']) * 100;
                                            }
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
@if(!empty($ads) && count($ads) > 0)
<div class="home-advertisement">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-6 col-sm-6 col-12">
				<div class="home-ads">
					@php
					    $adsArray = $ads->toArray();
					@endphp
					@foreach(array_slice($adsArray, 0, count($adsArray) - 1) as $ad)

	                    <div class="news-item">
	                        <a href="#"><img src="{{ asset('storage/uploads/advertisement/' . $ad['file']) }}" /></a>
	                    </div>
	                @endforeach				
				</div>
			</div>
	<div class="col-md-6 col-sm-6 col-12">
		    @php
			   $lastAd = end($adsArray);
			@endphp
			<a href="#"  class="home-single-ad"><img src="{{ asset('storage/uploads/advertisement/' . $lastAd['file']) }}" /></a>
			</div>
		</div>
	</div>
</div>
@endif
<div class="home-top-picks">
		<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-lg-6 col-md-6 col-12">
				<div class="main-title">
				<h1>what is<span>trending</span></h1>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-12">
			<ul class="htp-list" role="tablist">
			<li role="presentation"><a class="active" href="javascript:void(0);" id="new-tab" data-bs-toggle="tab" data-bs-target="#new-tab-pane" type="button" role="tab" aria-controls="new-tab-pane" aria-selected="true"><span>New</span></a></li>
			<li role="presentation"><a class="" href="javascript:void(0);" id="bestsellers-tab" data-bs-toggle="tab" data-bs-target="#bestsellers-tab-pane" type="button" role="tab" aria-controls="bestsellers-tab-pane" aria-selected="false"><span>Bestsellers</span></a></li>
			<!-- <li role="presentation"><a class="" href="javascript:void(0);" id="onsale-tab" data-bs-toggle="tab" data-bs-target="#onsale-tab-pane" type="button" role="tab" aria-controls="onsale-tab-pane" aria-selected="false"><span>On Sale</span></a></li> -->
			</ul>
			</div>
		</div>
		
		<div class="tab-content htp-tabs" id="home-top-picks">
			
		<!-- New Products -->
			 		
		<div class="tab-pane fade" id="new-tab-pane" role="tabpanel" aria-labelledby="new-tab" tabindex="0">
	
			<div class="row product-list justify-content-center">
		@foreach($productlist as $product)
			<div class="col-xxl-3 col-xl-4 col-lg-4 col-6">
				<div class="prd-item">
					<figure onclick="location.href = '{{ url('product-category/'.\Illuminate\Support\Str::slug($product->category->name)) }}'">
						<span class="prd-tag new">New</span>
						<img style="width: 350px; height: 350px; object-fit: cover;" src="{{ asset('storage/uploads/product/' . $product->product->file) }}" />
						<ul class="pab-list">
							<li><a href="{{ route('wishlist.add', $product['id']) }}"><i class="material-symbols-outlined fav">heart_plus</i></a></li>
							<li><a href="#"><span class="material-symbols-rounded">open_in_new</span></a></li>
							<li><a href="#"><i class="material-symbols-outlined shop">add_shopping_cart</i></a></li>
						</ul>
					</figure>
					<h3 class="prd-name"><span>{{$product->category->name}}</span><a href="product-single.html">{{$product->product->name}}</a></h3>
					<h5 class="prd-price"><span class="dc-price"><i>TSh</i>{{$product->offer_price}}</span><i>TSh</i>{{$product->product_cost}}</h5>
				</div>
			</div>
		@endforeach	 		
		</div> 
		</div>  	


		<!-- Bestsellers -->
		
		<div class="tab-pane fade show active" id="bestsellers-tab-pane" role="tabpanel" aria-labelledby="bestsellers-tab" tabindex="0">
		
			<div class="row product-list justify-content-center">
		@foreach($data as $bestlist)
			<div class="col-xxl-3 col-xl-4 col-lg-4 col-6">
				<div class="prd-item">
					<figure onclick="location.href = '{{ url('product-category/'.\Illuminate\Support\Str::slug($bestlist['category_name'])) }}'">
						<span class="prd-tag bestsell">Bestsellers</span>
						<img style="width: 350px; height: 350px; object-fit: cover;" src="{{ asset('storage/uploads/product/' . $bestlist['product_file']) }}" />
						<ul class="pab-list">
							<li><a href="{{ route('wishlist.add', $bestlist['id']) }}"><i class="material-symbols-outlined fav">heart_plus</i></a></li>
							<li><a href="{{ url('product-category/'.\Illuminate\Support\Str::slug($bestlist['category_name'])) }}"><span class="material-symbols-rounded">open_in_new</span></a></li>
							<li><a href="#"><i class="material-symbols-outlined shop">add_shopping_cart</i></a></li>
						</ul>
					</figure>
					<h3 class="prd-name"><span>{{$bestlist['category_name']}}</span><a href="product-single.html">{{$bestlist['product_name']}}</a></h3>
					<h5 class="prd-price"><span class="dc-price"><i>TSh</i>{{$bestlist['offer_price']}}</span><i>Tsh</i>{{$bestlist['product_cost']}}</h5>
				</div>
			</div>
	@endforeach		  
		</div>	
		</div>	
		
		<!-- On Sale -->
		
		<div class="tab-pane fade" id="onsale-tab-pane" role="tabpanel" aria-labelledby="onsale-tab" tabindex="0">
			<div class="row product-list justify-content-center">
		@foreach($productlist as $product)
			<div class="col-xxl-3 col-xl-4 col-lg-4 col-6">
				<div class="prd-item">
					<figure onclick="location.href = '{{ url('product-category/'.\Illuminate\Support\Str::slug($product->category->name)) }}';">
						<span class="prd-tag onsale">On Sale</span>
						<img style="width: 350px; height: 350px; object-fit: cover;" src="{{ asset('storage/uploads/product/' . $product->product->file) }}" />
						<ul class="pab-list">
							<li><a href="{{ route('wishlist.add', $product['id']) }}"><i class="material-symbols-outlined fav">heart_plus</i></a></li>
							<li><a href="product-single.html"><span class="material-symbols-rounded">open_in_new</span></a></li>
							<li><a href="#"><i class="material-symbols-outlined shop">add_shopping_cart</i></a></li>
						</ul>
					</figure>
					<h3 class="prd-name"><span>{{$product->category->name}}</span><a href="product-single.html">{{$product->product->name}}</a></h3>
					<h5 class="prd-price"><span class="dc-price"><i>TSh</i>{{$product->offer_price}}</span><i>TSh</i>{{$product->product_cost}}</h5>
				</div>
			</div>
		 @endforeach	
		  </div>			  
		</div>	
		
		<!-- Combo Offers -->
		
		<div class="tab-pane fade" id="combo-offers-tab-pane" role="tabpanel" aria-labelledby="combo-offers-tab" tabindex="0">
			<div class="row product-list justify-content-center">
			<div class="col-xxl-3 col-xl-4 col-lg-4 col-6">
				<div class="prd-item">
					<figure onclick="location.href = 'product-single.html';">
						<span class="prd-tag bestsell">Bestseller</span>
						<img src="assets/images/products/prd-13.jpg" />
						<ul class="pab-list">
							<li><a href="my-wishlist.html"><i class="material-symbols-outlined fav">heart_plus</i></a></li>
							<li><a href="product-single.html"><span class="material-symbols-rounded">
open_in_new
</span></a></li>
							<li><a href="#"><i class="material-symbols-outlined shop">add_shopping_cart</i></a></li>
						</ul>
					</figure>
					<h3 class="prd-name"><span>Category Name</span><a href="product-single.html">Product Name</a></h3>
					<h5 class="prd-price"><span class="dc-price"><i>TSh</i>245,250.00</span><i>TSh</i>187,650.00</h5>
				</div>
			</div>
			<div class="col-xxl-3 col-xl-4 col-lg-4 col-6">
				<div class="prd-item">
					<figure onclick="location.href = 'product-single.html';">
						<span class="prd-tag new">New</span>
						<img src="assets/images/products/prd-14.jpg" />
						<ul class="pab-list">
							<li><a href="my-wishlist.html"><i class="material-symbols-outlined fav">heart_plus</i></a></li>
							<li><a href="product-single.html"><span class="material-symbols-rounded">
open_in_new
</span></a></li>
							<li><a href="#"><i class="material-symbols-outlined shop">add_shopping_cart</i></a></li>
						</ul>
					</figure>
					<h3 class="prd-name"><span>Category Name</span><a href="product-single.html">Product Name</a></h3>
					<h5 class="prd-price"><span class="dc-price"><i>TSh</i>245,250.00</span><i>TSh</i>187,650.00</h5>
				</div>
			</div>
			<div class="col-xxl-3 col-xl-4 col-lg-4 col-6">
				<div class="prd-item">
					<figure onclick="location.href = 'product-single.html';">
						<span class="prd-tag onsale">On Sale</span>
						<img src="assets/images/products/prd-15.jpg" />
						<ul class="pab-list">
							<li><a href="my-wishlist.html"><i class="material-symbols-outlined fav">heart_plus</i></a></li>
							<li><a href="product-single.html"><span class="material-symbols-rounded">
open_in_new
</span></a></li>
							<li><a href="#"><i class="material-symbols-outlined shop">add_shopping_cart</i></a></li>
						</ul>
					</figure>
					<h3 class="prd-name"><span>Category Name</span><a href="product-single.html">Product Name</a></h3>
					<h5 class="prd-price"><span class="dc-price"><i>TSh</i>245,250.00</span><i>TSh</i>187,650.00</h5>
				</div>
			</div>	
			<div class="col-xxl-3 col-xl-4 col-lg-4 col-6">
				<div class="prd-item">
					<figure onclick="location.href = 'product-single.html';">
						<span class="prd-tag bestsell">Bestseller</span>
						<img src="assets/images/products/prd-16.jpg" />
						<ul class="pab-list">
							<li><a href="my-wishlist.html"><i class="material-symbols-outlined fav">heart_plus</i></a></li>
							<li><a href="product-single.html"><span class="material-symbols-rounded">
open_in_new
</span></a></li>
							<li><a href="#"><i class="material-symbols-outlined shop">add_shopping_cart</i></a></li>
						</ul>
					</figure>
					<h3 class="prd-name"><span>Category Name</span><a href="product-single.html">Product Name</a></h3>
					<h5 class="prd-price"><span class="dc-price"><i>TSh</i>245,250.00</span><i>TSh</i>187,650.00</h5>
				</div>
			</div>					
		</div>
				  
		</div>	
		
			</div>
				
		</div>
</div>	

<!-- News / Testimonials -->

<div class="home-testimonials">
		<div class="container-fluid">
		
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="main-title pt-0 pb-3">
					
					<h1>what our customer says</h1>
				</div>
			</div>
	
			<div class="col-lg-6 col-md-7 col-12">
				<div class="ht-container">
				@foreach($reviewlists as $list)
					<div class="testimonial-item">
						<h3>{{$list['productname']}}</h3>
						@php
						    $rating = $list['rating'];
						@endphp

						<ul class="star-rating">
						    @for ($i = 1; $i <= 5; $i++)
						        <li>
						            <i class="las la-star {{ $i <= $rating ? 'starred' : '' }}"></i>
						        </li>
						    @endfor
						</ul>
						<h4>{{$list['comment']}}</h5>
						<h5>{{$list['clientname']}}</h5>
						</div>
				@endforeach	
				</div>
			</div>			
		</div>		
		</div>
		
</div>

<!-- Brand Logo -->

<div class="home-brands">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="hbp-carousel">
				  @foreach($brandList as $brand)	
				  <div class="item"><a href="#"><img src="{{ asset('storage/uploads/Home/' . $brand['file']) }}" alt="" /></a></div>
				  @endforeach
				</div>
			</div>
		</div>
	
	</div>
	</div>

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
<!-- eCom Features-->

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
@endsection
