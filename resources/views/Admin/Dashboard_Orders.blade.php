@extends('Admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
            <div class="row">
                <div class="col-12">
                    <h1>Order Management</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="{{url('tsfy-admin/dashboard')}}">Back to Orders</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div> 
            </div>
<div class="row">
                <div class="col-md-4 col-12">
                    <div class="card mb-5 colorBox">
                        <div class="card-body">
                            <h3 class="text-white font-weight-bolder">{{$OrderDeatils[0]['order_number']}}</h3>
                            <p class="text-small text-white mb-2"><b>Date:</b> {{$OrderDeatils[0]['order_date']}}</p>
                            <p class="text-small text-white mb-2"><b>Txn ID:</b> {{$OrderDeatils[0]['txn_reference'] ?? '-'}}</p>
                            <p class="text-small text-white mb-2"><b>Order Status:</b> {{$OrderDeatils[0]['order_status']}}</p>
                            <p class="text-small text-white mb-2"><b>Payment Status:</b> {{$OrderDeatils[0]['payment_status']}}</p>
                            <p class="text-small text-white mb-2"><b>Pick Up Status:</b> {{$pickupStatus}}</p>
                            <a href="javascript:void(0);" 
                               data-toggle="modal" 
                               data-backdrop="static" 
                               data-target="#orderUpdates"   
                               data-order_group_id="{{ $OrderDeatils[0]['order_group_id'] }}"  
                               class="btn btn-primary mb-1 mt-1 float-right">Manage Updates</a> 
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-body">
                            <h5 class="font-weight-bold">Customer Details</h5>
                            <p class="text-small line-height-2 mb-1"><b>{{$finalShipping['name']}}</b><br>{{$finalShipping['address']}}{{$finalShipping['customer_pincode']}}</p>
                            <p class="text-small line-height-2 mb-1"><b>Mobile Number:</b> {{$finalShipping['customer_mobile']}}<br>
                            <b>Email Address :</b>{{$finalShipping['customer_email']}}</p>
                            <a href="{{ route('orders.invoice', $encryptedId) }}" target="_blank" class="btn btn-secondary mt-1 float-right">Print Invoice</a>

                            <div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            <h5 class="font-weight-bold">Ordered Items</h5>
                            <div class="separator mb-0"></div>
                            <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product Details</th>
                                        <th scope="col">Qty.</th>
                                        <th scope="col">Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                     @foreach($OrderItems as $order)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $order['product_name'] }}</td>
                                        <td>{{ $order['quantity'] }}</td>
                                        <td><small class="font-weight-bold ">TsH</small>{{ number_format($order['price'], 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="thead-light">
                                    <tr>
                                        <td scope="col" class="text-left font-weight-bolder"></td>
                                        <td colspan="2" scope="col" class="text-left font-weight-bolder">Shipping Rate</td>
                                        <td scope="col"><small class="font-weight-bold ">TsH</small>{{ number_format($OrderItems[0]['shipping_price'] ?? 0, 2) }}</td >
                                    </tr>
                                    <tr>
                                        <td colspan="3" scope="col" class="text-right font-weight-bolder">Grand Total</td>
                                        <td scope="col"><small class="font-weight-bold ">TsH</small>{{ number_format(array_sum(array_column($OrderItems, 'total')) + ($OrderItems[0]['shipping_price'] ?? 0), 2) }}</td >
                                    </tr>
                                </tfoot>
                            </table>
                            </div>
                            <div class="d-block text-right">
                            <a href="javascript:void(0);" 
                               data-toggle="modal" 
                               data-backdrop="static" 
                               data-target="#orderUpdates" 
                               data-order_group_id="{{ $OrderDeatils[0]['order_group_id'] }}"
                               class="btn btn-secondary m-1">Manage Updates</a>
                            <a href="{{ route('orders.invoice', $encryptedId) }}" target="_blank" class="btn btn-secondary m-1">Print Invoice</a>
                            </div>
                        </div>
                    </div> 
                    <div class="card mb-5">
                        <div class="card-body">
                            <h5 class="font-weight-bold">Order Status Log</h5>
                            <div class="separator mb-0"></div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orderStatusLog as $log)
                                            <tr>
                                                <td>{{ $log['date'] }}</td>
                                                <td>{{ $log['status'] }}</td>
                                                <td>{{ $log['message'] }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">No order updates recorded yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
                    <div class="card mb-5">
                        <div class="card-body">
                            <h5 class="font-weight-bold">Payment Status Log</h5>
                            <div class="separator mb-0"></div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Payment Status</th>
                                            <th scope="col">Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($paymentStatusLog as $log)
                                            <tr>
                                                <td>{{ $log['date'] }}</td>
                                                <td>{{ $log['status'] }}</td>
                                                <td>{{ $log['message'] }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">No payment updates recorded yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>               
                </div>  
            
            </div>


            <!-- Order Updates Modal -->
   
            <div class="modal fade modal-right" id="orderUpdates" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalRight" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold">Order Updates</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form>
                            <input type="hidden" id="orderGroupIdInput" value="">

                            <div class="border rounded p-3 mb-4">
                                <h6 class="font-weight-bold mb-3">Order Status Update</h6>
                                <div class="form-group">
                                    <label for="orderStatus">Order Status</label>
                                    <select id="orderStatus" class="form-control select2-single" data-width="100%">
                                        <option label="&nbsp;">Select Status</option>
                                        @foreach($orderStatusLabels as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            <!--     <div class="form-group" id="hasShipped">
                                    <label for="shipperName">Delivery Company</label>
                                    <select id="shipperName" class="form-control select2-single" data-width="100%">
                                        <option label="&nbsp;">Select Courier</option>
                                        <option value="Fedex">Fedex</option>
                                        <option value="Delhivery">Delhivery</option>
                                        <option value="Blue Dart">Blue Dart</option>
                                    </select>
                                    <label for="trackingNo" class="mt-2">AWB/ Consignment No.</label>
                                    <input id="trackingNo" type="text" class="form-control" placeholder="">
                                </div> -->

                                <div class="form-group" id="orderMessage">
                                    <label for="orderMessageInput">Custom Message</label>
                                    <textarea id="orderMessageInput" placeholder="" class="form-control" rows="2"></textarea>
                                </div>
                                <div class="form-group text-right mb-0">
                                    <button type="button" class="btn btn-secondary" id="updateOrderBtn">Update Order Status</button>
                                </div>
                            </div>

                            <div class="border rounded p-3">
                                <h6 class="font-weight-bold mb-3">Payment Status Update</h6>
                                <div class="form-group">
                                    <label for="paymentStatus">Payment Status</label>
                                    <select id="paymentStatus" class="form-control select2-single" data-width="100%">
                                        <option label="&nbsp;">Select Payment Status</option>
                                        @foreach($paymentStatusLabels as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="paymentMessage">
                                    <label for="paymentMessageInput">Payment Note</label>
                                    <textarea id="paymentMessageInput" placeholder="" class="form-control" rows="2"></textarea>
                                </div>
                                <div class="form-group text-right mb-0">
                                    <button type="button" class="btn btn-primary" id="updatePaymentBtn">Update Payment Status</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>

$(document).ready(function () {
    const $orderGroupInput = $('#orderGroupIdInput');

    function resetModalFields() {
        $orderGroupInput.val('');
        $('#orderStatus').val('');
        $('#paymentStatus').val('');
        $('#orderMessageInput').val('');
        $('#paymentMessageInput').val('');
        $('#shipperName').val('');
        $('#trackingNo').val('');
    }

    $(document).on('click', '[data-toggle="modal"][data-target="#orderUpdates"]', function () {
        const groupId = $(this).data('order_group_id') || '';
        $orderGroupInput.val(groupId);
    });

    $('#orderUpdates').on('hidden.bs.modal', function () {
        resetModalFields();
    });

    $(document).on('click', '#updateOrderBtn', function () {
        const currentOrderGroupId = $orderGroupInput.val();

        if (!currentOrderGroupId) {
            alert('Order Group ID not found!');
            return;
        }

        const order_status = $('#orderStatus').val();
        const custom_message = $('#orderMessageInput').val();

        if (!order_status) {
            alert('Please select an order status!');
            return;
        }

        $.ajax({
            url: '{{ route("orders.updateGroup") }}',
            type: 'POST',
            data: {
                order_group_id: currentOrderGroupId,
                order_status: order_status,
                custom_message: custom_message,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.status === 'success') {
                    alert('Order status updated successfully!');
                    $('#orderUpdates').modal('hide');
                    window.location.reload();
                } else {
                    alert(response.message || 'Update failed!');
                }
            },
            error: function () {
                alert('Something went wrong while updating the order!');
            }
        });
    });

    $(document).on('click', '#updatePaymentBtn', function () {
        const currentOrderGroupId = $orderGroupInput.val();

        if (!currentOrderGroupId) {
            alert('Order Group ID not found!');
            return;
        }

        const payment_status = $('#paymentStatus').val();
        const custom_message = $('#paymentMessageInput').val();

        if (!payment_status) {
            alert('Please select a payment status!');
            return;
        }

        $.ajax({
            url: '{{ route("orders.updatePayment") }}',
            type: 'POST',
            data: {
                order_group_id: currentOrderGroupId,
                payment_status: payment_status,
                custom_message: custom_message,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.status === 'success') {
                    alert('Payment status updated successfully!');
                    $('#orderUpdates').modal('hide');
                    window.location.reload();
                } else {
                    alert(response.message || 'Update failed!');
                }
            },
            error: function () {
                alert('Something went wrong while updating the payment status!');
            }
        });
    });
});
</script>

@endsection
