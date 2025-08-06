@extends('Admin.layouts.app')
@section('title', 'Edit Manage Offers')
@section('content')
            <div class="row">
                <div class="col-12">
                    <h1>Manage Offers</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="{{url('/tsfy-admin/manage-offers')}}">Back to List</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Offers</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                    <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4 font-weight-bold">Manage Offers</h5>
                            <form action="{{url('tsfy-admin/update-productlistoffers/'. Crypt::encrypt($productList->id))}}" method="POST" enctype="multipart/form-data">
                            @csrf    

                            <div class="form-group mb-4">
                                    <label class="form-group has-float-label mb-1">
                                        <input data-role="tagsinput" name="label" type="text" value="{{$productList->label}}"> <span>label</span>
                                    </label> 
                            </div>
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
                                <select id="Subcategories" name="Subcategories" class="form-control select2-single" data-width="100%">
                                    <option label="&nbsp;">Select Subcategories</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" 
                                            {{ $product->id == $productList->subcategory_id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span>Subcategories</span>
                            </label>
                                </div>
                               <div class="form-group mb-4">
                                <label class="form-group has-float-label mb-4">
                                <select id="productList" name="productList[]" class="form-control select2-single" multiple="multiple" data-width="100%">
                                    <option label="&nbsp;">Select product</option>
                                    @foreach($productLists as $productdeatils)
                                          @php
                                            $selectedIds = explode(',', $productList->proudct_deatils_id);
                                            $isSelected = in_array($productdeatils->id, $selectedIds);
                                        @endphp
                                        <option value="{{ $productdeatils->id }}" {{ $isSelected ? 'selected' : '' }}>
                                            {{ $productdeatils->listing_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span>Product name</span>
                            </label>
                                </div> 
                                <div class="row mb-3">
                                <div class="col-md-4 col-6">
                                    <label class="form-label font-weight-bold" id="switch3-label">Offer Online</label>
                                    <div class="custom-switch custom-switch-primary-inverse mb-2">
                                          <input class="custom-switch-input" name="Online" id="switch3" type="checkbox" value="1"  {{(isset($productList) && $productList->product_online == 1) ? 'checked' : '' }}>
                                          <label class="custom-switch-btn" for="switch3"></label>
                                         <!--  <input type="hidden" name="Online" value="0"> -->
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
@endsection
