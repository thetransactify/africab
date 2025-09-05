@extends('Admin.layouts.app')
@section('title', 'Price List')
@section('content')
<div class="row">
<div class="col-12">
<h1>Product Settings</h1>
<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
</nav>
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
{{ session('success') }}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

<script>
setTimeout(function() {
$('.alert').alert('close');
    }, 5000); // 5000 milliseconds = 5 seconds
</script>
@endif
@if (session('error'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<script>
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000); // 5000 milliseconds = 5 seconds
</script>
@endif
<div class="separator mb-5"></div>
<div class="row">
<div class="col-12 mb-4">
<div class="card mb-4">
<div class="card-body">
<a href="javascript:void(0);" data-toggle="modal" data-backdrop="static" data-target="#addpriceentry" class="btn btn-secondary mb-2 float-right adjust-margin-01">Add Product</a>
<h5 class="mb-4 font-weight-bold">Product List</h5>
<div class="separator mb-5"></div>

<div class="table-responsive">
	 @if($productlist->count() > 0)
<table class="data-table data-table-prdprice">
<thead>
<tr>
<th>#</th>
<th>Date</th>
<th>Product Name</th>
<th>Pkg. Wt.</th>
<th>Cost</th>
<th>Actions</th>

</tr>
</thead>
<tbody>
         @foreach($productlist as $index => $category)
					<tr>
						<td>{{ $index + 1 }}</td>
						<td>{{ $category->created_at->format('d-m-Y') }}</td>
						<td>{{ $category->listing_name }}</td>
						<td>{{ $category->packing_weight }}</td>
						<td><small class="font-weight-bold "></small>{{ $category->product_cost }}</td>
						<td class="text-center"><a href="{{ url('tsfy-admin/edit-productlist/' . Crypt::encrypt($category->id)) }}" class="las la-edit btn btn-secondary mx-1"></a>
							<a href="{{ route('productlist.delete', Crypt::encrypt($category->id)) }}" onclick="return confirm('Are you sure you want to delete this product?')" class="las la-trash-alt btn btn-secondary mx-1"></a></td>
						</tr>
		 @endforeach				
					</tbody>
				</table>
                    @else
                    <p>No categories found.</p>
                     @endif				
			</div>
		</div>
	</div>
</div>

</div>
</div> 
</div>

<!-- Add Price List -->
   
<div class="modal fade modal-right" id="addpriceentry" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalRight" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-bold">List the Product</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                            
                            <form action="{{url('tsfy-admin/add-productlist')}}" method="Post">
                            	@csrf
                            <div class="form-group mb-4">
                            <label class="form-group has-float-label mb-4">
                               <select id="CategoryList" name="CategoryList" class="form-control select2-single" data-width="100%" required>
								  <option>Select Category</option>
								    @foreach($categories as $category)
								        <option value="{{ $category->id }}">{{ $category->name }}</option>
								    @endforeach
								</select>
								<span>Category</span>
                            </label>
                            </div>
                            <div class="form-group mb-4">
                            	<label class="form-group has-float-label mb-4">
                                <select id="productList" name="productList" class="form-control select2-single" data-width="100%" required>
									<option label="&nbsp;">Select Subcategories</option>
								</select>
								<span>Subcategories</span>
                            </label>
                                </div>
                                <div class="form-group mb-4">
									<label class="form-group has-float-label mb-1">
										<input data-role="tagsinput" name="name" type="text"> <span>Product Name</span>
									</label> 
							    </div>

							    <div class="form-group mb-4">
									<label class="form-group has-float-label mb-1">
										<input data-role="tagsinput" name="Code" type="text"> <span>Code</span>
									</label> 
							    </div>

							    <div class="form-group mb-4">
								    <label for="colors" class="form-group has-float-label mb-1"> <span>Colors</span></label>
								    <div id="color-wrapper">
								        <input type="text" name="colors[]" class="form-control mb-2" placeholder="Enter color">
								    </div>
								    <button type="button" id="add-color" class="btn btn-sm btn-secondary">+ Add More</button>
								</div>
							    <div class="form-group mb-4">
			                        <label class="form-group has-float-label mb-1">
			                        <textarea class="form-control" rows="7" name="description" required></textarea>
			                        <span>Description</span></label>
		                        </div>
								<div class="form-group mb-4">
									<label class="form-group has-float-label mb-1">
										<input data-role="tagsinput" name="Weight" type="text"> <span>Packaging Weight</span>
									</label> 
									<label class="tooltip-text mb-0">Please use standard denominations like ml, gm, L, Kg etc.</label>
								</div>
								<div class="form-group mb-4">
									<label class="form-group has-float-label mb-1">
										<input data-role="tagsinput" name="packing_type" type="text"> <span>Packaging Type</span>
									</label> 
									<label class="tooltip-text mb-0">Please use standards like PET, Glass, Tetra Pack, Tin etc.</label>
								</div>
								<div class="form-group mb-4">
									<label class="form-group has-float-label mb-1">
										<input data-role="tagsinput" name="Item_cost" type="text"> <span>Item Cost</span>
									</label> 
								</div>
								<div class="form-group mb-4">
									<label class="form-group has-float-label mb-1">
										<input data-role="tagsinput" name="offer_price" type="text"> <span>Offer price</span>
									</label>
								</div>
								<!-- <div class="form-group mb-4">
									<label class="form-group has-float-label mb-1">
										<input data-role="tagsinput" type="text"> <span>Barcode (GTIN)</span>
									</label> 
								</div> -->
								<!-- <div class="form-group mb-4">
									<label class="form-group has-float-label mb-1">
										<input data-role="tagsinput" type="text"> <span>SKU Code</span>
									</label> 
								</div> -->
								<!-- <div class="form-group mb-4">
									<label class="form-group has-float-label mb-1">
										<input data-role="tagsinput" type="text"> <span>HSN Code</span>
									</label> 
								</div> -->
								<div class="row mb-3">
								<div class="col-md-6 col-12">
									<label class="form-label font-weight-bold" id="switch3-label">Product Online</label>
                                    <div class="custom-switch custom-switch-primary-inverse mb-2">
                                          <input class="custom-switch-input" name="OnlineProduct" id="switch3" type="checkbox" value="1" checked>
                                          <label class="custom-switch-btn" for="switch3"></label>
                                    </div>
								</div>
								<div class="col-md-6 col-12">
									<label class="form-label font-weight-bold" id="switch7-label">Sell as Single</small></label>
									<div class="custom-switch custom-switch-primary mb-2">
                                         <input class="custom-switch-input" name="sellSingle" id="switch7" value="1" type="checkbox" checked>
                                         <label class="custom-switch-btn" for="switch7"></label>
                                     </div>
								</div>                             
                                </div>						
							    <div  class="form-group text-right">                                                            
                                	<button class="btn btn-secondary" type="submit">List the Product</button>
                                </div>
                            </form>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {	
    $('#CategoryList').on('change', function () {
        var categoryId = $(this).val();
        if (categoryId) {
            $.ajax({
                url: "get-subcategiores/" + categoryId,
                type: 'GET',
                success: function (data) {
                    $('#productList').empty().append('<option label="&nbsp;">Select Product</option>');
                    $.each(data, function (key, value) {
                        $('#productList').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        } else {
            $('#productList').empty().append('<option label="&nbsp;">Select Product</option>');
        }
    });
});
</script>  

<script>
document.getElementById('add-color').addEventListener('click', function () {
    let wrapper = document.getElementById('color-wrapper');
    let input = document.createElement('input');
    input.type = 'text';
    input.name = 'colors[]';
    input.className = 'form-control mb-2';
    input.placeholder = 'Enter color';
    wrapper.appendChild(input);
});
</script>                          
@endsection