@extends('Admin.layouts.app')
@section('title', 'View Category')
@section('content')
<div class="row">
<div class="col-12">
    <h1>Manage Category</h1>
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
                            <h5 class="mb-4 font-weight-bold">Category List</h5>
                            <div class="separator mb-5"></div>

                            <div class="table-responsive">
                             @if($categories->count() > 0)     
                             <table class="data-table data-table-category">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Image</th>
                                        <th>Category Name</th>
                                        <th>No. of Products</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $index => $category)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $category->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            @if($category->file)
                                            <div class="img lightbox"><a href="{{ asset('storage/uploads/category/' . $category->file) }}"><img src="{{ asset('storage/uploads/category/' . $category->file) }}"/></a></div>
                                            @else
                                            No Image
                                            @endif
                                        </td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->id }}</td>
                                        <td class="text-center"> <a href="{{ url('tsfy-admin/edit-category/' . Crypt::encrypt($category->id)) }}" class="las la-edit btn btn-secondary mx-1"></a>
                                            <a href="{{ url('tsfy-admin/delete-categorys', Crypt::encrypt($category->id)) }}" 
                                             onclick="return confirm('Are you sure you want to delete this category?')" 
                                             class="las la-trash-alt btn btn-secondary mx-1">
                                         </a>
                                        @if($category->status == 1)
                                                <a href="{{ url('tsfy-admin/category-status', ['id' => Crypt::encrypt($category->id), 'status' => 0]) }}" 
                                                   class="btn btn-success mx-1"
                                                   onclick="return confirm('Do you want to set this category Offline?')">
                                                   <i class="las la-toggle-on"></i> Online
                                                </a>
                                        @else
                                                <a href="{{ url('tsfy-admin/category-status', ['id' => Crypt::encrypt($category->id), 'status' => 1]) }}" 
                                                   class="btn btn-secondary mx-1"
                                                   onclick="return confirm('Do you want to set this category Online?')">
                                                   <i class="las la-toggle-off"></i> Offline
                                                </a>
                                        @endif
                                     </td>
                                 </tr>
                                 @endforeach
                             </tbody>
                         </table>
                         @else
                         <p>No categories found.</p>
                         @endif
                     </div>
                 </div>
             </div>
         </div>
     </div> 
 </div>


 @endsection
