<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Back In Stock Notification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 20px;
            color: #2d3748;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        .email-header {
            background: linear-gradient(120deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 25px 20px;
            text-align: center;
        }
        .email-body {
            padding: 30px;
        }
        .email-footer {
            background-color: #f8fafc;
            padding: 25px 20px;
            text-align: center;
            font-size: 13px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }
        .product-image {
            width: 100%;
            max-width: 220px;
            border-radius: 10px;
            margin: 0 auto;
            display: block;
            border: 1px solid #e2e8f0;
        }
        .product-title {
            font-weight: 700;
            font-size: 22px;
            margin: 20px 0 10px;
            color: #2d3748;
        }
        .product-price {
            font-size: 20px;
            font-weight: 600;
            color: #6a11cb;
            margin-bottom: 15px;
        }
        .in-stock-badge {
            display: inline-block;
            background-color: #10b981;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .cta-button {
            display: block;
            width: 100%;
            background: linear-gradient(120deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 16px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 18px;
            margin: 25px 0;
            text-align: center;
            transition: all 0.3s ease;
        }
        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 17, 203, 0.3);
        }
        .features-list {
            text-align: left;
            margin: 20px 0;
        }
        .features-list li {
            margin-bottom: 10px;
            display: flex;
            align-items: flex-start;
        }
        .features-list i {
            color: #6a11cb;
            margin-right: 10px;
            margin-top: 4px;
            flex-shrink: 0;
        }
        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background: #e2e8f0;
            color: #64748b;
            border-radius: 50%;
            margin: 0 5px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .social-icons a:hover {
            background: #6a11cb;
            color: white;
            transform: translateY(-3px);
        }
        .warning-text {
            background: #fffbeb;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #f59e0b;
            margin: 20px 0;
            text-align: center;
        }
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #cbd5e1, transparent);
            margin: 30px 0;
        }
        @media (max-width: 576px) {
            .email-body {
                padding: 20px;
            }
            .product-title {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-header">
            <h2>Hi,</h2>
            <h3>Good News! It's Back In Stock</h3>
            <p class="mb-0">The product you wanted is now available</p>
        </div>

        <!-- Body Section -->
        <div class="email-body">
            <div class="text-center">
                <span class="in-stock-badge">
                    <i class="fas fa-check-circle me-2"></i> Now In Stock
                </span>
                
                <img src="https://via.placeholder.com/300" class="product-image" alt="Wireless Headphones">
                
                <h2 class="product-title">Premium Wireless Noise-Cancelling Headphones</h2>
                
                <div class="product-price">$129.99</div>
                
                <p class="mb-0">Hurry! Limited stock available. This product may sell out quickly.</p>
            </div>

            <a href="#" class="cta-button">
                <i class="fas fa-shopping-cart me-2"></i> Shop Now Before It's Gone
            </a>

            <div class="divider"></div>

            <div class="divider"></div>

            <div class="text-center">
                <p class="text-muted">
                    You received this notification because you asked us to alert you when this product was back in stock.
                </p>
            </div>
        </div>

        <!-- Footer Section -->
        <div class="email-footer">
             <p class="mb-2">© 2025 Africab. All Rights Reserved.</p>
            <p class="mb-3">Africab Business Park,
                Plot no 34, Kilwa Road, Kurasini, Mivenjeni Area,
                Opposite Tanesco - Kurasini,
                Dar es Salaam, Tanzania</p>
            <div class="social-icons mb-3">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
            <p class="small mb-0">This is an automated email, please do not reply directly to this message.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>