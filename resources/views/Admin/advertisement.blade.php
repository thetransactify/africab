@extends('Admin.layouts.app')
@section('title', 'Advertisement')
@section('content')
<div class="row">
            <div class="col-12">
                <h1>eCommerce Settings</h1>
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
                <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4 font-weight-bold">Advertisement</h5>
                        <div class="alert alert-warning mb-5 mr-md-5" role="alert">* Please note, you can upload upto 8 advertisement. Banners are numbered in ascending order. If you upload an image over "Advertisement 01", the image will be shown first, if you upload over a current image, it will be replaced. If you delete "Advertisement 01", "Advertisement 02" will be shown first.</div>
                        <div class="row mb-3">
                        <div class="col-md-6 col-12">
                        <form action="{{url('tsfy-admin/post-advertisement')}}" Method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group mb-4">
                            <label class="form-group has-float-label mb-4">
                            <select id="CategoryList" name="banner" class="form-control select2-single" data-width="100%">
                                <option label="&nbsp;" selected disabled>Select Advertisement Location</option>
                                <option value="1">Advertisement 01</option>
                                <option value="2">Advertisement 02</option>
                                <option value="3">Advertisement 03</option>
                                <option value="4">Advertisement 04</option>
                                <option value="5">Advertisement 05</option>
                                <option value="6">Advertisement 06</option>
                                <option value="7">Advertisement 07</option>
                                <option value="8">Advertisement 08</option>

                            </select>
                            <span>Advertisement Location</span>
                            </label>
                            </div>
                        
                            <div class="form-group mb-4">
                            <label class="form-group has-float-label mb-1">
                            <input class="form-control" name="Category_file" type="file" accept=".jpg,.png,.jpeg,.png,.gif" onchange="validateImage(this)"><span>Image Upload</span></label>
                            <label class="tooltip-text mb-4">(Only upload 1920x1080 size images.)</label>
                            </div>
                        <div class="form-group text-right">                                                            
                            <button class="btn btn-secondary" type="submit">Add Image</button>
                        </div>
                        </form>
                        </div>
                       </div>
                         <div class="separator mb-5"></div>
                        <div class="row">
                        <div class="col-12"> 
                        <div class="table-responsive">
                        @if($advertisement->count() > 0)     
                        <table class="data-table data-table-category-image">
                        <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>advertisement Location</th>
                                    <th>Last Updated on</th>
                                    <th class="text-center">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                            @foreach($advertisement as $index => $value)    
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><div class="img lightbox"><a href="{{ asset('storage/uploads/advertisement/' . $value->file) }}"><img src="{{ asset('storage/uploads/advertisement/' . $value->file) }}"/></a></div></td>
                                    <td>{{ $value->ads_no }}</td>
                                    <td>{{ $value->created_at->format('d-m-y') }}</td>
                                    <td class="text-center"><a href="{{ url('tsfy-admin/delete-advertisement', Crypt::encrypt($value->id)) }}"  onclick="return confirm('Are you sure you want to delete this advertisement?')" class="las la-trash-alt btn btn-secondary mx-1"></a></td>
                                </tr>
                              @endforeach    
                            </tbody>
                        </table>
                         @else
                         <p>No advertisement found.</p>
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
