@extends('Admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
 <div class="row">
                <div class="col-12">
                    <h1>Manage Category</h1>
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
                    <div class="row">
                    <div class="col-12 col-md-6 mb-4">
					<div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4 font-weight-bold">Add New Category</h5>

                            <form action="{{url('/tsfy-admin/post-category')}}" Method="POST" enctype="multipart/form-data">
                            	@csrf
                                <label class="form-group has-float-label mb-4">
                                    <input data-role="tagsinput" name="category_name" type="text">
                                    <span>Category Name</span>
                                </label>
							<label class="form-group has-float-label mb-1">
							<textarea class="form-control" rows="7" name="description" required></textarea>
							<span>Description</span></label>
							<label class="tooltip-text mb-4">(Use Redactor or any WYSIWYG html editor)</label>
                                <label class="form-group has-float-label mb-4">
                                    <input data-role="tagsinput" name="meta_title" type="text">
                                    <span>Meta Page Title</span>
                                </label>
                                <label class="form-group has-float-label mb-4">
                                    <textarea class="form-control" name="meta_description" rows="4" required></textarea> 
                                    <span>Meta Page Description</span>
                                </label>
								<label class="form-group has-float-label mb-1">
								<input class="form-control" type="file" name="Category_file" accept=".jpg,.png,.jpeg,.png,.gif" onchange="validateImage(this)"><span>Featured Image Upload</span></label>
								<label class="tooltip-text mb-4">(Only upload 300x300 size images.)</label>
                                <div  class="form-group text-right">
                                <button class="btn btn-secondary" type="submit">Add Category</button>
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
