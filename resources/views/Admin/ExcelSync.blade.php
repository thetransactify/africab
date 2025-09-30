@extends('Admin.layouts.app')
@section('title', 'Product')
@section('content')
<div class="row">
            <div class="col-12">
                <h1>Product Price Sync</h1>
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
                <div class="separator mb-5">
                    
                </div>
                <div class="col-12 col-md-6 mb-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4 font-weight-bold">Google Sheet Sync</h5>

                        <div class="d-flex justify-content-between">
                            <!-- Button for Sheet 1 -->
                            <form action="{{ route('excel.FirstExcelSheet') }}" method="Post">
                                @csrf
                                <button class="btn btn-primary" type="submit">
                                    Sync Sheet 1
                                </button>
                            </form>

                            <!-- Button for Sheet 2 -->
                            <form action="{{ route('excel.SecondExcelSheet') }}" method="get">
                                @csrf
                                <button class="btn btn-success" type="submit">
                                    Sync Sheet 2
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div> 
        </div>
@endsection
