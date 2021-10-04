<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



/*
********************************************************************
*******************ROUTE Ở PHẦN GIAO DIỆN ADMIN********************
********************************************************************
*/
Route::group(['module' => 'dashboard', 'middleware' => 'web', 'namespace' => "App\Http\Controllers"], function () {
    // Route::get('/admin/tc', 'AdminController@getIndexAdmin');
    // Route::get('/allhotels', 'AdminController@getAllHotel');
    // Route::get('/admin/addhotel', 'AdminController@AddHotel');
    // Route::post('/admin/savehotel', 'AdminController@getSaveHotel');
    // Route::get('/admin/deletehotel/{id}', 'AdminController@DeleteHotel');
    // Route::get('/admin/edithotel/{id}', 'AdminController@EditHotel');
    // Route::post('/admin/updatehotel/{id}', 'AdminController@UpdateHotel');

    Route::group(['middleware' => ['auth']], function () {
      
        //Dashboard
        Route::get("/", ["as" => "admin.dashboard.index", "uses" => "AdminController@getIndexAdmin"]);

        Route::group(["prefix" => "hotels"], function() {
            Route::get("/", ["as" => "admin.hotels", "uses" => "AdminController@getAllHotel"]);
            Route::get("addhotel", ["as" => "admin.hotels.add", "uses" => "AdminController@AddHotel"]);
            Route::post("savehotel", ["as" => "admin.hotels.add", "uses" => "AdminController@getSaveHotel"]);
            Route::get("deletehotel/{id}", ["as" => "admin.hotels.edit", "uses" => "AdminController@DeleteHotel"]);
            Route::get("edithotel/{id}", ["as" => "admin.hotels.edit", "uses" => "AdminController@EditHotel"]);
            Route::post("updatehotel/{id}", ["as" => "admin.hotels.eidt", "uses" => "AdminController@UpdateHotel"]);
        });

        Route::group(["prefix" => "categories"], function() {
            Route::get("/", ["as" => "admin.categories", "uses" => "CategoriesController@getAllCategories"]);
            Route::get("add", ["as" => "admin.categories.add", "uses" => "CategoriesController@AddCategories"]);
            Route::post("save", ["as" => "admin.categories.add", "uses" => "CategoriesController@getSaveCategories"]);
            Route::get("delete/{id}", ["as" => "admin.categories.delete", "uses" => "CategoriesController@DeleteCategories"]);
            Route::get("edit/{id}", ["as" => "admin.categories.edit", "uses" => "CategoriesController@EditCategories"]);
            Route::post("update/{id}", ["as" => "admin.categories.eidt", "uses" => "CategoriesController@UpdateCategories"]);
        });
        Route::group(["prefix" => "favorite"], function() {
            Route::get("/", ["as" => "admin.favorite", "uses" => "FavoriteController@getAllFavorite"]);
           
            Route::get("delete/{id}", ["as" => "admin.favorite.delete", "uses" => "FavoriteController@DeleteFavorite"]);
           
        });
        Route::group(["prefix" => "rating"], function() {
            Route::get("/", ["as" => "admin.rating", "uses" => "RatingController@getAllRating"]);
           
            Route::get("delete/{id}", ["as" => "admin.rating.delete", "uses" => "RatingController@DeleteRating"]);
           
        });
        Route::group(["prefix" => "location"], function() {
            Route::get("/", ["as" => "admin.location", "uses" => "LocationController@getAllLocation"]);
            Route::get("add", ["as" => "admin.location.add", "uses" => "LocationController@AddLocation"]);
            Route::post("save", ["as" => "admin.location.add", "uses" => "LocationController@getSaveLocation"]);
            Route::get("delete/{id}", ["as" => "admin.location.delete", "uses" => "LocationController@DeleteLocation"]);
            Route::get("edit/{id}", ["as" => "admin.location.edit", "uses" => "LocationController@EditLocation"]);
            Route::post("update/{id}", ["as" => "admin.location.eidt", "uses" => "LocationController@UpdateLocation"]);
        });
        Route::group(["prefix" => "users"], function() {
            Route::get("/", ["as" => "admin.users", "uses" => "UsersController@getAllUser"]);
            Route::get("add", ["as" => "admin.users.add", "uses" => "UsersController@AddUser"]);
            Route::post("save", ["as" => "admin.users.add", "uses" => "UsersController@getSaveUser"]);
            Route::get("delete/{id}", ["as" => "admin.users.delete", "uses" => "UsersController@DeleteUser"]);
            Route::get("edit/{id}", ["as" => "admin.users.edit", "uses" => "UsersController@EditUser"]);
            Route::post("update/{id}", ["as" => "admin.users.eidt", "uses" => "UsersController@UpdateUser"]);
        });


    });
});
// Route::get('/login-checkout', 'CheckoutController@login_checkout');


// Route::get('/allproducts', 'AdminController@getAllProductsAdmin');




// //manufacture admin
// Route::get('/allmanufactures', 'AdminController@getAllManufacturesAdmin');
// Route::get('/admin/addmanufactures', 'AdminController@getIndexAddManufactures');
// Route::post('/admin/savemanufactures', 'AdminController@getSaveManufactures');
// Route::get('/admin/editmanu/{id}', 'AdminController@EditManu');
// Route::post('/admin/updatemanu/{id}', 'AdminController@UpdateManu');
// Route::get('/admin/deletemanu/{id}', 'AdminController@DeleteManu');
// Route::get('/allprotypes', 'AdminController@getAllProtypesAdmin');
// Route::get('/admin/addprotypes', 'AdminController@getIndexAddProtypes');
// Route::post('/admin/saveprotypes', 'AdminController@getSaveProtypes');
// Route::get('/admin/editprotype/{id}', 'AdminController@EditProtypes');
// Route::post('/admin/updateprotype/{id}', 'AdminController@UpdateProtypes');
// Route::get('/admin/deleteprotype/{id}', 'AdminController@DeleteProtypes');

// //user admin
// Route::get('/allusers', 'AdminController@getAllUserInAdmin');
// Route::get('/admin/deleteuser/{id}', 'AdminController@DeleteUser');
// Route::get('/adduser', 'AdminController@AddUser');
// Route::post('/saveuser', 'AdminController@SaveUser');
// Route::get('/edituser/{id}', 'AdminController@EditUser');
// Route::post('/updateuser/{id}', 'AdminController@UpdateUser');
// //bill admin
// Route::get('/allbills', 'AdminController@getAllBillInAdmin');
// Route::get('/admin/deletebill/{id}', 'AdminController@DeleteBill');
// Route::get('/admin/billdetail/{id}', 'AdminController@DetailBill');



