<?php

return [
    'allow_user_overrides' => filter_var(env('VOIDWAVE_ALLOW_USER_OVERRIDES', true), FILTER_VALIDATE_BOOL),
    'sync_preferences' => filter_var(env('VOIDWAVE_SYNC_PREFERENCES', true), FILTER_VALIDATE_BOOL),
    'show_controls' => filter_var(env('VOIDWAVE_SHOW_CONTROLS', true), FILTER_VALIDATE_BOOL),

    'defaults' => [
        'effects' => filter_var(env('VOIDWAVE_DEFAULT_EFFECTS', true), FILTER_VALIDATE_BOOL),
        'compact' => filter_var(env('VOIDWAVE_DEFAULT_COMPACT', false), FILTER_VALIDATE_BOOL),
        'contrast' => filter_var(env('VOIDWAVE_DEFAULT_CONTRAST', false), FILTER_VALIDATE_BOOL),
        'oled' => filter_var(env('VOIDWAVE_DEFAULT_OLED', false), FILTER_VALIDATE_BOOL),
        'palette' => env('VOIDWAVE_DEFAULT_PALETTE', 'voidwave'),
        'ambience' => env('VOIDWAVE_DEFAULT_AMBIENCE', 'balanced'),
        'surface' => env('VOIDWAVE_DEFAULT_SURFACE', 'glass'),
    ],
];
