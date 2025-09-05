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
                            <p class="text-small text-white mb-2"><b>Txn ID:</b> {{$OrderDeatils[0]['order_group_id']}}</p>
                            <p class="text-small text-white mb-2"><b>Order Status:</b>{{$OrderDeatils[0]['order_status']}}</p>
                            <a href="javascript:void(0);" data-toggle="modal" data-backdrop="static" data-target="#orderUpdates"   data-order_group_id="{{ $OrderDeatils[0]['order_group_id'] }}"  class="btn btn-primary mb-1 mt-1 float-right">Manage Updates</a> 
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-body">
                            <h5 class="font-weight-bold">Customer Details</h5>
                            <p class="text-small line-height-2 mb-1"><b>{{$finalShipping['name']}}</b><br>{{$finalShipping['address']}}{{$finalShipping['customer_pincode']}}</p>
                            <p class="text-small line-height-2 mb-1"><b>Mobile Number:</b> {{$finalShipping['customer_mobile']}}<br>
                            <b>Email Address :</b>{{$finalShipping['customer_email']}}</p>
                            <a href="Pages.Misc.Invoice.Standalone.html" target="_blank" class="btn btn-secondary mt-1 float-right">Print Invoice</a>

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
                            <a href="javascript:void(0);" data-toggle="modal" data-backdrop="static" data-target="#orderUpdates" class="btn btn-secondary m-1">Manage Updates</a>
                            <a href="Pages.Misc.Invoice.Standalone.html" target="_blank" class="btn btn-secondary m-1">Print Invoice</a>
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
                            <div class="form-group">
                                <label for="orderStatus">Order Status</label>
                                <select id="orderStatus" class="form-control select2-single" data-width="100%">
                                    <option label="&nbsp;">Select Status</option>
                                    <option value="1">Processing</option>
                                    <option value="2">Shipped</option>
                                    <option value="3">Delivered</option>
                                </select>

                            </div>
                            <div class="form-group" id="hasShipped">
                                <label for="shipperName">Delivery Company</label>
                                <select id="shipperName" class="form-control select2-single" data-width="100%">
                                    <option label="&nbsp;">Select Courier</option>
                                    <option value="1">Fedex</option>
                                    <option value="1">Delhivery</option>
                                    <option value="2">Blue Dart</option>
                                </select>
                                <label for="trackingNo" class="mt-2">AWB/ Consignment No.</label>
                                <input id="trackingNo" type="text" class="form-control" placeholder="">
                            </div>

                            <div class="form-group" id="customMessage">
                                <label>Custom Message</label>
                                <textarea placeholder="" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-secondary" id="updateOrderBtn" >Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>

$(document).ready(function(){
     var currentOrderGroupId = null;
    $('.btn[data-toggle="modal"]').on('click', function(){
        currentOrderGroupId = $(this).data('order_group_id');
       // console.log('Current Group ID:', currentOrderGroupId);
        $('#currentGroupId').text(currentOrderGroupId);
    });
    $(document).on('click', '#updateOrderBtn', function() {

        if(!currentOrderGroupId){
            alert('Order Group ID not found!');
            return;
        }
        var order_status = $('#orderStatus').val();
        $.ajax({
            url: '{{ route("orders.updateGroup") }}',
            type: 'POST',
            data: {
                order_group_id: currentOrderGroupId,
                order_status: order_status,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if(response.status == 'success'){
                    alert('Orders updated successfully!');
                    window.location.reload();
                    $('#orderUpdates').modal('hide');
                } else {
                    alert('Update failed!');
                }
            },
            error: function(xhr){
                alert('Something went wrong!');
            }
        });

    });

});
</script>

@endsection
