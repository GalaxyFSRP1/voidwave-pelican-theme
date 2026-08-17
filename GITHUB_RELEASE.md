# Publishing Voidwave v1.3.0

Two different ZIP files are provided. They are not interchangeable.

## 1. Update the repository source

Extract `voidwave-github-source.zip`, then place its **contents** on the `main` branch of:

https://github.com/GalaxyFSRP1/voidwave-pelican-theme

`plugin.json` must be at the repository root. Commit at least these changed files:

- `plugin.json`
- `update.json`
- `src/VoidwaveThemePlugin.php`
- `resources/css/theme.css`
- `README.md`
- `CHANGELOG.md`
- `GITHUB_RELEASE.md`
- `.github/workflows/validate.yml`

Confirm the raw files show version 1.3.0:

- https://raw.githubusercontent.com/GalaxyFSRP1/voidwave-pelican-theme/main/plugin.json
- https://raw.githubusercontent.com/GalaxyFSRP1/voidwave-pelican-theme/main/update.json

## 2. Create the release

Create a release at:

https://github.com/GalaxyFSRP1/voidwave-pelican-theme/releases/new

Use these exact values:

- **Tag:** `v1.3.0` — lowercase `v`
- **Target:** `main`
- **Title:** `Voidwave Theme v1.3.0`
- **Asset:** `voidwave-theme.zip`

Upload the separate **installation package** named `voidwave-theme.zip`. Do not upload a folder, `voidwave-github-source.zip`, or a file without `.zip`.

Wait for the upload to finish before publishing. The published release must show an Assets entry named exactly `voidwave-theme.zip`.

## 3. Verify automatic updates

This URL must return HTTP 200 and download a valid ZIP:

```text
https://github.com/GalaxyFSRP1/voidwave-pelican-theme/releases/download/v1.3.0/voidwave-theme.zip
```

Test it with:

```bash
curl -fL \
  https://github.com/GalaxyFSRP1/voidwave-pelican-theme/releases/download/v1.3.0/voidwave-theme.zip \
  -o /tmp/voidwave-theme.zip
unzip -t /tmp/voidwave-theme.zip
```

Then clear Pelican's cached update response:

```bash
cd /var/www/pelican
sudo -u www-data php artisan optimize:clear
```

## Common causes of a 404

- Release tag uses uppercase `V1.3.0` instead of lowercase `v1.3.0`
- Release is still a draft
- Asset was not uploaded
- Asset has a different name
- Asset has no `.zip` extension
- `update.json` was not committed to `main`
