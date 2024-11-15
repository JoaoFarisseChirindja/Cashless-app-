<?php

use App\Http\Controllers\Actors\ManagerController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'manager'])->group(function()
{
    Route::prefix('/manager')->group(function()
    {
        Route::name('manager')->group(function()
        {
            Route::controller(ManagerController::class)->group(function()
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
