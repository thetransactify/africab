
<h2>Order #{{ $order->id }}</h2>
<p>Amount: {{ $order->amount }}</p>

<iframe src="{{ $paymentUrl }}" width="100%" height="600" style="border:none;"></iframe>

<a href="{{ route('payment.cancel', Crypt::encrypt($order->id)) }}" class="btn btn-danger">Cancel Payment</a>
