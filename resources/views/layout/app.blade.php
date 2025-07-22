<!doctype html>
<html lang="en">
<head>
<title>Africab Online Shop </title>
<meta charset="utf-8" />
<meta name="description" content />
<meta name="keywords" content />
<meta name="author" content />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="mobile-web-app-capable" content="yes" />
<link rel="shortcut icon" href="{{asset('client/assets/images/favicons/favicon.png')}}" />
<link rel="apple-touch-icon" href="{{asset('client/assets/images/favicons/apple-touch-icon.png')}}" />
<link rel="apple-touch-icon" sizes="72x72" href="{{asset('client/assets/images/favicons/apple-touch-icon-72x72.png')}}" />
<link rel="apple-touch-icon" sizes="114x114" href="{{asset('client/assets/images/favicons/apple-touch-icon-114x114.png')}}" />
<meta name="application-name" content="Enjoy" />
<meta name="msapplication-TileColor" content="#FFF" />
<meta name="msapplication-square70x70logo" content="{{asset('client/assets/images/favicons/msapplication-tiny.png')}}" />
<meta name="msapplication-square150x150logo" content="{{asset('client/assets/images/favicons/msapplication-square.png')}}" />

<meta name="theme-color" content="#7a94a2" />
<meta name="msapplication-navbutton-color" content="#7a94a2" />
<meta name="apple-mobile-web-app-status-bar-style" content="#7a94a2s" />
<link rel="stylesheet" href="{{asset('client/assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('client/assets/fonts/fontawesome/css/all.min.css')}}"> 
<link rel="stylesheet" href="{{asset('client/assets/fonts/themify-icons/themify-icons.css')}}"> 
 <link rel="stylesheet" href="{{asset('client/assets/fonts/line-awesome-1.3.0/css/line-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('client/assets/css/default.css')}}"> 
<link rel="stylesheet" href="{{asset('client/assets/slick/slick.css')}}">   
<link rel="stylesheet" href="{{asset('client/assets/slick/slick-theme.css')}}">
<link rel="stylesheet" href="{{asset('client/assets/css/lightbox.css')}}">
<link rel="stylesheet" href="{{asset('client/assets/css/datepicker.css')}}">
<link rel="stylesheet" href="{{asset('client/assets/css/intlTelInput.min.css')}}">
<link rel="stylesheet" href="{{asset('client/assets/css/style.css')}}">
<style type="text/css">.search-results {
  background: #fff;
  border: 1px solid #ccc;
  max-height: 300px;
  overflow-y: auto;
  padding: 10px;
}
.search-item:hover {
  background-color: #f8f9fa;
  cursor: pointer;
}
</style>        

</head>
<body>
<div class="wrapper">

 @include('layout.header')
 @yield('content')
 @include('layout.footer')