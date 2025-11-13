@extends('Admin.layouts.app')
@section('title', 'Price List')
@section('content')
<div class="row">
<div class="col-12">
<h1>Product Settings</h1>
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
    }, 5000);
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
    }, 5000);
</script>
@endif
<div class="separator mb-5"></div>
<div class="row">
<div class="col-12 mb-4">
<div class="card mb-4">
<div class="card-body">
<a href="{{url('/tsfy-admin/product-list')}}"  class="btn btn-secondary mb-2 float-right adjust-margin-01">Add Product</a>
<h5 class="mb-4 font-weight-bold">Product List</h5>
<div class="separator mb-5"></div>

<div class="table-responsive">
	 @if($productlist->count() > 0)
<table class="data-table data-table-prdprice">
<thead>
<tr>
<th>#</th>
<th>Date</th>
<th>Product Name</th>
<th>Product Code</th>
<th>Cost</th>
<th>Actions</th>

</tr>
</thead>
<tbody>
         @foreach($productlist as $index => $category)
					<tr>
						<td>{{ $index + 1 }}</td>
						<td>{{ $category->created_at->format('d-m-Y') }}</td>
						<td>{{ $category->listing_name }}</td>
                        @php
                         $rawValue = $category->code;
                         $displayValue = $rawValue; // default
                         if (preg_match('/"([^"]+)"\s*\)$/', $rawValue, $matches)) {
                            $displayValue = trim($matches[1]);
                             }
                        @endphp
						<td>{{ $displayValue }}</td>
						<td><small class="font-weight-bold "></small>{{ $category->product_cost }}</td>
                       
						<td class="text-center"><a href="{{ url('tsfy-admin/edit-productlist/' . Crypt::encrypt($category->id)) }}" class="las la-edit btn btn-secondary mx-1"></a>
							<a href="{{ route('productlist.delete', Crypt::encrypt($category->id)) }}" onclick="return confirm('Are you sure you want to delete this product?')" class="las la-trash-alt btn btn-secondary mx-1"></a></td>
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
</div>                          
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const token = '{{ csrf_token() }}';
    document.querySelectorAll('.txn-toggle').forEach(function (toggle) {
        toggle.dataset.previous = toggle.checked ? '1' : '0';
        toggle.addEventListener('change', function () {
            const encryptedId = this.dataset.id;
            const isChecked = this.checked;
            const label = this.closest('.txn-switch-wrapper').querySelector('.txn-label');

            fetch(`{{ url('tsfy-admin/product-list') }}/${encryptedId}/toggle-txn`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    label.textContent = data.label;
                    toggle.dataset.previous = data.value == 1 ? '1' : '0';
                } else {
                    throw new Error('Toggle failed');
                }
            })
            .catch(() => {
                alert('Unable to update Txn status. Please try again.');
                toggle.checked = toggle.dataset.previous === '1';
                label.textContent = toggle.dataset.previous;
            });
        });
    });
});
</script>
@endpush
