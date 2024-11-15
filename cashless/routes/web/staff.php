<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Actors\StaffController;

Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])
->middleware('auth')->name('staff.dashboard');


Route::middleware(['auth', 'staff'])->group(function()
{
    Route::prefix('/staff')->group(function()
    {
        Route::name('staff')->group(function()
        {
            Route::controller(StaffController::class)->group(function()
            {
                Route::get('/','dashboard')
                    ->name('.dashboard');

                Route::get('/profile','profile')
                    ->name('.profile');
            });
        });


    });

});

