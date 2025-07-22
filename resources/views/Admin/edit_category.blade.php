@extends('Admin.layouts.app')
@section('title', 'Edit Category')
@section('content')
<div class="row">
    <div class="col-12">
        <h1>Manage Category</h1>
        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
            <ol class="breadcrumb pt-0">
                <li class="breadcrumb-item"><a href="{{url('/tsfy-admin/view-category')}}">Back to List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Cateogry</li>
            </ol>
        </nav>
        <div class="separator mb-5"></div>
        <div class="row">
            <div class="col-12 col-md-6 mb-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4 font-weight-bold">Edit Category</h5>

                        <form action="{{url('tsfy-admin/update-category/'. Crypt::encrypt($category->id))}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label class="form-group has-float-label mb-4">
                                <input data-role="tagsinput" name="category_name" type="text" value="{{$category->name}}">
                                <span>Category Name</span>
                            </label>
                            <label class="form-group has-float-label mb-4">
                                <textarea class="form-control" name="description" rows="4" required>{{$category->description}}</textarea> 
                                <span>Category Desc</span>
                            </label>
                            <label class="form-group has-float-label mb-4">
                                <input data-role="tagsinput" type="text" name="meta_page" value="{{$category->page_title}}">
                                <span>Meta Page Title</span>
                            </label>
                            <label class="form-group has-float-label mb-4">
                                <textarea class="form-control" rows="4" name="page_description" required>{{$category->page_description}}</textarea> 
                                <span>Meta Page Description</span>
                            </label>
                       
                            <label class="form-group has-float-label mb-1">
                                <input class="form-control" type="file" name="Category_file" accept=".jpg,.png,.jpeg,.png,.gif" onchange="validateImage(this)"><span>Featured Image Upload</span></label>
                                <label class="tooltip-text mb-4">(Only upload 300x300 size images.)</label>
                                <input type="text" name="Category_file_old" value="{{$category->file}}" hidden>
                                <div  class="form-group text-right">                                                            
                                    <button class="btn btn-secondary" type="submit">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4 font-weight-bold">Featured Image</h5>
                            <div class="img fullwidth lightbox"><a href="{{ asset('storage/uploads/category/' . $category->file) }}"><img src="{{ asset('storage/uploads/category/' . $category->file) }}"/></a></div>
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
