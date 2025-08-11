<?php

use App\Http\Controllers\LogoutController;
use App\Livewire\Posts\Index;
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;




Route::middleware('auth')->group(function (){
    Route::get('/', \App\Livewire\Home::class)->name('home');
    Route::get('/about', \App\Livewire\About::class)->name('about');

    Route::get('/posts/create', \App\Livewire\Posts\Create::class)->name('posts.create');
    Route::get('/posts/{post}/edit', \App\Livewire\Posts\Create::class)->name('posts.edit');
    Route::post('/posts/{post}/delete', \App\Livewire\Posts\Create::class)->name('posts.delete');
    Route::get('/posts', App\Livewire\Posts\Index::class)->name('posts.index');
    // Route::get('/posts', \App\Livewire\Posts\Index::class)->name('posts.index');

    Route::get('users/{user}', \App\Livewire\Users\Show::class)
        ->name('users.show');
});

Route::get('/login', \App\Livewire\Login::class)->name('login')->middleware('guest');
Route::get('/logout', [LogoutController::class, '__invoke'])->name('logout');

