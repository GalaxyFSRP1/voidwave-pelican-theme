# Changelog

## 1.10.0 — Cosmic Persistence

- Fixed preferences not visually restoring after browser Back and Forward navigation
- Added forced no-cache account-preference requests and private `no-store` API responses
- Added preference refresh on bfcache restore, `popstate`, Livewire navigation, and Turbo navigation
- Added Clear Void, Aurora Storm, and Meteor Storm synchronized cosmic-weather profiles
- Meteor Storm increases procedural meteor frequency while Aurora Storm boosts volumetric color
- Added an animated Supernova scene with a hot stellar core, expanding gas shell, diffraction rays, and palette-aware bloom
- Added a brief hyperspace treatment during panel navigation
- Added six-particle click starbursts in Vivid mode
- Added administrator and native profile controls for cosmic weather and Supernova
- Expanded diagnostics, validation, migration, account sync, and presets for all new options
- Added automatic migration from v1.1 through v1.9 preferences
- Bumped plugin and updater manifests to 1.10.0

## 1.9.0 — Event Horizon

- Added a synchronized Subtle, Normal, and Intense glow profile
- Added administrator and profile controls for glow intensity
- Added a gravitationally lensed Black Hole celestial scene
- Added a layered palette-aware accretion disk, event horizon, lensing glow, and rotating gas detail
- Added automatic portal suppression while the Black Hole scene is active
- Added warm star color temperatures to the procedural night sky
- Added slow travelling highlights to active navigation items
- Added short spring-like focus arrival animations to form controls
- Added a native confirmed **Reset to administrator defaults** action on Profile → Voidwave
- Expanded preference validation, account sync, diagnostics, presets, and migration for the new options
- Added automatic migration from v1.1 through v1.8 preferences
- Bumped plugin and updater manifests to 1.9.0

## 1.8.0 — Celestial Profiles

- Removed the floating Voidwave launcher shown in the lower-right corner
- Made **Profile → Voidwave** the single native user-customization location
- Kept administrator defaults under **Admin → Plugins → Voidwave Theme → Settings**
- Added None, Void Eclipse, and Ringed World celestial scenes
- Added a realistic palette-aware eclipse corona and rotating atmospheric glow
- Added a shaded ringed planet with layered rings and depth lighting
- Added slow palette-aware aurora curtains behind the interface
- Added Slow, Normal, and Fast animation-speed profiles
- Applied animation speed to the procedural canvas, nebulae, celestial body, aurora, and floating orbs
- Improved the optional legacy drawer with a close button and cleaner responsive controls, while keeping it disabled
- Added synchronized scene and speed preferences to the native profile section and administrator defaults
- Expanded Balanced, Performance, and Cinematic presets with scene and speed choices
- Added automatic migration from v1.1 through v1.7 preferences
- Bumped plugin and updater manifests to 1.8.0

## 1.7.0 — Living Night Sky

- Added a hardware-accelerated procedural canvas star field
- Added depth-aware twinkling, bright-star flares, pointer parallax, and palette-aware star colors
- Added randomized shooting stars with natural velocity, lifetime, glow, and fading trails
- Added subtle generated constellation lines in Galaxy sky mode
- Added adaptive 20, 30, and 50 FPS rendering based on ambient intensity
- Added static rendering for reduced motion, data-saving mode, disabled effects, and background tabs
- Preserved the layered CSS sky as a graceful no-canvas fallback
- Added cinematic pointer-based card tilt in Vivid mode
- Added realistic status-light breathing and slow dashboard surface sweeps
- Added a native **Voidwave** section to the Pelican profile page
- Added native profile controls for every synchronized user preference
- Added automatic live refresh after profile preference changes
- Kept administrator defaults on the official plugin settings page
- Bumped plugin and updater manifests to 1.7.0

## 1.6.0 — Void Command Center

