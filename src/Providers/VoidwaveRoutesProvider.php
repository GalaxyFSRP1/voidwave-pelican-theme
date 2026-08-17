<?php

namespace PhantomVoidTTV\VoidwaveTheme\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use PhantomVoidTTV\VoidwaveTheme\Http\Controllers\PreferencesController;

class VoidwaveRoutesProvider extends RouteServiceProvider
{
    public function boot(): void
    {
        $this->routes(function (): void {
            Route::middleware(['web', 'throttle:60,1'])
                ->get('/voidwave/preferences', [PreferencesController::class, 'show'])
                ->name('voidwave.preferences.show');

            Route::middleware(['web', 'auth.session', 'throttle:30,1'])->group(function (): void {
                Route::put('/voidwave/preferences', [PreferencesController::class, 'update'])
                    ->name('voidwave.preferences.update');
                Route::delete('/voidwave/preferences', [PreferencesController::class, 'destroy'])
                    ->name('voidwave.preferences.destroy');
            });
        });
    }
}
