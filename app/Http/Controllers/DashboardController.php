<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Orders;
use App\Models\OrderUpdate;
use App\Models\PaymentUpdate;
use App\Models\TaxFormula;
use App\Models\address;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;




class DashboardController extends Controller
{

    #view dashboard
    #authr: vivek
    public function GetDashboard(){
        $today = Carbon::today();
        $month = Carbon::now()->month;
        $year  = Carbon::now()->year;
        $newOrders = Orders::whereDate('created_at', $today)->count();
        $pendingOrders = Orders::whereIn('order_status', [1, 2])->count();
        $completedOrders = Orders::where('order_status', 3)->count();
        $dailySales = Orders::where('payment_status', 2)
        ->whereDate('created_at', $today)
        ->sum(DB::raw('total_amount + shipping_charge'));
        $monthlySales = Orders::where('payment_status', 2)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum(DB::raw('total_amount + shipping_charge'));
        $totalSales = Orders::where('payment_status', 2)
            ->sum(DB::raw('total_amount + shipping_charge'));
        $todayNewUsers = User::where('role', 1)
        ->where('is_suspended', 1)
        ->whereDate('created_at', $today)
        ->count();
         $monthlyNewUsers = User::where('role', 1)
        ->where('is_suspended', 1)
        ->whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->count();
        $totalUsers = User::where('role', 1)
        ->where('is_suspended', 1)
        ->count();    
        $todayNewUserslist = User::where('role', 1)
        ->where('is_suspended', 1)
        ->whereMonth('created_at', $month)
        ->select('name', 'email', 'mobile')
        ->latest() 
        ->take(10)
        ->get();
        $orderlist = Orders::with(['users','products'])->latest()->take(10)->get();
        $orderSummary = Orders::select(
        'user_id',
        DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(total_amount + COALESCE(shipping_charge, 0)) as total_amount')
            )
        ->with('users:id,name')
        ->where('payment_status', '2') 
        ->groupBy('user_id')
        ->orderByDesc('total_orders') 
        ->take(10)
        ->get();
        $orderSpending = Orders::select(
        'user_id',
        DB::raw('COUNT(*) as total_orders'),
        DB::raw('SUM(total_amount + COALESCE(shipping_charge, 0)) as total_amount')
        )
        ->with('users:id,name')
        ->where('payment_status', '2')
        ->groupBy('user_id')
        ->orderByDesc('total_amount')
        ->take(10)
        ->get();
        $orderlists = []; 
        foreach ($orderlist as $order) {
           $orderlists[] = [
             'id'           => Crypt::encrypt($order->id),
            'order_number'  => $order->order_number,
            'order_group'   => $order->order_group_id,
            'customer_name' => $order->users->name ?? 'Guest',
            'customer_email'=> $order->users->email ?? '-',
            'customer_mobile'=> $order->users->mobile ?? '-',
            'product_name'  => $order->products->listing_name ?? '-',
            'quantity'      => $order->quantity,
            'payment_token'      => $order->payment_token ?? null,
            'amount'        => $order->total_amount + ($order->shipping_charge ?? 0),
            'order_status'  =>  [9 => 'Order Placed',
            1 => 'Order Processing',
            7 => 'Order Packed', 
            2 => 'Order Shipped',
            6 => 'Out for Delivery',
            5 => 'Order Undelivered',
            3 => 'Order Delivered',
            4 => 'Order Cancelled',
            8 => 'Refund Status',][$order->order_status] ?? 'Cancelled',
            'payment_status'=> [1 => 'Pending', 2 => 'Paid', 3 => 'Failed'][$order->payment_status] ?? 'Unknown',
            'method'        => [1 => 'Online', 2 => 'Cash on Delivery'][$order->method] ?? 'Unknown',
            'created_at'    => $order->created_at->format('d-m-Y H:i'),
           ];
        }

        return view(' Admin.dashboard',compact('newOrders','pendingOrders','completedOrders','dailySales','monthlySales','totalSales','todayNewUsers','monthlyNewUsers','totalUsers','todayNewUserslist','orderlists','orderSummary','orderSpending'));
    }
    #view dashboard
    #authr: vivek
    public function DashboardOrders($id){
        $orderId = Crypt::decrypt($id);
        $orderlists = Orders::with(['users','products','Address'])->where('id',$orderId)->firstOrFail();

        $orderStatusLabels = [
            9 => 'Order Placed',
            1 => 'Order Processing',
            7 => 'Order Packed',
            2 => 'Order Shipped',
            6 => 'Out for Delivery',
            5 => 'Order Undelivered',
            3 => 'Order Delivered',
            4 => 'Order Cancelled',
            8 => 'Refund Status',
        ];

        $paymentStatusLabels = [
            1 => 'Pending',
            2 => 'Paid',
            3 => 'Failed',
        ];

        $groupId = $orderlists->order_group_id;
        $shippingAddress = $orderlists->shipping_address;
        $shopId = $orderlists->shop_id;

        $orderUpdates = OrderUpdate::with('createdByUser')
            ->where('order_group_id', $groupId)
            ->latest()
            ->get();

        $paymentUpdates = PaymentUpdate::with('createdByUser')
            ->where('order_group_id', $groupId)
            ->latest()
            ->get();

        $orderStatusLog = $orderUpdates->map(function ($update) use ($orderStatusLabels) {
            return [
                'date' => optional($update->created_at)->format('d/m/Y H:i') ?? '-',
                'status' => $orderStatusLabels[$update->order_status] ?? 'Unknown',
                'message' => $update->custom_message ?? '-',
            ];
        });

        $paymentStatusLog = $paymentUpdates->map(function ($update) use ($paymentStatusLabels) {
            return [
                'date' => optional($update->created_at)->format('d/m/Y H:i') ?? '-',
                'status' => $paymentStatusLabels[$update->payment_status] ?? 'Unknown',
                'message' => $update->custom_message ?? '-',
            ];
        });

        if (is_null($shippingAddress)) {
            $shippingDetails = DB::table('shop')
                ->select('name as shop_name', 'address as shop_address')
                ->where('id', $shopId)
                ->first();

            $finalShipping = [
                'name'    => $shippingDetails->shop_name ?? 'Unknown Shop',
                'address' => $shippingDetails->shop_address ?? 'No Address',
                'customer_email'  => $orderlists->users->email ?? '-',
                'customer_mobile' => $orderlists->users->mobile ?? '-',
                'customer_pincode' => $orderlists->pincode ?? '-',
            ];
        } else {
            $address = DB::table('address')->where('id', $shippingAddress)->first();
            $finalShipping = [
                'name'    => $orderlists->users->name ?? 'Guest',
                'address' => $address->home_address 
                                ?? $address->office_address 
                                ?? $address->other_address 
                                ?? 'No Address',
                'customer_email'  => $orderlists->users->email ?? '-',                    
                'customer_mobile'  => $orderlists->mobile_no ?? '-',
                'customer_pincode' => $orderlists->pincode ?? '-',
            ];
        }

        $pickupStatus = !is_null($shippingAddress)
            ? 'Pickup from Customer Location'
            : (!is_null($shopId) ? 'Pickup from Shop' : 'Pickup status unknown');

        $ordersDeatils = DB::table('orders')
                        ->join('product_details', 'orders.product_id', '=', 'product_details.id')
                        ->where('orders.order_group_id', $groupId)
                        ->get();

        $OrderDeatils = [];
        $OrderItems = [];
        $OrderDeatils[] = [
            'order_number'   => $orderlists->order_number,
            'order_group_id' => $orderlists->order_group_id,
            'order_date'     => $orderlists->created_at->format('d-m-Y'),
            'order_status'   => $orderStatusLabels[$orderlists->order_status] ?? 'Unknown',
            'method'         => $orderlists->method == 1 ? 'Online' : 'Cash on Delivery',
            'total_amount'   => $orderlists->total_amount + ($orderlists->shipping_charge ?? 0),
            'payment_status' => $paymentStatusLabels[$orderlists->payment_status] ?? 'Unknown',
            'txn_reference'  => $orderlists->method == 1
                ? ($orderlists->payment_token ?? $orderlists->order_group_id)
                : $orderlists->order_group_id,
        ];

        foreach ($ordersDeatils as $order) {
            $price = $order->total_amount ?? 0;
            $qty   = $order->quantity;
            $OrderItems[] = [
                'product_name' => $order->listing_name ?? '-',
                'quantity'     => $order->quantity,
                'price'        => $order->total_amount ?? 0,
                'shipping_price' => $order->shipping_charge ?? 0,
                'total'        => $qty * $price,
                'grandtotal'  => $qty * $price + $order->shipping_charge,
            ];
        }

        $encryptedId = $id;

        return view(' Admin.Dashboard_Orders',compact(
            'OrderDeatils',
            'OrderItems',
            'finalShipping',
            'orderStatusLabels',
            'paymentStatusLabels',
            'orderStatusLog',
            'paymentStatusLog',
            'pickupStatus',
            'encryptedId'
        ));
    }
    #view dashboard
    #authr: vivek
    public function Dashboard(){
    	return view(' Admin.index');
    }

