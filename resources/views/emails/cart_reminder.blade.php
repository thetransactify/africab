<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Reminder Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #ff7f7f 0%, #6a11cb 50%, #2575fc 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .email-body {
            padding: 30px;
            text-align: center;
        }
        .email-footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
        }
        .cart-icon {
            font-size: 48px;
            margin-bottom: 20px;
            color: #6a11cb;
        }
        .reminder-text {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 25px;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #ff7f7f 0%, #6a11cb 50%, #2575fc 100%);
            color: white;
            padding: 14px 35px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            margin: 15px 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(106, 17, 203, 0.3);
        }
        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(106, 17, 203, 0.4);
        }
        .offer-text {
            background-color: #fff9e6;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 25px 0;
            border-radius: 4px;
            text-align: center;
        }
        .social-icons a {
            color: #6c757d;
            margin: 0 10px;
            text-decoration: none;
            font-size: 16px;
        }
        .divider {
            height: 1px;
            background-color: #eaeaea;
            margin: 25px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="email-header">
            <h2>Did You Forget Something?</h2>
            <p class="mb-0">Your cart is waiting for you!</p>
        </div>

        <!-- Body Section -->
        <div class="email-body">
            <div class="cart-icon">🛒</div>
            
            <h3>Dear Customer,</h3>
            
            <p class="reminder-text">
                We noticed you left some items in your shopping cart. Don't miss out on the products you selected!
            </p>
            
            <div class="offer-text">
                <h5>✨ Special Offer Just For You! ✨</h5>
                <p class="mb-0">Complete your purchase within 24 hours and get your order!</p>
            </div>
            
            <p class="reminder-text">
                Your cart will be saved for your convenience, but items may sell out if you wait too long.
            </p>
            
            <a href="{{url('/cart')}}" class="cta-button">Complete Your Purchase Now</a>
            
            <div class="divider"></div>
            
            <p class="text-muted">
                If you have any questions, our support team is here to help.
            </p>
        </div>

        <!-- Footer Section -->
        <div class="email-footer">
            <p class="mb-2">© 2025 Africab. All Rights Reserved.</p>
            <p class="mb-3">Africab Business Park,
                Plot no 34, Kilwa Road, Kurasini, Mivenjeni Area,
                Opposite Tanesco - Kurasini,
                Dar es Salaam, Tanzania</p>
            <p class="small mb-0">You received this email because you left items in your shopping cart on our website.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>