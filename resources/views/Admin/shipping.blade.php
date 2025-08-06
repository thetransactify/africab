@extends('Admin.layouts.app')
@section('title', 'shipping')
@section('content')
            <div class="row">
                <div class="col-12">
                    <h1>Shipping List</h1>
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
                    <div class="col-12 mb-4">
                    <div class="card mb-4">
                        <div class="card-body">
                        <a href="javascript:void(0);" data-toggle="modal" data-backdrop="static" data-target="#addprdimg" class="btn btn-secondary mb-2 float-right adjust-margin-01">Add Shipping Area</a>
                            <h5 class="mb-4 font-weight-bold">Shipping List</h5>
                             <div class="separator mb-5"></div>

                            <div class="table-responsive">
                            @if($ShippingList->count() > 0)
                            <table class="data-table data-table-shipping-gallry">
                            <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Region</th>
                                        <th>Price</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach($ShippingList as $index => $value)    
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $value->created_at->format('d-m-Y') }}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->price ?? ''}}</td>
                                        <td class="text-center"><a href="{{ url('tsfy-admin/delete-shipping', Crypt::encrypt($value->id)) }}" onclick="return confirm('Are you sure you want to delete this list?')" class="las la-trash-alt btn btn-secondary mx-1"></a></td>
                                    </tr>
                                   @endforeach  
                                </tbody>
                            </table>
                             @else
                             <p>No Shipping List found.</p>
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
            <h5 class="modal-title font-weight-bold">Add Shipping</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <form action="{{url('tsfy-admin/post-shipping')}}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="form-group mb-4">
                <label class="form-group has-float-label mb-4">                       
                    <input type="text" class="form-control" name="name" id="CategoryList" required>
                    <span>Region*</span>
                </label>
            </div>
            <div class="form-group mb-4">
                <label class="form-group has-float-label mb-4">
                     <input type="text" class="form-control" name="price" id="productList" required>
                    <span>Price*</span>
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