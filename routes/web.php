<?php


Route::get('/', 'HalamanAwalController@index')->name('halaman-awal');

Route::get('/belanja', 'BelanjaController@index')->name('belanja.index');
Route::get('/belanja/{produk}', 'BelanjaController@show')->name('belanja.show');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::patch('/cart/{produk}', 'CartController@update')->name('cart.update');
Route::delete('/cart/{produk}', 'CartController@destroy')->name('cart.destroy');
Route::post('/cart/switchToSaveForLater/{produk}', 'CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');

Route::delete('/saveForLater/{produk}', 'SaveForLaterController@destroy')->name('saveForLater.destroy');
Route::post('/saveForLater/switchToCart/{produk}', 'SaveForLaterController@switchToCart')->name('saveForLater.switchToCart');

Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');


Route::get('/Terimakasih', 'ConfirmationController@index')->name('confirmation.index');
