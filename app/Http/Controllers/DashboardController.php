<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;



class DashboardController extends Controller
{

    #view dashboard
    #authr: vivek
    public function GetDashboard(){
        return view(' Admin.dashboard');
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
}
