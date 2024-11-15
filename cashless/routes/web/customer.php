<?php


use App\Http\Controllers\Actors\CustomerController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'customer'])->group(function()
{
    Route::prefix('/customer')->group(function()
    {
        Route::name('customer')->group(function()
        {
            Route::controller(CustomerController::class)->group(function()
            {
                Route::get('/','home')
                    ->name('.home');

                Route::post('/', 'store')
                    ->name('.store');

                Route::get('/{id}', 'show')
                    ->name('.show');

                Route::put('/{id}', 'update')
                    ->name('.update');

                Route::delete('/{id}', 'destroy')
                    ->name('.destroy');
            });
        });


    });

});

