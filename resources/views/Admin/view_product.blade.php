@extends('Admin.layouts.app')
@section('title', 'View SubCategories')
@section('content')
<div class="row">
<div class="col-12">
<h1>Manage SubCategories</h1>
<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
</nav>
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <script>
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>
@endif
@if (session('error'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <script>
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>
@endif
<div class="separator mb-5"></div>
<div class="col-12 mb-4">
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4 font-weight-bold">SubCategories List</h5>
            <div class="separator mb-5"></div>

            <div class="table-responsive">
            @if($productlist->count() > 0)  
                <table class="data-table data-table-products">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <!-- <th>Image</th> -->
                            <th>SubCategories Name</th>
                            <th>Category Name</th>
                            <th>Label</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productlist as $index => $product)
                        <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $product->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    @if($product->check_remark=2)
                                    <td><span class="badge badge-pill badge-primary m-1">New</span></td>
                                    @elseif($product->check_remark=3)
                                    <td><span class="badge badge-pill badge-primary m-1">Featured</span></td>
                                    @else
                                    <td><span class="badge badge-pill badge-primary m-1">Bestseller</span></td>
                                    @endif
                                    <td class="text-center"> <a href="{{ url('tsfy-admin/edit-SubCategories/' . Crypt::encrypt($product->id)) }}" class="las la-edit btn btn-secondary mx-1"></a>
                                    <!-- <a href="javascript:void(0)" class="las la-trash-alt btn btn-secondary mx-1"></a></td> -->
                                    <a href="{{ route('product.delete', Crypt::encrypt($product->id)) }}" 
                                       onclick="return confirm('Are you sure you want to delete this product?')" 
                                       class="las la-trash-alt btn btn-secondary mx-1">
                                    </a></td>

                            </tr> 
                        @endforeach    
                    </tbody>
                </table>
                @else
                    <p>No products found.</p>
                @endif
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>

@endsection
