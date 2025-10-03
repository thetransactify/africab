<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Africab - Coming Soon</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #fff5f5 0%, #ffe6e6 100%);
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
            line-height: 1.6;
        }

        .container {
            max-width: 900px;
            width: 100%;
            animation: fadeIn 1.5s ease-in-out;
        }

        .logo {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #e53935;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .logo span {
            color: #333;
        }

        h1 {
            font-size: 3.2rem;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            color: #e53935;
        }

        .tagline {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            font-weight: 300;
        }

        p {
            font-size: 1.3rem;
            margin-bottom: 2.5rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            color: #555;
        }

        .features {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 25px;
            margin: 3rem 0;
        }

        .feature {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 15px;
            padding: 25px 20px;
            width: 200px;
            box-shadow: 0 8px 20px rgba(229, 57, 53, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(229, 57, 53, 0.1);
        }

        .feature:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 25px rgba(229, 57, 53, 0.15);
        }

        .feature i {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #e53935;
        }

        .feature h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #333;
        }

        .feature p {
            font-size: 0.9rem;
            margin-bottom: 0;
            color: #666;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 3rem;
        }

        .social-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(229, 57, 53, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            color: #e53935;
            text-decoration: none;
            font-size: 1.3rem;
        }

        .social-icon:hover {
            background: #e53935;
            color: white;
            transform: translateY(-5px) scale(1.1);
        }

        .contact {
            margin-top: 3rem;
            font-size: 1.1rem;
            color: #666;
        }

        .contact a {
            color: #e53935;
            text-decoration: none;
            font-weight: 600;
        }

        .contact a:hover {
            text-decoration: underline;
        }

        .badge {
            display: inline-block;
            background: #e53935;
            color: white;
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 2rem;
            box-shadow: 0 4px 10px rgba(229, 57, 53, 0.3);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }
            
            .tagline {
                font-size: 1.5rem;
            }
            
            p {
                font-size: 1.1rem;
            }
            
            .features {
                gap: 15px;
            }
            
            .feature {
                width: 160px;
                padding: 20px 15px;
            }
        }
        
        @media (max-width: 480px) {
            h1 {
                font-size: 2rem;
            }
            
            .tagline {
                font-size: 1.3rem;
            }
            
            p {
                font-size: 1rem;
            }
            
            .logo {
                font-size: 2.2rem;
            }
            
            .features {
                flex-direction: column;
                align-items: center;
            }
            
            .feature {
                width: 100%;
                max-width: 280px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">Africab</div>
        <div class="badge">Launching Soon</div>
        <h1>Your Ultimate Shopping Destination</h1>
        <p class="tagline">Get ready for a revolutionary shopping experience</p>
        <p>We're building an e-commerce platform that will transform how you shop online. With exclusive deals, fast delivery, and a seamless experience, your perfect shopping journey is just around the corner.</p>
        
        <div class="features">
            <div class="feature">
                <i class="fas fa-shipping-fast"></i>
                <h3>Fast Delivery</h3>
                <p>Get your orders delivered in record time</p>
            </div>
            <div class="feature">
                <i class="fas fa-tags"></i>
                <h3>Best Prices</h3>
                <p>Exclusive deals and discounts every day</p>
            </div>
            <div class="feature">
                <i class="fas fa-shield-alt"></i>
                <h3>Secure Payment</h3>
                <p>Your transactions are 100% protected</p>
            </div>
            <div class="feature">
                <i class="fas fa-headset"></i>
                <h3>24/7 Support</h3>
                <p>We're here to help you anytime</p>
            </div>
        </div>
        

    </div>
</body>
</html>