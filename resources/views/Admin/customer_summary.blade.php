@extends('Admin.layouts.app')
@section('title', 'Customer Summary')
@section('content')
            <div class="row">
                <div class="col-12">
                    <h1>Customers</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">

                    </nav>
                    <div class="separator mb-5"></div>
                    <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4 font-weight-bold">Customers Wishlist</h5>
                            <div class="alert alert-warning mb-5" role="alert">* Select the customer you want to view the orders of.</div>
                            <div class="row mb-3">
                            <div class="col-md-6 col-12">
                            <form id="customerForm">
                            <div class="form-group mb-4">
                                <label class="form-group has-float-label mb-4">
                                <select id="CategoryList" class="form-control select2-single" data-width="100%">
                                    <option label="&nbsp;">Select Customer</option>
                                @foreach($customer_summary as $customer)
                                   <option value="{{ $customer->id }}">
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                                </select>
                                    <span>Customer Name</span>
                            </label>
                                </div>  
                            <div class="form-group text-right">                                                            
                                <button class="btn btn-secondary" type="submit">List Orders</button>
                            </div>
                            </form>
                            </div>
                           </div>
                             <div class="separator mb-5"></div>
                             <p class="text-center font-weight-bold pt-1 pb-3 m-0">Displaying Orders for "John Smith"</p>
                            <div class="row">
                            <div class="col-12"> 
                            <div class="table-responsive">
                            <table class="data-table data-table-customer-orders" id="ordersTable">
                            <thead>
                                    <tr>
                                        <th>Order No.</th>
                                        <th>Order Date</th>
                                        <th>Amount</th> 
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>                                  
                                </tbody>
                            </table>
                            </div>
                            </div>
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
                                        <p><b>Customer Name:</b> John Doe Smith</p>
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
                                                    <td>John Doe Smith</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Customer Status</td>
                                                    <td>Active</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Wishlist Products</td>
                                                    <td>5</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Total Orders</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Mobile No.</td>
                                                    <td>+91-9876543210</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">E-mail</td>
                                                    <td>john.dsmith@gmail.com</td>
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
     function getOrderStatusText(status) {
        switch (parseInt(status)) {
            case 1:
                return 'Processing';
            case 2:
                return 'Shipped';
            case 3:
                return 'Delivered';
            default:
                return 'Unknown';
        }
    }
    $('#customerForm').on('submit', function (e) {
        e.preventDefault();

        let customerId = $('#CategoryList').val();

        if (!customerId) return;

        $.ajax({
            url: "{{ route('customer.orders') }}",
            type: "POST",
            data: {
                customer_id: customerId,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                let tbody = $('#ordersTable tbody');
                tbody.empty();
                if (response.orders.length > 0) {
                    response.orders.forEach(order => {
                        tbody.append(`
                            <tr>
                                <td><a href="javascript:void(0);" data-toggle="modal" data-target="#orderDetails">${order.order_no}</a></td>
                                <td>${order.order_date}</td>
                                <td><small class="font-weight-bold">TsH</small>${order.amount}</td>
                                <td>${getOrderStatusText(order.order_status)}</td>
                                <td>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#orderDetails" class="las la-eye btn btn-secondary mx-1 my-3" title="Manage Order"></a>
                                    <a href="#" target="_blank" class="las la-print btn btn-secondary mx-1 my-3" title="Print Order"></a>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    tbody.append('<tr><td colspan="7" class="text-center">No orders found.</td></tr>');
                }
            }
        });
    });
</script>

@endsection