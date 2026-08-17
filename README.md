# Voidwave Theme for Pelican Panel

An animated, neon-glass Pelican Panel theme by **PhantomVoidTTV**.

**Repository:** https://github.com/GalaxyFSRP1/voidwave-pelican-theme

Voidwave wraps the entire panel in a deep-space purple/cyan look with drifting aurora orbs, a perspective grid, twinkling stars, glowing navigation, glass cards, animated headings, polished forms, and enhanced console styling.

## Features

- Applies to all standard Pelican panels: `admin`, `app`, and `server`
- Covers login/simple pages, dashboards, server pages, console, tables, forms, dialogs, dropdowns, notifications, and navigation
- Pointer-reactive ambient spotlight on desktop
- Animated shooting comets, stars, aurora orbs, and perspective grid
- Interaction ripples on buttons, tabs, menus, and navigation
- Top loading indicator for Livewire, Turbo, and normal panel navigation
- Built-in **FX toggle** that remembers the user's choice in local storage
- Enhanced badges, notifications, tooltips, pagination, skeleton loaders, and empty states
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

## Effects control

A small **FX** button appears in the lower-right corner. It pauses the ambient movement, comets, reactive spotlight, shimmer, and click ripples. The choice is stored only in the user's browser under `voidwave-effects`; no data is transmitted.

## Pelican Hub listing

**Name:** Voidwave Theme  
**Category:** Themes  
**Author:** PhantomVoidTTV  
**Version:** 1.1.0  
**License:** MIT

**Short description:**

> Enter the Voidwave: an interactive purple-and-cyan glass theme for every Pelican Panel page.

**Full description:**

> Voidwave transforms Pelican Panel with a rich deep-space interface, animated aurora lighting, twinkling stars, shooting comets, a drifting perspective grid, pointer-reactive glow, glass surfaces, glowing navigation, interaction ripples, and a built-in effects toggle. It themes the admin, app, and server panels—including authentication, dashboards, forms, tables, dialogs, file views, and console chrome. No external assets or tracking are used, and motion automatically reduces when requested by the operating system.

Suggested tags: `theme`, `dark`, `animated`, `interactive`, `neon`, `purple`, `cyan`, `glass`

## Publishing checklist

1. Push this source tree to `GalaxyFSRP1/voidwave-pelican-theme` on the `main` branch.
2. Create a GitHub release tagged `v1.1.0`.
3. Attach the provided archive as `voidwave-theme.zip`; this filename matches `update.json`.
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
