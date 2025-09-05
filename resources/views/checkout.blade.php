@extends('layout.app')
@section('title', 'Checkout')
@section('content')
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
    <!-- <div class="message-box coupon-added">
    <p>Coupon Code NEWATAFRICAB Applied! You got a <sup>TSh</sup>75,060.00 discount on order. <a class="expand-btn"
    href="javascript:void(0);">Click Here To Remove It.</a></p>
    </div> -->

    <!-- Add Coupon - incase if coupon was not added at Cart -->
    <!-- <div class="message-box addcoup">
    <p>Have A Coupon? 
    <a class="expand-btn"
    href="#coupon_info">Click Here To Enter Your Code.</a></p>
    </div> -->
    <!-- <div id="coupon_info" class="coupon-action-box">
    <div class="row">
    <div class="col-md-6 col-12">
    <form class="standard-form-rules coupon-form" action="post">
    <p class="mb-2">If you have a coupon code, please apply it below.</p>
    <input type="text" placeholder="Coupon Code" />
    <button type=submit>Apply</button>
    </form>
    </div>
    </div>
    </div> -->
    </div> 
            </div>

                 <div class="row my-5">
                    <div class="col-md-6">
                        <div class="address-widget">
                            <div class="main-title py-2">
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

                                    <label class="checkboxLarge ship-to-address"><input type="checkbox" name="showaddressx" id="showaddress"><b>Ship to a Different address</b></label>
                                    

                                    <label class="checkboxLarge ship-to-address"><input type="checkbox" id="showShopOption" name="shipping_option" value="cash_on_shop"><b>Pick in store</b>
                                    </label>

                                    <div class="show-more-address"  id="show-more-address">
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
                                        </div>

                                        <!-- Add Address Buttone -->
                                        <button type="button" class="general-button blackbutton my-3" id="Addressbutton" data-bs-toggle="modal" data-bs-target="#addWindow" >
                                            <i class="material-symbols-outlined">add</i>New 
                                        Address</button>
                                    </div>
                                    <div id="shopDropdownContainer" style="display:none; margin-top:10px;">
                                      <label for="shopSelect">Select Shop:</label>
                                      <select id="shopSelect" class="form-control" name="selected_shop">
                                        <option selected disabled>-- Choose a shop --</option>
                                        @foreach ($shopdeatils as $val)
                                         <option value="{{$val['id']}}">{{$val['name']}}-{{$val['address']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                            <!-- <div class="space-y-2"> -->
                            @if(collect($cartDetails)->pluck('color')->flatten()->filter()->isNotEmpty())
    
                                <div id="shopDropdownContainer">
                                 <label for="shopSelect">Select Product Color</label>
                                  <select name="color" class="form-control" id="color" required>
                                    <option selected disabled>Select Product Color</option>
                                    @foreach($cartDetails as $item)
                                               @foreach((array) $item['color'] as $clr)
                                    <option value="{{ $clr }}">{{ $clr }}</option>
                                     @endforeach
                                    @endforeach
                                </select>
                                 </div>
                            @endif     
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
        <p class="mb-3 text-small"><strong>The above bill is inclusive of VAT.</strong></p>
       <input type="hidden" name="shipping_charge">
        <button type="submit" id="confirmOrderBtn" class="general-button redbutton">Confirm Order</button>
        <div id="paymentErrorMsg" class="general-button" style="color: red; margin-top: 10px; display: none;"></div>
        <div id="shippingErrorMsg" class="general-button" style="color:red; margin-top:10px; display:none;"></div>
    </form>
</div>

<!-- <a type="button" onclick="location.href='thank-you.html'" href="javascript:void(0);" class="general-button redbutton">Confirm Order</a> -->
</div>
</div>

</div>

</div>

</div>
</div> 

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
  $('input[name="shipping_option"]').on('change', function () {
    $('input[name="shipping_option"]').not(this).prop('checked', false);

    if ($('#showShopOption').is(':checked')) {
      $('#shopDropdownContainer').show();
       $('#Addressbutton').hide();
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
        $('#Addressbutton').prop('checked', false);
      } else {
        $('#showShopOption').prop('checked', false);
         $('#Addressbutton').show();
         $('#shopDropdownContainer').hide();
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
            e.preventDefault(); // prevent form submission

            $('#shippingErrorMsg')
                .text("Please select a shipping option or shop.")
                .fadeIn();

            setTimeout(function () {
                $('#shippingErrorMsg').fadeOut();
            }, 5000);

            return;
        }

        // Optional: Validate payment-method also
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

    if (selectedPayment.value === "payu") {
        let formData = new FormData(this);

        fetch("{{ route('selcom.create.order') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === "success" && data.redirect_url) {
            window.location.href = data.redirect_url;
            } else {
                alert("Error: " + data.message);
            }
        })
        .catch(err => console.error(err));
    } 
    else {
        this.submit();
    }
});

</script>
@endsection