    #view order
    #authr: vivek
    public function Orders(){
    	return view(' Admin.orders');
    }


    #view order
    #authr: vivek
    public function Customers(){
    	return view(' Admin.customers');
    }

    #view Reviews
    #authr: vivek
    public function Reviews(){
    	return view(' Admin.Reviews');
    }

    #view ecomercemanagment
    #authr: vivek
    public function ecomercemanagment(){
    	return view(' Admin.Reviews');
    }

    #view ecomercemanagment
    #authr: vivek
    public function cmsmanagment(){
    	return view(' Admin.Reviews');
    }

    #view Manage Profile
    #authr: vivek
    public function ManageProfile(){
        return view(' Admin.ManageAccount');
    }

    #view Manage Profile
    #authr: vivek
    public function UpdateProfile(Request $request){
     try{   
        $userId = Auth::id();
        $request->validate([
            'Administrator' => 'required',
            'Category_file' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
         $User = User::findOrFail($userId) ;
         $User->name = $request->input('Administrator');
         if ($request->hasFile('Category_file')) {
                $image = $request->file('Category_file');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('uploads/product', $imageName, 'public');
                $User->avtar = $imageName;  
            }

        $User->save();
        if ($User->save()) {
            return back()->with('success', 'User updated successfully!');
        } else {
            return back()->with('error', 'Failed to update user!');
        }
     } catch (\Exception $e) {
        Log::error('Update Error: ' . $e->getMessage());
        return back()->with('error', 'Something went wrong! Please try again.');
    }    

    }

    public function updateGroup(Request $request){
        $validated = $request->validate([
            'order_group_id' => 'required|string',
            'order_status' => 'required|integer',
            'custom_message' => 'nullable|string|max:500',
        ]);

        $order_group_id = $validated['order_group_id'];
        $referenceOrder = Orders::where('order_group_id', $order_group_id)->first();

        if (!$referenceOrder) {
            return response()->json(['status' => 'error', 'message' => 'Order group not found'], 404);
        }
        $payload = [
            'order_status'   => $validated['order_status'],
            'updated_at'     => now(),
        ];

        if (!empty($validated['payment_status'])) {
            $payload['payment_status'] = $validated['payment_status'];
        }

        DB::beginTransaction();

        try {
            Orders::where('order_group_id', $order_group_id)->update($payload);

            OrderUpdate::create([
                'order_group_id' => $order_group_id,
                'order_status'   => $validated['order_status'],
                'payment_status' => $validated['payment_status'] ?? $referenceOrder->payment_status ?? 1,
                'custom_message' => $validated['custom_message'] ?? null,
                'created_by'     => Auth::id(),
            ]);

            if (!empty($validated['payment_status'])) {
                PaymentUpdate::create([
                    'order_group_id' => $order_group_id,
                    'payment_status' => $validated['payment_status'],
                    'custom_message' => $validated['custom_message'] ?? null,
                    'created_by'     => Auth::id(),
                ]);
            }

            DB::commit();

            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Order update failed', [
                'error' => $th->getMessage(),
                'order_group_id' => $order_group_id,
            ]);

            return response()->json(['status' => 'error'], 500);
        }
    }

