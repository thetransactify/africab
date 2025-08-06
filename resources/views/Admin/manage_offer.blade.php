@extends('Admin.layouts.app')
@section('title', 'Manage Offers')
@section('content')
<div class="row">
<div class="col-12">
<h1>Manage Offers</h1>
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
<a href="javascript:void(0);" data-toggle="modal" data-backdrop="static" data-target="#addpriceentry" class="btn btn-secondary mb-2 float-right adjust-margin-01">Add Offer</a>
<h5 class="mb-4 font-weight-bold">Manage Offers</h5>
<div class="separator mb-5"></div>

<div class="table-responsive">
	 @if($productlist->count() > 0)
<table class="data-table data-table-prdpriceoffer">
<thead>
<tr>
<th>#</th>
<th>Date</th>
<th>Product Name</th>
<th>Offer status</th>
<th>Actions</th>

</tr>
 </thead>
 
<tbody> @foreach($productlist as $index => $category) <tr>
<td>{{ $index + 1 }}</td>
<td>{{ $category->created_at->format('d-m-Y')}}</td>
<td>{{ $category->label }}</td>
<td>{{ $category->product_online  == 1 ? 'Active' : 'Deactive' }}</td>
 <td class="text-center"><a href="{{
url('tsfy-admin/edit-offers/' . Crypt::encrypt($category->id)) }}"
class="las la-edit btn btn-secondary mx-1"></a> <a href="{{
route('productlistoffers.delete', Crypt::encrypt($category->id)) }}" onclick="return
confirm('Are you sure you want to delete this offer product?')" class="las
la-trash-alt btn btn-secondary mx-1"></a></td> 
</tr> @endforeach	
 </tbody>

</table>
 @else 
 <p>No Offer found.</p>
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
                                            <h5 class="modal-title font-weight-bold">List the Offers</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                            
                            <form action="{{url('tsfy-admin/add-productoffers')}}" method="post">
                            	@csrf

                             <div class="form-group mb-4">
									<label class="form-group has-float-label mb-1">
										<input data-role="tagsinput" name="name" type="text"> <span>Offer label</span>
									</label> 
							</div> 	
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
                            	<label class="form-group has-float-label mb-4">
                                <select id="productName" name="productName[]" class="form-control select2-single" data-width="100%" multiple="multiple" required>
									<option label="&nbsp;">Select Product</option>
								</select>
								<span>Product Name</span>
                                 </label>
                            </div>
							    
						
								<div class="row mb-3">
								<div class="col-md-6 col-12">
									<label class="form-label font-weight-bold" id="switch3-label">Offer Online</label>
                                    <div class="custom-switch custom-switch-primary-inverse mb-2">
                                          <input class="custom-switch-input" name="OnlineProduct" id="switch3" type="checkbox" value="1" checked>
                                          <label class="custom-switch-btn" for="switch3"></label>
                                    </div>
								</div>                          
                                </div>						
							    <div  class="form-group text-right">                                                            
                                	<button class="btn btn-secondary" type="submit">List the Offer</button>
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
                url: "get-products/" + categoryId,
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

$(document).ready(function () {	
    $('#productList').on('change', function () {
        var categoryId = $(this).val();
        if (categoryId) {
            $.ajax({
                url: "get-productslist/" + categoryId,
                type: 'GET',
                success: function (data) {
                    $('#productName').empty().append('<option label="&nbsp;">Select Product</option>');
                    $.each(data, function (key, value) {
                        $('#productName').append('<option value="' + value.id + '">' + value.listing_name + '</option>');
                    });
                }
            });
        } else {
            $('#productName').empty().append('<option label="&nbsp;">Select Product Name</option>');
        }
    });
});
</script>                            
@endsection