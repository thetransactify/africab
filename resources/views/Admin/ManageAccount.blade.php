@extends('Admin.layouts.app')
@section('title', 'Manage Account')
@section('content')
        <div class="row">
            <div class="col-12">
                <h1>Manage Admin Account</h1>
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
            </div>
            <div class="col-12 col-md-6 mb-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4 font-weight-bold">Admin Details</h5>
                        <form action="{{url('tsfy-admin/update-profile')}}" method="Post" enctype="multipart/form-data">
                            @csrf
                        <label class="form-group has-float-label mb-4">
                        <input data-role="tagsinput" type="text" name="Administrator" value="Administrator" readonly> <span>Account Name</span>
                        </label>
                        <label class="form-group has-float-label mb-1">
                        <input class="form-control" type="file" name="Category_file" onchange="validateImage(this)" accept=".jpg,.png,.jpeg,.png,.gif"><span>Change Display Image</span></label>
                        <label class="tooltip-text mb-4">( Onlyupload 600x600 size images.)</label>
                        <div  class="form-group text-right">                                                            
                            <button class="btn btn-secondary" type="submit">Save Details</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4">
                <div class="card mb-4">
                    <div class="card-body"> 
                        <form action="{{url('tsfy-admin/forgot-passwords')}}" method="POST">
                            @csrf
                        <h5 class="mb-4 font-weight-bold">Reset Password</h5>                   
                        <div class="alert alert-warning mb-3" role="alert">* Please note, password instructions will be sent on the registered email. Please only toggle the button below if you wish to reset the password now.</div>
                        <label class="form-label font-weight-bold" id="switch6-label">Confirm Reset</label>
                        <div class="custom-switch custom-switch-primary-inverse mb-2">

                                      <input class="custom-switch-input" id="switch6" type="checkbox" value="1" required>
                                      <label class="custom-switch-btn" for="switch6"></label>
                                      <input type="text" name="email" value="{{Auth::user()->email}}" hidden>

                         </div>
                         <div  class="form-group text-right">  
                        <!-- <p><a href="#" class="btn btn-secondary">Send Reset Instructions</a></p> -->
                        <button type="submit" class="btn btn-secondary">Send Reset Instructions</button>
                        </div>
                        </form>
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
