# Voidwave Theme for Pelican Panel

An animated, neon-glass Pelican Panel theme by **PhantomVoidTTV**.

Voidwave wraps the entire panel in a deep-space purple/cyan look with drifting aurora orbs, a perspective grid, twinkling stars, glowing active navigation, glass cards, animated headings, polished forms, tables, modals, authentication screens, and console styling.

## Features

- Applies to all standard Pelican panels: `admin`, `app`, and `server`
- Covers login/simple pages, dashboards, server pages, console, tables, forms, dialogs, dropdowns, notifications, and navigation
- Pure CSS atmosphere with no remote fonts, scripts, trackers, or image dependencies
- Dark mode is forced so every component stays legible and visually consistent
- Responsive styling for desktop and mobile
- Honors `prefers-reduced-motion` and `prefers-contrast`
- MIT licensed and ready to publish on Pelican Hub

## Install

1. Download `voidwave-theme.zip`.
2. Sign in to the Pelican Panel admin area.
3. Open **Plugins**.
4. Select **Import from File**.
5. Upload the ZIP, complete installation, and enable **Voidwave Theme**.
6. If prompted by your Pelican installation, rebuild panel assets and clear the application cache.

The ZIP must contain `plugin.json` at its root. The provided release archive is already packaged this way.

## Compatibility

Voidwave uses Pelican's current Filament plugin and Vite theme APIs. It intentionally lists all three standard panels in `plugin.json`. Avoid enabling multiple theme plugins at the same time because themes can compete for the same Filament theme slot.

## Pelican Hub listing

**Name:** Voidwave Theme  
**Category:** Themes  
**Author:** PhantomVoidTTV  
**Version:** 1.0.0  
**License:** MIT

**Short description:**

> Enter the Voidwave: an animated purple-and-cyan glass theme for every Pelican Panel page.

**Full description:**

> Voidwave transforms Pelican Panel with a rich deep-space interface, animated aurora lighting, twinkling stars, a drifting perspective grid, glass surfaces, glowing navigation, and responsive interactions. It themes the admin, app, and server panels—including authentication, dashboards, forms, tables, dialogs, file views, and console chrome. No external assets or tracking are used, and motion automatically reduces when requested by the operating system.

Suggested tags: `theme`, `dark`, `animated`, `neon`, `purple`, `cyan`, `glass`

## Publishing checklist

1. Create the GitHub repository `PhantomVoidTTV/voidwave-pelican-theme`.
2. Push this source tree to the repository's `main` branch.
3. Create a release tagged `v1.0.0`.
4. Attach the provided archive as `voidwave-theme.zip` (the name matches `update.json`).
5. Capture clean screenshots of login, dashboard, server overview, and console pages on a test panel.
6. Submit the plugin on Pelican Hub using the listing copy above.
7. Test Hub's downloaded ZIP on a fresh/current Pelican Panel before publishing.

## Development validation

From the Pelican Panel root, place this repository at `plugins/voidwave-theme`, then run:

```bash
php -l plugins/voidwave-theme/src/VoidwaveThemePlugin.php
yarn build
```

## License

Copyright © 2026 PhantomVoidTTV. Released under the MIT License.
