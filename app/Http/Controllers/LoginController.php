<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Orders;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

use Illuminate\Validation\Rules\Password as RulesPassword;



class LoginController extends Controller
{
    //

    public function Showlogin(){
    	return view('Admin.index');
    }

    public function LoginCreadintial(Request $request){
        // Validate input
        //return $request->all();
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

			if (Auth::user()->role == 2) {
				 return redirect()->intended('tsfy-admin/dashboard')->with('success', 'Logged in successfully');
			} else {
			Auth::logout(); 
			return back()->with('error', 'Invalid credentials or unauthorized access.');
			}
        }
        	return back()->with('error', 'Invalid credentials or unauthorized access.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('tsfy-admin/login')->with('success', 'Logged out successfully.');
    }

    public function ForgetPassword(){
    	return view(' Admin.ForgetPassword');
    }

     public function sendResetLinkEmail(Request $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        if ($status === Password::RESET_THROTTLED) {
         return back()->withErrors(['email' => 'Too many requests. Please try again in a few minutes.']);
        }

        return back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request, $token)
    {
        return view(' Admin.reset', [
            'token' => $token,
            'email' => $request->query('email') ?? '',
        ]);
    }

    public function reset(Request $request)
    {
    	
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);



        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );
        //dd($status);

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    #customer list 
    #auth vivek
    public function Getcustomer(){
        $customer_list = User::with(['wishlists','Orders'])->withCount('orders')->withCount('wishlists')->orderbydesc('id')->where('role',1)->get();
        //return  $customer_list;
        return view(' Admin.customer_manage',compact('customer_list'));
    }
    #customer summary list 
    #auth vivek
    public function Getsummary(){
        $customer_summary = User::with(['wishlists','Orders'])->withCount('orders')->withCount('wishlists')->orderbydesc('id')->where('role',1)->get();
        //return  $customer_summary;
        return view(' Admin.customer_summary',compact('customer_summary'));
    }
    

    #customer Orders list 
    #auth vivek
    public function fetchOrders(Request $request){
    $user = User::with('orders')->find($request->customer_id);

    if (!$user) {
        return response()->json(['orders' => []]);
    }


    $orders = $user->orders->map(function ($order) {
        return [
            'order_no' => $order->order_number ?? 'N/A',
            'order_date' => $order->created_at->format('d/m/Y'),
            'amount' => $order->total_amount ?? 0,
            'order_status' => $order->order_status ?? 'Unknown',
        ];
    });

    return response()->json(['orders' => $orders]);
    }

    #customer wishlist list 
    #auth vivek
    public function Getwishlist(){
         $Getwishlist = User::with(['wishlists','Orders'])->withCount('orders')->withCount('wishlists')->orderbydesc('id')->where('role',1)->get();
        return view(' Admin.customer_wishlist',compact('Getwishlist'));
    }

    #customer Orders list 
    #auth vivek
  public function fetchWishlist(Request $request)
{
    $user = User::with('wishlists.product.category')->find($request->customer_id);

    if (!$user) {
        return response()->json(['wishlists' => []]);
    }

    $wishlists = $user->wishlists->map(function ($wishlist, $index) {
        return [
            'id'         => $index + 1,
            'added_on'   => $wishlist->created_at->format('d/m/Y'),
            'image_url'  => asset('storage/uploads/product/' . ($wishlist->product->file ?? 'no-image.png')),
            'product'    => $wishlist->product->name ?? '—',
            'category'   => $wishlist->product->category->name ?? '—',
            'label'      => $wishlist->product->label ?? '—',
        ];
    });

    return response()->json(['wishlists' => $wishlists]);
}


    
    #Toggle Customer Access 
    #auth vivek
    public function toggleStatus(Request $request, $id){
         $ids = Crypt::decrypt($id);
    $customer = User::findOrFail($ids);
    $customer->is_suspended = $request->status;
    $customer->save();
    return response()->json(['success' => true]);
   }

   #client login 
   #auth vivek
   public function ClientLogin(){
        return view('login');
    }

public function ClientLoginCreadintial(Request $request){
        try {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

if (Auth::attempt($credentials)) {

    $user = Auth::user();

    if ($user->role == 1) {
        if ($user->is_suspended == 0) {
            Auth::logout();
            return back()->with('error', 'Your account is suspended. Contact the admin.');
        }

        return redirect()->intended('/my-account')->with('success', 'Logged in successfully');
    } else {
        Auth::logout();
        return back()->with('error', 'Invalid credentials or unauthorized access. Contact the admin.');
    }

} else {
    return back()->with('error', 'Invalid credentials or unauthorized access. Contact the admin.');
}

    } catch (\Exception $e) {
        \Log::error('Login Error: ' . $e->getMessage());

        return back()->with('error', 'Something went wrong. Please try again later.');
    }
} 

#client logout
#auth vivek
public function clientlogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login')->with('success', 'Logged out successfully.');
    }

    #chnage password client logout
    #auth vivek
    public function ChangePassword(Request $request)
    {
        return view('forgot-password');
    }

    #sendReset client
    #auth vivek
     public function sendResetLinkEmailClient(Request $request)
    {
        //return $request->all();
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        if ($status === Password::RESET_THROTTLED) {
         return back()->withErrors(['email' => 'Too many requests. Please try again in a few minutes.']);
        }

        return back()->withErrors(['email' => __($status)]);
    }

    public function showResetFormClient(Request $request, $token)
    {
        return view('reset-password', [
            'token' => $token,
            'email' => $request->query('email') ?? '',
        ]);
    }

    public function resetClient(Request $request)
    {
        
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );
        //dd($status);

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('get.ClientLogin')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    #add registration 
 public function getregister(Request $request){
      return view('registration');
    }

    #add registration 
 public function postregister(Request $request)
    {

        try {
            $request->validate([
                'name'     => 'required',
                'email'    => 'required|email|unique:users,email',
                'phone'    => 'required|unique:users,mobile',
                'password' => 'required|string|min:6',
            ]);

            \Log::info('Validation passed');


            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'mobile'    => $request->phone,
                'password' => Hash::make($request->password)
            ]);

            auth()->login($user);
            return redirect()->route('MyAccount.shows')->with('success', 'Account registered successfully!');
            } catch (\Illuminate\Validation\ValidationException $e) {
                Log::warning('Validation failed', $e->errors());
                return back()->withErrors($e->validator)->withInput();
            } catch (\Exception $e) {
                Log::error('Registration error: ' . $e->getMessage());
                return back()->with('error', 'Something went wrong. Please try again.')->withInput();
            }
    }

  #update client
  #auth vivek
  public function ChangePasswords(){
     $email=Auth::user()->email;
    return view('change_password',compact('email'));

  }



}
