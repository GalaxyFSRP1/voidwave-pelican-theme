<?php

namespace PhantomVoidTTV\VoidwaveTheme\Providers;

use Illuminate\Support\ServiceProvider;

class VoidwaveThemeProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            plugin_path('voidwave-theme', 'config/voidwave-theme.php'),
            'voidwave-theme',
        );
    }
}
