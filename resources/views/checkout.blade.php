@extends('layout.app')
@section('title', 'Checkout')
@section('content')
<style>
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.98);
    display: none;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    z-index: 99999; /* Very high z-index */
    font-family: Arial, sans-serif;
}

.spinner {
    border: 5px solid #f3f3f3;
    border-radius: 50%;
    border-top: 5px solid #3498db;
    border-right: 5px solid #3498db;
    width: 80px;
    height: 80px;
    animation: spin 1.5s linear infinite;
    margin-bottom: 20px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.loading-overlay p {
    font-size: 18px;
    color: #333;
    font-weight: 500;
    margin: 0;
    text-align: center;
}

.loading-overlay .sub-text {
    font-size: 14px;
    color: #666;
    margin-top: 8px;
}

body.loading-active {
    overflow: hidden;
}
</style>
    <div class="content-area">
    <!-- Banner Area -->
    <div class="page-headers smaller">
    <div class="container-fluid">
    <div class="row align-items-center">
    <div class="col-md-6 col-12">
    <h1>Checkout</h1>
    </div>
    <div class="col-md-6 col-12">
    <ul class="ph-breadcrumbs-list">
    <li><a href="{{url('index')}}">Home</a></li>
    <li><a href="{{route('checkout.get')}}" class="active">Checkout</a></li>
    </ul>
    </div>          

    </div>
    </div>
    </div>
@if ($errors->any())
    <div class="alert alert-danger" id="errorMessage" style="display: none;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <!-- Checkout Page -->
    <div class="checkout-page">
    <div class="container">

    <div class="row">
    <div class="col-12 mb-container">
  <form action="{{ route('checkout.cod') }}" method="post" id="checkoutForm" class="standard-form-rules">
        @csrf
    </div> 
            </div>

                 <div class="row my-5">
                    <div class="col-md-6">
                        <div class="address-widget">
                            <div class="main-title py-2 d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Billing <span class="">Details</span></h4>

                            </div>  
                            <!-- Addreess Selection-->       
                            <div class="address-section">
                                <div class="address-box"  id="all-addresses">
                                    <!-- Each Address -->
                                    @foreach($addressDetails as $address)
                                    @php
                                                $fullAddress = ($address['home_address'] ?? $address['office_address'] ?? $address['other_address']) . ', ' . $address['pincode'];
                                    @endphp
                                    <h6 class="address-label"><input addressid="15" class="address-selected" name="billing_address" id="billing_address" type="radio" value="{{ $address['id'] }}">
                                        <span>
                                            @if($address['label'] == 1)
                                            Home Address
                                            @elseif($address['label'] == 2)
                                            Office Address
                                            @elseif($address['label'] == 3)
                                            Other Address
                                            @endif
                                        </span></h6>
                                        <div class="address-body">
                                            <p>Address: <span class="block"><br>
                                            {{ $address['home_address'] ?? $address['office_address'] ?? $address['other_address'] }}</span></p>
                                            <p><span></span>{{ $address['pincode'] }}</p>
                                            <p>Mobile Number: <span>{{ $address['mobile_no'] }}</span></p>
                                        </div>
                                        @endforeach    

                                    </div>
<div class="row pb-5">
    <div class="col-auto">
                                        <button type="button" class="general-button blackbutton my-3" id="Addressbutton" data-bs-toggle="modal" data-bs-target="#addWindow" >
                                            <i class="material-symbols-outlined">add</i>New 
                                        Address</button> 
    </div>
     <div class="col-auto">

                                        <button type="button" class="general-button blackbutton my-3" id="priceListModalbutton" data-bs-toggle="modal" data-bs-target="#priceListModal" >
                                            <i class="material-symbols-outlined">delivery_truck_speed</i>Delivery Zones & Charges</button> 
</div>
</div>
                            <div class="main-title py-2 d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Delivery <span class="">Details</span></h4>

                            </div> 
                                  
                                    <label class="checkboxLarge ship-to-address pt-2"><input type="checkbox" name="showaddressx" id="showaddress"><b>Ship To Address</b></label>
                              
                                    <div class="show-more-address "  id="show-more-address">
                                        <div class="address-box">
                                            @foreach($addressDetails as $address)
                                            @php
                                                $fullAddress = ($address['home_address'] ?? $address['office_address'] ?? $address['other_address']) . ', ' . $address['pincode'];
                                            @endphp
                                            <h6 class="address-label"><input addressid="15" class="address-selected" value="{{ $address['id']  }}" data-price="{{ $address['price'] ?? 0 }}" name="shiping_address" id="shiping_address" type="radio">
                                                <span>
                                                    @if($address['label'] == 1)
                                                    Home Address
                                                    @elseif($address['label'] == 2)
                                                    Office Address
                                                    @elseif($address['label'] == 3)
                                                    Other Address
                                                    @endif
                                                </span></h6>
                                                <div class="address-body">
                                                    <p>Address: <span class="block"><br>
                                                    @if($address['label'] == 1)
                                                        {{ $address['home_address'] }}
                                                    @elseif($address['label'] == 2)
                                                        {{ $address['office_address'] }}
                                                    @elseif($address['label'] == 3)
                                                        {{ $address['other_address'] }}
                                                    @endif
                                                   </span></p>
                                                  
                                                    <p><span></span>{{ $address['pincode'] }}</p>
                                                    <p>Mobile Number: <span>{{ $address['mobile_no'] }}</span></p>
                                                </div>
                                                @endforeach 
                                            </div>
<div class="row pb-2">
    <div class="col-auto">
                                        <button type="button" class="general-button blackbutton my-3" id="Addressbutton" data-bs-toggle="modal" data-bs-target="#addWindow" >
                                            <i class="material-symbols-outlined">add</i>New 
                                        Address</button> 
    </div>
     <div class="col-auto">

                                        <button type="button" class="general-button blackbutton my-3" id="priceListModalbutton" data-bs-toggle="modal" data-bs-target="#priceListModal" >
                                            <i class="material-symbols-outlined">delivery_truck_speed</i>Delivery Zones & Charges</button> 
</div>
</div>
                                        </div>     
                                    <label class="checkboxLarge ship-to-address pt-1"><input type="checkbox" id="showShopOption" name="shipping_option" value="cash_on_shop"><b>Pick Up from a Nearby Store</b>
                                    </label>
                                    <div id="shopDropdownContainer" style="display:none; margin-top:10px;">
                                      <div class="select-wrapper">
                                      <select id="shopSelect" class="selectStoreDD" name="selected_shop">
                                        <option selected disabled>-- Choose a shop --</option>
                                        @foreach ($shopdeatils as $val)
                                         <option value="{{$val['id']}}">{{$val['name']}}-{{$val['address']}}</option>
                                        @endforeach
                                    </select>
                                       <i class="material-symbols-outlined">change_history</i>
                                    </div>
                                </div>
                                    </div>
                                </div>
                            <!-- <div class="space-y-2"> -->
                            </div>
                               @if(count($cartDetails) > 0)
                               <div class="col-md-5 offset-md-1">
                                <!-- Bill Summary -->
                                <div class="order-details">
                                    <div class="main-title py-2">
                                        <h4 class="mb-0">Bill <span class="red-color">Summary</span></h4>
                                    </div>
                                    <div class="table-responsive my-2">
                                        <table class="table order-table">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            @foreach($cartDetails as $value)    
                                            <tbody>
                                                <tr>
                                                    <td>{{$value['product_name']}} <strong>x {{$value['quantity']}}</strong>
                                                    </td>
                                                    <td class="text-end"><i>TSh</i>{{$value['total']}}</td>
                                                </tr>
                                            </tbody>
                                            @endforeach
                                            <tfoot>

                                                <tr class="cart-subtotal">
                                                    <td>Subtotal</td>
                                                    <td class="text-end"><i>TSh</i><span id="subtotalAmount">{{$subtotal}}</span></td>
                                                </tr>
                                                <tr class="shipping">
                                                    <td>Shipping</td>
                                                   <td class="text-end" id="shippingChargeAmount"><i>TSh</i>
                                                    </td>
                                                </tr>
                                                <tr class="order-total">
                                                    <td>Order Total</td>
                                                    <td class="text-end"><span class="order-total-ammount"><i>TSh</i><span id="totalAmount"></span></span>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                @else
                                No product found.
                                @endif  
<input type="hidden" name="total_ammount" class="order-total-ammount"  id="totalAmountInput">
<input type="hidden" name="user_id" class="order-total-ammount"  value="{{Crypt::encrypt($id)}}" id="user_id" required>
<div class="checkout-payment">
  
        <div class="payment-group mb--10">
            <div class="custom-radio">
                <input type="radio" value="payu"  name="payment-method" id="payu">
                <label class="payment-label" for="payu">Pay via Payment Gateway</label>
            </div><div class="payment-info payu hide-in-default" data-method="payu">
                <p>Make Payment via <b>Payment Gateway</b></p>
            </div>
        </div>
        <div class="payment-group mb--10">
            <div class="custom-radio">
                <input type="radio" value="cash" name="payment-method" id="cash" required>
                <label class="payment-label" for="cash">
                    Cash on Delivery
                </label>
            </div>
            <div class="payment-info cash hide-in-default" data-method="cash">
                <p>Pay with cash upon delivery.</p>
            </div>
        </div>
        <p class="mt-5 mb-3 fw-bold">The above bill is inclusive of VAT.</p>
       <input type="hidden" name="shipping_charge">
        <button type="submit" id="confirmOrderBtn" class="general-button redbutton">Confirm Order</button>
        <div id="paymentErrorMsg" class="fw-bold error-msg" style=" display: none;"></div>
        <div id="shippingErrorMsg" class="fw-bold error-msg" style="display:none;"></div>
    </form>
</div>

<!-- <a type="button" onclick="location.href='thank-you.html'" href="javascript:void(0);" class="general-button redbutton">Confirm Order</a> -->
</div>
</div>

</div>

</div>

</div>
</div> 
<div id="loadingOverlay" class="loading-overlay">
    <div class="spinner"></div>
    <p>Processing Your Order</p>
    <p class="sub-text">Please wait while we redirect you...</p>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
  $('input[name="shipping_option"]').on('change', function () {
    $('input[name="shipping_option"]').not(this).prop('checked', false);

    if ($('#showShopOption').is(':checked')) {
      $('#shopDropdownContainer').show();
       //$('#Addressbutton').hide();
       $('#show-more-address').hide();
    } else {
      $('#shopDropdownContainer').hide();
        $('#Addressbutton').show();
      $('#shopSelect').val('');
    }
  });
});
$(document).ready(function () {
  $('#showShopOption, #showaddress').on('change', function () {
    if ($(this).is(':checked')) {
      if ($(this).attr('id') === 'showShopOption') {
        $('#showaddress').prop('checked', false);
        $('input[name="shiping_address"]').prop('checked', false);
        $('#Addressbutton').prop('checked', false);
        $('#shopDropdownContainer').show();
      } else {
        $('#showShopOption').prop('checked', false);
        $('#shopSelect').val('');
        $('#shopDropdownContainer').hide();
        $('#Addressbutton').show();
      }
    }
  });
});

