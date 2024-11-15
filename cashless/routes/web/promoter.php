<?php

use App\Http\Controllers\Actors\PromoterController;
use Illuminate\Support\Facades\Route;




Route::middleware(['auth', 'promoter'])->group(function()
{
    Route::prefix('/promoter')->group(function()
    {
        Route::name('promoter')->group(function()
        {
            Route::controller(PromoterController::class)->group(function()
            {
                Route::get('/dashboard','dashboard')
                        ->name('.dashboard');

                Route::prefix('/users')->group(function()
                {
                    Route::name('.users')->group(function()
                    {
                        Route::get('/', 'index')
                            ->name('.index');

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


    });

});
