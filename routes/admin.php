<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Livewire\Admin\Admin\AdminEdit;
use App\Livewire\Admin\Admin\AdminIndex;
use App\Livewire\Admin\Home;
use App\Livewire\Admin\Request\RequestIndex;
use App\Livewire\Admin\Room\RoomEdit;
use App\Livewire\Admin\Room\RoomIndex;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('admin.login');
});
Route::controller(LoginController::class)
    ->group(static function () {
        Route::get('login', 'index')->name('login');
        Route::post('login', 'login')->name('login.store');
        Route::post('logout', 'logout')->name('logout');
    });


Route::middleware(['auth:admin','check.permission'])->group(function () {
    Route::get('home', Home::class)->name('home');
    Route::get('index', AdminIndex::class)->name('index');
    Route::get('edit/{admin}', AdminEdit::class)->name('edit')->where('admin', '[0-9]+');
    Route::prefix('room')->name('room.')->group(function () {
        Route::get('index', RoomIndex::class)->name('index');
        Route::get('edit/{room}', RoomEdit::class)->name('edit')->where('room', '[0-9]+');
    });
    Route::prefix('request')->name('request.')->group(function () {
        Route::get('index', RequestIndex::class)->name('index');
    });
});

