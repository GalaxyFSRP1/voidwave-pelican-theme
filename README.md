# Voidwave Theme for Pelican Panel

An animated, neon-glass Pelican Panel theme by **PhantomVoidTTV**.

**Repository:** https://github.com/GalaxyFSRP1/voidwave-pelican-theme

Voidwave wraps the entire panel in a deep-space purple/cyan look with drifting aurora orbs, a perspective grid, twinkling stars, glowing navigation, glass cards, animated headings, polished forms, and enhanced console styling.

## Features

- Applies to all standard Pelican panels: `admin`, `app`, and `server`
- Covers login/simple pages, dashboards, server pages, console, tables, forms, dialogs, dropdowns, notifications, and navigation
- Pointer-reactive ambient spotlight on desktop
- Procedural canvas night sky with depth-aware stars, natural twinkling, cross-shaped bright stars, pointer parallax, and adaptive frame rates
- Physically animated shooting stars with randomized origins, speed, lifetime, color, brightness, and fading trails
- Galaxy-mode constellation lines generated from the procedural star field
- Layered CSS fallback sky with twinkling stars, parallax stardust, colored nebula clouds, and a perspective grid
- Distant animated void portal with orbiting energy rings
- Floating crystalline void shards and optional floating dashboard widgets in Vivid mode
- Interaction ripples on buttons, tabs, menus, and navigation
- Top loading indicator for Livewire, Turbo, and normal panel navigation
- Native Profile → Voidwave customization section with synchronized motion, density, contrast, OLED, palette, ambience, scene, speed, and surface preferences
- Per-account preference synchronization across browsers and devices
- Administrator defaults and an official Pelican plugin settings page
- Optional administrator lock, sync toggle, and appearance-button visibility control
- One-click Performance, Balanced, and Cinematic presets
- Independent Sparse, Normal, and Galaxy sky-density profiles
- Sharp, Soft, and Round corner profiles
- Separate cursor-stardust and floating-accent controls
- Automatic reduced-data performance mode when the browser requests data saving
- Adaptive 20/30/50 FPS sky rendering for Calm, Balanced, and Vivid modes
- Cinematic pointer-based 3D card tilt on precise-pointer devices
- Realistic server-status breathing lights and slow surface-light sweeps
- Dedicated **Voidwave** section on the Pelican profile customization page
- Four switchable palettes: **Voidwave**, **Aurora**, **Ember**, and **Nebula**
- Calm, balanced, and vivid ambience intensity levels
- Glass, Solid, and Crystal surface profiles
- Optional OLED profile with true-black backgrounds and chrome
- Automatic effect pausing while the browser tab is hidden
- Print, forced-colors, and reduced-transparency support
- Copyable theme diagnostics for support requests
- Smart back-to-top control for long administration and server pages
- Enhanced badges, notifications, tooltips, pagination, skeleton loaders, uploads, accordions, wizards, repeaters, calendars, search, and empty states
- No remote fonts, trackers, libraries, or image dependencies
- Dark mode is forced so every component stays legible and consistent
- Responsive design with reduced visual load on touch/mobile devices
- Honors `prefers-reduced-motion` and `prefers-contrast`
- MIT licensed and ready to publish on Pelican Hub

## Install

1. Download `voidwave-theme.zip`.
2. Sign in to the Pelican Panel admin area.
3. Open **Plugins**.
4. Select **Import from File**.
5. Upload the ZIP, complete installation, and enable **Voidwave Theme**.
6. If prompted, rebuild panel assets and clear the application cache.

The ZIP must contain `plugin.json` at its root. The release archive is already packaged this way.

## Compatibility

Voidwave uses Pelican's current Filament plugin, render hook, and Vite theme APIs. It lists all three standard panels in `plugin.json`. Avoid enabling multiple theme plugins simultaneously because themes can compete for the same Filament theme slot.

## User appearance controls

The old floating **VOIDWAVE** launcher has been removed. Users now configure the theme from the native **Profile → Voidwave** section. Available synchronized controls include:

- Motion effects, cursor stardust, and floating accents
- Compact density, stronger contrast, and OLED mode
- Voidwave, Aurora, Ember, and Nebula palettes
- Calm, Balanced, and Vivid ambience
- Glass, Solid, and Crystal surfaces
- Sparse, Normal, and Galaxy sky density
- Sharp, Soft, and Round corners
- None, Void Eclipse, Ringed World, and Black Hole celestial scenes
- Slow, Normal, and Fast animation speeds
- Subtle, Normal, and Intense glow intensity
- A confirmed reset action that returns every option to administrator defaults
- Subtle, Normal, and Intense synchronized glow profiles
- None, Void Eclipse, Ringed World, and gravitationally lensed Black Hole scenes
- Native reset-to-administrator-defaults action with confirmation

Changes save directly to the signed-in Pelican account and refresh the active theme. Version 1.9 automatically migrates preferences from versions 1.1 through 1.8.

## Administrator defaults and user customization

Open **Admin → Plugins → Voidwave Theme → Settings** to configure panel-wide defaults. Administrators can choose the default state of every appearance option, allow or lock user overrides, and enable or disable account synchronization.

Users configure the synchronized options under **Profile → Voidwave**. The dedicated profile section uses native Filament controls and saves each change directly to the signed-in Pelican account.

When synchronization is enabled, authenticated preferences are stored inside Pelican's existing user `customization` data under the isolated `voidwave` key. No new database table or external service is required. Login and logged-out pages use the administrator defaults with a local browser fallback.

## Pelican Hub listing

**Name:** Voidwave Theme  
**Category:** Themes  
**Author:** PhantomVoidTTV  
**Version:** 1.9.0  
**License:** MIT

**Short description:**

> Enter the Voidwave: an interactive purple-and-cyan glass theme for every Pelican Panel page.

**Full description:**

> Voidwave transforms Pelican Panel with a rich deep-space interface, animated aurora lighting, twinkling stars, shooting comets, a drifting perspective grid, pointer-reactive glow, glass surfaces, glowing navigation, and interaction ripples. Its native Profile → Voidwave section gives every user synchronized motion, density, contrast, OLED, ambience, surface, sky, celestial-scene, speed, and four-palette controls, with administrator-managed defaults. It themes the admin, app, and server panels—including authentication, dashboards, forms, tables, dialogs, uploads, file views, wizards, calendars, and console chrome. No external assets or tracking are used, and motion automatically reduces when requested by the operating system.

Suggested tags: `theme`, `dark`, `animated`, `interactive`, `neon`, `purple`, `cyan`, `glass`

## Publishing checklist

1. Push this source tree to `GalaxyFSRP1/voidwave-pelican-theme` on the `main` branch.
2. Push the tag `v1.9.0` (lowercase `v`).
3. Let `.github/workflows/release.yml` create the release and attach `voidwave-theme.zip` automatically.
4. Capture clean screenshots of login, dashboard, server overview, and console pages on a test panel.
5. Submit the plugin on Pelican Hub using the listing copy above.
6. Test the Hub-downloaded ZIP on a fresh/current Pelican Panel before publishing.

## Development validation

From the Pelican Panel root, place this repository at `plugins/voidwave-theme`, then run:

```bash
php -l plugins/voidwave-theme/src/VoidwaveThemePlugin.php
yarn build
```

See [CHANGELOG.md](CHANGELOG.md) for release details.

## License

Copyright © 2026 PhantomVoidTTV. Released under the MIT License.
