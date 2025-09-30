@extends('Admin.layouts.app')
@section('title', 'customer wishlist')
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
                            <h5 class="mb-4 font-weight-bold">Customers Cart Reminder</h5>
                            <div class="alert alert-warning mb-5" role="alert">* Select the customer you want to view the Cart reminder of.</div>
                            <div class="row mb-3">
                            <div class="col-md-6 col-12">
                            <form id="wishlistForm">
                            <div class="form-group mb-4">
                                <label class="form-group has-float-label mb-4">
                                <select id="ProductList" class="form-control select2-single" data-width="100%">
                                    <option label="&nbsp;">Select Product</option>
                                @foreach($Getcart as $cartdeatils)
                                   <option value="{{ $cartdeatils->product_id }}">
                                        {{ $cartdeatils->product->listing_name }}
                                    </option>
                                @endforeach
                                </select>
                                    <span>Product Name</span>
                            </label>
                                </div>  
                            <div class="form-group text-right">                                                            
                                <button class="btn btn-secondary" type="submit">List Cart Reminder</button>
                            </div>
                            </form>
                            </div>
                           </div>
                             <div class="separator mb-5"></div>
                            <div class="row">
                            <div class="col-12"> 
                            <div class="table-responsive">
                            <table class="data-table data-table-permission" id="CartReminderTable">
                            <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Added on</th>
                                        <th>Customer Name</th>
                                        <th>Product Name</th>
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

<!-- Wshlist Details Modal -->
<div class="modal fade bd-example-modal-lg" id="productWishlist" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cart Reminder</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                 <div class="row">
                                    <div class="col-12">
                                    <div class="table-responsive">
                                    <table class="table table-bordered">
                                    
                                    <tbody>
                                        <tr>
                                            <td class="font-weight-bold">Last Added on</td>
                                             <td id="modal_last_added"></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Email Total</td>
                                            <td id="modal_email_total"></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Sms Total</td>
                                            <td id="modal_sms_total"></td>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $('#wishlistForm').on('submit', function (e) {
    e.preventDefault();

    let product_id = $('#ProductList').val();
    if (!product_id) return;

    $.ajax({
        url: "{{ route('customer.cartreminder') }}",
        type: "POST",
        data: {
            product_id: product_id,
            _token: "{{ csrf_token() }}"
        },
        success: function (response) {
            let tbody = $('#CartReminderTable tbody');
            tbody.empty();

            if (response.cartsreminder.length > 0) {
                response.cartsreminder.forEach(item => {
                    tbody.append(`
                        <tr>
                            <td>${item.sno}</td>
                            <td>${item.created_at}</td>
                            <td>${item.name}</td>
                            <td>${item.product_name}</td>
                            <td class="d-flex"><button class="btn btn-primary"   onclick="sendSMS(${item.id}, this)"><i class="las la-sms"></i></button>
                                    <button class="btn btn-success"   onclick="sendEmail(${item.id}, this)"><i class="las la-envelope"></i></button>
                                <button class="las la-eye btn btn-secondary"  onclick="openModal(${item.id}, '${item.created_at}', ${item.email_count ?? 0}, ${item.sms_count ?? 0})"><i class="bi bi-eye"></i></button>

                                </td>
                        </tr>
                    `);
                });
            } else {
                tbody.append('<tr><td colspan="7" class="text-center">No Cart Reminder items found.</td></tr>');
            }
        }
    });
});
function openModal(id, created_at, email_total, sms_total) {
    document.getElementById("modal_last_added").innerText = created_at;
    document.getElementById("modal_email_total").innerText = email_total;
    document.getElementById("modal_sms_total").innerText = sms_total;

    $('#productWishlist').modal('show');
}
function sendEmail(cartId, btnElem) {
    if (btnElem) btnElem.disabled = true;

    $.ajax({
        url: "{{ route('customer.emailreminder') }}",
        type: "POST",
        data: {
            product_id: cartId, 
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            alert(response.message || "Email sent successfully");
            location.reload(); 
        },
        error: function(xhr) {
            console.error(xhr.responseText);
            alert("Error sending email");
        },
        complete: function() {
            if (btnElem) btnElem.disabled = false;
        }
    });
}

function sendSMS(cartId, btnElem) {
    if (btnElem) btnElem.disabled = true;

    $.ajax({
        url: "{{ route('customer.emailreminder') }}",
        type: "POST",
        data: {
            product_id: cartId, 
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            alert(response.message || "Email sent successfully");
            location.reload(); 
        },
        error: function(xhr) {
            console.error(xhr.responseText);
            alert("Error sending email");
        },
        complete: function() {
            if (btnElem) btnElem.disabled = false;
        }
    });
}


</script>
@endsection