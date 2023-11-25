<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
    // AllTestimonials
    public function AllTestimonials(){
        $testimonial = Testimonial::latest()->get();
        return view('backend.testimonial.all_testimonial',compact('testimonial'));

    } // End Method

    // AddTestimonials
    public function AddTestimonials(){
        return view('backend.testimonial.add_testimonial');
    }// End Method

    // StoreTestimonials
    public function StoreTestimonials(Request $request){

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(100,100)->save('upload/testimonial/'.$name_gen);
        $save_url = 'upload/testimonial/'.$name_gen;

        Testimonial::insert([
            'name' => $request->name,
            'position' => $request->position,
            'message' => $request->message,
            'image' => $save_url,
        ]);

        $notification = array(
                'message' => 'Testimonial Inserted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.testimonials')->with($notification);

    }// End Method

    // EditTestimonials
    public function EditTestimonials($id){

        $testimonial = Testimonial::findOrFail($id);
        return view('backend.testimonial.edit_testimonial',compact('testimonial'));

    }// End Method

    // UpdateTestimonials
    public function UpdateTestimonials(Request $request){

        $test_id = $request->id;

        if ($request->file('image')) {

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(100,100)->save('upload/testimonial/'.$name_gen);
        $save_url = 'upload/testimonial/'.$name_gen;

        Testimonial::findOrFail($test_id)->update([
            'name' => $request->name,
            'position' => $request->position,
            'message' => $request->message,
            'image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Testimonial Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.testimonials')->with($notification);

        }else{

        Testimonial::findOrFail($test_id)->update([
            'name' => $request->name,
            'position' => $request->position,
            'message' => $request->message,
        ]);

        $notification = array(
            'message' => 'Testimonial Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.testimonials')->with($notification);

        }

    }// End Method

    // DeleteTestimonials
    public function DeleteTestimonials($id){

        $test = Testimonial::findOrFail($id);
        $img = $test->image;
        unlink($img);

        Testimonial::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Testimonial Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method
}
