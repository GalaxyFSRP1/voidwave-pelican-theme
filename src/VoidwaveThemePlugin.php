<?php

namespace PhantomVoidTTV\VoidwaveTheme;

use App\Contracts\Plugins\HasPluginSettings;
use App\Traits\EnvironmentWriterTrait;
use Filament\Contracts\Plugin;
use Filament\Enums\ThemeMode;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Panel;
use Filament\Schemas\Components\Component;
use Filament\Support\Colors\Color;

class VoidwaveThemePlugin implements HasPluginSettings, Plugin
{
    use EnvironmentWriterTrait;
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

    /** @return array<string, mixed> */
    public function getSettingsFormData(): array
    {
        return [
            'allow_user_overrides' => config('voidwave-theme.allow_user_overrides', true),
            'sync_preferences' => config('voidwave-theme.sync_preferences', true),
            'show_controls' => config('voidwave-theme.show_controls', true),
            'default_effects' => config('voidwave-theme.defaults.effects', true),
            'default_compact' => config('voidwave-theme.defaults.compact', false),
            'default_contrast' => config('voidwave-theme.defaults.contrast', false),
            'default_oled' => config('voidwave-theme.defaults.oled', false),
            'default_cursor' => config('voidwave-theme.defaults.cursor', true),
            'default_floating' => config('voidwave-theme.defaults.floating', true),
            'default_palette' => config('voidwave-theme.defaults.palette', 'voidwave'),
            'default_ambience' => config('voidwave-theme.defaults.ambience', 'balanced'),
            'default_surface' => config('voidwave-theme.defaults.surface', 'glass'),
            'default_sky' => config('voidwave-theme.defaults.sky', 'normal'),
            'default_radius' => config('voidwave-theme.defaults.radius', 'soft'),
        ];
    }

    /** @return Component[] */
    public function getSettingsForm(): array
    {
        return [
            Toggle::make('allow_user_overrides')
                ->label('Allow user appearance overrides')
                ->helperText('When disabled, all users receive the administrator defaults.')
                ->inline(false),
            Toggle::make('sync_preferences')
                ->label('Synchronize preferences to user accounts')
                ->helperText('Lets signed-in users carry their Voidwave choices across devices.')
                ->inline(false),
            Toggle::make('show_controls')
                ->label('Show the Voidwave appearance button')
                ->inline(false),
            Toggle::make('default_effects')->label('Default motion effects')->inline(false),
            Toggle::make('default_compact')->label('Default compact density')->inline(false),
            Toggle::make('default_contrast')->label('Default high contrast')->inline(false),
            Toggle::make('default_oled')->label('Default OLED mode')->inline(false),
            Toggle::make('default_cursor')->label('Default cursor stardust')->inline(false),
            Toggle::make('default_floating')->label('Default floating interface accents')->inline(false),
            Select::make('default_palette')
                ->label('Default accent palette')
                ->options([
                    'voidwave' => 'Voidwave',
                    'aurora' => 'Aurora',
                    'ember' => 'Ember',
                    'nebula' => 'Nebula',
                ])
                ->required(),
            Select::make('default_ambience')
                ->label('Default ambient intensity')
                ->options([
                    'calm' => 'Calm',
                    'balanced' => 'Balanced',
                    'vivid' => 'Vivid',
                ])
                ->required(),
            Select::make('default_surface')
                ->label('Default surface style')
                ->options([
                    'glass' => 'Glass',
                    'solid' => 'Solid',
                    'crystal' => 'Crystal',
                ])
                ->required(),
            Select::make('default_sky')
                ->label('Default sky density')
                ->options([
                    'sparse' => 'Sparse',
                    'normal' => 'Normal',
                    'galaxy' => 'Galaxy',
                ])
                ->required(),
            Select::make('default_radius')
                ->label('Default corner style')
                ->options([
                    'sharp' => 'Sharp',
                    'soft' => 'Soft',
                    'round' => 'Round',
                ])
                ->required(),
        ];
    }

