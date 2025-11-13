<!-- Header -->
<!-- =================================================================================================== -->
<header class="">
<!-- Header Container -->
<div class="container-fluid">
<div class="row justify-content-center align-items-center">
<div class="col-md-5 col-sm-5 col-0">
<ul class="menu">
<li class="has-submenu red-text"><a href="javascript:void(0);" style="color: red !important;">Shop For Products</a>
    <ul class="sub-menu">
    @foreach($Categories as $category)
        @php
            $categorySlug = \Illuminate\Support\Str::slug($category->name);
            $categoryImg = $category->file
                ? asset('storage/uploads/category/' . $category->file)
                : asset('client/assets/images/no-image-ph.jpg');
        @endphp
        <li><a href="{{ url('product-category/' . $categorySlug) }}" class=""><img src="{{ $categoryImg }}" alt="{{ $category->name }}" /><span>{{$category->name}}</span></a></li>
    @endforeach
    </ul>
    </li>
    <li class=""><a href="#" style="color: red !important;">Africab Corporate</a></li>
<!--     <li class=""><a href="{{url('/offers')}}">Offers</a></li> -->
    <li class="desktop-hidden"><a href="{{url('/register')}}">Register Account</a></li>
    <li class="desktop-hidden"><a href="{{url('/login')}}">Account Login</a></li>
    <li class="desktop-hidden"><a href="{{url('/my-account')}}">My Account</a></li>
    <li class="desktop-hidden"><a href="{{url('/support-centre')}}">Support Centre</a></li>
    <li class="has-submenu desktop-hidden"><a href="javascript:void(0)" class="title">Terms & Policy</a>
    <ul class="sub-menu">      
        <li><a href="{{url('/terms-conditions')}}">Terms & Conditions</a></li>
        <li><a href="{{url('/privacy-policy')}}">Privacy Policy</a></li>
        <li><a href="{{url('/shipping-policy')}}">Shipping Policy</a></li>
        <li><a href="{{url('/refund-policy')}}">Return & Refund Policy</a></li>
        <li><a href="{{url('/support-centre')}}">Support Centre</a></li>
    </ul>
    <li class=""><a href="https://africabgroup.com/" target="_blank" style="color: red !important;">Africab Group</a></li>
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
        @php $cartTotal = $cartCount ?? 0; @endphp
        <li class="">
            <a href="javascript:void(0);" class="shopbag-icon cartopenbutton">
                @if($cartTotal > 0)
                    <span>{{ $cartTotal > 99 ? '99+' : $cartTotal }}</span>
                @endif
            </a>
        </li>
        <li class=""><a href="javascript:void(0);" class="menu-icon menuopenbutton"></a></li>
    </ul>

</div>
</div>
</div>
</header>
