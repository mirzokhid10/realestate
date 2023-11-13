<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// User frontend all routes
Route::get('/', [UserController::class, 'Index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfile'])
    ->name('user.profile');

    // Saving the user profile changes
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])
    ->name('user.profile.store');

    // Logout the user action
    Route::get('/user/logout', [UserController::class, 'UserLogout'])
    ->name('user.logout');

    // change the user password
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])
    ->name('user.change.password');

    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])
    ->name('user.password.update');
});

require __DIR__.'/auth.php';

/// Admin Group Middleware
Route::middleware('auth', 'role:admin')->group(function () {
    // Admin dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])
    ->name('admin.dashboard');

    // Admin logout route
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])
    ->name('admin.logout');

    // Admin profile route
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])
    ->name('admin.profile');

    // Admin profile store/edit route
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])
    ->name('admin.profile.store');

    // Admin profile change page route
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])
    ->name('admin.change.password');

    // Admin profile change password route
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])
    ->name('admin.update.password');

}); // Admin dashboard


/// Agent Group Middleware
Route::middleware('auth', 'role:agent')->group(function () {
    // Agent dashboard
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])
    ->name('agent.dashboard');
}); // Agent dashboard

// Admin login page
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

// Property Type Middleware
Route::middleware(['auth','role:admin'])->group(function(){
    // Property Type All Route
    Route::controller(PropertyTypeController::class)->group(function(){
        Route::get('/all/type', 'AllType')->name('all.type');
        Route::get('/add/type', 'AddType')->name('add.type');
        Route::post('/store/type', 'StoreType')->name('store.type');
        Route::get('/edit/type/{id}', 'EditType')->name('edit.type');
        Route::post('/update/type/{id}', 'UpdateType')->name('update.type');
        Route::get('/delete/type/{id}', 'DeleteType')->name('delete.type');
    });
}); //

 // Amenities Type All Route
 Route::controller(PropertyTypeController::class)->group(function(){

    Route::get('/all/amenitie', 'AllAmenitie')->name('all.amenitie');
    Route::get('/add/amenitie', 'AddAmenitie')->name('add.amenitie');
    Route::post('/store/amenitie', 'StoreAmenitie')->name('store.amenitie');
    Route::get('/edit/amenitie/{id}', 'EditAmenitie')->name('edit.amenitie');
    Route::post('/update/amenitie', 'UpdateAmenitie')->name('update.amenitie');
    Route::get('/delete/amenitie/{id}', 'DeleteAmenitie')->name('delete.amenitie');

});

Route::controller(PropertyController::class)->group(function(){

    Route::get('/all/property', 'AllProperty')->name('all.property');
    Route::get('/add/property', 'AddProperty')->name('add.property');
    Route::post('/store/property', 'StoreProperty')->name('store.property');
    Route::get('/edit/property/{id}', 'EditProperty')->name('edit.property');
    Route::post('/update/property', 'UpdateProperty')->name('update.property');
    Route::post('/update/property/thambnail', 'UpdatePropertyThambnail')->name('update.property.thambnail');
    Route::post('/update/property/multiimage', 'UpdatePropertyMultiimage')->name('update.property.multiimage');
    Route::get('/property/multiimg/delete/{id}', 'PropertyMultiImageDelete')->name('property.multiimg.delete');
    Route::post('/store/new/multiimage', 'StoreNewMultiimage')->name('store.new.multiimage');
    Route::post('/update/property/facilities', 'UpdatePropertyFacilities')->name('update.property.facilities');
    Route::get('/delete/property/{id}', 'DeleteProperty')->name('delete.property');
    Route::get('/details/property/{id}', 'DetailsProperty')->name('details.property');
    Route::post('/inactive/property', 'InactiveProperty')->name('inactive.property');
    Route::post('/active/property', 'ActiveProperty')->name('active.property');
    Route::get('/admin/login', [AdminController::class, 'AdminLogin'])
    ->name('admin.login')->middleware(RedirectIfAuthenticated::class);
});


