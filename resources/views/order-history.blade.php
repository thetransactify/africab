@extends('layout.app')
@section('title', 'Order History')
@section('content')
<div class="content-area">
    <!-- Banner Area -->
    <div class="page-headers smaller">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6 col-12">
                    <h1>My Account</h1>
                </div>
                <div class="col-md-6 col-12">
                    <ul class="ph-breadcrumbs-list">
                        <li><a href="{{url('/index')}}">Home</a></li>
                        <li><a href="{{url('/my-account')}}" class="active">My Account</a></li>
                    </ul>	
                </div>			
            </div>
        </div>
    </div>

    <!-- Accounts Page -->
    <div class="account-pages">
        <div class="container">
            <div class="row justify-content-center align-items-start">
                <div class="col-12">
                    <div class="dashboard-top">
                        @include('dashboard-header')
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-items-start">
                <div class="col-lg-2 col-md-2 col-12">
                    @include('dashboard-menu')
                </div>
                <div class="col-lg-8 col-md-10 col-12">
                    <div class="dashboard-tab">
                        <div class="main-title py-3 pt-2">
                            <h4>Order <span class="">History</span></h4>
                        </div>
                        <div class="container-fluid div-tables dash-dt mb-0">
                            <div class="row dt-row dt-head align-items-center">
                                <div class="col-lg-2 col-sm-3 dt-col">Date</div>
                                <div class="col-lg-3 col-sm-2 dt-col">Order ID</div>
                                <div class="col-lg-2 col-sm-3 dt-col">Order Status</div>
                                <div class="col-lg-2 col-sm-2 dt-col">Payment Status</div>
                                <div class="col-lg-2 col-sm-2 dt-col">Payment Method</div>
                                <div class="col-lg-3 col-sm-4 dt-col"></div>		
                            </div>
                            @foreach($Orderhistory as $list)	 
                                <div class="row dt-row dt-body align-items-center">
                                    <div class="col-lg-2 col-sm-3 dt-col">{{ $list['order_date'] }}</div>
                                    <div class="col-lg-3 col-sm-2 dt-col">{{ $list['order_number'] }}</div>
                                    <div class="col-lg-2 col-sm-3 dt-col">
                                      {{$list['order_status']}}
                                    </div>
                                    <div class="col-lg-2 col-sm-2 dt-col">
                                      {{$list['payment']}}
                                    </div>
                                    <div class="col-lg-2 col-sm-2 dt-col">
                                        @if($list['payment_method'] == 1)
                                            Online
                                        @else
                                            Cash on Delivery
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-sm-4 dt-col">
                                        <ul class="general-button-list small-v no-text blackbutton my-0">
                                            <li class="">
                                                <a href="javascript:void(0);" class="order-details-btn" 
                                                   data-bs-toggle="modal" 
                                                   data-bs-target="#odmwindow" 
                                                   data-order-id="{{ $list['id'] }}">
                                                    <i class="material-symbols-outlined">open_in_new</i>Details
                                                </a>
                                            </li>
<!--                                             <li class="">
                                                <a href="bill-sample.pdf" target="_blank">
                                                    <i class="material-symbols-outlined">print</i>Print
                                                </a>
                                            </li> -->
                                        </ul>
                                    </div>	
                                </div>
                            @endforeach	 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection

