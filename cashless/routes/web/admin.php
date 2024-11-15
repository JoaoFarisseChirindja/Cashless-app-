<?php

use App\Http\Controllers\Actors\AdminController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth', 'admin'])->group(function()
{
    Route::prefix('/admin')->group(function()
    {
        Route::name('admin')->group(function()
        {
            Route::controller(AdminController::class)->group(function()
            {
                Route::get('/dashboard','dashboard')
                    ->name('.dashboard');

                Route::name('.users')->group(function()
                {
                    Route::prefix('/users')->group(function()
                    {
                        Route::get('/','index')
                            ->name('.index');

                        Route::get('/{id}','show')
                            ->name('.show');

                        Route::get('/create', 'create')
                            ->name('.create');

                        Route::post('/','store')
                            ->name('.store');

                        Route::get('/{id}','edit')
                            ->name('.edit');

                        Route::put('/{id}','update')
                            ->name('.update');

                        Route::delete('/{id}','destroy')
                            ->name('.destroy');
                    });

                });

            });

        });


    });

});
