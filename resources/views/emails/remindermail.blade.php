<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Saved Items</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #f9f3f3;
            padding: 20px;
            color: #333333;
            line-height: 1.6;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
        }
        .header {
            background: linear-gradient(to right, #ff6b6b, #ff8e8e);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .content {
            padding: 35px;
        }
        .footer {
            background-color: #fff5f5;
            padding: 25px 20px;
            text-align: center;
            font-size: 13px;
            color: #888;
            line-height: 1.5;
        }
        .icon-wrapper {
            text-align: center;
            margin: 20px 0;
        }
        .icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            background-color: #fff2f2;
            border-radius: 50%;
            margin: 0 15px;
        }
        .icon i {
            font-size: 30px;
            color: #ff6b6b;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(to right, #ff6b6b, #ff8e8e);
            color: white;
            padding: 14px 30px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 20px 0;
            text-align: center;
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.25);
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(255, 107, 107, 0.35);
        }
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #ffd6d6, transparent);
            margin: 30px 0;
        }
        .text-center {
            text-align: center;
        }
        .offer-box {
            background-color: #fffafa;
            border-left: 4px solid #ff6b6b;
            padding: 18px;
            border-radius: 6px;
            margin: 25px 0;
        }
        .social-icons {
            margin: 20px 0;
        }
        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background-color: #ffecec;
            color: #ff6b6b;
            border-radius: 50%;
            margin: 0 5px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .social-icons a:hover {
            background-color: #ff6b6b;
            color: white;
            transform: translateY(-3px);
        }
        
        /* Responsive styles */
        @media screen and (max-width: 600px) {
            .content {
                padding: 25px 20px;
            }
            .icon {
                width: 60px;
                height: 60px;
                margin: 0 10px;
            }
            .icon i {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Your Saved Items Are Waiting</h1>
            <p>We've saved your selections for you!</p>
        </div>
        
        <div class="content">
            <p>Dear Customer,</p>
            <p>We noticed you've shown interest in some of our products. Whether they're in your wishlist or shopping cart, we've saved them for you to come back to anytime.</p>
            
            <div class="offer-box">
                <p><strong>Special limited-time offer:</strong> Enjoy <strong>OFFERS</strong> on any saved items when you complete your purchase within the next 48 hours!</p>
            </div>
            
            <div class="text-center">
                <a href="{{url('my-wishlist')}}" class="btn">View My Saved Items</a>
            </div>
            
            <div class="divider"></div>
            
            <p>Your saved items will be waiting for you, but remember that prices and availability may change. We recommend completing your purchase soon to secure your products at current prices.</p>
            
            <p>If you have any questions or need assistance, our customer support team is here to help!</p>
        </div>
        
        <div class="footer">
            <p class="mb-2">© 2025 Africab. All Rights Reserved.</p>
            <p class="mb-3">Africab Business Park,
                Plot no 34, Kilwa Road, Kurasini, Mivenjeni Area,
                Opposite Tanesco - Kurasini,
                Dar es Salaam, Tanzania</p>
            <p>You received this email because you saved items on In Africab.</p>
        </div>
    </div>

    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>