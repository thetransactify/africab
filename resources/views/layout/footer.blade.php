<footer class="footer-area">
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-3 col-12">
                <ul class="footer-menu">
                    <li><a href="javascript:void(0)" class="title">Customer Section</a></li>
                    <li><a href="cart.html">My Cart</a></li>
                    <li><a href="my-wishlist.html">My Wishlist</a></li>
                    <li><a href="register.html">Register Account</a></li>
			  <li><a href="login.html">Account Login</a></li>
                    <li><a href="my-account.html">My Account</a></li>
                    <li><a href="support-centre.html">Support Centre</a></li>
                </ul>
			</div>
			<div class="col-xl-3 col-lg-3 col-12">
                <ul class="footer-menu">
                    <li><a href="javascript:void(0)" class="title">Terms & Policy</a></li>
                    <li><a href="terms-and-conditions.html">Terms & Conditions</a></li>
                    <li><a href="privacy-policy.html">Privacy Policy</a></li>
                    <li><a href="shipping-policy.html">Shipping Policy</a></li>
                    <li><a href="returns-and-refunds.html">Return & Refund Policy</a></li>
                </ul>
			</div>
			<div class="col-xl-3 col-lg-3 col-12">
                <ul class="footer-menu">
                    <li><a href="javascript:void(0)" class="title">About Africab</a></li>
                    <li class=""><a href="https://www.africab.co.tz" target="_blank">Visit Corp Website</a></li>
                    <li><a href="reviews.html">Testimonials</a></li>
                </ul>
			</div>
			<div class="col-xl-3 col-lg-3 col-12">
                <p class="footer-social-text">Visit. Like. Comment. Share.</p>
                <ul class="footer-social">
					<li><a href="https://www.twitter.com/" target="_blank" title="Visit us on Twitter"><i class="fab fa-twitter"></i></a></li>
					<li><a href="https://www.instagram.com/" target="_blank" title="Visit us on Instagram"><i class="fab fa-instagram"></i></a></li>
					<li><a href="https://www.youtube.com/" target="_blank" title="Visit us on Youtube"><i class="fab fa-youtube"></i></a></li>			
					<li><a href="https://www.pinterest.com/" target="_blank" title="Visit us on Pinterest"><i class="fab fa-linkedin-in"></i></a></li>						
				</ul>
							

			</div>
			<div class="col-12">
                <p class="copyright-p">&copy; 2023 Africab. All Rights Reserved.</p>
							

			</div>
		</div>

	</div>
</footer>
</div>


<!-- Search -->
<!-- =================================================================================================== -->
<div class="modal fade search-body" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-body">
                    <a class="close-icon"href="javascript:void(0);" data-bs-dismiss="modal"><i class="material-symbols-outlined standard-icon">close</i></a>
                    <form class="search-form">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8 col-12 form-area">
                                        <h1>What are you looking for?</h1>
                                        <input type="text" id="searchInput" placeholder="Search by typing..." />
                                        <button type="button" id="searchInput">Search Item</button>
                                        </div>
                                        <div id="searchResults" class="search-results mt-3"></div>

                                    </div>
                                </div>  
                    </form>
      </div>
    </div>
  </div>
</div>


<!-- Mobile eComm Panel -->
<!-- =================================================================================================== -->        

    <ul class="mobile-ecom-panel">
        <li class=""><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#searchModal" class="search-icon"></a></li>
        <li class=""><a href="my-account.html" class="myacc-icon"></a></li>
        <li class=""><a href="javascript:void(0);" class="shopbag-icon cartopenbutton"><span>99+</span></a></li>
    </ul>
    
<!-- Cart Modal-->
<!-- =================================================================================================== -->
        <div class="side-cart">

            <a class="close-icon side-modal-close"href="javascript:void(0);"><i class="material-symbols-outlined standard-icon">close</i></a>           
            <div class="sc-container">
                <!-- Each Row is product -->
            @foreach($wishlist ?? [] as $item)
                <div class="row g-0 each-product">
                    <div class="col-5">
                        <a class="prd-img" href="product-single.html"><img src="{{ asset('storage/uploads/product/' . $item->file) }}" /></a>
                    </div>
                    <div class="col-7">
                        <a href="product-single.html" class="prd-caption">
                            <span class="prd-name">{{$item->listing_name}}</span>
                            <ul class="prd-price">
                                <li><span class="dc-price"><i>TSh</i>{{$item->product_cost}}</span><i>TSh</i>{{$item->offer_price}}</li>

                            </ul>
                        </a>
                        <a href="{{ route('wishlist.delete', ['id' => $item->id]) }}" class="std-icon floatright"><i class="material-symbols-outlined" data-id="{{ $item->id }}" onclick="return confirm('Are you sure you want to delete this item?');">delete</i></a>
                    </div>              
                </div>       
            @endforeach

            </div>
            <ul class="sc-button-list">
            <li><a href="cart.html">View Cart</a></li>
            <li><a href="checkout.html">Checkout</a></li>
            </ul>

        </div>


<!-- Mobile Side Menu -->
<!-- =================================================================================================== -->
        <div class="side-menu">

                    <a class="close-icon side-menu-close"href="javascript:void(0);"><i class="material-symbols-outlined standard-icon">close</i></a>            
            <div class="sm-container">
            
            </div>
        </div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchInput').on('keyup', function() {
            let query = $(this).val().trim();

            if (query.length > 1) {
                $.ajax({
                    url: "{{ route('search.products') }}",
                    method: "GET",
                    data: { query: query },
                    beforeSend: function() {
                        $('#searchResults').html('<div class="text-center py-3"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
                        $('#searchResults').show();
                    },
                    success: function(data) {
                        $('#searchResults').html(data);
                        $('#searchResults').show();
                    },
                    error: function() {
                        $('#searchResults').html('<div class="no-results">Error loading results</div>');
                        $('#searchResults').show();
                    }
                });
            } else {
                $('#searchResults').hide();
                $('#searchResults').html('');
            }
        });

        // Hide results when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#searchResults, #searchInput').length) {
                $('#searchResults').hide();
            }
        });

        // Handle item click
        $(document).on('click', '.search-item', function() {
            let productName = $(this).find('strong').text();
            $('#searchInput').val(productName);
            $('#searchResults').hide();
            // You can add navigation to product page here
        });
    });
    </script>

<!-- =================================================================================================== -->
        <script src="{{asset('client/assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
        <script src="{{asset('client/assets/js/vendor/jquery-ui.js')}}"></script>
        
        <!-- Important CDNs -->
        <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
        
        <script src="{{asset('client/assets/js/vendor/modernizr.custom.js')}}"></script>
        <script src="{{asset('client/assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('client/assets/slick/slick.min.js')}}"></script> 
        <script src="{{asset('client/assets/js/lightbox.js')}}"></script> 
        <script src="{{asset('client/assets/js/intlTelInput-jquery.min.js')}}"></script> 
        <script src="{{asset('client/assets/js/date-picker.js')}}"></script>     
        <script src="{{asset('client/assets/js/news-ticker.js')}}"></script>
             
        <script src="{{asset('client/assets/js/main.js')}}"></script>
        
        
</body>

</html>