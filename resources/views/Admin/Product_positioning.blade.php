@extends('Admin.layouts.app')
@section('title', 'Shop list')
@section('content')
            <div class="row">
                <div class="col-12">
                    <h1>Product Positioning</h1>
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
                        <a href="javascript:void(0);" data-toggle="modal" data-backdrop="static" data-target="#addprdimg" class="btn btn-secondary mb-2 float-right adjust-margin-01">Add list</a>
                            <h5 class="mb-4 font-weight-bold">Product list</h5>
                             <div class="separator mb-5"></div>

                            <div class="table-responsive">
                           @if($products->count() > 0)
                            <table class="data-table data-table-shop-gallryss">
                            <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Position</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $index => $product)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $product->product->listing_name }}</td>
                                        <td>{{ $product->position }}</td>
                                        <td class="text-center"><a href="{{ url('tsfy-admin/product-positioning', Crypt::encrypt($product->id)) }}" onclick="return confirm('Are you sure you want to delete this item?')" class="las la-trash-alt btn btn-secondary mx-1"></a></td>
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

<!-- Add Price List -->
   
<div class="modal fade modal-right" id="addprdimg" tabindex="-1" role="dialog"
aria-labelledby="exampleModalRight" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title font-weight-bold">Add Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <form action="{{url('tsfy-admin/post-productpositioning')}}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="form-group mb-4">
               <label class="form-group has-float-label mb-4">
                    <select class="form-control" name="product_id" id="ProductList" required>
                        <option selected disabled>Select Product</option>
                            @foreach($productList as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->listing_name }}
                                </option>
                            @endforeach
                    </select>
                    <span>Product Name</span>
                </label>

            </div>
            <div class="form-group mb-4">
                <label class="form-group has-float-label mb-4">
                    <select class="form-control" name="Postion" required>
                        <option value="" selected disabled>Select Position</option>
                        @for($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <span>Position</span>
                </label>
            </div>
           

                <div  class="form-group text-right">                                                            
                    <button class="btn btn-secondary" type="submit">Add</button>
                </div>
            </form>
        </div>

    </div>
</div>
</div>     
@endsection