@extends('Admin.layouts.app')
@section('title', 'Product Permission')
@section('content')
            <div class="row">
                <div class="col-12">
                    <h1>Product Settings</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">

                    </nav>
                    <div class="separator mb-5"></div>
                    <div class="col-12 mb-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4 font-weight-bold">Product Visibility</h5>
                             <div class="separator mb-5"></div>

                            <div class="table-responsive">
                        @if($Permission->count() > 0) 
                            <table class="data-table data-table-products-display">
                            <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Sub Category Name</th>
                                        <th>Product Name</th>
                                        <th>Status</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($Permission as $index => $product)
                                    <tr> 
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{$product->category->name}}</td>
                                        <td>{{$product->product->name}}</td>
                                        <td>{{$product->listing_name}}</td>
                                        <td>@if($product->product_online == 1)
                                            Online
                                        @else
                                            Offline
                                        @endif</td>
                                        <td class="text-center"><a href="javascript:void(0)" data-toggle="modal" data-target="#prdvisibilty"        data-name="{{ $product->listing_name }}" data-status="{{ $product->product_online }}" data-id="{{ $product->id }}" class="las la-ban btn btn-secondary mx-1 openToggleVisibility"></a></td>
                                    </tr>
                                 @endforeach
                                </tbody>
                            </table>
                             @else
                             <p>No product visibility found.</p>
                             @endif
                            </div>
                        </div>
                    </div>
                </div>
                </div> 
            </div>

<!-- Category Activation Toggle Modal -->
   
<div class="modal fade bd-example-modal-sm" id="prdvisibilty" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Toggle Product Visibility</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                        <div class="alert alert-warning mb-5" role="alert">* Please note, you cannot delete any product here, only deactivate it. If you deactivate a product, all the listing under it will be deacivated too.</div>
                                        <p><b>Product Name:</b><span id="product-name-display"></span></p>
                                       <label class="form-label font-weight-bold" id="switch3-label">Product Online</label>
                                    <div class="custom-switch custom-switch-primary-inverse mb-2">
                                          <input class="custom-switch-input" id="switch3" type="checkbox" checked>
                                          <label class="custom-switch-btn" for="switch3"></label>
                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let currentProductId = null;
    $(document).on('click', '.openToggleVisibility', function () {
        let productName = $(this).data('name');
        let productStatus = $(this).data('status');
         currentProductId = $(this).data('id');

        $('#product-name-display').text(productName);
        $('#switch3').prop('checked', productStatus == 1);
    });
</script>

<script>
    $('#switch3').on('change', function () {
        let isChecked = $(this).is(':checked') ? 1 : 2;; 
        if (!currentProductId) {
        alert('No product selected');
        return;
        }
        $.ajax({
            url: "products-permission/" + currentProductId + "/toggle-visibility",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: isChecked
            },
            success: function(response) {
                alert(response.message);
                location.reload();
            }
        });
    });
</script>

@endsection
