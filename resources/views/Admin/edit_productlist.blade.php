@extends('Admin.layouts.app')
@section('title', 'Edit Category')
@section('content')
            <div class="row">
                <div class="col-12">
                    <h1>Product Settings</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="{{url('/tsfy-admin/product-price')}}">Back to List</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Price Listing</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                    <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4 font-weight-bold">Product List</h5>
                            <form action="{{url('tsfy-admin/update-productlist/'. Crypt::encrypt($productList->id))}}" method="POST" enctype="multipart/form-data">
                            @csrf    
                        <div class="form-group mb-4">
                            <label class="form-group has-float-label mb-4">                      
                                <select id="CategoryList" name="CategoryList" class="form-control select2-single" data-width="100%">
                                   @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ $category->id == $productList->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span>Category</span>
                            </label>
                                </div>
                            <div class="form-group mb-4">
                                <label class="form-group has-float-label mb-4">
                                <select id="productList" name="productList" class="form-control select2-single" data-width="100%">
                                    <option label="&nbsp;">Select Subcategories</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" 
                                            {{ $product->id == $productList->product_id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span>Subcategories</span>
                            </label>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-group has-float-label mb-1">
                                        <input data-role="tagsinput" name="price_list" type="text" value="{{$productList->listing_name}}"> <span>Product Name</span>
                                    </label> 
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-group has-float-label mb-1">
                                        <input data-role="tagsinput" name="Code" value="{{$productList->code}}" type="text"> <span>Code</span>
                                    </label> 
                                </div>

                                <div class="form-group mb-4">
                                    <label for="colors" class="form-group has-float-label mb-1"> <span>Colors</span></label>
                                    <div id="color-wrapper">
                                        <input type="text" name="colors[]" value="{{$productList->color_name}}" class="form-control mb-2" placeholder="Enter color">
                                    </div>
                                    <button type="button" id="add-color" class="btn btn-sm btn-secondary">+ Add More</button>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-group has-float-label mb-1">
                                    <textarea class="form-control" rows="7" name="description" required>{{$productList->description}}</textarea>
                                    <span>Description</span></label>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-group has-float-label mb-1">
                                        <input data-role="tagsinput" type="text" name="weight" value="{{$productList->packing_weight}}"> <span>Packaging Weight</span>
                                    </label> 
                                    <label class="tooltip-text mb-0">Please use standard denominations like ml, gm, L, Kg etc.</label>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-group has-float-label mb-1">
                                        <input data-role="tagsinput" type="text" name="type" value="{{$productList->packing_type}}"> <span>Packaging Type</span>
                                    </label> 
                                    <label class="tooltip-text mb-0">Please use standards like PET, Glass, Tetra Pack, Tin etc.</label>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-group has-float-label mb-1">
                                        <input data-role="tagsinput" name="cost"  type="text" value="{{$productList->product_cost}}"> <span>Item Cost</span>
                                    </label> 
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-group has-float-label mb-1">
                                        <input data-role="tagsinput" name="offer_price" value="{{$productList->offer_price}}" type="text"> <span>Offer price</span>
                                    </label> 
                                </div>
                                <!-- <div class="form-group mb-4">
                                    <label class="form-group has-float-label mb-1">
                                        <input data-role="tagsinput" type="text" value="8906000482032"> <span>Barcode (GTIN)</span>
                                    </label> 
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-group has-float-label mb-1">
                                        <input data-role="tagsinput" type="text" value="2003"> <span>SKU Code</span>
                                    </label> 
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-group has-float-label mb-1">
                                        <input data-role="tagsinput" type="text" value="20089912"> <span>HSN Code</span>
                                    </label> 
                                </div> -->
                                <div class="row mb-3">
                                <div class="col-md-4 col-6">
                                    <label class="form-label font-weight-bold" id="switch3-label">Product Online</label>
                                    <div class="custom-switch custom-switch-primary-inverse mb-2">
                                          <input class="custom-switch-input" name="Online" id="switch3" type="checkbox" value="1"  {{(isset($productList) && $productList->product_online == 1) ? 'checked' : '' }}>
                                          <label class="custom-switch-btn" for="switch3"></label>
                                         <!--  <input type="hidden" name="Online" value="0"> -->
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <label class="form-label font-weight-bold">Sell as Single</small></label>
                                    <div class="custom-switch custom-switch-primary mb-2">
                                         <input class="custom-switch-input" id="switch7" name="Sell" type="checkbox" value="1" {{(isset($productList) && $productList->status == 1) ? 'checked' : '' }}>
                                         <label class="custom-switch-btn" for="switch7"></label>
                                        <!--  <input type="hidden" name="Sell" value="0"> -->
                                     </div>
                                </div>                             
                                </div>                      
                                <div  class="form-group text-right">                                                            
                                    <button class="btn btn-secondary" type="submit">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                </div>
                </div> 
            </div>

  
<script>
function validateImage(input) {
    const file = input.files[0];

    if (file) {
        const fileSize = file.size / 1024 / 1024;
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];

        if (!allowedTypes.includes(file.type)) {
            alert('Only JPG, JPEG, PNG, and GIF files are allowed.');
            input.value = '';
            return false;
        }

        if (fileSize > 2) {
            alert('Maximum file size is 2MB.');
            input.value = '';
            return false;
        }
    }
}
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
