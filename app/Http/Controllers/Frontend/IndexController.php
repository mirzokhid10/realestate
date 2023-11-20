<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Property;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    // PropertyDetails
    public function PropertyDetails($id,$slug){

        $property = Property::findOrFail($id);
        $multiImage = MultiImage::where('property_id',$id)->get();
        $facility = Facility::where('property_id',$id)->get();
        $amenities = $property->amenities_id;
        $property_amen = explode(',',$amenities);
        $type_id = $property->ptype_id;
        $relatedProperty = Property::where('ptype_id',$type_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(3)->get();

        return view('frontend.property.property_details',compact('property','multiImage','property_amen','facility','relatedProperty'));

    }// End Method


}
