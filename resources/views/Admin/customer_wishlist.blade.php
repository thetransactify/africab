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
                            <h5 class="mb-4 font-weight-bold">Customers Wishlist</h5>
                            <div class="alert alert-warning mb-5" role="alert">* Select the customer you want to view the wishlist of.</div>
                            <div class="row mb-3">
                            <div class="col-md-6 col-12">
                            <form id="wishlistForm">
                            <div class="form-group mb-4">
                                <label class="form-group has-float-label mb-4">
                                <select id="CategoryList" class="form-control select2-single" data-width="100%">
                                    <option label="&nbsp;">Select Customer</option>
                                @foreach($Getwishlist as $wishlist)
                                   <option value="{{ $wishlist->id }}">
                                        {{ $wishlist->name }}
                                    </option>
                                @endforeach
                                </select>
                                    <span>Customer Name</span>
                            </label>
                                </div>  
                            <div class="form-group text-right">                                                            
                                <button class="btn btn-secondary" type="submit">List Wishlist</button>
                            </div>
                            </form>
                            </div>
                           </div>
                             <div class="separator mb-5"></div>
                            <div class="row">
                            <div class="col-12"> 
                            <div class="table-responsive">
                            <table class="data-table data-table-permission" id="wishlistTable">
                            <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Added on</th>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Category Name</th>

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
                                    <h5 class="modal-title">Wshlist Details</h5>
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
                                            <td class="font-weight-bold">Wishlist Added on</td>
                                            <td>20/04/2020</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Category Name</td>
                                            <td>Mojitos</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Product Name</td>
                                            <td>Original</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Product Label</td>
                                            <td>Bestseller</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Product Status</td>
                                            <td>Online</td>
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

    let customerId = $('#CategoryList').val();
    if (!customerId) return;

    $.ajax({
        url: "{{ route('customer.wishlist') }}",
        type: "POST",
        data: {
            customer_id: customerId,
            _token: "{{ csrf_token() }}"
        },
        success: function (response) {
            let tbody = $('#wishlistTable tbody');
            tbody.empty();

            if (response.wishlists.length > 0) {
                response.wishlists.forEach(item => {
                    tbody.append(`
                        <tr>
                            <td>${item.id}</td>
                            <td>${item.added_on}</td>
                            <td><img src="${item.image_url}" width="50" height="50" /></td>
                            <td>${item.product}</td>
                            <td>${item.category}</td>
                        </tr>
                    `);
                });
            } else {
                tbody.append('<tr><td colspan="7" class="text-center">No wishlist items found.</td></tr>');
            }
        }
    });
});

</script>
@endsection