<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Main\MainController;
use App\Http\Controllers\User\UserController;



//ADMIN ROUTES
   Route::middleware(['auth', 'AdminRoute'])->group(function () {

    Route::prefix('upload')->controller(MainController::class)->group(function () {

        // Route for Uploading Cars 
        Route::post('uploadcar', 'uploadCar')->name('upload.car');
        Route::get('uploadform', 'CarUploadForm')->name('upload.form');
        //For Admin Dashboard Management
        Route::get('adminDash', 'AdminDash')->name('admin.dashboard');
        Route::get('updateOrder/{id}', 'UpdateOrder')->name('update.order');
        Route::get('cancelOrder/{order}', 'CancelOrder')->name('cancel.order');
        Route::get('restore-order/{order}', 'RestoreOrder')->name('order.restore');
        Route::get("/logout","Logout")->name('admin.logout');
    });

   });


//RANDOM USERS ROUTE
  Route::controller(UserController::class)->group(function() {
    Route::get("/","indexPage");
    Route::get("/dashboard","HomePage")->name('dashboard');
    Route::view("/register","auth.register")->name('register');
    Route::get('/cars/search','search')->name('cars.search');
    Route::Post("/addToCart/{id}","AddToCart")->name('add.cart');
    Route::get("cart","ViewCart")->name('view.cart');
    Route::Delete('remove/{id}','RemoveItem')->name('remove.item');
    Route::Post("/PAI","OrderCheckout")->name("order.checkout");
    Route::get("details/{id}","CarDetails")->name('car.detail');
    Route::get("checkout/{grandTotal}","Checkout")->name('user.checkout');
   
   });



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
