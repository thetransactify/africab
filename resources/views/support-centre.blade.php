@extends('layout.app')
@section('title', 'My Address')
@section('content')
<div class="content-area">

<!-- Banner Area -->
<div class="page-headers smaller">
<div class="container-fluid">
	<div class="row align-items-center g-0">
		<div class="col-lg-6 col-md-6 col-12">	
		<h1>Support Centre</h1>
		</div>
		<div class="col-lg-6 col-md-6 col-12">
		
	<ul class="ph-breadcrumbs-list">
					<li><a href="index.html">Home</a></li>
					<li><a href="page-category.html" class="active">Support Centre</a></li>
				</ul>
		</div>	
	</div>
</div>
</div>

<!-- Support Centre Page -->

<div class="support-page">
	<div class="container">
	<div class="row justify-content-between">
				<div class="col-md-8 col-12">
				<div class="main-title pb-5">
					<h2 class="">Frequently<br>Asked <span class="red-color">Questions</span></h2>
				</div>
				<p>We are glad to help. If you have any questions regarding our products or purchases you have made, you can refer to our Frequently Asked Questions Section for self resolutions.</p>
				<div id="ac-tab" class="ac-tab pt-3">
					 @foreach($faqs as $faq)
					 <h2 class="ac-title">{{ $faq->question }}</h2>
                     <div class="ac-content">
                    <p>{!! nl2br(e($faq->answer)) !!}</p>
                       </div>
					 @endforeach
					</div>
				
				
			</div>
			
			</div>
</div>


</div>

<div class="support-highlight">
		<div class="container">
		
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-5 col-md-6 col-12">
				<h3>If you still have questions, you may contact us using either of these options.</h3>
				<h3>Please note for Business Inquiries write to us at <a href="mailto:sales@africab.co.tz">sales@africab.co.tz</a></h3>
			</div>
			<div class="col-lg-7 col-md-6 col-12">
				<a href="https://web.whatsapp.com/send?phone=" target="_blank" class="support-tab">
				Connect on WhatsApp<span>+255 774 786 247</span><small>(10am to 6pm - Monday to Saturday)</small></a>
				<a href="tel://+919504009009" target="_blank" class="support-tab">
				Call us<span>+255 774 786 247</span><span>+255 682 121 112</span>
				<small>(10am to 6pm - Monday to Saturday)</small></a>
				<a href="mailto:support@lessouvenir.com" target="_blank" class="support-tab">Email your Query<span>support@africab.co.tz</span><small>(Please mention your Order No. or "PG Name" Transaction No. along with screenshot)</small></a>
			</div>			
		</div>		
		</div>
		
</div>

</div>
@endsection