    public function updatePaymentStatus(Request $request)
    {
        $validated = $request->validate([
            'order_group_id' => 'required|string',
            'payment_status' => 'required|integer|in:1,2,3',
            'custom_message' => 'nullable|string|max:500',
        ]);

        $order_group_id = $validated['order_group_id'];
        $referenceOrder = Orders::where('order_group_id', $order_group_id)->first();

        if (!$referenceOrder) {
            return response()->json(['status' => 'error', 'message' => 'Order group not found'], 404);
        }

        DB::beginTransaction();

        try {
            Orders::where('order_group_id', $order_group_id)->update([
                'payment_status' => $validated['payment_status'],
                'updated_at' => now(),
            ]);

            PaymentUpdate::create([
                'order_group_id' => $order_group_id,
                'payment_status' => $validated['payment_status'],
                'custom_message' => $validated['custom_message'] ?? null,
                'created_by' => Auth::id(),
            ]);

            DB::commit();

            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Payment update failed', [
                'error' => $th->getMessage(),
                'order_group_id' => $order_group_id,
            ]);

            return response()->json(['status' => 'error'], 500);
        }
    }

    public function orderInvoice($id)
    {
        $orderId = Crypt::decrypt($id);
        $order = Orders::with(['users','products'])->where('id', $orderId)->firstOrFail();
        $orders = Orders::with('products')
            ->where('order_group_id', $order->order_group_id)
            ->get();
        $subtotal = $orders->sum('total_amount');
        $shippingTotal = $orders->sum('shipping_charge');
        $grandTotal = $subtotal + $shippingTotal;

        $statusLabels = [
            9 => 'Order Placed',
            1 => 'Order Processing',
            7 => 'Order Packed',
            2 => 'Order Shipped',
            6 => 'Out for Delivery',
            5 => 'Order Undelivered',
            3 => 'Order Delivered',
            4 => 'Order Cancelled',
            8 => 'Refund Status',
        ];

        $paymentStatusLabels = [
            1 => 'Pending',
            2 => 'Paid',
            3 => 'Failed',
        ];

        $shippingAddress = $order->shipping_address;
        $billingAddressId = $order->billing_address;
        $shopId = $order->shop_id;
        $sellerLines = [
            'Sold By : Africab',
            'Address : P.O.Box # 2562, Africab Business Park',
            'Plot no 34, Kilwa Road, Kurasini, Mivenjeni Area',
            'Opposite Tanesco - Kurasini,',
            'Dar es Salaam, Tanzania',
            'Email : sales@africab.co.tz',
            'Phone : +255 682 121 112',
        ];

        if (is_null($shippingAddress)) {
            $addressBlock = [
                'name'    => $order->users->name ?? 'Guest',
                'address' => 'No Address Available',
                'customer_email'  => $order->users->email ?? '-',
                'customer_mobile' => $order->users->mobile ?? $order->mobile_no ?? '-',
                'customer_pincode' => $order->pincode ?? '-',
            ];
        } else {
            $address = DB::table('address')->where('id', $shippingAddress)->first();
            $addressBlock = [
                'name'    => $order->users->name ?? 'Guest',
                'address' => $address->home_address 
                                ?? $address->office_address 
                                ?? $address->other_address 
                                ?? 'No Address',
                'customer_email'  => $order->users->email ?? '-',                    
                'customer_mobile'  => $order->users->mobile ?? $order->mobile_no ?? '-',
                'customer_pincode' => $order->pincode ?? '-',
            ];
        }

        $billingBlock = $addressBlock;
        if ($billingAddressId) {
            $billingAddress = DB::table('address')->where('id', $billingAddressId)->first();
            if ($billingAddress) {
                $billingBlock = [
                    'name'    => $order->users->name ?? 'Guest',
                    'address' => $billingAddress->home_address 
                                    ?? $billingAddress->office_address 
                                    ?? $billingAddress->other_address 
                                    ?? 'No Address',
                    'customer_email'  => $order->users->email ?? '-',                    
                    'customer_mobile'  => $order->users->mobile ?? $order->mobile_no ?? '-',
                    'customer_pincode' => $billingAddress->pincode ?? '-',
                ];
            }
        }

        $pickupBlock = $addressBlock;
        if ($shopId) {
            $pickup = DB::table('shop')->select('name','address')->where('id', $shopId)->first();
            if ($pickup) {
                $pickupBlock = [
                    'name' => $pickup->name ?? 'Pickup Point',
                    'address' => $pickup->address ?? 'No Address Available',
                    'customer_email' => null,
                    'customer_mobile' => null,
                    'customer_pincode' => '',
                ];
            }
        }

        $orderItems = [];
        foreach ($orders as $item) {
            $orderItems[] = [
                'product_name' => $item->products->listing_name ?? '-',
                'quantity' => $item->quantity,
                'price' => $item->total_amount ?? 0,
                'shipping' => $item->shipping_charge ?? 0,
                'total' => ($item->total_amount ?? 0) + ($item->shipping_charge ?? 0),
            ];
        }

        $taxAmount = null;
        $taxPercentage = null;
        $taxFormula = TaxFormula::first();
        $hasTxn = $orders->contains(function ($item) {
            return (int)($item->txn ?? 0) === 1;
        });
        if ($hasTxn && $taxFormula && $taxFormula->txn_value !== null) {
            $taxAmount = ($subtotal * $taxFormula->txn_value) / 100;
            $taxPercentage = $taxFormula->txn_value;
        }

        $customerVatNo = $order->users->tin_num ?? null;
        $customerTrnNo = $order->users->vrn_num ?? null;

        return view('Admin.invoice', [
            'order' => $order,
            'orderItems' => $orderItems,
            'subtotal' => $subtotal,
            'shippingTotal' => $shippingTotal,
            'grandTotal' => $grandTotal,
            'addressBlock' => $addressBlock,
            'billingBlock' => $billingBlock,
            'pickupBlock' => $pickupBlock,
            'sellerLines' => $sellerLines,
            'statusLabels' => $statusLabels,
            'paymentStatusLabels' => $paymentStatusLabels,
            'customerVatNo' => $customerVatNo,
            'customerTrnNo' => $customerTrnNo,
            'taxPercentage' => $taxPercentage,
            'taxAmount' => $taxAmount,
        ]);
    }

}
