@extends('layout.app')
@section('title', 'Review')
<style type="text/css">
    .star-rating {
        list-style: none;
        padding: 0;
        display: flex;
        margin-bottom: 5px;
    }

    .star-rating li {
        margin-right: 5px;
    }

    .star-rating .la-star {
        color: #ccc; /* gray for unfilled */
    }

    .star-rating .starred {
        color: #f7c600; /* yellow for filled */
    }

    .customer-name {
        display: block;
        font-weight: bold;
        margin-top: 5px;
    }

</style>
@section('content')
<div class="content-area">

<!-- Banner Area -->
<div class="page-headers smaller">
	<div class="container-fluid">
	<div class="row align-items-center g-0">
		<div class="col-lg-6 col-md-6 col-12">	
		<h1>Testimonials</h1>
		</div>
		<div class="col-lg-6 col-md-6 col-12">
		
	<ul class="ph-breadcrumbs-list">
					<li><a href="{{url('/index')}}">Home</a></li>
					<li><a href="page-category.html" class="active">Testimonials</a></li>
				</ul>
		</div>	
	</div>
</div>
</div>

<!-- Testimonials Area -->
<div class="client-testimonials">
                <div class="container-fluid">
                	<div class="row align-items-center mb-3">
						<div class="col-12">
							<form class="standard-form-rules product-sorter">
								<p>Filter Items:</p>
								 <select name="sort" id="shop-sort">
								<option>By Ratings</option>
								<option value="all">All Ratings</option>
								<option value="5">5 Stars</option>
								<option value="4">4 Stars</option>
								<option value="3">3 Stars</option>
								<option value="2">2 Stars</option>
								<option value="1">1 Stars</option>
								</select>
							</form>
						</div></div>
					<div class="row">
						@foreach($reviewlists as $review)
					<div class="col-md-6 col-12 review-item" data-rating="{{ $review['rating'] }}">
					<div class="testimonial-single">
							<div class="row">
							<div class="col-12">
							<ul class="star-rating">
							@for($i = 1; $i <= 5; $i++)
                                <li>
                                    <i class="las la-star {{ $i <= (int)$review['rating'] ? 'starred' : '' }}"></i>
                                </li>
                            @endfor
							</ul>
							</div>
							<div class="col-12">
							 <h3>{{ $review['productname'] }}</h3>
							</div>
							<div class="col-12">
							<p>{{ $review['comment'] }}
							<span class="customer-name">– {{ $review['clientname'] }}</span></p>
							</div>						
							</div>
					</div>
					</div>
					@endforeach
					</div>
                </div>
            </div>
</div>

<script>
    document.getElementById('shop-sort').addEventListener('change', function () {
        const selectedRating = this.value;
        const allReviews = document.querySelectorAll('.review-item');

        allReviews.forEach(review => {
            const rating = review.getAttribute('data-rating');

            if (selectedRating === 'all' || selectedRating === rating) {
                review.style.display = 'block';
            } else {
                review.style.display = 'none';
            }
        });
    });
</script>

@endsection
