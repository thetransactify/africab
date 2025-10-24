@extends('Admin.layouts.app')
@section('title', 'Product Gallery')
@section('content')
<div id="fullscreen-loader" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(255,255,255,0.8); z-index:9999; backdrop-filter: blur(2px); align-items:center; justify-content:center;">
  <div class="text-center">
      <div class="spinner-border text-primary" style="width:3rem;height:3rem;" role="status"></div>
      <p class="mt-2 text-dark font-weight-bold">Loading, please wait...</p>
  </div>
</div>
            <div class="row">
                <div class="col-12">
                    <h1>Product Settings</h1>
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
                        setTimeout(function () {
                            $('.alert').alert('close');
                        }, 5000);
                    </script>
                    @endif
                    <div class="separator mb-5"></div>
                    <div class="col-12 mb-4">
					<div class="card mb-4">
                        <div class="card-body">
                        <a href="javascript:void(0);" data-toggle="modal" data-backdrop="static" data-target="#addprdimg" class="btn btn-secondary mb-2 float-right adjust-margin-01">Add Product Image</a>
                            <h5 class="mb-4 font-weight-bold">Product Gallery</h5>
                             <div class="separator mb-5"></div>

                            <div class="table-responsive">
                            @if($ProdcutGallery->count() > 0)
							<table class="data-table data-table-products-gallry">
							<thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
										<th>Image</th>
										<th>Category Name</th>
										<th>Product Name</th>
										<th>Image Label</th>
										<th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach($ProdcutGallery as $index => $gallery)	
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $gallery->created_at->format('d-m-Y') }}</td>
                                        <td><div class="img prd lightbox"><a href="{{ asset('storage/uploads/product/' . $gallery->file) }}"><img src="{{ asset('storage/uploads/product/' . $gallery->file) }}"/></a></div></td>
                                        <td>{{$gallery->category->name}}</td>
                                        <td>{{$gallery->ProductPrice->listing_name ?? ''}}</td>
                                        <td>{{$gallery->label}}</td>
                                        <td class="text-center"><a href="{{ url('tsfy-admin/delete-gallery', Crypt::encrypt($gallery->id)) }}" onclick="return confirm('Are you sure you want to delete this gallery item?')" class="las la-trash-alt btn btn-secondary mx-1"></a></td>
                                    </tr>
                                   @endforeach  
								</tbody>
							</table>
							 @else
		                     <p>No Product Gallery found.</p>
		                     @endif		
							</div>
                        </div>
                    </div>
				</div>
                </div> 
            </div>

<!-- Add Price List -->

<div class="modal fade modal-right" id="addprdimg" tabindex="-1" role="dialog"
aria-labelledby="exampleModalRight" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title font-weight-bold">Add Product Image</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            
            <form action="{{url('tsfy-admin/post-gallery')}}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="form-group mb-4">
                <label class="form-group has-float-label mb-4">                       
                    <select id="CategoryList" name="CategoryList" class="form-control select2-single" data-width="100%">
                        <option label="&nbsp;">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach

                    </select>
                    <span>Category</span>
                </label>
            </div>
            <div class="form-group mb-4">
               <label class="form-group has-float-label mb-4">
                <select id="productList" name="productList" class="form-control select2-single" data-width="100%">
                    <option label="&nbsp;">Select Product</option>
                </select>
                <span>Product</span>
            </label>
        </div>
        <div class="form-group mb-4">
            <label class="form-group has-float-label mb-1">
               <input data-role="tagsinput" name="image_label" type="text"> <span>Image Label</span>
           </label> 
       </div>
       <div class="form-group mb-4">
        <label class="form-group has-float-label mb-1">
            <input class="form-control" name="Category_file" type="file" onchange="validateImage(this)" accept=".jpg,.png,.jpeg,.png,.gif"><span>Image Upload</span></label>
            <label class="tooltip-text mb-4">(Only upload 600x600 size images.)</label>
        </div>
        
        <div  class="form-group text-right">                                                            
           <button class="btn btn-secondary" type="submit">List Item</button>
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
        var $loader = $('#fullscreen-loader');
        var $productList = $('#productList');

        if (categoryId) {
            $loader.fadeIn(200);

            $.ajax({
                url: "get-products/" + categoryId,
                type: 'GET',
                success: function (data) {
                    $productList.empty().append('<option value="">Select Product</option>');
                    $.each(data, function (key, value) {
                        $productList.append('<option value="' + value.id + '">' + value.listing_name + ' ('+ value.code + ')</option>');
                    });
                },
                error: function () {
                    alert('Failed to load products. Please try again.');
                },
                complete: function () {
                    $loader.fadeOut(300);
                }
            });
        } else {
            $productList.empty().append('<option value="">Select Product</option>');
        }
    });
});
</script> 
<script>
function validateImage(input) {
    const file = input.files[0];

    if (file) {
        const fileSize = file.size / 1024 / 1024;
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        const cleanFileName = file.name.replace(/\s+/g, '_');


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
