<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li>
                    <a href="{{url('tsfy-admin/dashboard')}}">
                        <i class="iconsminds-monitor"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="active">
                    <a href="{{url('tsfy-admin/product-orders')}}">
                        <i class="iconsminds-basket-coins"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li>
                    <a href="#products">
                        <i class="iconsminds-record"></i>
                        <span>Products</span>
                    </a>
                </li> 
                <li>
                    <a href="#users">
                        <i class="iconsminds-male-female"></i>
                        <span>Customers</span>
                    </a>
                </li>
                <li>
                    <a href="#reviews">
                        <i class="iconsminds-speach-bubble"></i>
                        <span>Reviews</span>
                    </a>
                </li>
                    <!-- <a href="#ecom-management">
                        <i class="iconsminds-tag"></i>
                        <span>eCommerce Management</span>
                    </a> -->

                <li>
                    <a href="#cms-management">
                        <i class="iconsminds-equalizer"></i>
                        <span>CMS Management</span>
                    </a>
                </li>              
            </ul>
        </div>
    </div>

    <div class="sub-menu">
        <div class="scroll">
            <ul class="list-unstyled" data-link="products">
                <li>
                    <a href="#" data-toggle="collapse" data-target="#manageCategory" aria-expanded="true"
                        aria-controls="collapseForms" class="rotate-arrow-icon opacity-50">
                        <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Manage Category</span>
                    </a>
                    <div id="manageCategory" class="collapse show">
                        <ul class="list-unstyled inner-level-menu">
                            <li>
                                <a href="{{url('tsfy-admin/create-category')}}">
                                    <i class="simple-icon-plus"></i> <span class="d-inline-block">Add New</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('tsfy-admin/view-category')}}">
                                    <i class="simple-icon-list"></i> <span class="d-inline-block">View List</span>
                                </a>
                            </li>
							<!-- <li>
                                <a href="Category.BgImage.html">
                                    <i class="simple-icon-picture"></i> <span class="d-inline-block">Cat. BgImage</span>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" data-target="#manageProducts" aria-expanded="true"
                        aria-controls="collapseDataTables" class="rotate-arrow-icon opacity-50">
                        <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Manage Subcategory</span>
                    </a>
                    <div id="manageProducts" class="collapse show">
                        <ul class="list-unstyled inner-level-menu">
                            <li>
                                <a href="{{url('tsfy-admin/brand')}}">
                                    <i class="simple-icon-magic-wand"></i> <span class="d-inline-block">Manage Brands</span>
                                </a>
                            </li>
                                                       	
                            <li>
                                <a href="{{url('tsfy-admin/create-subcategory')}}">
                                    <i class="simple-icon-plus"></i> <span class="d-inline-block">Add New</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('tsfy-admin/view-subcategory')}}">
                                    <i class="simple-icon-list"></i> <span class="d-inline-block">View List</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="Product.Bestsellers.List.html">
                                    <i class="simple-icon-list"></i> <span class="d-inline-block">Bestsellers</span>
                                </a>
                            </li>  -->                            
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" data-target="#mediaGallery" aria-expanded="true"

                        aria-controls="collapseDataTables" class="rotate-arrow-icon opacity-50">
                        <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Product Settings</span>
                    </a>
                    <div id="mediaGallery" class="collapse show">
                        <ul class="list-unstyled inner-level-menu">
							<li>
                                <a href="{{url('tsfy-admin/product-price')}}">
                                    <i class="simple-icon-list"></i> <span class="d-inline-block">Product List</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('tsfy-admin/manage-offers')}}">
                                    <i class="simple-icon-plus"></i> <span class="d-inline-block">Products Offers</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('tsfy-admin/product-gallery')}}">
                                    <i class="simple-icon-picture"></i> <span class="d-inline-block">Product Gallery</span>
                                </a>
                            </li>
                             <li>
                                <a href="{{url('tsfy-admin/add-product')}}">
                                    <i class="simple-icon-picture"></i> <span class="d-inline-block">Bulk upload</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('tsfy-admin/google-sheet')}}">
                                    <i class="simple-icon-wallet"></i> <span class="d-inline-block">Price Sync</span>
                                </a>
                            </li>
                             <li>
                                <a href="{{url('tsfy-admin/upload-video')}}">
                                    <i class="simple-icon-picture"></i> <span class="d-inline-block">Upload Video</span>
                                </a>
                            </li>
                             <li>
                                <a href="{{url('tsfy-admin/popular-product')}}">
                                    <i class="simple-icon-picture"></i> <span class="d-inline-block">Popular Items</span>
                                </a>
                            </li>

						<div id="manageProductsSecurity" class="collapse show">
                        <ul class="list-unstyled inner-level-menu">
                            <li>
                                <a href="{{url('tsfy-admin/product-permission')}}">
                                    <i class="simple-icon-eye"></i> <span class="d-inline-block">Product Visibility</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                        </ul>
                    </div>
                </li>
            </ul>
			<ul class="list-unstyled" data-link="users">
                <li>
                    <a href="{{url('tsfy-admin/customer-manage')}}">
                        <i class="simple-icon-eye"></i> <span class="d-inline-block">Manage Customers</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('tsfy-admin/customer-summary')}}">
                        <i class="simple-icon-list"></i> <span class="d-inline-block">Customer Summary</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('tsfy-admin/customer-wishlist')}}">
                        <i class="simple-icon-heart"></i> <span class="d-inline-block">Customer Wishlist</span>
                    </a>
                </li>
                 <li>
                    <a href="{{url('tsfy-admin/cart-reminder')}}">
                        <i class="simple-icon-wallet"></i> <span class="d-inline-block">Cart Reminder</span>
                    </a>
                </li>
                 <li>
                    <a href="{{url('tsfy-admin/save-to-cart')}}">
                        <i class="simple-icon-handbag"></i> <span class="d-inline-block">Save To Cart</span>
                    </a>
                </li>
                
            </ul>              
            <ul class="list-unstyled" data-link="reviews">
                <li>
                    <a href="{{url('tsfy-admin/review-list')}}">
                        <i class="simple-icon-speech"></i> <span class="d-inline-block">New Reviews</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('tsfy-admin/moderated-review')}}">
                        <i class="simple-icon-list"></i> <span class="d-inline-block">Moderated Reviews</span>
                    </a>
                </li>
                
            </ul>  
			<!-- <ul class="list-unstyled" data-link="ecom-management">
               	<li>
                    <a href="Discount.Manager.List.html">
                        <i class="simple-icon-tag"></i> <span class="d-inline-block">Discount Manager</span>
                    </a>
                </li>
                <li>
                    <a href="Shipping.Shipping.List.html">
                        <i class="simple-icon-handbag"></i> <span class="d-inline-block">Shipping Manager</span>
                    </a>
                </li> 
               	<li>
                    <a href="Volume.Discount.Manage.html">
                        <i class="simple-icon-wallet"></i> <span class="d-inline-block">Volume Discount Manager</span>
                    </a>
                </li>
                <li>
                    <a href="Cart.Limit.Manage.html">
                        <i class="simple-icon-basket"></i> <span class="d-inline-block">Cart Limit Manager</span>
                    </a>
                </li>                     
            </ul> -->
            
            <ul class="list-unstyled" data-link="cms-management">
                <li>
                   <a href="{{url('tsfy-admin/homepage')}}">
                        <i class="simple-icon-screen-desktop"></i> <span class="d-inline-block">Homepage Banners</span>
                   </a>
                </li>
                <li>
                   <a href="{{url('tsfy-admin/frequently-asked-questions')}}">
                        <i class="simple-icon-screen-desktop"></i> <span class="d-inline-block">Frequently Asked Questions</span>
                   </a>
                </li>
                <li>
                   <a href="{{url('tsfy-admin/advertisement')}}">
                        <i class="simple-icon-star"></i> <span class="d-inline-block">Home Ad Popup</span>
                   </a>
                </li> 
                <li>
                   <a href="{{url('tsfy-admin/product-positioning')}}">
                        <i class="simple-icon-star"></i> <span class="d-inline-block">Product Positioning</span>
                   </a>
                </li> 
                <li>
                    <a href="{{url('tsfy-admin/shipping-zone')}}">
                        <i class="simple-icon-cup"></i> <span class="d-inline-block">Shipping Zones</span>
                    </a>
                </li>
                 <li>
                    <a href="{{url('tsfy-admin/shop-list')}}">
                        <i class="simple-icon-plus"></i> <span class="d-inline-block">Store List</span>
                    </a>
                </li>
				<!-- <li> -->
               <!--      <a href="#" data-toggle="collapse" data-target="#manageNews" aria-expanded="true"
                        aria-controls="collapseDataTables" class="rotate-arrow-icon opacity-50">
                        <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Manage News & Events</span>
                    </a>
                    <div id="manageProducts" class="collapse show">
                        <ul class="list-unstyled inner-level-menu">
                            <li>
                                <a href="News.Events.List.html">
                                    <i class="simple-icon-plus"></i> <span class="d-inline-block">News & Events List</span>
                                </a>
                            </li>
                            <li>
                                <a href="News.Events.Gallery.html">
                                    <i class="simple-icon-list"></i> <span class="d-inline-block">N & E Gallery</span>
                                </a>
                            </li>
                                                           
                        </ul>
                    </div>
                </li> -->

              <!--   <li>
                    <a href="CMS.Static.Pages.List.html">
                        <i class="simple-icon-link"></i> <span class="d-inline-block">Static Pages Meta Tags</span>
                    </a>
                </li> -->

            </ul> 
        </div>
    </div>
</div>
