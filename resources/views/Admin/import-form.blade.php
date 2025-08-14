@extends('Admin.layouts.app')
@section('title', 'Product')
@section('content')
<div class="row">
            <div class="col-12">
                <h1>Bulk Upload</h1>
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
                        <h5 class="mb-4 font-weight-bold">Bulk Upload</h5>
                        <form action="{{ url('tsfy-admin/add-excel-product') }}" method="POST" enctype="multipart/form-data">
                         @csrf
                        <div class="form-group mb-1">
                        <label class="form-group has-float-label mb-1">
                        <input type="file" class="form-control" name="excel_file" required>
                        <span>Description</span></label>
                          
                            </div>                            
                            </div>
                            <div  class="form-group text-right">                                                            
                            <button class="btn btn-secondary" type="submit">Upload</button>
                            </div>
                           <!--  <div class="alert alert-warning mt-5" role="alert">* Please note, the new product is labelled as 'New' for a period of 10 days. Product marked 'Featured' remains unless changed</div> -->
                        </form>
                    </div>
                </div>
            </div>
            </div> 
        </div>
@endsection
