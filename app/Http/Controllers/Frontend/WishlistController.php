<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Amenities;
use App\Models\PropertyType;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // AddToWishList
    public function AddToWishList(Request $request, $property_id){
        if(Auth::check()){

            $exists = Wishlist::where('user_id',Auth::id())->where('property_id',$property_id)->first();

            if (!$exists) {
                Wishlist::insert([
                'user_id' => Auth::id(),
                'property_id' => $property_id,
                'created_at' => Carbon::now()
                ]);
                return response()->json(['success' => 'Successfully Added On Your Wishlist']);
            }else{
                return response()->json(['error' => 'This Property Has Already in your WishList']);
            }

        }else{
            return response()->json(['error' => 'At First Login Your Account']);
        }
    } // End Method

    // UserWishlist
    public function UserWishlist(){

        $id = Auth::user()->id;
        $userData = User::find($id);

        return view('frontend.dashboard.wishlist',compact('userData'));

    }// End Method

    // GetWishlistProperty
    public function GetWishlistProperty(){

        $wishlist = Wishlist::with('property')->where('user_id',Auth::id())->latest()->get();

        $wishQty = wishlist::count();

        return response()->json(['wishlist' => $wishlist, 'wishQty' => $wishQty]);

    }// End Method

    // WishlistRemove
    public function WishlistRemove($id){

        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success' => 'Successfully Property Remove']);

      }// End Method
}
