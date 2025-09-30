@extends('layout.app')
@section('title', 'Product')
@section('content')

<div class="content-area">

	<!-- Banner Area -->
	<div class="page-headers smaller">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-md-6 col-12">
					<h1>My Cart</h1>
				</div>
				<div class="col-md-6 col-12">
					<ul class="ph-breadcrumbs-list">
						<li><a href="{{url('index')}}">Home</a></li>
						<li><a href="#" class="active">My Cart</a></li>
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
	<!-- Cart Page -->
	<div class="cart-page">	
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h4>Please verify your purchase before continuing on.</h4>
				</div>
			</div>	

			<div class="row">
				<div class="col-lg-8 col-12">
					<div class="row">
						<form class="product-cart-form standard-form-rules" action="#">
							<div class="container-fluid div-tables">
								<div class="row dt-row dt-head align-items-center">
									<div class="col-lg-10 col-sm-9 dt-col">
										Product
									</div>
									<div class="col-lg-2 col-sm-3 dt-col">
										Product Total
									</div>
								</div>
                                @if(count($cartDetails) > 0)
                                @foreach($cartDetails as $value)	
								<div class="row dt-row dt-body align-items-center">	
									<div class="col-lg-10 col-sm-9 dt-col">
										<div class="row align-items-center">
											<div class="col-lg-1 col-md-1 col-12">
												<a href="{{ url('/cart-delete', $value['cart_id']) }}" class="std-icon floatright" onclick="return confirm('Are you sure you want to delete this cart item?')" 
                                             class="las la-trash-alt btn btn-secondary mx-1"><i class="material-symbols-outlined">delete</i></a>
                                            </div>
												<div class="col-lg-2 col-md-3 col-12 table-img">
													<img src="{{ asset('storage/uploads/product/' . $value['gallery_file']) }}" alt="">
												</div>
												<div class="col-lg-6 col-md-5 col-12">
													<a href="{{ url('product/'.\Illuminate\Support\Str::slug($value['product_name'])) }}" class="prd-caption">{{$value['product_name']}}<span>{{$value['category_name']}}</span></a>
													<p class="prd-price"><span class="dc-price"><i>TSh</i>{{$value['offer_price']}}</span><i>TSh</i>{{$value['price']}}</p>
												</div>										 	
												<div class="col-lg-3 col-md-3 col-12">
													<div class="sta-form-group">
														<div class="qty-input">
															<input type="button" value="-" class="button-minus" data-field="quantity">
															<input type="number" step="1" max="" value="{{$value['quantity']}}" name="quantity" class="quantity-field">
															<input type="button" value="+" class="button-plus" data-field="quantity">
														</div>
													</div>

												</div>
											</div>
										</div>
										<div class="col-lg-2 col-sm-3 dt-col">
											<p class="prd-price"><i>TSh</i>{{$value['total']}}</p>
										</div>
										<div class="col-lg-2 col-sm-3 dt-col">
										 <!-- Save for Later Button -->
												<a href="{{ url('/cart-save-later', $value['cart_id']) }}" 
												   class="d-block mt-1 text-muted" 
												   style="font-size: 12px; text-decoration: underline;">
													Save for Later
												</a>
										</div>		
									</div>	 											 
						
							    @endforeach	
								@else
                                No product found.
								@endif  

							</form>
						</div>
					</div>
					</div>
					
					<div class="col-lg-4 col-12">
						<div class="cart-widget">
							<div class="main-title py-2">
								<h4 class="mb-2">Cart <span class="red-color">Total</span></h4>
							</div>
							<table class="table cart-total">
								<tbody>
									<tr>
										<th>Sub Total</th>
										<td><p class="prd-price"><i>TSh</i>{{$subtotal}}</p>
										</td>
									</tr>
									<tr class="total-amt">
										<th>Total</th>
										<td><p class="prd-price"><i>TSh</i>{{$subtotal}}</p>
										</tr>
									</tbody>
								</table>
								<div class="w-100 text-right">
									<a href="{{route('checkout.get')}}" class="general-button redbutton">Procced to checkout</a>
								</div>
							</div>
							<!-- /. cart widget -->
						</div>
					</div>
<div class="row mt-5">
    <div class="col-12">
        <h4>Save for Later</h4>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-12">
        <div class="row">
            <div class="container-fluid div-tables">
                <div class="row dt-row dt-head align-items-center">
                    <div class="col-lg-10 col-sm-9 dt-col">
                        Product
                    </div>
                    <div class="col-lg-2 col-sm-3 dt-col">
                        Product Total
                    </div>
                </div>

                @if(count($SaveToDetails) > 0)
                @foreach($SaveToDetails as $item)	
                <div class="row dt-row dt-body align-items-center">	
                    <div class="col-lg-10 col-sm-9 dt-col">
                        <div class="row align-items-center">
                            <div class="col-lg-1 col-md-1 col-12">
                                <a href="{{ url('/save-later-delete', $item['savetoCart_id']) }}" 
                                   onclick="return confirm('Are you sure you want to remove this item?')" 
                                   class="std-icon floatright">
                                   <i class="material-symbols-outlined">delete</i>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-3 col-12 table-img">
                                <img src="{{ asset('storage/uploads/product/' . $item['gallery_file']) }}" alt="">
                            </div>
                            <div class="col-lg-6 col-md-5 col-12">
                                <a href="{{ url('product/'.\Illuminate\Support\Str::slug($item['product_name'])) }}" 
                                   class="prd-caption">
                                    {{$item['product_name']}}
                                    <span>{{$item['category_name']}}</span>
                                </a>
                                <p class="prd-price">
                                    <span class="dc-price"><i>TSh</i>{{$item['offer_price']}}</span>
                                    <i>TSh</i>{{$item['price']}}
                                </p>
                            </div>										 	
                            <div class="col-lg-3 col-md-3 col-12">
                                <a href="{{ url('/move-to-cart', $item['savetoCart_id']) }}" 
                                   class="btn btn-sm btn-primary">
                                    Move to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-3 dt-col">
                        <p class="prd-price"><i>TSh</i>{{$item['total']}}</p>
                    </div>
                </div>	 											 
                @endforeach	
                @else
                <p>No items saved for later.</p>
                @endif  
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
<script>
document.addEventListener("DOMContentLoaded", function () {
	const minValue = 1;
	const maxValue = 1000;

	document.querySelectorAll(".button-minus, .button-plus").forEach(function (button) {
		button.addEventListener("click", function () {
			const input = this.parentNode.querySelector(".quantity-field");
			let currentValue = parseInt(input.value) || minValue;

			if (this.classList.contains("button-minus")) {
				if (currentValue > minValue) {
					input.value = currentValue - 1;
				}
			} else if (this.classList.contains("button-plus")) {
				if (currentValue < maxValue) {
					input.value = currentValue + 1;
				}
			}
		});
	});
});
</script>

@endsection
