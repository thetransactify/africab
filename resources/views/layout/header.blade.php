<!-- Header -->
<!-- =================================================================================================== -->
<header class="">
<!-- Header Container -->
<div class="container-fluid">
<div class="row justify-content-center align-items-center">
<div class="col-md-5 col-sm-5 col-0">
<ul class="menu">
<li class="has-submenu"><a href="javascript:void(0);">Shop For Products</a>
    <ul class="sub-menu">
    @foreach($Categories as $category)
        <li><a href="{{ url('product-category/' .\Illuminate\Support\Str::slug($category->name)) }}" class=""><img src="{{ asset('storage/uploads/category/'. $category->file) }}" /><span>{{$category->name}}</span></a></li>
    @endforeach
    </ul>
    </li>
    <li class=""><a href="{{url('/reviews')}}">Reviews</a></li>
<!--     <li class=""><a href="{{url('/offers')}}">Offers</a></li> -->
    <li class="desktop-hidden"><a href="{{url('/register')}}">Register Account</a></li>
    <li class="desktop-hidden"><a href="{{url('/login')}}">Account Login</a></li>
    <li class="desktop-hidden"><a href="{{url('/my-account')}}">My Account</a></li>
    <li class="desktop-hidden"><a href="{{url('/support-centre')}}">Support Centre</a></li>
    <li class="has-submenu desktop-hidden"><a href="javascript:void(0)" class="title">Terms & Policy</a>
    <ul class="sub-menu">      
        <li><a href="cart.html">Terms & Conditions</a></li>
        <li><a href="{{url('/my-wishlist')}}">Privacy Policy</a></li>
        <li><a href="{{url('/register')}}">Shipping Policy</a></li>
        <li><a href="{{url('/my-account')}}">Return & Refund Policy</a></li>
        <li><a href="{{url('/support-centre')}}">Support Centre</a></li>
    </ul>
    <li class=""><a href="https://www.africab.co.tz" target="_blank">Visit Corp Website</a></li>
    </li>
    
</ul>
</div>
<div class="col-md-2 col-sm-2 col-6">
<a href="{{url('index')}}" class="logo" title="Welcome to Africab" style="background-image: url('{{ asset('client/assets/images/logo-light.png') }}');"><img src="{{asset('client/assets/images/logo.png')}}" alt="Africab" /></a>
</div>
<div class="col-md-5 col-sm-5 col-6">
<ul class="ecom-panel align-items-center">
        <li class=""><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#searchModal" class="search-icon"></a></li>
        <li class=""><a href="{{url('/my-account')}}" class="myacc-icon"></a></li>
        <li class=""><a href="javascript:void(0);" class="shopbag-icon cartopenbutton"><span>99+</span></a></li>
        <li class=""><a href="javascript:void(0);" class="menu-icon menuopenbutton"></a></li>
    </ul>

</div>
</div>
</div>
</header>
