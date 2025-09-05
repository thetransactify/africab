@extends('Admin.layouts.app')
@section('title', 'Homepage')
@section('content')
<div class="row">
            <div class="col-12">
                <h1>CMS Management</h1>
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
                        <h5 class="mb-4 font-weight-bold">Upload video</h5>
                        <div class="alert alert-warning mb-5 mr-md-5" role="alert">* Please note, you can upload upto 1 video. video are numbered in descending order.</div>
                        <div class="row mb-3">
                        <div class="col-md-6 col-12">
                        <form action="{{url('tsfy-admin/post-video')}}" Method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-4">
                            <label class="form-group has-float-label mb-1">
                            <input class="form-control" name="videourl" type="text"><span> Url</span></label>
                            </div>
                        <div class="form-group text-right">          
                            <button class="btn btn-secondary" type="submit">upload url</button>
                        </div>
                        </form>
                        </div>
                       </div>
                         <div class="separator mb-5"></div>
                        <div class="row">
                        <div class="col-12"> 
                        <div class="table-responsive">
                        @if($videourl->count() > 0)     
                        <table class="data-table data-table-category-imagess">
                        <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Url</th>
                                    <th>Last Updated on</th>
                                    <th class="text-center">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                            @foreach($videourl as $index => $home)    
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $home->url }}</td>
                                    <td>{{ $home->created_at->format('d-m-y') }}</td>
                                    <td class="text-center"><a href="{{ url('tsfy-admin/delete-url', Crypt::encrypt($home->id)) }}"  onclick="return confirm('Are you sure you want to delete this url?')" class="las la-trash-alt btn btn-secondary mx-1"></a></td>
                                </tr>
                              @endforeach    
                            </tbody>
                        </table>
                         @else
                         <p>No homeslider found.</p>
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
