@extends('layout.app')
@section('title', $data['product_price']['meta_title'])
@section('meta_description', $data['product_price']['meta_description'])
@section('meta_keywords', $data['product_price']['keyword'])
@section('content')
@php $defaultImage = asset('client/assets/images/no-image-ph.jpg'); @endphp
<div class="content-area">
 
<!-- Banner Area -->
<div class="page-headers">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-6 col-12">
				<h1>{{$data['product_price']['category']}}</h1>
			</div>
			<div class="col-md-6 col-12">
					<ul class="ph-breadcrumbs-list">
					<li><a href="{{url('/index')}}">Home</a></li>
					<li><a href="{{ url('product-category/'.\Illuminate\Support\Str::slug($data['product_price']['category'])) }}" class="">{{$data['product_price']['category']}}</a></li>
					<li><a href="#" class="active">{{$data['product_price']['listing_name']}}</a></li>
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
@if (session('error'))
    <div id="error-message" class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Products List -->
<div class="product-single-area">	
	<div class="container">
		<div class="row justify-content-center align-items-start">
			<div class="col-12">
				<div class="product-title">
					<ul class="prd-sub-link">
						<li><span class="new">New</span></li>
					</ul>
					<h1 class="prd-name">{{$data['product_price']['listing_name']}}</h1>
					@php
					$reviewRatings = $data['product_price']['reviewRatings'] ?? [];
					$numericRatings = array_map('intval', $reviewRatings);
					$averageRating = count($numericRatings) > 0 
					? round(array_sum($numericRatings) / count($numericRatings)) 
					: 0;
					$reviewCount = count($data['product_price']['comment'] ?? []);
					@endphp
					<ul class="star-rating">
						@for($i = 1; $i <= 5; $i++)
						<li><i class="las la-star {{ $i <= $averageRating  ? 'starred' : '' }}"></i></li>
						@endfor
						<li><a href="#desc-reviews">({{ $reviewCount }} {{ Str::plural('customer review', $reviewCount) }})</a></li>
					</ul>
					<ul class="prd-sub-link">
						<!--  <li><i class="fas fa-times red-color"></i> out of stock</li> -->
						<li><i class="fas fa-check green-color"></i> in stock</li>
					</ul>
				</div>
			</div>
			<div class="col-xxl-auto col-xl-auto col-lg-auto col-md-auto col-12">
				<div class="pp-slider">

					@foreach($data['product_price']['galleries'] as $gallery)
					<div><a class="pv-icon" href="{{ asset('storage/uploads/product/' . $gallery) }}" data-lightbox="prd-view" data-title="{{$data['product_price']['listing_name']}}"><img src="{{ asset('storage/uploads/product/' . $gallery) }}" /></a></div>
					@endforeach
				</div>
				<div class="pp-slider-thumbnail">
					<div></div>
					@foreach($data['product_price']['galleries'] as $gallery)
					<div><img src="{{ asset('storage/uploads/product/' . $gallery) }}" /></div>
					@endforeach
				</div>
			</div>

			<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
				<!-- Product Cost -->	
				<div class="prd-price">
					<h1 class="">
						@if(!empty($data['product_price']['offer_price']))
						<span class="dc-price"><i>TSh</i>{{$data['product_price']['offer_price']}}</span>
						@endif
						<i>TSh</i>{{$data['product_price']['product_cost']}}</h1>
					</div>

					<!-- Add to Wishlist / Add to Cart -->

					<form class="standard-form-rules add-to-cart" id="addToCartForm">
						<input type="hidden" name="product_id" value="{{$data['product_price']['id']}}" id="product_id">
						<input type="hidden" name="price_id" value="{{$data['product_price']['product_cost']}}" id="price_id">

						<div class="row">
							<div class="col-xl-8 col-lg-10 col-md-10 col-12">
								<p>Desired Quantity</p>
								<div class="qty-input">
									<input type="button" value="-" class="button-minus" data-field="quantity">
									<input type="number" step="1" max="" value="1" name="quantity" class="quantity-field" id="quantity">
									<input type="button" value="+" class="button-plus" data-field="quantity">
								</div>
								<p><small>Max Allowed : 1000</small></p>
								@if(is_array($data['product_price']['color']) && count($data['product_price']['color']) > 0)
								<p>Select Color</p>
								<div class="color-options mb-3">
									<select name="color" id="color" class="form-control">
										@foreach($data['product_price']['color'] as $color)
										<option value="{{ $color }}">{{ ucfirst($color) }}</option>
										@endforeach
									</select>
								</div>
								@endif
								<ul class="general-button-list">
									<li><a href="{{ route('wishlist.add', $data['product_price']['id']) }}" class="redbutton"><i class="material-symbols-outlined">favorite</i>Wishlist</a></li>
									<li><a href="javascript:void(0);" class="blackbutton" id="addToCartBtn"><i class="material-symbols-outlined" >add_shopping_cart</i>Add to Cart</a></li>
								</ul>
							</div>
						</div>


					</form>

					<!-- Add to Wishlist / Add to Cart -->
					<div class="ac-tab-container">
						<div id="ac-tab" class="ac-tab">
							<h2 class="ac-title active">Product Details</h2>
							@if(!empty($data['product_price']['packing_weight']))
							<div class="ac-content active">
								<p><b>Product Weight :</b>{{$data['product_price']['packing_weight']}} </p>
							</div>
							@endif
							<h2 class="ac-title">Product Description</h2>
							<div class="ac-content">
								<div class="richtext-content">
									<p>{{$data['product_price']['description']}}</p>
								</ul>   
							</div>
						</div>
						<h2 class="ac-title">Reviews ({{ $reviewCount }})</h2>
						<div class="ac-content">
							@foreach($data['product_price']['comment'] as $index => $comment)
							<div class="each-review">
								<div class="content">
									<p class="mb-0">{{ $comment }}</p>
								</div>
								<ul class="star-rating">
									@php
									$rating = isset($data['product_price']['reviewRatings'][$index]) 
									? (int)$data['product_price']['reviewRatings'][$index] 
									: 0;
									@endphp

									@for($i = 1; $i <= 5; $i++)
									<li>
										<i class="las la-star {{ $i <= $rating ? 'starred' : '' }}"></i>
									</li>
									@endfor
								</ul>
							</div>
							@endforeach
						</div>
						<h2 class="ac-title">Add Review</h2>
						<div class="ac-content">

							<form class="standard-form-rules" action="{{route('addReviews.shows')}}" method="Post">
								@csrf
								@if(isset(auth()->user()->id))
								<p> Add Review.</p>
								@else
								<p>Please <a href="{{route('get.ClientLogin')}}">Login</a> to Add Review.</p>
								@endif

								<p>Greetings, <b class="darkgrey-color">Customer Name</b>, please post your review using the form. Please note all reviews are moderated to check for spamming.</p>

								<div class="sta-form-group">
									<fieldset class="rating-stars">
										<input type="checkbox" id="5-star" name="rating" value="5" /><label for="5-star" title="Excellent Quality"></label>
										<input type="checkbox" id="4-star" name="rating" value="4" /><label for="4-star" title="Very Good Quality"></label>
										<input type="checkbox" id="3-star" name="rating" value="3" /><label for="3-star" title="Good Quality"></label>
										<input type="checkbox" id="2-star" name="rating" value="2" /><label for="2-star" title="Average Quality"></label>
										<input type="checkbox" id="1-star" name="rating" value="1" /><label for="1-star" title="Poor Quality"></label>
									</fieldset>
								</div>
								<div class="sta-form-group">
									<label for="review">Add Review</label>
									<textarea name="review" id="review" cols="30" rows="6" class="sta-form-control"></textarea>
								</div>
								<input type="hidden" name="product_price_id" value="{{$data['product_price']['id']}}">

								<input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">
								<div class="sta-form-group">
									<button type="submit" class="general-button blackbutton"><i class="material-symbols-outlined">save</i>Submit Review</button>
								</div>
							</form>
							
						</div>

					</div>
				</div>		

			</div>	
		</div>
	</div>

