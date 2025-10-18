<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    //
    #view Category
    #authr: vivek
    public function showcategory(){
    	return view(' Admin.create_category');
    }

    #Category List
    #authr: vivek
    public function Viewcategory(){
        $categories = Category::orderBy('id', 'desc')->get();
        
    	return view(' Admin.view_category',compact('categories'));
    }

    #Category Edit
    #authr: vivek
    public function EditCategory($id){
        try {
        $decryptedId = Crypt::decrypt($id);
        $category = Category::findOrFail($decryptedId);
        return view(' Admin.edit_category', compact('category'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid or expired link.');
        }
    }

    #Category toggle
    #authr: vivek
    public function changeCategoryStatus($id, $status){
    $category = Category::findOrFail(Crypt::decrypt($id));
    $category->status = $status;
    $category->save();

    return redirect()->back()->with('success', 'Category status updated successfully.');
    }


    #Add Category
    #authr: vivek
    public function CreateCategory(Request $request){
    	//return $request->all();
    	$request->validate([
		    'category_name' => 'required|string|max:255',
		    'description' => 'required|string',
		    'meta_title' => 'required|string|max:255',
		    'meta_description' => 'required|string',
		    'Category_file' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
		]);
         $category = new Category();
            $category->name = $request->input('category_name');
            $category->description = $request->input('description');
            $category->page_title = $request->input('meta_title');
            $category->page_description = $request->input('meta_description');

            // File Upload
            if ($request->hasFile('Category_file')) {
                $image = $request->file('Category_file');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('uploads/category', $imageName, 'public');
                $category->file = $imageName;  // Now $category is not null
            }

            $category->save();
        return redirect()->back()->with('success', 'Category added successfully!');
    }


    #Update Category
    #authr: vivek
    public function UpdateCategory(Request $request, $encryptedId)
    {
        //return $request->all();

        $id = Crypt::decrypt($encryptedId);
        $category = Category::findOrFail($id);

        $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'required|string',
            'meta_page' => 'nullable|string|max:255',
            'page_description' => 'nullable|string',
            'Category_file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $category->name = $request->category_name;
        $category->description = $request->description;
        $category->page_title = $request->meta_page;
        $category->page_description = $request->page_description;
    if($request->hasFile('Category_file') && $request->file('Category_file') != null){
        if ($request->hasFile('Category_file')) {
            $image = $request->file('Category_file');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('uploads/category', $imageName, 'public');
            $category->file = $imageName;
        }
    }else{
        $imageName = $request->Category_file_old;
        $category->file = $imageName;
    }

        $category->save();
        
        return redirect()->route('category.list')->with('success', 'Category updated successfully!');
   }

    #soft delete Category
    #authr: vivek
   public function DeleteCategory($id){

        try {
            $decryptedId = Crypt::decrypt($id);
            $category = Category::where('id',$decryptedId)->first();

            if ($category && $category->file) {
                Storage::disk('public')->delete('uploads/category/' . $category->file);
            }
            if ($category) {
             $category->delete();
            }

            return redirect()->back()->with('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }


}
