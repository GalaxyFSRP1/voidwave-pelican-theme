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

        $panel->renderHook('panels::head.end', fn (): string => <<<'HTML'
<script>
(function () {
    if (window.__voidwaveEnhanced) return;
    window.__voidwaveEnhanced = true;

    var root = document.documentElement;
    var progressTimer;
    var pointerFrame;

    try {
        if (localStorage.getItem('voidwave-effects') === 'off') {
            root.classList.add('voidwave-static');
        }
    } catch (e) {}

    function setupToggle() {
        var toggle = document.getElementById('voidwave-fx-toggle');
        if (!toggle || toggle.dataset.ready === 'true') return;
        toggle.dataset.ready = 'true';

        function syncToggle() {
            var isStatic = root.classList.contains('voidwave-static');
            toggle.setAttribute('aria-pressed', isStatic ? 'true' : 'false');
            toggle.setAttribute('title', isStatic ? 'Enable Voidwave effects' : 'Pause Voidwave effects');
            toggle.querySelector('.voidwave-fx-label').textContent = isStatic ? 'FX OFF' : 'FX';
        }

        toggle.addEventListener('click', function () {
            root.classList.toggle('voidwave-static');
            try {
                localStorage.setItem('voidwave-effects', root.classList.contains('voidwave-static') ? 'off' : 'on');
            } catch (e) {}
            syncToggle();
        });

        syncToggle();
    }

    function startProgress() {
        var bar = document.getElementById('voidwave-progress');
        if (!bar) return;
        clearTimeout(progressTimer);
        bar.classList.remove('voidwave-progress-done');
        bar.classList.add('voidwave-progress-active');
        progressTimer = setTimeout(finishProgress, 8000);
    }

    function finishProgress() {
        var bar = document.getElementById('voidwave-progress');
        if (!bar) return;
        clearTimeout(progressTimer);
        bar.classList.add('voidwave-progress-done');
        setTimeout(function () {
            bar.classList.remove('voidwave-progress-active', 'voidwave-progress-done');
        }, 420);
        setupToggle();
    }

    document.addEventListener('pointermove', function (event) {
        if (pointerFrame || root.classList.contains('voidwave-static')) return;
        pointerFrame = requestAnimationFrame(function () {
            root.style.setProperty('--vw-pointer-x', event.clientX + 'px');
            root.style.setProperty('--vw-pointer-y', event.clientY + 'px');
            pointerFrame = null;
        });
    }, { passive: true });

    document.addEventListener('click', function (event) {
        var target = event.target.closest('.fi-btn, .fi-icon-btn, .fi-sidebar-item-btn, .fi-sidebar-item-button, .fi-tabs-item, .fi-dropdown-list-item');
        if (!target || root.classList.contains('voidwave-static')) return;

        var rect = target.getBoundingClientRect();
        var ripple = document.createElement('span');
        var size = Math.max(rect.width, rect.height) * 1.8;
        ripple.className = 'voidwave-ripple';
        ripple.style.width = size + 'px';
        ripple.style.height = size + 'px';
        ripple.style.left = (event.clientX - rect.left - size / 2) + 'px';
        ripple.style.top = (event.clientY - rect.top - size / 2) + 'px';
        target.appendChild(ripple);
        setTimeout(function () { ripple.remove(); }, 650);
    });

    document.addEventListener('livewire:navigating', startProgress);
    document.addEventListener('livewire:navigated', finishProgress);
    document.addEventListener('turbo:before-visit', startProgress);
    document.addEventListener('turbo:load', finishProgress);
    window.addEventListener('pageshow', finishProgress);
    window.addEventListener('DOMContentLoaded', setupToggle);

    document.addEventListener('click', function (event) {
        var link = event.target.closest('a[href]');
        if (!link || link.target === '_blank' || link.hasAttribute('download') || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;
        try {
            var next = new URL(link.href, location.href);
            if (next.origin === location.origin && next.href !== location.href && !next.hash) startProgress();
        } catch (e) {}
    });
})();
</script>
HTML);

        $panel->renderHook('panels::body.start', fn (): string => <<<'HTML'
<div id="voidwave-progress" aria-hidden="true"><span></span></div>
<div class="voidwave-ambient" aria-hidden="true">
    <div class="voidwave-grid"></div>
    <div class="voidwave-orb voidwave-orb-one"></div>
    <div class="voidwave-orb voidwave-orb-two"></div>
    <div class="voidwave-orb voidwave-orb-three"></div>
    <div class="voidwave-stars voidwave-stars-a"></div>
    <div class="voidwave-stars voidwave-stars-b"></div>
    <div class="voidwave-comets"><i></i><i></i><i></i></div>
    <div class="voidwave-spotlight"></div>
    <div class="voidwave-vignette"></div>
</div>
<button id="voidwave-fx-toggle" type="button" aria-label="Toggle Voidwave visual effects" aria-pressed="false" title="Pause Voidwave effects">
    <span class="voidwave-fx-icon" aria-hidden="true">✦</span>
    <span class="voidwave-fx-label">FX</span>
</button>
HTML);
    }

    public function boot(Panel $panel): void {}
}
