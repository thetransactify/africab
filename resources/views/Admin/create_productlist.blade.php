@extends('Admin.layouts.app')
@section('title', 'Product')
@section('content')
<div class="row">
  <div class="col-12 mb-4">
    <h1 class="mb-3">Manage Product</h1>
    <li>
     <a href="{{url('/tsfy-admin/product-price')}}">Back to product list</a></li>
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
    <div class="separator mb-4"></div>
  </div>

  <div class="col-lg-8 col-md-7">
    <div class="card mb-4 shadow-sm">
      <div class="card-body">
        <h5 class="mb-4 font-weight-bold text-primary">List the Product</h5>

        <form action="{{ url('tsfy-admin/add-productlist') }}" method="POST">
          @csrf
          <!-- Category & Subcategory -->
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Category</label>
              <select id="CategoryList" name="CategoryList" class="form-control select2-single" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group col-md-6">
              <label>Subcategory</label>
              <select id="productList" name="productList" class="form-control select2-single" required>
                <option value="">Select Subcategories</option>
              </select>
            </div>
          </div>

          <!-- Meta Information -->
          <h6 class="mt-4 text-secondary">SEO & Meta Information</h6>
          <hr>
          <div class="form-group">
            <label>Meta Page Title</label>
            <input data-role="tagsinput" name="meta_title" type="text" class="form-control">
          </div>

          <div class="form-group">
            <label>Meta Page Description</label>
            <textarea class="form-control" name="meta_description" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>Keyword</label>
            <textarea class="form-control" name="Keyword" rows="3"></textarea>
          </div>
          <!-- Product Details -->
          <h6 class="mt-4 text-secondary">Product Details</h6>
          <hr>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Product Name</label>
              <input data-role="tagsinput" name="name" type="text" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label>Code</label>
              <input data-role="tagsinput" name="Code" type="text" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <label>Colors</label>
            <div id="color-wrapper">
              <input type="text" name="colors[]" class="form-control mb-2" placeholder="Enter color">
            </div>
            <button type="button" id="add-color" class="btn btn-sm btn-outline-secondary">+ Add More</button>
          </div>

          <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" rows="5" name="description" required></textarea>
          </div>

          <!-- Packaging Info -->
          <h6 class="mt-4 text-secondary">Packaging & Pricing</h6>
          <hr>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>Packaging Weight</label>
              <input data-role="tagsinput" name="Weight" type="text" class="form-control">
              <small class="form-text text-muted">Use ml, gm, L, Kg etc.</small>
            </div>
            <div class="form-group col-md-4">
              <label>Packaging Type</label>
              <input data-role="tagsinput" name="packing_type" type="text" class="form-control">
              <small class="form-text text-muted">Use PET, Glass, Tin etc.</small>
            </div>
            <div class="form-group col-md-4">
              <label>Item Cost</label>
              <input data-role="tagsinput" name="Item_cost" type="text" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <label>Offer Price</label>
            <input data-role="tagsinput" name="offer_price" type="text" class="form-control">
          </div>

          <!-- Switches -->
          <div class="form-row mt-4">
            <div class="col-md-6">
              <label class="font-weight-bold">Product Online</label>
              <div class="custom-switch custom-switch-primary-inverse">
                <input class="custom-switch-input" name="OnlineProduct" id="switch3" type="checkbox" value="1" checked>
                <label class="custom-switch-btn" for="switch3"></label>
              </div>
            </div>
      

             <div class="col-md-6">
                <label class="font-weight-bold">Transaction Enabled</label>
                    <div class="custom-switch custom-switch-primary-inverse">
                        <input class="custom-switch-input" name="TransactionEnabled" id="switch4" type="checkbox" value="1" checked>
                        <label class="custom-switch-btn" for="switch4"></label>
                    </div>
                </div>
            </div>


          <div class="form-group text-right mt-4">
            <button class="btn btn-primary px-4" type="submit">List Product</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- RIGHT SIDEBAR SECTION -->
  <div class="col-lg-4 col-md-5">
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <h6 class="text-secondary mb-3 font-weight-bold">Quick Tips</h6>
        <ul class="small pl-3">
          <li>Ensure all fields are filled before submitting.</li>
          <li>Use short and clear product names.</li>
          <li>SEO titles should be under 60 characters.</li>
          <li>Offer price should not exceed the item cost.</li>
        </ul>
      </div>
    </div>
<div id="loader" style="display:none; text-align:center; margin-top:10px;">
  <img src="{{ asset('admin/logos/logo-mono-dark.png') }}" alt="Loading..." width="40">
  <p class="text-muted small">Loading subcategories...</p>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('#CategoryList').on('change', function () {
        var categoryId = $(this).val();
        var $loader = $('#loader');
        var $productList = $('#productList');

        if (categoryId) {
            $loader.show();

            $.ajax({
                url: "get-subcategiores/" + categoryId,
                type: 'GET',
                success: function (data) {
                    $productList.empty().append('<option value="">Select Product</option>');
                    
                    $.each(data, function (key, value) {
                        $productList.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function () {
                    alert('Failed to load subcategories. Please try again.');
                },
                complete: function () {
                    $loader.hide();
                }
            });
        } else {
            $productList.empty().append('<option value="">Select Product</option>');
        }
    });
});
</script>  

<script>
document.getElementById('add-color').addEventListener('click', function () {
    let wrapper = document.getElementById('color-wrapper');
    let input = document.createElement('input');
    input.type = 'text';
    input.name = 'colors[]';
    input.className = 'form-control mb-2';
    input.placeholder = 'Enter color';
    wrapper.appendChild(input);
});
</script>                          
@endsection
