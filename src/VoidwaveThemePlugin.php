<?php

namespace PhantomVoidTTV\VoidwaveTheme;

use Filament\Contracts\Plugin;
use Filament\Enums\ThemeMode;
use Filament\Panel;
use Filament\Support\Colors\Color;

class VoidwaveThemePlugin implements Plugin
{
    /** @var array<int, string> */
    public const VOID_GRAY = [
        50 => '#f4f2ff',
        100 => '#e8e5f5',
        200 => '#d2cde4',
        300 => '#aaa4c0',
        400 => '#827b9b',
        500 => '#625c79',
        600 => '#4a455f',
        700 => '#353047',
        800 => '#211d31',
        900 => '#151120',
        950 => '#09070f',
    ];

    public function getId(): string
    {
        return 'voidwave-theme';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->viteTheme('plugins/voidwave-theme/resources/css/theme.css')
            ->darkMode(isForced: true)
            ->defaultThemeMode(ThemeMode::Dark)
            ->colors([
                'gray' => self::VOID_GRAY,
                'primary' => Color::hex('#a855f7'),
                'info' => Color::hex('#22d3ee'),
                'success' => Color::hex('#34d399'),
                'warning' => Color::hex('#fbbf24'),
                'danger' => Color::hex('#fb7185'),
            ]);

        $panel->renderHook('panels::body.start', fn (): string => <<<'HTML'
<div class="voidwave-ambient" aria-hidden="true">
    <div class="voidwave-grid"></div>
    <div class="voidwave-orb voidwave-orb-one"></div>
    <div class="voidwave-orb voidwave-orb-two"></div>
    <div class="voidwave-orb voidwave-orb-three"></div>
    <div class="voidwave-stars voidwave-stars-a"></div>
    <div class="voidwave-stars voidwave-stars-b"></div>
    <div class="voidwave-vignette"></div>
</div>
HTML);
    }

    public function boot(Panel $panel): void {}
}
