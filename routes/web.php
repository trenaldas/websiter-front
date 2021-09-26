<?php

use App\Http\Controllers\ProjectController;
use App\Http\Livewire\BitShow;
use App\Http\Livewire\CartIndex;
use App\Http\Livewire\ContactUs;
use App\Http\Livewire\OrderConfirmed;
use App\Http\Livewire\TagShow;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['set.project.vars']], function() {
    Route::get('/', [ProjectController::class, 'index'])
        ->name('home');

    Route::get('/t/{tag}', TagShow::class)
        ->name('tag.show');

    Route::get('/b/{bit}', BitShow::class)
        ->name('bit.show');

    Route::get('/contact-us', ContactUs::class)
        ->name('contact-us.create');

    Route::get('/cart', CartIndex::class)->name('cart.index');

    Route::get('/order/{order}/confirm/{confirm_code}', OrderConfirmed::class);
});
