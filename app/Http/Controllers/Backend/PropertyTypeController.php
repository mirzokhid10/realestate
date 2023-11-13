<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{

    // show all types of properties
    public function AllType() {
        $types = PropertyType::latest()->get();
        return view('backend.type.all_type', compact('types'));
    }

    // add type of properties
    public function AddType() {
        return view('backend.type.add_type');
    }

    // save added type of properties
    public function StoreType(Request $request) {
        // validation
        $request->validate([
            'type_name' => 'required|unique:property_types|max:220',
            'type_icon' => 'required',
        ]);

        PropertyType::insert([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);

        // notifications
        $notification = array(
            'message' =>'Property Type Created Successfully',
            'alert_type' => 'success',
        );

        return redirect()->route('all.type')->with($notification);
    }

    // go to edit type of properties
    public function EditType($id) {
        $types = PropertyType::findOrFail($id);
        return view('backend.type.edit_type', compact('types'));
    }

    // edit type of properties
    public function UpdateType(Request $request) {

        $pid = $request->id;

        PropertyType::findOrFail($pid)->update([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);

        // notifications
        $notification = array(
            'message' =>'Property Type Updated Successfully',
            'alert_type' => 'success',
        );

        return redirect()->route('all.type')->with($notification);
    }

    // Delete types of properties
    public function DeleteType($id) {
        PropertyType::findOrFail($id)->delete;

        // notifications
        $notification = array(
            'message' =>'Property Type Deleted Successfully',
            'alert_type' => 'danger',
        );

        return redirect()->back()->with($notification);
    }

    /////////////// ------ Amenities All Methods --------- /////////////

    // adding amenities
    public function AllAmenitie(){
        $amenities = Amenities::latest()->get();
        return view('backend.amenities.all_amenities',compact('amenities'));

    } // End Method

    public function AddAmenitie(){
        return view('backend.amenities.add_amenities');
    }// End Method

    public function StoreAmenitie(Request $request){
        Amenities::insert([
            'amenities_name' => $request->amenities_name,
        ]);

          $notification = array(
            'message' => 'Amenities Create Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.amenitie')->with($notification);

    }// End Method


    public function EditAmenitie($id){

        $amenities = Amenities::findOrFail($id);
        return view('backend.amenities.edit_amenities',compact('amenities'));

    }// End Method


    public function UpdateAmenitie(Request $request){
        $ame_id = $request->id;
        Amenities::findOrFail($ame_id)->update([
            'amenities_name' => $request->amenities_name,
        ]);
          $notification = array(
            'message' => 'Amenities Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.amenitie')->with($notification);
    }// End Method


    public function DeleteAmenitie($id){

        Amenities::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Amenities Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

}