- Added one-click Performance, Balanced, and Cinematic appearance presets
- Added independent Sparse, Normal, and Galaxy sky-density controls
- Added Sharp, Soft, and Round corner profiles across cards, dialogs, inputs, buttons, tabs, and navigation
- Added separate synchronized controls for cursor stardust and floating interface accents
- Added administrator defaults for cursor effects, floating accents, sky density, and corner style
- Added automatic browser reduced-data detection that disables expensive background layers and blur
- Added compact handling for short-height displays and a scrollable appearance center
- Expanded account synchronization and diagnostics to all new options
- Added automatic migration from v1.1 through v1.5 preferences
- Bumped plugin and updater manifests to 1.6.0

## 1.5.0 — Synced Across the Void

- Added an official Pelican plugin settings page for administrator defaults
- Added per-account preference synchronization across browsers and devices
- Added administrator controls for user overrides, synchronization, and appearance-button visibility
- Stored synchronized choices safely in Pelican's existing user customization data without a new database table
- Added automatic local-to-account preference migration and offline/local fallback
- Added visible sync states: loading, device-only, syncing, account-synced, panel defaults, and administrator-managed
- Added a protected preference API with validation, authentication, CSRF protection, and rate limiting
- Added Vivid-mode cursor stardust on precise-pointer devices
- Added automatic migration from v1.1 through v1.4 preference formats
- Bumped plugin and updater manifests to 1.5.0

## 1.4.0 — Reliable Releases

- Added a much richer layered night sky with nebula clouds and parallax stardust
- Expanded the shooting-star system to seven staggered paths
- Added a distant animated void portal with three energy rings
- Added floating crystalline debris across the background
- Added optional gently floating dashboard widgets in Vivid ambience mode
- Added Glass, Solid, and Crystal surface profiles
- Added a lower-GPU solid mode that removes expensive backdrop blur
- Added automatic animation pausing while the browser tab is hidden
- Added reduced-transparency, forced-colors, and print styles
- Expanded styling for callouts, markdown, split layouts, and error pages
- Added automatic migration from v1.1 through v1.3 preferences
- Added a tag-driven GitHub Actions release workflow
- The release workflow validates versions and URLs, builds the correctly named install ZIP, tests it, generates a checksum, and publishes both assets automatically
- Bumped plugin and updater manifests to 1.4.0

## 1.3.0 — Display Profiles

- Added OLED mode with true-black backgrounds, navigation, and content surfaces
- Added calm, balanced, and vivid ambient intensity profiles
- Added the Nebula pink/violet/blue accent palette
- Added `Alt + V` as an accessible appearance-center shortcut
- Added non-intrusive confirmation toasts for preference changes
- Added copyable, privacy-safe theme diagnostics for support requests
- Added automatic migration from both v1.1 and v1.2 preference formats
- Expanded styling for wizards, repeaters, calendars, table headers, and global search
- Improved the appearance center on narrow and short mobile screens
- Bumped plugin and updater manifests to 1.3.0

## 1.2.0 — Personalize the Void

- Replaced the basic FX switch with an accessible appearance center
- Added persistent compact-density and high-contrast modes
- Added Voidwave, Aurora, and Ember accent palettes
- Added one-click reset and automatic migration of v1.1 preferences
- Added a smart back-to-top control for long pages
- Added subtle page-entry transitions for Livewire-rendered pages
- Improved uploads, accordions, record selection, and mobile controls
- Added keyboard dismissal, click-outside handling, focus management, and ARIA state synchronization
- Kept all preferences private in browser local storage with no external requests
- Bumped plugin and updater manifests to 1.2.0

## 1.1.0 — Enhanced Void

- Added pointer-reactive ambient spotlight on precise-pointer devices
- Added animated shooting comets to the global background
- Added interaction ripples to buttons, navigation, tabs, and dropdown actions
- Added a top loading indicator for Livewire, Turbo, and standard navigation
- Added an accessibility-friendly FX toggle that persists locally
- Added animated notification entrance and status glow treatments
- Added skeleton loading shimmer and improved empty-state styling
- Added richer server status, badge, tooltip, pagination, and breadcrumb styling
- Added mobile-specific performance reductions
- Updated project and updater URLs to GalaxyFSRP1/voidwave-pelican-theme

## 1.0.0 — Initial release

- Initial animated Voidwave theme
- Admin, app, server, authentication, console, table, form, and modal coverage
