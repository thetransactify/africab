@extends('Admin.layouts.app')
@section('title', 'Homepage')
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
                        <h5 class="mb-4 font-weight-bold">Frequently Asked Questions</h5>
                        <div class="row mb-3">
                        <div class="col-md-6 col-12">
                        <form action="{{url('tsfy-admin/post-fasq')}}" Method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group mb-4">
                            <label class="form-group has-float-label mb-4">
                             <textarea class="form-control" name="question" rows="4" required></textarea> 
                            <span>Question</span>
                            </label>
                            </div>
                        
                            <div class="form-group mb-4">
                            <label class="form-group has-float-label mb-1">
                            <textarea class="form-control" name="answer" rows="4" required></textarea> 
                            <span>Answer</span></label>
                            </div>
                        <div class="form-group text-right">                                                            
                            <button class="btn btn-secondary" type="submit">Add</button>
                        </div>
                        </form>
                        </div>
                       </div>
                         <div class="separator mb-5"></div>
                        <div class="row">
                        <div class="col-12"> 
                        <div class="table-responsive">
                    @if($fasq->count() > 0)     
                        <table class="data-table data-table-category-images">
                        <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                          <tbody>
                           @foreach($fasq as $index => $questionss)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $questionss->question }}</td>
                                    <td>{{ $questionss->answer }}</td>
                                    <td class="text-center"><a href="{{ url('tsfy-admin/delete-fasq', Crypt::encrypt($questionss->id)) }}"  onclick="return confirm('Are you sure you want to delete this fasq?')" class="las la-trash-alt btn btn-secondary mx-1"></a></td>
                                </tr>  
                          
                          @endforeach 
                            </tbody> 
                        </table>
                         @else
                         <p>No fasq found.</p>
                         @endif
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
            </div> 
        </div>
@endsection
