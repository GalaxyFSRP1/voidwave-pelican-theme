# Voidwave Theme for Pelican Panel

An animated, neon-glass Pelican Panel theme by **PhantomVoidTTV**.

**Repository:** https://github.com/GalaxyFSRP1/voidwave-pelican-theme

Voidwave wraps the entire panel in a deep-space purple/cyan look with drifting aurora orbs, a perspective grid, twinkling stars, glowing navigation, glass cards, animated headings, polished forms, and enhanced console styling.

## Features

- Applies to all standard Pelican panels: `admin`, `app`, and `server`
- Covers login/simple pages, dashboards, server pages, console, tables, forms, dialogs, dropdowns, notifications, and navigation
- Pointer-reactive ambient spotlight on desktop
- Layered night-sky background with twinkling stars, parallax stardust, colored nebula clouds, and a perspective grid
- Seven staggered shooting-star paths with varied speeds and sizes
- Distant animated void portal with orbiting energy rings
- Floating crystalline void shards and optional floating dashboard widgets in Vivid mode
- Interaction ripples on buttons, tabs, menus, and navigation
- Top loading indicator for Livewire, Turbo, and normal panel navigation
- Built-in appearance center with persistent motion, compact-density, contrast, OLED, palette, ambience, and surface preferences
- Per-account preference synchronization across browsers and devices
- Administrator defaults and an official Pelican plugin settings page
- Optional administrator lock, sync toggle, and appearance-button visibility control
- One-click Performance, Balanced, and Cinematic presets
- Independent Sparse, Normal, and Galaxy sky-density profiles
- Sharp, Soft, and Round corner profiles
- Separate cursor-stardust and floating-accent controls
- Automatic reduced-data performance mode when the browser requests data saving
- Four switchable palettes: **Voidwave**, **Aurora**, **Ember**, and **Nebula**
- Calm, balanced, and vivid ambience intensity levels
- Glass, Solid, and Crystal surface profiles
- Optional OLED profile with true-black backgrounds and chrome
- Automatic effect pausing while the browser tab is hidden
- Print, forced-colors, and reduced-transparency support
- `Alt + V` keyboard shortcut for the appearance center
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

## Appearance controls

A small **VOIDWAVE** button appears in the lower-right corner and opens the theme's appearance center. Each user can independently:

- Enable or pause motion effects
- Enable a compact information density
- Enable stronger contrast
- Choose Voidwave, Aurora, Ember, or Nebula accents
- Choose calm, balanced, or vivid ambience intensity
- Choose Glass, Solid, or Crystal surface treatment
- Enable an OLED true-black display profile
- Enable or disable cursor stardust and floating accents independently
- Choose Sparse, Normal, or Galaxy sky density
- Choose Sharp, Soft, or Round component corners
- Apply Performance, Balanced, or Cinematic presets
- Copy a safe theme diagnostic string for support
- Reset all appearance preferences

Press `Alt + V` to open the appearance center. A back-to-top control appears beside it on long pages. Signed-in users can synchronize preferences through their Pelican account, while local storage keeps the theme responsive and supports login pages. Version 1.6 automatically migrates preferences from versions 1.1 through 1.5.

## Administrator defaults and account sync

Open **Admin → Plugins → Voidwave Theme → Settings** to configure panel-wide defaults. Administrators can choose the default state of every appearance option, allow or lock user overrides, enable or disable account synchronization, and show or hide the appearance control.

When synchronization is enabled, authenticated preferences are stored inside Pelican's existing user `customization` data under the isolated `voidwave` key. No new database table or external service is required. Login and logged-out pages use the administrator defaults with a local browser fallback.

## Pelican Hub listing

**Name:** Voidwave Theme  
**Category:** Themes  
**Author:** PhantomVoidTTV  
**Version:** 1.6.0  
**License:** MIT

**Short description:**

> Enter the Voidwave: an interactive purple-and-cyan glass theme for every Pelican Panel page.

**Full description:**

> Voidwave transforms Pelican Panel with a rich deep-space interface, animated aurora lighting, twinkling stars, shooting comets, a drifting perspective grid, pointer-reactive glow, glass surfaces, glowing navigation, and interaction ripples. Its built-in appearance center gives every user persistent motion, density, contrast, OLED, ambience, surface, and four-palette controls, with optional account synchronization and administrator-managed defaults. It themes the admin, app, and server panels—including authentication, dashboards, forms, tables, dialogs, uploads, file views, wizards, calendars, and console chrome. No external assets or tracking are used, and motion automatically reduces when requested by the operating system.

Suggested tags: `theme`, `dark`, `animated`, `interactive`, `neon`, `purple`, `cyan`, `glass`

## Publishing checklist

1. Push this source tree to `GalaxyFSRP1/voidwave-pelican-theme` on the `main` branch.
2. Push the tag `v1.6.0` (lowercase `v`).
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
