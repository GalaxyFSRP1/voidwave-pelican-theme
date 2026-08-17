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
    var storageKey = 'voidwave-preferences-v3';
    var defaults = {
        effects: true,
        compact: false,
        contrast: false,
        oled: false,
        palette: 'voidwave',
        ambience: 'balanced',
        surface: 'glass'
    };
    var preferences = Object.assign({}, defaults);

    function loadPreferences() {
        try {
            var saved = JSON.parse(localStorage.getItem(storageKey) || '{}');
            if (typeof saved.effects === 'boolean') preferences.effects = saved.effects;
            if (typeof saved.compact === 'boolean') preferences.compact = saved.compact;
            if (typeof saved.contrast === 'boolean') preferences.contrast = saved.contrast;
            if (typeof saved.oled === 'boolean') preferences.oled = saved.oled;
            if (['voidwave', 'aurora', 'ember', 'nebula'].indexOf(saved.palette) !== -1) preferences.palette = saved.palette;
            if (['calm', 'balanced', 'vivid'].indexOf(saved.ambience) !== -1) preferences.ambience = saved.ambience;
            if (['glass', 'solid', 'crystal'].indexOf(saved.surface) !== -1) preferences.surface = saved.surface;

            /* Migrate preferences from versions 1.1 through 1.3. */
            var legacyV2 = JSON.parse(localStorage.getItem('voidwave-preferences-v2') || '{}');
            var legacyV1 = JSON.parse(localStorage.getItem('voidwave-preferences-v1') || '{}');
            var legacy = Object.assign({}, legacyV1, legacyV2);
            ['effects', 'compact', 'contrast', 'oled'].forEach(function (key) {
                if (typeof legacy[key] === 'boolean' && typeof saved[key] !== 'boolean') preferences[key] = legacy[key];
            });
            if (['voidwave', 'aurora', 'ember', 'nebula'].indexOf(legacy.palette) !== -1 && !saved.palette) preferences.palette = legacy.palette;
            if (['calm', 'balanced', 'vivid'].indexOf(legacy.ambience) !== -1 && !saved.ambience) preferences.ambience = legacy.ambience;
            if (localStorage.getItem('voidwave-effects') === 'off' && typeof saved.effects !== 'boolean') preferences.effects = false;
        } catch (e) {}
        applyPreferences();
    }

    function savePreferences() {
        try {
            localStorage.setItem(storageKey, JSON.stringify(preferences));
            localStorage.removeItem('voidwave-effects');
            localStorage.removeItem('voidwave-preferences-v1');
            localStorage.removeItem('voidwave-preferences-v2');
        } catch (e) {}
    }

    function applyPreferences() {
        root.classList.toggle('voidwave-static', !preferences.effects);
        root.classList.toggle('voidwave-compact', preferences.compact);
        root.classList.toggle('voidwave-high-contrast', preferences.contrast);
        root.classList.toggle('voidwave-oled', preferences.oled);
        root.setAttribute('data-voidwave-palette', preferences.palette);
        root.setAttribute('data-voidwave-ambience', preferences.ambience);
        root.setAttribute('data-voidwave-surface', preferences.surface);
        syncControls();
    }

    function syncControls() {
        var panel = document.getElementById('voidwave-preferences');
        if (!panel) return;

        panel.querySelectorAll('[data-voidwave-option]').forEach(function (button) {
            var option = button.getAttribute('data-voidwave-option');
            var active = option === 'effects' ? preferences.effects : !!preferences[option];
            button.setAttribute('aria-pressed', active ? 'true' : 'false');
            var state = button.querySelector('.voidwave-option-state');
            if (state) state.textContent = active ? 'On' : 'Off';
        });

        panel.querySelectorAll('[data-voidwave-palette]').forEach(function (button) {
            var active = button.getAttribute('data-voidwave-palette') === preferences.palette;
            button.setAttribute('aria-checked', active ? 'true' : 'false');
        });

        panel.querySelectorAll('[data-voidwave-ambience]').forEach(function (button) {
            var active = button.getAttribute('data-voidwave-ambience') === preferences.ambience;
            button.setAttribute('aria-checked', active ? 'true' : 'false');
        });

        panel.querySelectorAll('[data-voidwave-surface]').forEach(function (button) {
            var active = button.getAttribute('data-voidwave-surface') === preferences.surface;
            button.setAttribute('aria-checked', active ? 'true' : 'false');
        });
    }

    function showToast(message) {
        var toast = document.getElementById('voidwave-toast');
        if (!toast) return;
        toast.textContent = message;
        toast.classList.remove('voidwave-toast-visible');
        requestAnimationFrame(function () { toast.classList.add('voidwave-toast-visible'); });
        clearTimeout(window.__voidwaveToastTimer);
        window.__voidwaveToastTimer = setTimeout(function () {
            toast.classList.remove('voidwave-toast-visible');
        }, 1800);
    }

    function setupControls() {
        var controls = document.getElementById('voidwave-controls');
        var toggle = document.getElementById('voidwave-settings-toggle');
        var panel = document.getElementById('voidwave-preferences');
        var backToTop = document.getElementById('voidwave-back-to-top');
        if (!controls || !toggle || !panel || controls.dataset.ready === 'true') return;
        controls.dataset.ready = 'true';

        function closePanel() {
            panel.hidden = true;
            toggle.setAttribute('aria-expanded', 'false');
        }

        toggle.addEventListener('click', function () {
            var opening = panel.hidden;
            panel.hidden = !opening;
            toggle.setAttribute('aria-expanded', opening ? 'true' : 'false');
            if (opening) {
                syncControls();
                var first = panel.querySelector('button');
                if (first) setTimeout(function () { first.focus(); }, 0);
            }
        });

        panel.addEventListener('click', function (event) {
            var optionButton = event.target.closest('[data-voidwave-option]');
            var paletteButton = event.target.closest('[data-voidwave-palette]');
            var ambienceButton = event.target.closest('[data-voidwave-ambience]');
            var surfaceButton = event.target.closest('[data-voidwave-surface]');
            var resetButton = event.target.closest('[data-voidwave-reset]');
            var diagnosticsButton = event.target.closest('[data-voidwave-diagnostics]');

            if (optionButton) {
                var option = optionButton.getAttribute('data-voidwave-option');
                preferences[option] = !preferences[option];
                savePreferences();
                applyPreferences();
                showToast('Appearance updated');
            } else if (paletteButton) {
                preferences.palette = paletteButton.getAttribute('data-voidwave-palette');
                savePreferences();
                applyPreferences();
                showToast('Palette changed');
            } else if (ambienceButton) {
                preferences.ambience = ambienceButton.getAttribute('data-voidwave-ambience');
                savePreferences();
                applyPreferences();
                showToast('Ambience updated');
            } else if (surfaceButton) {
                preferences.surface = surfaceButton.getAttribute('data-voidwave-surface');
                savePreferences();
                applyPreferences();
                showToast('Surface style updated');
            } else if (resetButton) {
                preferences = Object.assign({}, defaults);
                savePreferences();
                applyPreferences();
                showToast('Appearance reset');
            } else if (diagnosticsButton) {
                var details = 'Voidwave Theme 1.4.0 | palette=' + preferences.palette + ' | ambience=' + preferences.ambience + ' | surface=' + preferences.surface + ' | effects=' + preferences.effects + ' | compact=' + preferences.compact + ' | contrast=' + preferences.contrast + ' | oled=' + preferences.oled;
                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(details).then(function () { showToast('Diagnostics copied'); });
                } else {
                    showToast(details);
                }
            }
        });

        document.addEventListener('click', function (event) {
            if (!panel.hidden && !controls.contains(event.target)) closePanel();
        });

        document.addEventListener('keydown', function (event) {
            if (event.altKey && event.key.toLowerCase() === 'v') {
                event.preventDefault();
                toggle.click();
                return;
            }
            if (event.key === 'Escape' && !panel.hidden) {
                closePanel();
                toggle.focus();
            }
        });

        backToTop.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: preferences.effects ? 'smooth' : 'auto' });
        });

        function updateBackToTop() {
            backToTop.classList.toggle('voidwave-visible', window.scrollY > 520);
        }

        window.addEventListener('scroll', updateBackToTop, { passive: true });
        updateBackToTop();
        syncControls();
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
        setupControls();
    }

    loadPreferences();

    function syncPageVisibility() {
        root.classList.toggle('voidwave-page-hidden', document.hidden);
    }
    document.addEventListener('visibilitychange', syncPageVisibility);
    syncPageVisibility();

    document.addEventListener('pointermove', function (event) {
        if (pointerFrame || !preferences.effects) return;
        pointerFrame = requestAnimationFrame(function () {
            root.style.setProperty('--vw-pointer-x', event.clientX + 'px');
            root.style.setProperty('--vw-pointer-y', event.clientY + 'px');
            pointerFrame = null;
        });
    }, { passive: true });

    document.addEventListener('click', function (event) {
        var target = event.target.closest('.fi-btn, .fi-icon-btn, .fi-sidebar-item-btn, .fi-sidebar-item-button, .fi-tabs-item, .fi-dropdown-list-item');
        if (!target || !preferences.effects) return;

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
    window.addEventListener('DOMContentLoaded', setupControls);

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
    <div class="voidwave-nebula"></div>
    <div class="voidwave-portal"><i></i><i></i><i></i></div>
    <div class="voidwave-orb voidwave-orb-one"></div>
    <div class="voidwave-orb voidwave-orb-two"></div>
    <div class="voidwave-orb voidwave-orb-three"></div>
    <div class="voidwave-stars voidwave-stars-a"></div>
    <div class="voidwave-stars voidwave-stars-b"></div>
    <div class="voidwave-dust voidwave-dust-a"></div>
    <div class="voidwave-dust voidwave-dust-b"></div>
    <div class="voidwave-comets"><i></i><i></i><i></i><i></i><i></i><i></i><i></i></div>
    <div class="voidwave-shards"><i></i><i></i><i></i><i></i><i></i><i></i></div>
    <div class="voidwave-spotlight"></div>
    <div class="voidwave-vignette"></div>
</div>
<div id="voidwave-controls">
    <button id="voidwave-back-to-top" type="button" aria-label="Back to top" title="Back to top">↑</button>
    <button id="voidwave-settings-toggle" type="button" aria-label="Open Voidwave appearance preferences" aria-expanded="false" aria-controls="voidwave-preferences">
        <span aria-hidden="true">✦</span><span>VOIDWAVE</span>
    </button>
    <section id="voidwave-preferences" aria-label="Voidwave appearance preferences" hidden>
        <header><div><strong>Appearance</strong><small>Saved on this device</small></div><span aria-hidden="true">✦</span></header>
        <div class="voidwave-option-list">
            <button type="button" data-voidwave-option="effects" aria-pressed="true"><span><b>Motion effects</b><small>Ambient movement and ripples</small></span><em class="voidwave-option-state">On</em></button>
            <button type="button" data-voidwave-option="compact" aria-pressed="false"><span><b>Compact density</b><small>Fit more information on screen</small></span><em class="voidwave-option-state">Off</em></button>
            <button type="button" data-voidwave-option="contrast" aria-pressed="false"><span><b>High contrast</b><small>Stronger borders and text</small></span><em class="voidwave-option-state">Off</em></button>
            <button type="button" data-voidwave-option="oled" aria-pressed="false"><span><b>OLED surfaces</b><small>True-black background and chrome</small></span><em class="voidwave-option-state">Off</em></button>
        </div>
        <fieldset><legend>Accent palette</legend><div class="voidwave-palettes">
            <button type="button" data-voidwave-palette="voidwave" role="radio" aria-label="Voidwave purple and cyan" aria-checked="true"><i></i><span>Voidwave</span></button>
            <button type="button" data-voidwave-palette="aurora" role="radio" aria-label="Aurora blue and teal" aria-checked="false"><i></i><span>Aurora</span></button>
            <button type="button" data-voidwave-palette="ember" role="radio" aria-label="Ember orange and red" aria-checked="false"><i></i><span>Ember</span></button>
            <button type="button" data-voidwave-palette="nebula" role="radio" aria-label="Nebula pink and violet" aria-checked="false"><i></i><span>Nebula</span></button>
        </div></fieldset>
        <fieldset><legend>Ambient intensity</legend><div class="voidwave-ambience-options">
            <button type="button" data-voidwave-ambience="calm" role="radio" aria-checked="false">Calm</button>
            <button type="button" data-voidwave-ambience="balanced" role="radio" aria-checked="true">Balanced</button>
            <button type="button" data-voidwave-ambience="vivid" role="radio" aria-checked="false">Vivid</button>
        </div></fieldset>
        <fieldset><legend>Surface style</legend><div class="voidwave-surface-options">
            <button type="button" data-voidwave-surface="glass" role="radio" aria-checked="true">Glass</button>
            <button type="button" data-voidwave-surface="solid" role="radio" aria-checked="false">Solid</button>
            <button type="button" data-voidwave-surface="crystal" role="radio" aria-checked="false">Crystal</button>
        </div></fieldset>
        <footer><button type="button" data-voidwave-diagnostics>Copy diagnostics</button><button type="button" data-voidwave-reset>Reset</button></footer>
        <small class="voidwave-shortcut">Shortcut: Alt + V</small>
    </section>
</div>
<div id="voidwave-toast" role="status" aria-live="polite"></div>
HTML);
    }

    public function boot(Panel $panel): void {}
}
