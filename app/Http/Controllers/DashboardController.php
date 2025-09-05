<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Orders;
use App\Models\address;
use App\Models\shop;
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
        //return   $orderlist ;
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
            'amount'        => $order->total_amount + ($order->shipping_charge ?? 0),
            'order_status'  =>  [1 => 'Processing', 2 => 'Shipped', 3 => 'Delivered'][$order->order_status] ?? 'Unknown',
            'payment_status'=> [1 => 'Pending', 2 => 'Paid', 3 => 'Failed'][$order->payment_status] ?? 'Unknown',
            'method'        => [1 => 'Online', 2 => 'Cash on Delivery'][$order->method] ?? 'Unknown',
            'created_at'    => $order->created_at->format('d-m-Y H:i'),
           ];
        }

        return view(' Admin.dashboard',compact('newOrders','pendingOrders','completedOrders','dailySales','monthlySales','totalSales','todayNewUsers','monthlyNewUsers','totalUsers','todayNewUserslist','orderlists'));
    }
    #view dashboard
    #authr: vivek
    public function DashboardOrders($id){
        $orderId = Crypt::decrypt($id);
        $orderlists = Orders::with(['users','products','Address'])->where('id',$orderId)->first();
        //return  $orderlists;
       $groupId = $orderlists->order_group_id;
       $userid = $orderlists->user_id;
       $shippingAddress = $orderlists->shipping_address;
       $shopId = $orderlists->shop_id;
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

       $shhippingDeatils = DB::table('orders')
                        ->join('product_details', 'orders.product_id', '=', 'product_details.id')
                        ->where('orders.order_group_id', $groupId)
                        ->where('orders.shipping_address', $shippingAddress)
                        ->get();

       $ordersDeatils = DB::table('orders')
                        ->join('product_details', 'orders.product_id', '=', 'product_details.id')
                        ->where('orders.order_group_id', $groupId)
                        ->get();
       $OrderDeatils = [];
       $OrderItems = [];
        $OrderDeatils[] = [
        'order_number'   => $orderlists->order_number,
        'order_group_id'   => $orderlists->order_group_id,
        'order_date'     => $orderlists->created_at->format('d-m-Y H:i'),
        'payment_status' => $orderlists->payment_status == 1 ? 'Pending' : ($order->payment_status == 2 ? 'Paid' : 'Failed'),
        'order_status'   => $orderlists->order_status == 1 ? 'Processing' 
                             : ($orderlists->order_status == 2 ? 'Shipped' 
                             : ($orderlists->order_status == 3 ? 'Delivered' 
                             : 'Unknown')),
        'method'         => $orderlists->method == 1 ? 'Online' : 'Cash on Delivery',
        'total_amount'   => $orderlists->total_amount + $orderlists->shipping_charge ?? '0',
        ];

        foreach ($ordersDeatils as $order) {
            if ($ordersDeatils) {
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
        }

        return view(' Admin.Dashboard_Orders',compact('OrderDeatils','OrderItems','finalShipping'));
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
    $order_group_id = $request->order_group_id;
    $order_status = $request->order_status;
    $updatedRows = Orders::where('order_group_id', $order_group_id)
        ->update([ 
            'order_status'   => $order_status,
            'updated_at'     => now(),
        ]);

    if($updatedRows){
        return response()->json(['status' => 'success']);
    } else {
        return response()->json(['status' => 'error']);
    }
}

}
