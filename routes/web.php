<?php

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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products', 'ProductController@index')->name('products');
Route::get('/customers', 'CustomerController@index')->name('customers');


Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');
