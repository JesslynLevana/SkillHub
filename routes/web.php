<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');

    Route::get('/members', \App\Livewire\MsMember::class)->name('members.index');
    Route::get('/members/create', \App\Livewire\MsMember::class)->name('members.create');
    Route::get('/members/{id}', \App\Livewire\MsMember::class)->name('members.show');
    Route::get('/members/{id}/edit', \App\Livewire\MsMember::class)->name('members.edit');
    
    Route::get('/classes', \App\Livewire\MsClass::class)->name('classes.index');
    Route::get('/classes/create', \App\Livewire\MsClass::class)->name('classes.create');
    Route::get('/classes/{id}', \App\Livewire\MsClass::class)->name('classes.show');
    Route::get('/classes/{id}/edit', \App\Livewire\MsClass::class)->name('classes.edit');
    
    Route::get('/enrollments', \App\Livewire\TrClassMember::class)->name('enrollments.index');
    Route::get('/enrollments/create', \App\Livewire\TrClassMember::class)->name('enrollments.create');
    Route::get('/enrollments/create-multiple', \App\Livewire\TrClassMember::class)->name('enrollments.create-multiple');
});