<!-- Order Details Modal -->    
<div class="modal fade" id="odmwindow" tabindex="-1" aria-labelledby="odmwindowLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                <div class="row align-items-center">
                    <div class="col-12">
                        <a class="close-icon" href="javascript:void(0);" data-bs-dismiss="modal">
                            <i class="la la-times"></i>
                        </a>
                        <h4><i class="material-symbols-outlined">receipt_long</i>Order <span>Details</span></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="dashboard-tab" id="order-details-content">
                            <div class="text-center py-4">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p>Loading order details...</p>
                            </div>
                        </div>
                        <div class="table-responsive mt-4">
                            <h6>Order Status Log</h6>
                            <table class="table table-sm" id="order-status-log">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">No status updates yet.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive mt-4">
                            <h6>Payment Status Log</h6>
                            <table class="table table-sm" id="payment-status-log">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">No payment updates yet.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.order-details-btn').forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.getAttribute('data-order-id');
            loadOrderDetails(orderId);
        });
    });
    function loadOrderDetails(orderId) {
        document.getElementById('order-details-content').innerHTML = `
            <div class="text-center py-4">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p>Loading order details...</p>
            </div>
        `;
        document.querySelector('#order-status-log tbody').innerHTML = '<tr><td colspan="3" class="text-center text-muted">Loading...</td></tr>';
        document.querySelector('#payment-status-log tbody').innerHTML = '<tr><td colspan="3" class="text-center text-muted">Loading...</td></tr>';

        fetch(`/order-history/${orderId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    displayOrderDetails(data.order);
                    renderLogs(data.order.status_log, '#order-status-log tbody');
                    renderLogs(data.order.payment_log, '#payment-status-log tbody');
                } else {
                    document.getElementById('order-details-content').innerHTML = `
                        <div class="alert alert-danger">Error loading order details: ${data.message}</div>
                    `;
                    document.querySelector('#order-status-log tbody').innerHTML = '<tr><td colspan="3" class="text-center text-muted">No data available.</td></tr>';
                    document.querySelector('#payment-status-log tbody').innerHTML = '<tr><td colspan="3" class="text-center text-muted">No data available.</td></tr>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('order-details-content').innerHTML = `
                    <div class="alert alert-danger">Error loading order details. Please try again.</div>
                `;
                document.querySelector('#order-status-log tbody').innerHTML = '<tr><td colspan="3" class="text-center text-muted">Failed to load.</td></tr>';
                document.querySelector('#payment-status-log tbody').innerHTML = '<tr><td colspan="3" class="text-center text-muted">Failed to load.</td></tr>';
            });
    }

    function renderLogs(logs, selector) {
        const tbody = document.querySelector(selector);
        if (!logs || logs.length === 0) {
            tbody.innerHTML = '<tr><td colspan="3" class="text-center text-muted">No records found.</td></tr>';
            return;
        }
        tbody.innerHTML = logs.map(entry => `
            <tr>
                <td>${entry.date}</td>
                <td>${entry.status}</td>
                <td>${entry.message}</td>
            </tr>
        `).join('');
    }

function displayOrderDetails(order) {
    const orderDateRaw = order.order_date || '';
    const orderDate = orderDateRaw.split(' ')[0] || orderDateRaw || '-';

    let statusHistory = '';
    if (Array.isArray(order.status_log) && order.status_log.length) {
        order.status_log.forEach(entry => {
            statusHistory += `
                <tr>
                    <td>${entry.date || orderDate}</td>
                    <td>${entry.status || '-'}</td>
                    <td>${entry.message || ''}</td>
                </tr>
            `;
        });
    } else {
        statusHistory = `
            <tr>
                <td>${orderDate}</td>
                <td>${order.order_status_text || 'Order Processing'}</td>
                <td>Your order is being processed.</td>
            </tr>
        `;
    }

    let productsList = '';
    if (order.products && order.products.length > 0) {
        order.products.forEach((product, index) => {
            productsList += `
                <div class="product-item mb-2 p-2 border rounded">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>${product.product_name}</strong>
                        </div>
                        <div class="col-md-2 text-center">
                            Qty: ${product.quantity}
                        </div>
                        <div class="col-md-2 text-end">
                            
                        </div>
                        <div class="col-md-2 text-end">
                            <strong>Tsh-${product.total_amount}</strong>
                        </div>
                    </div>
                    ${order.payment_method == 1 && product.shipping_charge > 0 ? `
                    <div class="row mt-1">
                        <div class="col-md-10 text-end small">Shipping Charge:</div>
                        <div class="col-md-2 text-end small">Tsh-${product.shipping_charge}</div>
                    </div>
                    ` : ''}
                </div>
            `;
        });
    }

    const priceBreakdown = `
        <div class="row mt-3">
            <div class="col-md-8 text-end"><strong>Subtotal:</strong></div>
            <div class="col-md-4 text-end">Tsh-${order.subtotal}</div>
        </div>
        ${order.payment_method == 1 && order.shipping_charge > 0 ? `
        <div class="row">
            <div class="col-md-8 text-end"><strong>Shipping Charge:</strong></div>
            <div class="col-md-4 text-end">Tsh-${order.shipping_charge}</div>
        </div>
        ` : ''}
        <div class="row border-top pt-2">
            <div class="col-md-8 text-end"><strong>Total Amount:</strong></div>
            <div class="col-md-4 text-end"><strong>Tsh-${order.total_amount}</strong></div>
        </div>
        ${order.payment_method == 2 ? `
        <div class="row">
            <div class="col-md-12 text-end text-muted small">(Cash on Delivery - Pay Tsh-${order.total_amount} when you receive)</div>
        </div>
        ` : ''}
    `;

    const content = `
        <div class="row">
            <div class="col-md-4 col-12">
                <h5>Order Date: <span>${orderDate}</span></h5>
            </div>
            <div class="col-md-4 col-12">
                <h5>Order No: <span>${order.order_number}</span></h5>
            </div>
            <div class="col-md-4 col-12">
                <h5>Order Status: <span>${order.order_status_text}</span></h5>
            </div>
            <div class="col-md-4 col-12">
                <h5>Payment Method: <span>${order.payment_method_text}</span></h5>
            </div>
            <div class="col-md-4 col-12">
                <h5>Payment Status: <span>${order.payment_status_text}</span></h5>
            </div>
            <div class="col-md-4 col-12">
                <h5>Africab Selcom ID: <span>${order.order_group_id || '-'}</span></h5>
            </div>
        </div>
        
        ${productsList ? `
        <div class="mt-3">
            <h6>Order Items:</h6>
            ${productsList}
        </div>
        ` : ''}
        
        <div class="mt-3">
            ${priceBreakdown}
        </div>
        
        <p class="mt-3">Your order for ${order.products ? order.products.length : 0} item(s) - ${order.payment_method_text}</p>
        
        <div class="table-responsive mt-3">
            <table class="table order-meta-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    ${statusHistory}
                </tbody>
            </table>
        </div>
    `;

    document.getElementById('order-details-content').innerHTML = content;
}
});
</script>