    /** @param array<mixed, mixed> $data */
    public function saveSettings(array $data): void
    {
        $this->writeToEnvironment([
            'VOIDWAVE_ALLOW_USER_OVERRIDES' => (bool) ($data['allow_user_overrides'] ?? true),
            'VOIDWAVE_SYNC_PREFERENCES' => (bool) ($data['sync_preferences'] ?? true),
            'VOIDWAVE_SHOW_CONTROLS' => (bool) ($data['show_controls'] ?? true),
            'VOIDWAVE_DEFAULT_EFFECTS' => (bool) ($data['default_effects'] ?? true),
            'VOIDWAVE_DEFAULT_COMPACT' => (bool) ($data['default_compact'] ?? false),
            'VOIDWAVE_DEFAULT_CONTRAST' => (bool) ($data['default_contrast'] ?? false),
            'VOIDWAVE_DEFAULT_OLED' => (bool) ($data['default_oled'] ?? false),
            'VOIDWAVE_DEFAULT_CURSOR' => (bool) ($data['default_cursor'] ?? true),
            'VOIDWAVE_DEFAULT_FLOATING' => (bool) ($data['default_floating'] ?? true),
            'VOIDWAVE_DEFAULT_PALETTE' => $data['default_palette'] ?? 'voidwave',
            'VOIDWAVE_DEFAULT_AMBIENCE' => $data['default_ambience'] ?? 'balanced',
            'VOIDWAVE_DEFAULT_SURFACE' => $data['default_surface'] ?? 'glass',
            'VOIDWAVE_DEFAULT_SKY' => $data['default_sky'] ?? 'normal',
            'VOIDWAVE_DEFAULT_RADIUS' => $data['default_radius'] ?? 'soft',
        ]);

        Notification::make()
            ->title('Voidwave defaults saved')
            ->body('New defaults apply immediately. Existing user overrides remain synchronized.')
            ->success()
            ->send();
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
    var syncTimer;
    var lastSparkle = 0;
    var hasLocalPreferences = false;
    var syncStatus = { authenticated: false, enabled: false, overrides: true, showControls: true, loaded: false, message: 'Loading preferences…' };
    var storageKey = 'voidwave-preferences-v5';
    var defaults = {
        effects: true,
        compact: false,
        contrast: false,
        oled: false,
        cursor: true,
        floating: true,
        palette: 'voidwave',
        ambience: 'balanced',
        surface: 'glass',
        sky: 'normal',
        radius: 'soft'
    };
    var preferences = Object.assign({}, defaults);

    function loadPreferences() {
        try {
            var saved = JSON.parse(localStorage.getItem(storageKey) || '{}');
            hasLocalPreferences = Object.keys(saved).length > 0;
            if (typeof saved.effects === 'boolean') preferences.effects = saved.effects;
            if (typeof saved.compact === 'boolean') preferences.compact = saved.compact;
            if (typeof saved.contrast === 'boolean') preferences.contrast = saved.contrast;
            if (typeof saved.oled === 'boolean') preferences.oled = saved.oled;
            if (typeof saved.cursor === 'boolean') preferences.cursor = saved.cursor;
            if (typeof saved.floating === 'boolean') preferences.floating = saved.floating;
            if (['voidwave', 'aurora', 'ember', 'nebula'].indexOf(saved.palette) !== -1) preferences.palette = saved.palette;
            if (['calm', 'balanced', 'vivid'].indexOf(saved.ambience) !== -1) preferences.ambience = saved.ambience;
            if (['glass', 'solid', 'crystal'].indexOf(saved.surface) !== -1) preferences.surface = saved.surface;
            if (['sparse', 'normal', 'galaxy'].indexOf(saved.sky) !== -1) preferences.sky = saved.sky;
            if (['sharp', 'soft', 'round'].indexOf(saved.radius) !== -1) preferences.radius = saved.radius;

            /* Migrate preferences from versions 1.1 through 1.5. */
            var legacyV4 = JSON.parse(localStorage.getItem('voidwave-preferences-v4') || '{}');
            var legacyV3 = JSON.parse(localStorage.getItem('voidwave-preferences-v3') || '{}');
            var legacyV2 = JSON.parse(localStorage.getItem('voidwave-preferences-v2') || '{}');
            var legacyV1 = JSON.parse(localStorage.getItem('voidwave-preferences-v1') || '{}');
            var legacy = Object.assign({}, legacyV1, legacyV2, legacyV3, legacyV4);
            if (!hasLocalPreferences && Object.keys(legacy).length > 0) hasLocalPreferences = true;
            ['effects', 'compact', 'contrast', 'oled', 'cursor', 'floating'].forEach(function (key) {
                if (typeof legacy[key] === 'boolean' && typeof saved[key] !== 'boolean') preferences[key] = legacy[key];
            });
            if (['voidwave', 'aurora', 'ember', 'nebula'].indexOf(legacy.palette) !== -1 && !saved.palette) preferences.palette = legacy.palette;
            if (['calm', 'balanced', 'vivid'].indexOf(legacy.ambience) !== -1 && !saved.ambience) preferences.ambience = legacy.ambience;
            if (['glass', 'solid', 'crystal'].indexOf(legacy.surface) !== -1 && !saved.surface) preferences.surface = legacy.surface;
            if (['sparse', 'normal', 'galaxy'].indexOf(legacy.sky) !== -1 && !saved.sky) preferences.sky = legacy.sky;
            if (['sharp', 'soft', 'round'].indexOf(legacy.radius) !== -1 && !saved.radius) preferences.radius = legacy.radius;
            if (localStorage.getItem('voidwave-effects') === 'off' && typeof saved.effects !== 'boolean') preferences.effects = false;
        } catch (e) {}
        applyPreferences();
    }

    function savePreferences(skipSync) {
        try {
            localStorage.setItem(storageKey, JSON.stringify(preferences));
            localStorage.removeItem('voidwave-effects');
            localStorage.removeItem('voidwave-preferences-v1');
            localStorage.removeItem('voidwave-preferences-v2');
            localStorage.removeItem('voidwave-preferences-v3');
            localStorage.removeItem('voidwave-preferences-v4');
            hasLocalPreferences = true;
        } catch (e) {}
        if (!skipSync) schedulePreferenceSync();
    }

    function mergeValidPreferences(base, incoming) {
        var next = Object.assign({}, base);
        if (!incoming || typeof incoming !== 'object') return next;
        ['effects', 'compact', 'contrast', 'oled', 'cursor', 'floating'].forEach(function (key) {
            if (typeof incoming[key] === 'boolean') next[key] = incoming[key];
        });
        if (['voidwave', 'aurora', 'ember', 'nebula'].indexOf(incoming.palette) !== -1) next.palette = incoming.palette;
        if (['calm', 'balanced', 'vivid'].indexOf(incoming.ambience) !== -1) next.ambience = incoming.ambience;
        if (['glass', 'solid', 'crystal'].indexOf(incoming.surface) !== -1) next.surface = incoming.surface;
        if (['sparse', 'normal', 'galaxy'].indexOf(incoming.sky) !== -1) next.sky = incoming.sky;
        if (['sharp', 'soft', 'round'].indexOf(incoming.radius) !== -1) next.radius = incoming.radius;
        return next;
    }

    function setSyncLabel(message) {
        syncStatus.message = message;
        var label = document.getElementById('voidwave-sync-state');
        if (label) label.textContent = message;
    }

    function getCookie(name) {
        var match = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([.$?*|{}()\[\]\\/+^])/g, '\\$1') + '=([^;]*)'));
        return match ? decodeURIComponent(match[1]) : '';
    }

    function schedulePreferenceSync() {
        if (!syncStatus.loaded || !syncStatus.authenticated || !syncStatus.enabled || !syncStatus.overrides) return;
        clearTimeout(syncTimer);
        setSyncLabel('Saving to account…');
        syncTimer = setTimeout(function () {
            var csrf = document.querySelector('meta[name="csrf-token"]');
            fetch('/voidwave/preferences', {
                method: 'PUT',
                credentials: 'same-origin',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf ? csrf.content : '',
                    'X-XSRF-TOKEN': getCookie('XSRF-TOKEN')
                },
                body: JSON.stringify(preferences)
            }).then(function (response) {
                if (!response.ok) throw new Error('Sync failed');
                setSyncLabel('Synced to your account');
            }).catch(function () {
                setSyncLabel('Saved on this device');
            });
        }, 450);
    }

    function resetSyncedPreferences() {
        if (!syncStatus.authenticated || !syncStatus.enabled || !syncStatus.overrides) {
            setSyncLabel('Using panel defaults');
            return;
        }

        var csrf = document.querySelector('meta[name="csrf-token"]');
        fetch('/voidwave/preferences', {
            method: 'DELETE',
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrf ? csrf.content : '',
                'X-XSRF-TOKEN': getCookie('XSRF-TOKEN')
            }
        }).then(function (response) {
            if (!response.ok) throw new Error('Reset failed');
            setSyncLabel('Using panel defaults');
        }).catch(function () {
            setSyncLabel('Reset on this device');
        });
    }

    function loadSyncedPreferences() {
        fetch('/voidwave/preferences', {
            credentials: 'same-origin',
            headers: { 'Accept': 'application/json' }
        }).then(function (response) {
            if (!response.ok) throw new Error('Preferences unavailable');
            return response.json();
        }).then(function (data) {
            syncStatus = {
                authenticated: !!data.authenticated,
                enabled: !!data.sync_preferences,
                overrides: !!data.allow_user_overrides,
                showControls: !!data.show_controls,
                loaded: true,
                message: syncStatus.message
            };

            defaults = mergeValidPreferences(defaults, data.defaults);
            var shouldUploadLocal = hasLocalPreferences;
            var followingDefaults = false;
            var toggle = document.getElementById('voidwave-settings-toggle');
            if (toggle) toggle.hidden = !syncStatus.showControls || !syncStatus.overrides;

            if (!syncStatus.overrides) {
                preferences = Object.assign({}, defaults);
                followingDefaults = true;
                setSyncLabel('Managed by administrator');
            } else if (data.preferences) {
                preferences = mergeValidPreferences(defaults, data.preferences);
                setSyncLabel('Synced to your account');
            } else if (!hasLocalPreferences) {
                preferences = Object.assign({}, defaults);
                followingDefaults = true;
                setSyncLabel('Using panel defaults');
            } else {
                setSyncLabel(syncStatus.authenticated && syncStatus.enabled ? 'Syncing this device…' : 'Saved on this device');
            }

            if (followingDefaults) {
                try { localStorage.removeItem(storageKey); } catch (e) {}
                hasLocalPreferences = false;
            } else {
                savePreferences(true);
            }
            applyPreferences();

            if (syncStatus.authenticated && syncStatus.enabled && syncStatus.overrides && !data.preferences && shouldUploadLocal) {
                schedulePreferenceSync();
            }
        }).catch(function () {
            syncStatus.loaded = true;
            setSyncLabel('Saved on this device');
        });
    }

    function applyPreferences() {
        root.classList.toggle('voidwave-static', !preferences.effects);
        root.classList.toggle('voidwave-compact', preferences.compact);
        root.classList.toggle('voidwave-high-contrast', preferences.contrast);
        root.classList.toggle('voidwave-oled', preferences.oled);
        root.classList.toggle('voidwave-no-float', !preferences.floating);
        root.setAttribute('data-voidwave-palette', preferences.palette);
        root.setAttribute('data-voidwave-ambience', preferences.ambience);
        root.setAttribute('data-voidwave-surface', preferences.surface);
        root.setAttribute('data-voidwave-sky', preferences.sky);
        root.setAttribute('data-voidwave-radius', preferences.radius);
        if (window.VoidwaveSky && window.VoidwaveSky.configure) window.VoidwaveSky.configure(preferences);
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

        panel.querySelectorAll('[data-voidwave-sky]').forEach(function (button) {
            var active = button.getAttribute('data-voidwave-sky') === preferences.sky;
            button.setAttribute('aria-checked', active ? 'true' : 'false');
        });

        panel.querySelectorAll('[data-voidwave-radius]').forEach(function (button) {
            var active = button.getAttribute('data-voidwave-radius') === preferences.radius;
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
        if (syncStatus.loaded) toggle.hidden = !syncStatus.showControls || !syncStatus.overrides;
        setSyncLabel(syncStatus.message);

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
            var skyButton = event.target.closest('[data-voidwave-sky]');
            var radiusButton = event.target.closest('[data-voidwave-radius]');
            var presetButton = event.target.closest('[data-voidwave-preset]');
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
            } else if (skyButton) {
                preferences.sky = skyButton.getAttribute('data-voidwave-sky');
                savePreferences();
                applyPreferences();
                showToast('Sky density updated');
            } else if (radiusButton) {
                preferences.radius = radiusButton.getAttribute('data-voidwave-radius');
                savePreferences();
                applyPreferences();
                showToast('Corner style updated');
            } else if (presetButton) {
                var preset = presetButton.getAttribute('data-voidwave-preset');
                if (preset === 'performance') Object.assign(preferences, { effects: false, cursor: false, floating: false, ambience: 'calm', surface: 'solid', sky: 'sparse', radius: 'sharp' });
                if (preset === 'balanced') Object.assign(preferences, { effects: true, cursor: true, floating: true, ambience: 'balanced', surface: 'glass', sky: 'normal', radius: 'soft' });
                if (preset === 'cinematic') Object.assign(preferences, { effects: true, cursor: true, floating: true, ambience: 'vivid', surface: 'crystal', sky: 'galaxy', radius: 'round' });
                savePreferences();
                applyPreferences();
                showToast(preset.charAt(0).toUpperCase() + preset.slice(1) + ' preset applied');
            } else if (resetButton) {
                preferences = Object.assign({}, defaults);
                try { localStorage.removeItem(storageKey); } catch (e) {}
                hasLocalPreferences = false;
                applyPreferences();
                resetSyncedPreferences();
                showToast('Using panel defaults');
            } else if (diagnosticsButton) {
                var details = 'Voidwave Theme 1.7.0 | palette=' + preferences.palette + ' | ambience=' + preferences.ambience + ' | surface=' + preferences.surface + ' | sky=' + preferences.sky + ' | radius=' + preferences.radius + ' | effects=' + preferences.effects + ' | cursor=' + preferences.cursor + ' | floating=' + preferences.floating + ' | compact=' + preferences.compact + ' | contrast=' + preferences.contrast + ' | oled=' + preferences.oled + ' | accountSync=' + syncStatus.enabled;
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
            if (event.altKey && event.key.toLowerCase() === 'v' && !toggle.hidden) {
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

    function initSkyEngine() {
        if (window.VoidwaveSky && window.VoidwaveSky.ready) return;
        var canvas = document.getElementById('voidwave-sky-canvas');
        if (!canvas || !canvas.getContext) return;

        var context = canvas.getContext('2d', { alpha: true });
        if (!context) return;

        var width = 0;
        var height = 0;
        var ratio = 1;
        var stars = [];
        var meteors = [];
        var skyPreferences = Object.assign({}, preferences);
        var pointer = { x: 0, y: 0 };
        var frame = 0;
        var previousTime = 0;
        var accumulated = 0;
        var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

        function palette() {
            var styles = getComputedStyle(root);
            return {
                primary: styles.getPropertyValue('--vw-purple').trim() || '#a855f7',
                cyan: styles.getPropertyValue('--vw-cyan').trim() || '#22d3ee',
                pink: styles.getPropertyValue('--vw-pink').trim() || '#f472b6'
            };
        }

        function resize() {
            width = Math.max(1, window.innerWidth);
            height = Math.max(1, window.innerHeight);
            ratio = Math.min(window.devicePixelRatio || 1, 1.75);
            canvas.width = Math.floor(width * ratio);
            canvas.height = Math.floor(height * ratio);
            canvas.style.width = width + 'px';
            canvas.style.height = height + 'px';
            context.setTransform(ratio, 0, 0, ratio, 0, 0);
            rebuild();
        }

        function rebuild() {
            var count = skyPreferences.sky === 'sparse' ? 55 : (skyPreferences.sky === 'galaxy' ? 190 : 105);
            if (width < 700) count = Math.round(count * .58);
            stars = Array.from({ length: count }, function (_, index) {
                return {
                    x: Math.random(),
                    y: Math.random(),
                    depth: .25 + Math.random() * .75,
                    size: .45 + Math.random() * 1.65,
                    phase: Math.random() * Math.PI * 2,
                    speed: .35 + Math.random() * 1.25,
                    color: index % 17 === 0 ? 'cyan' : (index % 29 === 0 ? 'pink' : 'white')
                };
            });
            draw(performance.now(), true);
        }

        function spawnMeteor() {
            var colors = palette();
            meteors.push({
                x: width * (.45 + Math.random() * .7),
                y: -30 + Math.random() * height * .42,
                vx: -(520 + Math.random() * 520),
                vy: 230 + Math.random() * 330,
                life: 0,
                maxLife: .8 + Math.random() * .75,
                width: .8 + Math.random() * 1.4,
                color: Math.random() > .72 ? colors.cyan : '#ffffff'
            });
        }

        function draw(time, force) {
            var fps = skyPreferences.ambience === 'vivid' ? 50 : (skyPreferences.ambience === 'calm' ? 20 : 30);
            var interval = 1000 / fps;
            var elapsed = previousTime ? Math.min(80, time - previousTime) : interval;
            previousTime = time;
            accumulated += elapsed;

            var animated = skyPreferences.effects && !reducedMotion.matches && !document.hidden && !root.classList.contains('voidwave-data-saver');
            if (!force && animated && accumulated < interval) {
                frame = requestAnimationFrame(draw);
                return;
            }

            var dt = Math.max(.001, accumulated / 1000);
            accumulated = 0;
            context.clearRect(0, 0, width, height);
            var colors = palette();
            var parallaxX = pointer.x * 13;
            var parallaxY = pointer.y * 9;

            if (skyPreferences.sky === 'galaxy' && stars.length >= 8) {
                context.beginPath();
                context.strokeStyle = colors.cyan + '18';
                context.lineWidth = .6;
                for (var c = 0; c < 7; c++) {
                    var first = stars[c];
                    var second = stars[c + 1];
                    context.moveTo(first.x * width, first.y * height);
                    context.lineTo(second.x * width, second.y * height);
                }
                context.stroke();
            }

            stars.forEach(function (star) {
                var twinkle = animated ? .58 + Math.sin(time * .001 * star.speed + star.phase) * .3 : .72;
                var x = star.x * width + parallaxX * star.depth;
                var y = star.y * height + parallaxY * star.depth;
                var radius = star.size * (.55 + star.depth * .6);
                context.globalAlpha = Math.max(.12, twinkle) * (.45 + star.depth * .5);
                context.fillStyle = star.color === 'cyan' ? colors.cyan : (star.color === 'pink' ? colors.pink : '#ffffff');
                context.beginPath();
                context.arc(x, y, radius, 0, Math.PI * 2);
                context.fill();
                if (radius > 1.35) {
                    context.globalAlpha *= .22;
                    context.fillRect(x - radius * 3, y - .35, radius * 6, .7);
                    context.fillRect(x - .35, y - radius * 3, .7, radius * 6);
                }
            });
            context.globalAlpha = 1;

            if (animated) {
                var chance = skyPreferences.sky === 'galaxy' ? .012 : (skyPreferences.sky === 'sparse' ? .002 : .005);
                if (Math.random() < chance * dt * 60 && meteors.length < 3) spawnMeteor();
            }

            meteors = meteors.filter(function (meteor) {
                meteor.life += dt;
                meteor.x += meteor.vx * dt;
                meteor.y += meteor.vy * dt;
                var alpha = Math.sin(Math.min(1, meteor.life / meteor.maxLife) * Math.PI);
                var tailX = meteor.x - meteor.vx * .15;
                var tailY = meteor.y - meteor.vy * .15;
                var gradient = context.createLinearGradient(meteor.x, meteor.y, tailX, tailY);
                gradient.addColorStop(0, meteor.color);
                gradient.addColorStop(1, 'transparent');
                context.globalAlpha = alpha;
                context.strokeStyle = gradient;
                context.lineWidth = meteor.width;
                context.beginPath();
                context.moveTo(meteor.x, meteor.y);
                context.lineTo(tailX, tailY);
                context.stroke();
                context.globalAlpha = 1;
                return meteor.life < meteor.maxLife && meteor.x > -250 && meteor.y < height + 150;
            });

            if (animated) frame = requestAnimationFrame(draw);
        }

        function configure(next) {
            var oldSky = skyPreferences.sky;
            skyPreferences = Object.assign({}, next);
            if (oldSky !== skyPreferences.sky || !stars.length) rebuild();
            cancelAnimationFrame(frame);
            previousTime = 0;
            accumulated = 0;
            draw(performance.now(), true);
        }

        window.VoidwaveSky = {
            ready: true,
            configure: configure,
            pointer: function (event) {
                pointer.x = event.clientX / Math.max(1, width) - .5;
                pointer.y = event.clientY / Math.max(1, height) - .5;
            },
            wake: function () { configure(skyPreferences); }
        };

        root.classList.add('voidwave-canvas-ready');
        window.addEventListener('resize', resize, { passive: true });
        reducedMotion.addEventListener('change', function () { configure(skyPreferences); });
        resize();
        configure(preferences);
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
    loadSyncedPreferences();

    function syncPageVisibility() {
        root.classList.toggle('voidwave-page-hidden', document.hidden);
        if (!document.hidden && window.VoidwaveSky && window.VoidwaveSky.wake) window.VoidwaveSky.wake();
    }
    document.addEventListener('visibilitychange', syncPageVisibility);
    syncPageVisibility();

    var connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
    if (connection && connection.saveData) root.classList.add('voidwave-data-saver');

    document.addEventListener('pointermove', function (event) {
        if (window.VoidwaveSky && window.VoidwaveSky.pointer) window.VoidwaveSky.pointer(event);
        if (!preferences.effects) return;

        if (preferences.floating && preferences.ambience === 'vivid' && window.matchMedia('(pointer: fine)').matches) {
            var tiltCard = event.target.closest('.fi-wi-stats-overview-stat, .fi-section:not(.fi-section-not-contained)');
            if (tiltCard) {
                var tiltRect = tiltCard.getBoundingClientRect();
                var rotateY = ((event.clientX - tiltRect.left) / Math.max(1, tiltRect.width) - .5) * 2.4;
                var rotateX = -((event.clientY - tiltRect.top) / Math.max(1, tiltRect.height) - .5) * 2.1;
                tiltCard.style.setProperty('--vw-tilt-x', rotateX.toFixed(2) + 'deg');
                tiltCard.style.setProperty('--vw-tilt-y', rotateY.toFixed(2) + 'deg');
                tiltCard.classList.add('voidwave-tilting');
            }
        }

        var now = Date.now();
        if (preferences.cursor && preferences.ambience === 'vivid' && now - lastSparkle > 85 && window.matchMedia('(pointer: fine)').matches) {
            lastSparkle = now;
            var sparkle = document.createElement('i');
            sparkle.className = 'voidwave-cursor-sparkle';
            sparkle.style.left = event.clientX + 'px';
            sparkle.style.top = event.clientY + 'px';
            sparkle.style.setProperty('--vw-spark-x', ((Math.random() - .5) * 34) + 'px');
            sparkle.style.setProperty('--vw-spark-y', (12 + Math.random() * 24) + 'px');
            document.body.appendChild(sparkle);
            setTimeout(function () { sparkle.remove(); }, 760);
        }

        if (pointerFrame) return;
        pointerFrame = requestAnimationFrame(function () {
            root.style.setProperty('--vw-pointer-x', event.clientX + 'px');
            root.style.setProperty('--vw-pointer-y', event.clientY + 'px');
            pointerFrame = null;
        });
    }, { passive: true });

    document.addEventListener('pointerout', function (event) {
        var card = event.target.closest && event.target.closest('.voidwave-tilting');
        if (card && (!event.relatedTarget || !card.contains(event.relatedTarget))) {
            card.classList.remove('voidwave-tilting');
            card.style.removeProperty('--vw-tilt-x');
            card.style.removeProperty('--vw-tilt-y');
        }
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

    document.addEventListener('livewire:init', function () {
        if (!window.Livewire || window.__voidwaveProfileHook) return;
        window.__voidwaveProfileHook = true;
        window.Livewire.hook('commit', function (payload) {
            payload.succeed(function () {
                if (/profile/i.test(window.location.pathname)) setTimeout(loadSyncedPreferences, 80);
            });
        });
    });
    document.addEventListener('livewire:navigating', startProgress);
    document.addEventListener('livewire:navigated', finishProgress);
    document.addEventListener('turbo:before-visit', startProgress);
    document.addEventListener('turbo:load', finishProgress);
    window.addEventListener('pageshow', finishProgress);
    function bootVoidwaveUi() {
        setupControls();
        initSkyEngine();
    }
    if (document.readyState === 'loading') {
        window.addEventListener('DOMContentLoaded', bootVoidwaveUi);
    } else {
        bootVoidwaveUi();
    }

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
    <canvas id="voidwave-sky-canvas"></canvas>
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
        <header><div><strong>Appearance</strong><small id="voidwave-sync-state">Loading preferences…</small></div><span aria-hidden="true">✦</span></header>
        <div class="voidwave-presets" aria-label="Quick appearance presets">
            <button type="button" data-voidwave-preset="performance"><b>Performance</b><small>Low GPU</small></button>
            <button type="button" data-voidwave-preset="balanced"><b>Balanced</b><small>Recommended</small></button>
            <button type="button" data-voidwave-preset="cinematic"><b>Cinematic</b><small>Maximum void</small></button>
        </div>
        <div class="voidwave-option-list">
            <button type="button" data-voidwave-option="effects" aria-pressed="true"><span><b>Motion effects</b><small>Ambient movement and ripples</small></span><em class="voidwave-option-state">On</em></button>
            <button type="button" data-voidwave-option="compact" aria-pressed="false"><span><b>Compact density</b><small>Fit more information on screen</small></span><em class="voidwave-option-state">Off</em></button>
            <button type="button" data-voidwave-option="contrast" aria-pressed="false"><span><b>High contrast</b><small>Stronger borders and text</small></span><em class="voidwave-option-state">Off</em></button>
            <button type="button" data-voidwave-option="oled" aria-pressed="false"><span><b>OLED surfaces</b><small>True-black background and chrome</small></span><em class="voidwave-option-state">Off</em></button>
            <button type="button" data-voidwave-option="cursor" aria-pressed="true"><span><b>Cursor stardust</b><small>Interactive particles in Vivid mode</small></span><em class="voidwave-option-state">On</em></button>
            <button type="button" data-voidwave-option="floating" aria-pressed="true"><span><b>Floating accents</b><small>Portal, shards, icons, and widgets</small></span><em class="voidwave-option-state">On</em></button>
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
        <fieldset><legend>Sky density</legend><div class="voidwave-sky-options">
            <button type="button" data-voidwave-sky="sparse" role="radio" aria-checked="false">Sparse</button>
            <button type="button" data-voidwave-sky="normal" role="radio" aria-checked="true">Normal</button>
            <button type="button" data-voidwave-sky="galaxy" role="radio" aria-checked="false">Galaxy</button>
        </div></fieldset>
        <fieldset><legend>Corner style</legend><div class="voidwave-radius-options">
            <button type="button" data-voidwave-radius="sharp" role="radio" aria-checked="false">Sharp</button>
            <button type="button" data-voidwave-radius="soft" role="radio" aria-checked="true">Soft</button>
            <button type="button" data-voidwave-radius="round" role="radio" aria-checked="false">Round</button>
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