</script>
<script type="text/javascript">
$(document).ready(function () {
    function updateTotalAmount(shippingCharge = 0) {
        let subtotal = parseFloat($('#subtotalAmount').text()) || 0;
        if ($('#showShopOption').is(':checked')) {
            shippingCharge = 0;
        }

        let total = subtotal + shippingCharge;
        $('#shippingChargeAmount').text(shippingCharge.toFixed(2));
        $('#totalAmount').text(total.toFixed(2));
       document.getElementById('totalAmountInput').value = total;

    }
    $('#showaddress').change(function () {
        if ($(this).is(':checked')) {
            $('#show-more-address').show();
            $('#shopSelect').val('');
            $('#showShopOption').prop('checked', false);
        } else {
            $('#show-more-address').hide();
            updateTotalAmount(0);
        }
    });
    $(document).on('click', '#show-more-address h6.address-label', function () {
        const radio = $(this).find('input[type="radio"]');
        if (!radio.prop('checked')) {
            radio.prop('checked', true).trigger('change');
        }
        const currentBody = $(this).next(".address-body");
        $(".address-body").not(currentBody).slideUp(300);
        currentBody.slideDown(300);
        const value = radio.val();
        const id = radio.attr('id');
        const price = parseFloat(radio.data('price')) || 0;
        updateTotalAmount(price);
        $('input[name="shipping_charge"]').val(price);

    });
    $('input[name="shipping_option"]').on('change', function () {
        updateTotalAmount();
    });
    updateTotalAmount();
});

