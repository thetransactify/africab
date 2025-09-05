@extends('Admin.layouts.app')
<head><meta name="csrf-token" content="{{ csrf_token() }}">
</head>
@section('title', 'Moderatedlist')
@section('content')
<div class="row">
    <div class="col-12">
        <h1>Reviews</h1>
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
        <div class="col-12">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4 font-weight-bold">Moderated Reviews</h5>
                 <div class="separator mb-5"></div>
                <div class="row">
                <div class="col-12"> 
                <div class="table-responsive">
                    @if($moderatedlist->count() > 0)
                <table class="data-table data-table-reviews-list">
                <thead>
                        <tr>
                            <th>Review Date</th>
                            <th>Product Name</th>
                            <th>Customer Name</th>
                            <th>Customer Rating</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($moderatedlist as $index=> $review)
                        <tr>
                            <td>{{$review->created_at->format('d-m-Y')}}</td>
                            <td>{{$review->product->listing_name}}</td>
                            <td>{{$review->users->name}}</td>
                            <td>{{$review->rating}}</td>
                            <td>
                                @if($review->status == 2)
                                    Published
                                @elseif($review->status == 3)
                                    Unpublished
                                @endif
                            </td>
                            <td>{{$review->updated_at->format('d-m-Y')}}</td>
                            <td class="text-center">
                            <a href="javascript:void(0)" data-id="{{ Crypt::encrypt($review->id) }}" class="las la-eye btn btn-secondary mx-1 openReviewModal"></a>
                            <a href="{{ url('tsfy-admin/delete-reviews', Crypt::encrypt($review->id)) }}"  onclick="return confirm('Are you sure you want to delete this Moderated review?')" class="las la-trash-alt btn btn-secondary mx-1"></a></td>
                        </tr>  
                        @endforeach                                 
                    </tbody>
                </table>
                @else
                No list found
                @endif
                </div>
                </div>
            </div>
        </div>
    </div>
    
</div> 
</div>
</div>

<!-- Review Toggle Modal -->
   
<div class="modal fade" id="reviewWindow" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Toggle Review Visibility</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- Loader -->
                <div id="modalLoader" class="text-center">
                    <p>Loading...</p>
                </div>

                <!-- Modal Content -->
                <div id="modalContent" style="display:none;">
                    <div class="alert alert-warning mb-5" role="alert">
                        * You can only Publish or Unpublish Comments from here. To delete, use Delete Button in the list.
                    </div>

                    <div class="row text-left">
                        <div class="col-md-6 col-12">
                            <p><b>Review Date:</b><br><span id="modalReviewDate"></span></p>
                        </div>
                        <div class="col-md-6 col-12">
                            <p><b>Customer Name:</b><br><span id="modalCustomerName"></span></p>
                        </div>
                        <div class="col-md-6 col-12">
                            <p><b>Customer Email:</b><br><span id="modalCustomerEmail"></span></p>
                        </div>
                        <div class="col-md-6 col-12">
                            <p><b>Product Reviewed:</b><br><span id="modalProductName"></span></p>
                        </div>
                    </div>

                    <div class="row text-justify">
                        <div class="col-12">
                            <div class="form-group mb-1">
                                <label class="d-block">Product Rated</label>
                                <select class="rating"  data-current-rating="4" data-readonly="true">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <p><b>Customer Comment:</b><br><span id="modalCustomerComment"></span></p>
                        </div>
                    </div>

                    <div class="row text-center">
                        <div class="col-12">
                            <label class="form-label font-weight-bold" id="switch5-label">Publish Review</label>
                            <div class="custom-switch custom-switch-primary-inverse mb-2">
                                <input type="hidden" id="reviewIds" value="">
                                <input class="custom-switch-input" id="modalPublishSwitch" type="checkbox">
                                <label class="custom-switch-btn" for="modalPublishSwitch"></label>
                            </div>

                            <div class="form-group text-center mt-3">
                                <button type="button" class="btn btn-secondary update-review-btn">Update Review</button>
                            </div>
                        </div>
                    </div>
                </div> <!-- Modal Content -->
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
   $(document).on('click', '.openReviewModal', function() {
    var reviewId = $(this).data('id');
    $('#modalLoader').show();
    $('#modalContent').hide();

    $('#reviewWindow').modal('show');

    $.ajax({
        url: 'get-review/' + reviewId,
        type: 'GET',
        success: function(response) {
            $('#modalReviewDate').text(response.review_date);
            $('#modalCustomerName').text(response.customer_name);
            $('#modalCustomerEmail').text(response.customer_email);
            $('#modalProductName').text(response.product_name);
            let ratingValue = parseInt(response.rating);
            $('.rating').barrating('set', ratingValue);
            $('#modalCustomerComment').text(response.comment);
            $('#reviewIds').val(response.ids);
            $('#modalLoader').hide();
            $('#modalContent').show();
        },
        error: function() {
            alert('Error fetching review data.');
            $('#reviewWindow').modal('hide');
        }
    });
});


   $(document).ready(function() {
    $(document).on('click', '.update-review-btn', function() {
        var reviewId = $('#reviewIds').val();
        var newStatus = $('#modalPublishSwitch').is(':checked') ? 2 : 3;
        $.ajax({
            url: 'update-review-status',
            type: 'POST',
            data: {
                review_id: reviewId,
                status: newStatus,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert('Review status updated successfully.');
                $('#reviewWindow').modal('hide');
            },
            error: function() {
                alert('Error updating review status.');
            }
        });
    });

});


</script>


@endsection
