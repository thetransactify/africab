<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $order->order_number }}</title>
    <link rel="stylesheet" href="{{ asset('admin/css/vendor/bootstrap.min.css') }}">
    <style>
        body { background: #f8f9fa; font-family: 'Montserrat', sans-serif; }
        .invoice-wrapper { max-width: 960px; margin: 20px auto; background: #fff; padding: 40px 50px; border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.08); }
        .invoice-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .invoice-header img { max-height: 60px; }
        .invoice-title { text-transform: uppercase; font-size: 26px; letter-spacing: 3px; color: #343a40; }
        .seller-box, .customer-box { border: 1px solid #e9ecef; padding: 20px; border-radius: 10px; height: 100%; }
        .seller-box h5, .customer-box h5 { font-size: 15px; letter-spacing: 0.05em; color: #6c757d; text-transform: uppercase; margin-bottom: 10px; }
        .seller-box p, .customer-box p { margin: 0; line-height: 1.6; font-size: 14px; }
        .meta-grid { margin-top: 25px; }
        .meta-grid .meta-item { border: 1px solid #e9ecef; padding: 15px 20px; border-radius: 10px; font-size: 14px; }
        .meta-grid .meta-item span { display: block; color: #6c757d; font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; }
        .meta-grid .meta-item strong { font-size: 15px; color: #212529; }
        .items-table table { width: 100%; }
        .items-table th { background: #f1f3f5; font-weight: 600; text-transform: uppercase; font-size: 13px; }
        .items-table td { vertical-align: middle; }
        .totals-card { border: 1px solid #e9ecef; border-radius: 10px; padding: 25px; }
        .totals-card .line { display: flex; justify-content: space-between; padding: 6px 0; font-size: 15px; }
        .totals-card .line.total { font-size: 18px; font-weight: 700; border-top: 1px dashed #dee2e6; margin-top: 10px; padding-top: 15px; }
        .print-btn { margin-top: 30px; text-align: right; }
        @media print {
            body { background: transparent; }
            .invoice-wrapper { box-shadow: none; margin: 0; padding: 20px; }
            .print-btn { display: none; }
        }
    </style>
</head>
<body>
    <div class="invoice-wrapper">
        <div class="invoice-header">
            <div>
                <img src="{{ asset('admin/logos/logo-mono-dark.png') }}" alt="Africab" style="max-height: 60px;">
            </div>
            <div class="text-right">
                <p class="invoice-title mb-1">Invoice</p>
                <small>#{{ $order->order_number }}</small>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="seller-box">
                    @foreach($sellerLines as $index => $line)
                        @if($index === 0)
                            <p><strong>{{ $line }}</strong></p>
                        @else
                            <p>{{ $line }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="customer-box">
                    <h5>Customer</h5>
                    <p><strong>{{ $addressBlock['name'] }}</strong></p>
                    <p>{{ $addressBlock['address'] }}</p>
                    <p>{{ $addressBlock['customer_pincode'] }}</p>
                    <p>Email: {{ $addressBlock['customer_email'] }}</p>
                    <p>Phone: {{ $addressBlock['customer_mobile'] }}</p>
                </div>
            </div>
        </div>

        <div class="row meta-grid">
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="meta-item">
                    <span>Invoice Date</span>
                    <strong>{{ $order->created_at->format('d-m-Y') }}</strong>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="meta-item">
                    <span>Customer VAT No (Your TIN)</span>
                    <strong>{{ $customerVatNo ?? 'null' }}</strong>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="meta-item">
                    <span>Customer TRN No (Your VRN)</span>
                    <strong>{{ $customerTrnNo ?? 'null' }}</strong>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="customer-box">
                    <h5>Billing Address</h5>
                    <p><strong>{{ $billingBlock['name'] }}</strong></p>
                    <p>{{ $billingBlock['address'] }}</p>
                    <p>{{ $billingBlock['customer_pincode'] }}</p>
                    <p>Email: {{ $billingBlock['customer_email'] }}</p>
                    <p>Phone: {{ $billingBlock['customer_mobile'] }}</p>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="customer-box">
                    <h5>Pick Up Point</h5>
                    <p><strong>{{ $pickupBlock['name'] }}</strong></p>
                    <p>{{ $pickupBlock['address'] }}</p>
                    @if(!empty($pickupBlock['customer_pincode']))
                        <p>{{ $pickupBlock['customer_pincode'] }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="items-table mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Unit Price (Tsh)</th>
                        <th class="text-right">Shipping (Tsh)</th>
                        <th class="text-right">Total (Tsh)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderItems as $item)
                        <tr>
                            <td>{{ $item['product_name'] }}</td>
                            <td class="text-center">{{ $item['quantity'] }}</td>
                            <td class="text-right">{{ number_format($item['price'], 2) }}</td>
                            <td class="text-right">{{ number_format($item['shipping'], 2) }}</td>
                            <td class="text-right">{{ number_format($item['total'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row mt-4">
            <div class="col-md-6 mb-3">
                
            </div>
            <div class="col-md-6 mb-3">
                <div class="totals-card">
                    <div class="line">
                        <span>Subtotal</span>
                        <strong>Tsh {{ number_format($subtotal, 2) }}</strong>
                    </div>
                    <div class="line">
                        <span>Shipping</span>
                        <strong>Tsh {{ number_format($shippingTotal, 2) }}</strong>
                    </div>
                    @if(!is_null($taxAmount))
                    <div class="line">
                        <span>Tax Inclusive (Post Discount if applicable){{ $taxPercentage ? ' - '.$taxPercentage.'%' : '' }}</span>
                        <strong>Tsh {{ number_format($taxAmount, 2) }}</strong>
                    </div>
                    @endif
                    <div class="line total">
                        <span>Total</span>
                        <strong>Tsh {{ number_format($grandTotal, 2) }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="print-btn">
            <button class="btn btn-primary px-4" onclick="window.print()">Download / Print</button>
        </div>
        <p class="text-muted small mt-3">
            * This invoice was generated electronically and is valid without signature.
        </p>
    </div>
</body>
</html>
