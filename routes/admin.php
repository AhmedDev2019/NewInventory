<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\WarehouseController;



Route::group(
[
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
function()
{



    // All Routes Here..
    Route::group(['prefix' => 'admin'] , function(){

        // Auth Routes ...
        Route::get('/login' , [AdminAuthController::class , 'login'])->name('admin.login')->middleware('RedirectIfAuthAdmin');
        Route::post('/doLogin' , [AdminAuthController::class , 'doLogin'])->name('admin.doLogin');
        Route::any('/logout' , [AdminAuthController::class , 'logout'])->name('admin.logout');
        // Reset Password Routes ..
        Route::get('/forgot/password' , [AdminAuthController::class , 'forgot_password'])->name('admin.forgot_password');
        Route::post('/forgot/password/post' , [AdminAuthController::class , 'forgot_password_post'])->name('admin.forgot_password_post');
        Route::get('/reset/password/{token}' , [AdminAuthController::class , 'reset_password'])->name('admin.reset_password');
        Route::post('/reset/password/post/{token}' , [AdminAuthController::class , 'reset_password_post'])->name('admin.reset_password_post');
    
        // Start Authenticated Routes .... ...
        Route::group(['middleware' => 'admin'] , function(){
            
            // Dashboard Route ..
            Route::get('/dashboard' , [AdminAuthController::class,'index'])->name('admin.index');
            
            // Profile Routes ..
            Route::get('/profile' , [AdminProfileController::class,'index'])->name('admin.profile');
            Route::post('profile/update' , [AdminProfileController::class,'update'])->name('admin.profile.update');
            
            
            // Settings Routes ..
            Route::group(['prefix' => 'settings'] , function(){
                Route::get('/' , [SettingController::class,'index'])->name('admin.settings.index');
            });

            // Admins Routes ..
            Route::group(['prefix' => 'admins'], function(){
                Route::get('/' , [AdminController::class,'index'])->name('admin.admins.index');
                Route::get('/create' , [AdminController::class,'create'])->name('admin.admins.create');
                Route::post('/store' , [AdminController::class,'store'])->name('admin.admins.store');
                Route::get('/show/{admin}' , [AdminController::class,'show'])->name('admin.admins.show');
                Route::get('/edit/{admin}' , [AdminController::class,'edit'])->name('admin.admins.edit');
                Route::put('/update/{admin}' , [AdminController::class,'update'])->name('admin.admins.update');
                Route::delete('/destroy/{admin}' , [AdminController::class,'destroy'])->name('admin.admins.destroy');
                Route::get('/activation/{admin}' , [AdminController::class,'activation'])->name('admin.admins.activation');
            });

            // Users Routes ..
            // Route::group(['prefix' => 'users'], function(){
            //     Route::get('/' , [UserController::class,'index'])->name('admin.users.index');
            //     Route::get('/create' , [UserController::class,'create'])->name('admin.users.create');
            //     Route::post('/store' , [UserController::class,'store'])->name('admin.users.store');
            //     Route::get('/show/{user}' , [UserController::class,'show'])->name('admin.users.show');
            //     Route::get('/edit/{user}' , [UserController::class,'edit'])->name('admin.users.edit');
            //     Route::put('/update/{user}' , [UserController::class,'update'])->name('admin.users.update');
            //     Route::delete('/destroy/{user}' , [UserController::class,'destroy'])->name('admin.users.destroy');
            //     Route::get('/activation/{user}' , [UserController::class,'activation'])->name('admin.users.activation');
            // });

            // Admins Routes ..
            Route::group(['prefix' => 'brands'], function(){
                Route::get('/' , [BrandController::class,'index'])->name('admin.brands.index');
                Route::get('/create' , [BrandController::class,'create'])->name('admin.brands.create');
                Route::post('/store' , [BrandController::class,'store'])->name('admin.brands.store');
                Route::get('/edit/{brand}' , [BrandController::class,'edit'])->name('admin.brands.edit');
                Route::put('/update/{brand}' , [BrandController::class,'update'])->name('admin.brands.update');
                Route::delete('/destroy/{brand}' , [BrandController::class,'destroy'])->name('admin.brands.destroy');
                Route::get('/activation/{brand}' , [BrandController::class,'activation'])->name('admin.brands.activation');
            });

            // Warehouse Routes ..
            Route::group(['prefix' => 'warehouses'], function(){
                Route::get('/' , [WarehouseController::class,'index'])->name('admin.warehouses.index');
                Route::get('/create' , [WarehouseController::class,'create'])->name('admin.warehouses.create');
                Route::post('/store' , [WarehouseController::class,'store'])->name('admin.warehouses.store');
                Route::get('/show/{warehouse}' , [WarehouseController::class,'show'])->name('admin.warehouses.show');
                Route::get('/edit/{warehouse}' , [WarehouseController::class,'edit'])->name('admin.warehouses.edit');
                Route::put('/update/{warehouse}' , [WarehouseController::class,'update'])->name('admin.warehouses.update');
                Route::delete('/destroy/{warehouse}' , [WarehouseController::class,'destroy'])->name('admin.warehouses.destroy');
                Route::get('/activation/{warehouse}' , [WarehouseController::class,'activation'])->name('admin.warehouses.activation');
            });
            
    
    
    
        });
        // End Authenticated Routes ....
    
    });




});


