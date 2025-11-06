@extends('layout.app')
@section('title', 'Privacy Policy')

@section('content')
<div class="content-area">

  <!-- Banner Area -->
  <div class="page-headers smaller">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-6 col-12">
          <h1>Privacy Policy</h1>
        </div>
        <div class="col-md-6 col-12">
          <ul class="ph-breadcrumbs-list">
            <li><a href="{{ url('/index') }}">Home</a></li>
            <li><a href="#" class="active">Privacy Policy</a></li>
          </ul> 
        </div>      
      </div>
    </div>
  </div>

  <!-- Privacy Body -->
  <div class="about-body">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 col-12">
          <div class="richtext-content">

            <h3>Introduction</h3>
            <p>
              Welcome to www.shop.africab.co.tz (“we”, “our”, or “us”).  
              We are committed to protecting your privacy and ensuring that your personal information is handled securely and responsibly.  
              This Privacy Policy explains how we collect, use, share, and safeguard your personal data when you access or use our eCommerce platform.  
              By using our website, you agree to the practices described in this policy.
            </p>

            <h3>Information We Collect</h3>
            <p>
              We collect the following types of information from you when you register, shop, or otherwise interact with our website:
            </p>
            <ul>
              <li><strong>Personal Information:</strong> Full name, Email address, Phone number, Shipping and billing addresses, Payment details (processed securely through authorized payment providers).</li>
              <li><strong>Non-Personal Information:</strong> IP address, Browser and device information, Usage data (pages visited and interaction patterns).</li>
            </ul>

            <h3>How We Use Your Information</h3>
            <p>We use the information we collect for the following purposes:</p>
            <ul>
              <li>To create, manage, and maintain your account</li>
              <li>To process and fulfill your orders</li>
              <li>To communicate with you about your purchases, account updates, and customer service inquiries</li>
              <li>To prevent fraud and secure transactions</li>
              <li>To improve our website functionality and user experience</li>
              <li>To comply with legal obligations</li>
            </ul>

            <h3>Sharing of Your Information</h3>
            <p>
              We will not sell or trade your personal information. We only share your information with trusted third parties when necessary:
            </p>
            <ul>
              <li><strong>Payment Gateways:</strong> Your payment information is shared securely with authorized payment providers solely for transaction processing.</li>
              <li><strong>Delivery Agencies:</strong> Your name, address, and contact details are shared with delivery service providers to ensure purchased products are shipped and delivered to you.</li>
            </ul>

            <h3>Data Protection and Security</h3>
            <p>
              We implement strict technical and organizational measures to protect your data, including encryption, secure servers, and controlled access.  
              Despite these precautions, no system is completely secure, and you acknowledge that data transmission over the internet cannot be guaranteed to be fully protected at all times.
            </p>

            <h3>Your Rights Under Tanzanian Data Protection Principles</h3>
            <p>
              In line with Tanzania’s data protection expectations and best practices, you have the following rights:
            </p>
            <ul>
              <li><strong>Access:</strong> Request details of the personal information we hold about you.</li>
              <li><strong>Correction:</strong> Request corrections to inaccurate or incomplete information.</li>
              <li><strong>Deletion:</strong> Request the removal of your personal data where legally permissible.</li>
              <li><strong>Objection:</strong> Object to the processing of your data for certain purposes.</li>
              <li><strong>Data Portability:</strong> Request that your data be transferred in a structured, commonly used format (where feasible).</li>
            </ul>

            <h3>Cookies and Tracking Technologies</h3>
            <p>
              We use cookies and similar tracking technologies to enhance your experience on our site. Cookies allow us to keep you logged in, personalize content, analyze website usage, and improve performance.  
              You can control or disable cookies through your browser settings, although some features may not function properly without them.
            </p>

            <h3>Third-Party Links</h3>
            <p>
              Our website may include links to external sites. We are not responsible for the content or privacy practices of these third-party websites.  
              We encourage you to read their privacy policies before sharing any personal information.
            </p>

            <h3>Dispute Resolution</h3>
            <p>
              Any disputes arising out of the use of this website or data processing shall be governed by the laws of Tanzania.  
              We encourage you to contact us to resolve concerns amicably. If a resolution cannot be reached, you may escalate the matter in accordance with Tanzanian dispute resolution procedures.
            </p>

            <h3>Policy Updates</h3>
            <p>
              Africab reserves the right to change or update this policy at any time.  
              Such changes shall be effective immediately upon posting to the Site.
            </p>

            <h3>Contact Information</h3>
            <p>
              Call us - 888-9636-6000 <br/>
              Email us - <a href="mailto:info@africab.co.tz">info@africab.co.tz</a><br/>
              <strong>Africab Corporate Office</strong><br/>
              Head Office<br/>
              P.O.Box # 2562,<br/>
              Africab Business Park,<br/>
              Plot no 34, Kilwa Road, Kurasini, Mivenjeni Area,<br/>
              Opposite Tanesco - Kurasini,<br/>
              Dar es Salaam, Tanzania
            </p>

          </div>
        </div>       
      </div>
    </div>
  </div>
</div>
@endsection
