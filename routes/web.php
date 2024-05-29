<?php

use App\Livewire\User\UserHome;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('home', UserHome::class)->name('home');
});
