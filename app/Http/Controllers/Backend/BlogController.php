<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // AllBlogCategory
    public function AllBlogCategory(){

        $category = BlogCategory::latest()->get();
        return view('backend.category.blog_category',compact('category'));

    } // End Method

    // StoreBlogCategory
    public function StoreBlogCategory(Request $request){

        BlogCategory::insert([

            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
        ]);

          $notification = array(
            'message' => 'BlogCategory Create Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.category')->with($notification);

    }// End Method

    // EditBlogCategory
    public function EditBlogCategory($id){

        $categories = BlogCategory::findOrFail($id);
        return response()->json($categories);

    }// End Method

    // UpdateBlogCategory
    public function UpdateBlogCategory(Request $request){

        $cat_id = $request->cat_id;
        BlogCategory::findOrFail($cat_id)->update([

            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
        ]);

        $notification = array(
            'message' => 'BlogCategory Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.category')->with($notification);

    }// End Method

     // UpdateBlogCategory
    public function DeleteBlogCategory($id){

        BlogCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'BlogCategory Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method
}
