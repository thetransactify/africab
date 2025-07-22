@extends('Admin.layouts.app')
@section('title', 'customer manage')
@section('content')
        <div class="row">
            <div class="col-12">
                <h1>Customers</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">

                </nav>
                <div class="separator mb-5"></div>
                <div class="col-12 mb-4">
				<div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4 font-weight-bold">Manage Customers</h5>
                         <div class="separator mb-5"></div>

                        <div class="table-responsive">
                        @if($customer_list->count() > 0)    
						<table class="data-table data-table-customer-access-list">
						<thead>
                                <tr>
                                    <th>Registration Date</th>
                                    <th>Customer's Name</th>
									<th>Mobile No.</th>
									<th>E-mail</th>
									<th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer_list as $index => $client)
                                <tr>
                                    <td>{{$client->created_at->format('d-m-y')}}</td>
                                    <td>{{$client->name}}</td>
                                    <td>{{$client->mobile}}</td>
                                    <td>{{$client->email}}</td>
                                    <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="modal"  data-target="#customerDetails" data-name="{{$client->name}}" data-status="{{$client->is_suspended}}"  data-order="{{$client->orders_count}}"  data-whislist="{{$client->wishlists_count }}" data-mobile="{{$client->mobile}}" data-email="{{$client->email}}"  title="View KYC" class="las la-eye btn btn-secondary mx-1 openViewKYC"></a>

                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#activationmodal"  data-status="{{$client->is_suspended}}" data-id="{{ Crypt::encrypt($client->id) }}" data-name="{{$client->name}}" title="Activate / Deactivate" class="las la-ban btn btn-secondary mx-1 openActivationModal"></a>

<!--                                     <a href="javascript:void(0)" data-toggle="modal" data-target="#customerpwdrt" title="Reset Password" class="las la-key btn btn-secondary mx-1"></a> -->
                                    </td>
                                </tr>
                                 @endforeach
							</tbody>
                           
						</table>
                        @else
                        No customer found
                        @endif
						</div>
                    </div>
                </div>
			</div>
            </div> 
        </div>

<!-- Actvation Toggle Modal -->
   
<div class="modal fade bd-example-modal-sm" id="activationmodal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Toggle Customer Access</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                        <div class="alert alert-warning mb-5" role="alert">* Please note, This will only manage customer access to his account. If you wish to delete the customer, delete from the list.</div>
                                        <p><b>Customer Name:</b><span id="customer-name"></span></p>
                                       <label class="form-label font-weight-bold" id="switch4-label">Customer Active</label>
                                    <div class="custom-switch custom-switch-primary-inverse mb-2">
                                          <input class="custom-switch-input" id="switch4" type="checkbox" checked>
                                          <label class="custom-switch-btn" for="switch4"></label>
                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
<!-- Customer Popup -->
   
<div class="modal fade bd-example-modal-lg" id="customerDetails" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Customer Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                         <div class="row">
                                            <div class="col-12 text-left">
                                            <div class="table-responsive">
                                            <table class="table table-bordered">
                                            
                                            <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">Customer Name</td>
                                                    <td id="customer-names"></td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Customer Status</td>
                                                    <td id="customer-status"></td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Wishlist Products</td>
                                                    <td id="wishlist-products"></td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Total Orders</td>
                                                    <td id="total-orders"></td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Mobile No.</td>
                                                    <td id="mobile-number"></td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">E-mail</td>
                                                    <td id="email-address"></td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Delivery Address 1</td>
                                                    <td>
                                                    <b>Home Address</b><br>
                                                    Jason Smith<br>
                                                    Jewel World, 175, Kalbadevi Road,
                                                    Marine Lines East, Panjarpole,
                                                    Bhuleshwar, Mumbai, Maharashtra 400018<br>
                                                    Alternate Mobile Number : +91-9877895411
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Delivery Address 2</td>
                                                    <td>
                                                    <b>Office Address</b><br>
                                                    Jason Smith<br>
                                                    Jewel World, 175, Kalbadevi Road,
                                                    Marine Lines East, Panjarpole,
                                                    Bhuleshwar, Mumbai, Maharashtra 400018<br>
                                                    Alternate Mobile Number : +91-7877895411</td>
                                                </tr> 
                                            </tbody>
                                            </table>
                                            </div> 
                                            </div>              
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
<!-- Customer Password Form -->
   
<div class="modal fade modal-right" id="customerpwdrt" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalRight" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-bold">Customer Password Reset</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                            
                            <form>
                            <div class="alert alert-warning mb-3" role="alert">* Please note, password instructions will be sent on the registered email. Please only toggle the button below if you wish to reset the password now.</div>
                            <label class="form-label font-weight-bold" id="switch6-label">Confirm Reset</label>
                            <div class="custom-switch custom-switch-primary-inverse mb-2">
                                          <input class="custom-switch-input" id="switch6" type="checkbox">
                                          <label class="custom-switch-btn" for="switch6"></label>
                             </div>
                             <div  class="form-group text-right">  
                            <p><a href="javascript:void(0);" class="btn btn-secondary">Send Reset Instructions</a></p>
                            </div>
                            </form>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
<script>
    $(document).on('click', '.openActivationModal', function () {
        var name = $(this).data('name');
        var status = $(this).data('status');
        var id = $(this).data('id');

        $('#customer-name').text(name);
        $('#switch4').prop('checked', status == 1);
        $('#switch4').data('id', id);
    });
    $('#switch4').on('change', function () {
        var id = $(this).data('id');
        var status = $(this).is(':checked') ? 1 : 0;

        // Send AJAX to update activation status
        $.ajax({
            url: '/tsfy-admin/customers/' + id + '/toggle-status',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function (response) {
                alert('Customer status updated.');
            },
            error: function () {
                alert('Error updating customer status.');
            }
        });
    });



$(document).on('click', '.openViewKYC', function () {
    var name = $(this).data('name');
    var status = $(this).data('status');
    var whislist = $(this).data('whislist');
    var orders = $(this).data('order');
    var mobile = $(this).data('mobile');
    var email = $(this).data('email');
    var statusText = (status == 1) ? 'Active' : 'Inactive';


    $('#customer-names').text(name);
    $('#customer-status').text(statusText);
    $('#wishlist-products').text(whislist);
    $('#total-orders').text(orders);
    $('#mobile-number').text(mobile);
    $('#email-address').text(email);
});

</script>


@endsection