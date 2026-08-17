# Changelog

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
