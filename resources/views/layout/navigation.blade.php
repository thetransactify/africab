<header class="">
<!-- Header Container -->
<div class="container-fluid">
<div class="row justify-content-center align-items-center">
<div class="col-md-5 col-sm-5 col-0">
<ul class="menu">
<li class="has-submenu"><a href="javascript:void(0);">Shop For Products</a>
	<ul class="sub-menu">
		<li><a href="product-category.html" class=""><img src="assets/images/icon/lightfit-icon.png" /><span>Light Fittings</span></a></li>
		<li><a href="product-category.html" class=""><img src="assets/images/icon/lightsol-icon.png" /><span>Lighting Solutions</span></a></li>
		<li><a href="product-category.html" class=""><img src="assets/images/icon/fan-icon.png" /><span>Fans</span></a></li>
		<li><a href="product-category.html" class=""><img src="assets/images/icon/ac-icon.png" /><span>Air Conditioners</span></a></li>
		<li><a href="product-category.html" class=""><img src="assets/images/icon/aircool-icon.png" /><span>Air Coolers</span></a></li>
		<li><a href="product-category.html" class=""><img src="assets/images/icon/kitchen-icon.png" /><span>Kitchen Appliances</span></a></li>
		<li><a href="product-category.html" class=""><img src="assets/images/icon/lightfit-icon.png" /><span>Home Appliances</span></a></li>
		<li><a href="product-category.html" class=""><img src="assets/images/icon/wheater-icon.png" /><span>Water Heater</span></a></li>
		<li><a href="product-category.html" class=""><img src="assets/images/icon/wpurifier-icon.png" /><span>Water Purifier</span></a></li>
		<li><a href="product-category.html" class=""><img src="assets/images/icon/otherapp-icon.png" /><span>Other Appliances</span></a></li>
	</ul>
	</li>
	
    <li class=""><a href="reviews.html">Reviews</a></li>
	<li class="desktop-hidden"><a href="register.html">Register Account</a></li>
	<li class="desktop-hidden"><a href="login.html">Account Login</a></li>
    <li class="desktop-hidden"><a href="my-account.html">My Account</a></li>
    <li class="desktop-hidden"><a href="support-centre.html">Support Centre</a></li>
    <li class="has-submenu desktop-hidden"><a href="javascript:void(0)" class="title">Terms & Policy</a>
    <ul class="sub-menu">      
        <li><a href="cart.html">Terms & Conditions</a></li>
        <li><a href="my-wishlist.html">Privacy Policy</a></li>
        <li><a href="register.html">Shipping Policy</a></li>
        <li><a href="my-account.html">Return & Refund Policy</a></li>
        <li><a href="support-centre.html">Support Centre</a></li>
    </ul>
    <li class=""><a href="https://www.africab.co.tz" target="_blank">Visit Corp Website</a></li>
    </li>
    
</ul>
</div>
<div class="col-md-2 col-sm-2 col-6">
<a href="index.html" class="logo" title="Welcome to Africab" style="background-image: url('assets/images/logo-light.png');"><img src="assets/images/logo.png" alt="Africab" /></a>
</div>
<div class="col-md-5 col-sm-5 col-6">
<ul class="ecom-panel align-items-center">
		<li class=""><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#searchModal" class="search-icon"></a></li>
		<li class=""><a href="my-account.html" class="myacc-icon"></a></li>
        @php $cartTotalNav = $cartCount ?? 0; @endphp
		<li class=""><a href="javascript:void(0);" class="shopbag-icon cartopenbutton">@if($cartTotalNav > 0)<span>{{ $cartTotalNav > 99 ? '99+' : $cartTotalNav }}</span>@endif</a></li>
		<li class=""><a href="javascript:void(0);" class="menu-icon menuopenbutton"></a></li>
	</ul>

</div>
</div>
</div>
</header>
