@extends('Admin.layouts.app')
@section('title', 'Product')
@section('content')
<div class="row">
            <div class="col-12">
                <h1>Manage Subcategories</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                </nav>
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <script>
                        // Auto close alert after 5 seconds
                        setTimeout(function () {
                            $('.alert').alert('close');
                        }, 5000);
                    </script>
                @endif
                <div class="separator mb-5"></div>
                <div class="col-12 col-md-6 mb-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4 font-weight-bold">Add New SubCategories</h5>
                        <form action="{{url('/tsfy-admin/post-product')}}" method="POST" enctype="multipart/form-data">
                         @csrf
                        <div class="form-group mb-4">
                            <label class="form-group has-float-label mb-4">
                            <select id="CategoryList" name="CategoryList" class="form-control select2-single" data-width="100%">
                                <option label="&nbsp;">Select Category</option>
                                @foreach($category as $categories)
                                <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                @endforeach
                            </select>
                            <span>Category Name</span>
                            </label>
                            </div>
                            <label class="form-group has-float-label mb-4">
                        <input data-role="tagsinput" name="product_name" type="text"> <span>Subcategories Name</span>
                        </label>
                        <!-- <label class="form-group has-float-label mb-1">
                        <input class="form-control" type="file" name="Category_file" accept=".jpg,.png,.jpeg,.png,.gif" onchange="validateImage(this)"><span>Image Upload</span></label>
                        <label class="tooltip-text mb-4">(Only upload 600x600 size images.)</label> -->
                        <div class="form-group mb-1">
                        <label class="form-group has-float-label mb-1">
                        <textarea class="form-control" rows="7" name="description" required></textarea>
                        <span>Description</span></label>
                        <!-- <label class="tooltip-text mb-4">(Use Redactor or any WYSIWYG html editor)</label>
                         </div>
                         <label class="form-group has-float-label mb-4">
                                <input data-role="tagsinput"  name="page_title" type="text" >
                                <span>Meta Page Title</span>
                            </label>
                            <label class="form-group has-float-label mb-4">
                                <textarea class="form-control" name="page_description" rows="4" required></textarea> 
                                <span>Meta Page Description</span>
                            </label> 
                         -->    <div class="row mb-4">
                            <div class="col-md-4 col-4">
                                <label class="form-label font-weight-bold">No Label</small></label>
                                <div class="custom-switch custom-switch-primary mb-2">
                                     <input class="custom-switch-input" name="radioswitch" id="radioswitch1" type="radio" value="1" checked>
                                     <label class="custom-switch-btn" for="radioswitch1"></label>
                                 </div>
                            </div>
                            <div class="col-md-4 col-4">
                                <label class="form-label font-weight-bold">New</small></label>
                                <div class="custom-switch custom-switch-primary mb-2">
                                     <input class="custom-switch-input" name="radioswitch" id="radioswitch2" type="radio" value="2">
                                     <label class="custom-switch-btn" for="radioswitch2"></label>
                                 </div>
                            </div> 
                            <div class="col-md-4 col-4">
                                <label class="form-label font-weight-bold">Featured</small></label>
                                <div class="custom-switch custom-switch-primary mb-2">
                                     <input class="custom-switch-input" name="radioswitch" id="radioswitch3" type="radio" value="3">
                                     <label class="custom-switch-btn" for="radioswitch3"></label>
                                 </div>
                            </div>                            
                            </div>
                            <div  class="form-group text-right">                                                            
                            <button class="btn btn-secondary" type="submit">Add Product</button>
                            </div>
                           <!--  <div class="alert alert-warning mt-5" role="alert">* Please note, the new product is labelled as 'New' for a period of 10 days. Product marked 'Featured' remains unless changed</div> -->
                        </form>
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