</script>
<script>
$(document).ready(function () {
    $('#confirmOrderBtn').click(function (e) {
        const isShipChecked = $('#showaddress').is(':checked');
        const isStoreChecked = $('#showShopOption').is(':checked');

        if (!isShipChecked && !isStoreChecked) {
            e.preventDefault();

            $('#shippingErrorMsg')
                .text("Please select a shipping option or shop.")
                .fadeIn();

            setTimeout(function () {
                $('#shippingErrorMsg').fadeOut();
            }, 5000);

            return;
        }


        const selectedPayment = $('input[name="payment-method"]:checked');
        if (selectedPayment.length === 0) {
            e.preventDefault();

            $('#shippingErrorMsg')
                .text("Please select a payment method.")
                .fadeIn();

            setTimeout(function () {
                $('#shippingErrorMsg').fadeOut();
            }, 5000);
        }
    });
});
</script>
<script>
$('#confirmOrderBtn').click(function (e) {
    let shipChecked = $('#showaddress').is(':checked');
    let storeChecked = $('#showShopOption').is(':checked');

    let selectedShippingAddress = $('input[name="shiping_address"]:checked').length > 0;
    let selectedShopPickup = $('#shopSelect').val() !== '';

    let errorMsg = '';

    if (!shipChecked && !storeChecked) {
        errorMsg = 'Please select a shipping option.';
    } else if (shipChecked && !selectedShippingAddress) {
        errorMsg = 'Please select a shipping address.';
    } else if (storeChecked && !selectedShopPickup) {
        errorMsg = 'Please select a store for pickup.';
    }

    if (errorMsg !== '') {
        e.preventDefault();
        $('#shippingErrorMsg').text(errorMsg).fadeIn();
        setTimeout(function () {
            $('#shippingErrorMsg').fadeOut();
        }, 5000);
    }
});

</script>

<script type="text/javascript">
    document.getElementById("checkoutForm").addEventListener("submit", function(e) {
        e.preventDefault();

        let selectedPayment = document.querySelector('input[name="payment-method"]:checked');

        if (!selectedPayment) {
            alert("Please select a payment method.");
            return;
        }
        const loadingOverlay = document.getElementById("loadingOverlay");
        loadingOverlay.style.display = 'flex';
        
        document.body.classList.add('loading-active');
        
        const submitBtn = document.getElementById("confirmOrderBtn");
        submitBtn.disabled = true;
        if (selectedPayment.value === "payu") {
            // Direct form submit - CORS issue avoid karega
            this.action = "{{ route('selcom.create.order') }}";
            this.submit();
        } else {
            // For cash on delivery
            this.action = "{{ route('checkout.cod') }}";
            this.submit();
        }
    });
</script>
@endsection