<!-- eCom Features-->
<!-- recent view-->
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
                    @php
                        $recentImage = !empty($recentlist['file']) ? $recentlist['file'] : $defaultImage;
                    @endphp
                    <div class="item">
                    <a href="{{ url('product/'.\Illuminate\Support\Str::slug($recentlist['product_name']) . '/' . $recentlist['code']) }}"><img src="{{ $recentImage }}" alt="{{ $recentlist['product_name'] }}" /><span>{{ $recentlist['product_name'] }}</span>
                    </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>	
<!-- recent view-->

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

</div>
<!-- jQuery 3.6.0 CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    setTimeout(function() {
        let msg = document.getElementById('success-message');
        if (msg) {
            msg.style.display = 'none';
        }
    }, 5000);
</script>
<script>
    setTimeout(function() {
        let msg = document.getElementById('error-message');
        if (msg) {
            msg.style.display = 'none';
        }
    }, 5000);
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
	const minValue = 1;
	const maxValue = 1000;

	// Handle + / - quantity
	document.querySelectorAll(".button-minus, .button-plus").forEach(function (button) {
		button.addEventListener("click", function () {
			const input = this.closest(".qty-input").querySelector(".quantity-field");
			let currentValue = parseInt(input.value) || minValue;

			if (this.classList.contains("button-minus")) {
				if (currentValue > minValue) input.value = currentValue - 1;
			} else {
				if (currentValue < maxValue) input.value = currentValue + 1;
			}
		});
	});
	document.getElementById("addToCartBtn").addEventListener("click", function () {
		const quantity = document.getElementById("quantity").value;
		const productId = document.getElementById("product_id").value;
		const priceId = document.getElementById("price_id").value;
		const colorField = document.getElementById("color");
		const color = colorField ? colorField.value : null;

		if (quantity < 1 || quantity > 1000) {
			alert("Quantity must be between 1 and 1000");
			return;
		}

		fetch("{{ url('/add-cart') }}", {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
				"X-CSRF-TOKEN": "{{ csrf_token() }}"
			},
			body: JSON.stringify({
				product_id: productId,
				priceId: priceId,
				quantity: quantity,
				color : color
			})
		})
		.then(res => res.json())
		.then(data => {
			if (data.success) {
				alert("Product added to cart!");
		      window.location.href = "{{ route('cart.get') }}"; 

			} else {
				alert(data.message || "Something went wrong.");
			}
		})
		.catch(err => {
			console.error(err);
			//alert("Failed to add to cart.");
			 window.location.href = "/login";
		});
	});
});
</script>


@endsection
