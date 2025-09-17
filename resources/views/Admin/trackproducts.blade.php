@extends('Admin.layouts.app')
@section('title', 'Shop list')
@section('content')
            <div class="row">
                <div class="col-12">
                    <h1>Popular Items</h1>
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

                    @if($errors->any())
                        <div class="alert alert-danger" id="errorAlert">
                            <ul>
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <script>
                            setTimeout(function() {
                                let errorBox = document.getElementById('errorAlert');
                                if (errorBox) {
                                    errorBox.style.display = 'none';
                                }
                            }, 3000);
                        </script>
                    @endif

                    <div class="separator mb-5"></div>
                    <div class="col-12 mb-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4 font-weight-bold">Popular Items</h5>
                             <div class="separator mb-5"></div>
                            <div class="table-responsive">
                           @if($products->count() > 0)
                            <table class="data-table data-table-shop-gallrypopular">
                            <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Total Searches</th>

                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $index => $product)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $product->product->listing_name }}</td>
                                        <td>{{ $product->count }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>  
                           @else
                             <p>No Products Positioning found.</p>
                             @endif      
                            </div>
                        </div>
                    </div>
                </div>
                </div> 
            </div>     
@endsection