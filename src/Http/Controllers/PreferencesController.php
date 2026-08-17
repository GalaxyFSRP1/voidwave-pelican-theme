<?php

namespace PhantomVoidTTV\VoidwaveTheme\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;

class PreferencesController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        $preferences = null;
        $user = $request->user();

        if ($user && config('voidwave-theme.sync_preferences', true)) {
            $customization = is_string($user->customization)
                ? json_decode($user->customization, true)
                : ($user->customization ?? []);

            $preferences = $customization['voidwave'] ?? null;
        }

        return response()->json([
            'version' => '1.10.0',
            'authenticated' => $user !== null,
            'allow_user_overrides' => (bool) config('voidwave-theme.allow_user_overrides', true),
            'sync_preferences' => (bool) config('voidwave-theme.sync_preferences', true),
            'show_controls' => false,
            'defaults' => $this->defaults(),
            'preferences' => is_array($preferences) ? $preferences : null,
        ])->header('Cache-Control', 'no-store, private, max-age=0');
    }

    public function update(Request $request): JsonResponse
    {
        abort_unless(config('voidwave-theme.allow_user_overrides', true), 403, 'User appearance overrides are disabled.');
        abort_unless(config('voidwave-theme.sync_preferences', true), 409, 'Preference synchronization is disabled.');

        $validated = $request->validate([
            'effects' => ['required', 'boolean'],
            'compact' => ['required', 'boolean'],
            'contrast' => ['required', 'boolean'],
            'oled' => ['required', 'boolean'],
            'cursor' => ['required', 'boolean'],
            'floating' => ['required', 'boolean'],
            'palette' => ['required', Rule::in(['voidwave', 'aurora', 'ember', 'nebula'])],
            'ambience' => ['required', Rule::in(['calm', 'balanced', 'vivid'])],
            'surface' => ['required', Rule::in(['glass', 'solid', 'crystal'])],
            'sky' => ['required', Rule::in(['sparse', 'normal', 'galaxy'])],
            'radius' => ['required', Rule::in(['sharp', 'soft', 'round'])],
            'scene' => ['required', Rule::in(['none', 'eclipse', 'rings', 'blackhole', 'supernova'])],
            'speed' => ['required', Rule::in(['slow', 'normal', 'fast'])],
            'glow' => ['required', Rule::in(['subtle', 'normal', 'intense'])],
            'weather' => ['required', Rule::in(['clear', 'aurora', 'meteor'])],
        ]);

        $user = $request->user();
        $customization = is_string($user->customization)
            ? json_decode($user->customization, true)
            : ($user->customization ?? []);

        $customization['voidwave'] = array_replace($this->defaults(), $validated);
        $user->customization = $customization;
        $user->save();

        return response()->json([
            'saved' => true,
            'preferences' => $customization['voidwave'],
        ])->header('Cache-Control', 'no-store, private, max-age=0');
    }

    public function destroy(Request $request): JsonResponse
    {
        abort_unless(config('voidwave-theme.allow_user_overrides', true), 403, 'User appearance overrides are disabled.');

        $user = $request->user();
        $customization = is_string($user->customization)
            ? json_decode($user->customization, true)
            : ($user->customization ?? []);

        unset($customization['voidwave']);
        $user->customization = $customization;
        $user->save();

        return response()->json([
            'reset' => true,
            'preferences' => $this->defaults(),
        ]);
    }

    /** @return array<string, bool|string> */
    private function defaults(): array
    {
        $defaults = config('voidwave-theme.defaults', []);

        return [
            'effects' => (bool) ($defaults['effects'] ?? true),
            'compact' => (bool) ($defaults['compact'] ?? false),
            'contrast' => (bool) ($defaults['contrast'] ?? false),
            'oled' => (bool) ($defaults['oled'] ?? false),
            'cursor' => (bool) ($defaults['cursor'] ?? true),
            'floating' => (bool) ($defaults['floating'] ?? true),
            'palette' => in_array($defaults['palette'] ?? null, ['voidwave', 'aurora', 'ember', 'nebula'], true) ? $defaults['palette'] : 'voidwave',
            'ambience' => in_array($defaults['ambience'] ?? null, ['calm', 'balanced', 'vivid'], true) ? $defaults['ambience'] : 'balanced',
            'surface' => in_array($defaults['surface'] ?? null, ['glass', 'solid', 'crystal'], true) ? $defaults['surface'] : 'glass',
            'sky' => in_array($defaults['sky'] ?? null, ['sparse', 'normal', 'galaxy'], true) ? $defaults['sky'] : 'normal',
            'radius' => in_array($defaults['radius'] ?? null, ['sharp', 'soft', 'round'], true) ? $defaults['radius'] : 'soft',
            'scene' => in_array($defaults['scene'] ?? null, ['none', 'eclipse', 'rings', 'blackhole', 'supernova'], true) ? $defaults['scene'] : 'eclipse',
            'speed' => in_array($defaults['speed'] ?? null, ['slow', 'normal', 'fast'], true) ? $defaults['speed'] : 'normal',
            'glow' => in_array($defaults['glow'] ?? null, ['subtle', 'normal', 'intense'], true) ? $defaults['glow'] : 'normal',
            'weather' => in_array($defaults['weather'] ?? null, ['clear', 'aurora', 'meteor'], true) ? $defaults['weather'] : 'clear',
        ];
    }
}
