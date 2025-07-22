@extends('Admin.layouts.app')
@section('title', 'Product Brand')
@section('content')
            <div class="row">
                <div class="col-12">
                    <h1>Manage Products</h1>
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
                    <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4 font-weight-bold">Manage Brands</h5>
                            <div class="alert alert-warning mb-5 mr-md-5" role="alert">* Please note, If you upload a new image for the category, the old image will be deleted. Please make sure you upload a 770x788 pixel image to maintain the website design.</div>
                            <div class="row mb-3">
                            <div class="col-md-6 col-12">
                            <form action="{{url('tsfy-admin/post-brand')}}" Method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-4">
                                <label class="form-group has-float-label mb-4">
                                <input data-role="tagsinput" name="brand_name" type="text">
                                <span>Brand Name</span>
                                </label>
                                </div>
                            <div class="form-group mb-4">
                                <label class="form-group has-float-label mb-4">
                                <input data-role="tagsinput" name="Tagline" type="text">
                                <span>Brand Tagline <i>(optional)</i></span>
                                </label>
                                </div>
                            <div class="form-group mb-4">
                                <label class="form-group has-float-label mb-4">
                                    <input data-role="tagsinput" name="address" type="text"> 
                                    <span>Brand Website Address</span>
                                </label>
                                </div> 
                            <div class="form-group mb-4">
                                <label class="form-group has-float-label mb-4">
                                    <textarea class="form-control" name="Description" rows="4" required></textarea> 
                                    <span>Brand Description</span>
                                </label>
                                </div>                                                           
                                <div class="form-group mb-4">
                                <label class="form-group has-float-label mb-1">
                                <input class="form-control" name="Category_file" type="file" accept=".jpg,.png,.jpeg,.png,.gif" onchange="validateImage(this)"><span>Image Upload</span></label>
                                <label class="tooltip-text mb-1">(Only upload 250x150 size images.)</label>
                                </div> 
                                <div class="form-group text-right">                                                       
                                <button class="btn btn-secondary" type="submit">Add Brand</button>
                            </div>
                            </form>
                            </div>
                           </div>
                             <div class="separator mb-5"></div>
                            <div class="row">
                            <div class="col-12"> 
                            <div class="table-responsive">
                        @if($getbrand->count() > 0)  
                            <table class="data-table data-table-category-image">
                            <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Brand Name</th>
                                        <th>Last Updated on</th>
                                        <th class="text-center">Actions</th>

                                    </tr>
                                </thead>
                            @foreach($getbrand as $index => $home) 
                                <tbody>
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><div class="img lightbox"><a href="{{ asset('storage/uploads/Home/' . $home->file) }}"><img src="{{ asset('storage/uploads/Home/' . $home->file) }}"/></a></div></td>
                                        <td>{{ $home->name }}</td>
                                        <td>{{ $home->created_at->format('d-m-y') }}</td>
                                        <td class="text-center"><a href="{{ url('tsfy-admin/delete-brand', Crypt::encrypt($home->id)) }}"  onclick="return confirm('Are you sure you want to delete this brand?')"  class="las la-trash-alt btn btn-secondary mx-1"></a></td>
                                    </tr>
                                </tbody>
                            @endforeach 
                            </table>
                         @else
                         <p>No  brand found.</p>
                         @endif
                            </div>
                            </div>
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
