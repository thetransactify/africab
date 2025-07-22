@extends('Admin.layouts.app')
<head><meta name="csrf-token" content="{{ csrf_token() }}">
</head>
@section('title', 'Review')
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
                            <h5 class="mb-4 font-weight-bold">New Reviews</h5>
                             <div class="separator mb-5"></div>
                            <div class="row">
                            <div class="col-12"> 
                            <div class="table-responsive">
                            @if($reviewlist->count() > 0 )    
                            <table class="data-table data-table-reviews">
                            <thead>
                                    <tr>
                                        <th>Review Date</th>
                                        <th>Product Name</th>
                                        <th>Customer Name</th>
                                        <th>Customer Rating</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reviewlist as $index => $review)
                                    <tr>
                                        <td>{{$review->created_at->format('d-m-Y')}}</td>
                                        <td>{{$review->product->name}}</td>
                                        <td>{{$review->users->name}}</td>
                                        <td>{{$review->rating}}</td>
                                        <td class="text-center">
                                        <a href="javascript:void(0)" class="las la-eye btn btn-secondary mx-1 openReviewModal" data-id="{{ Crypt::encrypt($review->id) }}"></a>
                                        <a href="{{ url('/delete-reviews/', Crypt::encrypt($review->id)) }}" onclick="return confirm('Are you sure you want to delete this review?')"  class="las la-trash-alt btn btn-secondary mx-1"></a></td>
                                    </tr>   
                                    @endforeach                                
                                </tbody>
                            </table>
                             @else
                                <p>No Review found.</p>
                            @endif
                            </div>
                            </div>
                        </div>
                    </div>
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
        url: 'tsfy-admin/get-review/' + reviewId,
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
            url: 'tsfy-admin/update-review-status',
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
