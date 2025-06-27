<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::resource('books', App\Http\Controllers\BookController::class);
    Route::resource('borrows', App\Http\Controllers\BorrowController::class);

    Route::get('favorites', [App\Http\Controllers\FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('books/{book}/favorite', [App\Http\Controllers\FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('books/{book}/favorite', [App\Http\Controllers\FavoriteController::class, 'destroy'])->name('favorites.destroy');
});

require __DIR__.'/auth.php';
