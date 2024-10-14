<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@index')->name('home');

// Language switcher
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, array_keys(config('app.locales')))) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('changeLanguage');

Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/data', [ProductController::class, 'data'])->name('products.data');


    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('customers/data', [CustomerController::class, 'data'])->name('customers.data');
    Route::get('customers/create', [CustomerController::class, 'create'])->name('customers.create');


    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');


    Route::get('/about', function () {
        return view('about');
    })->name('about');

});







