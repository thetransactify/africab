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
                            <h5 class="mb-4 font-weight-bold">Customers Save to cart</h5>
                            <div class="row mb-3">
                            <div class="col-md-6 col-12">
                                 <button id="sendWishlistEmails" class="btn btn-success"><i class="las la-envelope"></i> Send Email to All</button>
                            </div>
                           </div>
                             <div class="separator mb-5"></div>
                            <div class="row">
                            <div class="col-12"> 
                            <div class="table-responsive">
                            <table class="data-table data-table-permissions" id="wishlistTable">
                            <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Added on</th>
                                        <th>Customer Name</th>
                                        <th>Product Name</th>

                                    </tr>
                                </thead>
                                <tbody>
                                 @forelse($GetSaveToCart as $index => $savetocart)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $savetocart->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $savetocart->users->name ?? 'N/A' }}</td>
                                        <td>{{ $savetocart->product->listing_name ?? 'N/A' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No save to later Records Found</td>
                                    </tr>
                                @endforelse     
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
<script>
document.getElementById("sendWishlistEmails").addEventListener("click", function() {
    $.ajax({
        url: "{{ route('savetocart.sendEmailSavecart') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            alert(response.message + " to " + response.count + " users");
        },
        error: function(xhr) {
            alert("Error: " + xhr.responseJSON.message);
        }
    });
});
</script>


@endsection