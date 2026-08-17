# Publishing Voidwave v1.8.0 with working Pelican updates

Voidwave now includes `.github/workflows/release.yml`. Pushing a correctly formatted version tag automatically creates the GitHub release, builds the installation ZIP with `plugin.json` at its root, names it `voidwave-theme.zip`, verifies it, and uploads it with a SHA-256 checksum.

## One-time repository setting

Open **Settings → Actions → General → Workflow permissions** in the GitHub repository. Select **Read and write permissions**, then save. The release workflow needs permission to create releases and upload assets.

## 1. Update the repository source

Extract `voidwave-github-source.zip`. Put its **contents**, including the `.github` directory, on the `main` branch of:

https://github.com/GalaxyFSRP1/voidwave-pelican-theme

The repository root must contain `plugin.json`; do not add an extra wrapper folder.

Commit at least:

- `.github/workflows/release.yml`
- `.github/workflows/validate.yml`
- `plugin.json`
- `update.json`
- `src/VoidwaveThemePlugin.php`
- `src/Http/Controllers/PreferencesController.php`
- `src/Providers/VoidwaveRoutesProvider.php`
- `src/Providers/VoidwaveThemeProvider.php`
- `src/Providers/VoidwaveProfileProvider.php`
- `config/voidwave-theme.php`
- `resources/css/theme.css`
- `README.md`
- `CHANGELOG.md`
- `GITHUB_RELEASE.md`
- `LICENSE`

Confirm both raw manifests show version 1.8.0:

- https://raw.githubusercontent.com/GalaxyFSRP1/voidwave-pelican-theme/main/plugin.json
- https://raw.githubusercontent.com/GalaxyFSRP1/voidwave-pelican-theme/main/update.json

## 2. Push the release tag

Do not manually create or rename a release asset. After the source commit is on `main`, create and push the exact lowercase tag:

```bash
git checkout main
git pull --ff-only
git tag v1.8.0
git push origin v1.8.0
```

The **Package and publish release** workflow will automatically publish:

- `voidwave-theme.zip`
- `voidwave-theme.zip.sha256`

Watch it under the repository's **Actions** tab. The workflow intentionally fails if the tag, `plugin.json`, `update.json`, or download URL do not agree.

## 3. Verify the updater asset

```bash
curl -fL \
  https://github.com/GalaxyFSRP1/voidwave-pelican-theme/releases/download/v1.8.0/voidwave-theme.zip \
  -o /tmp/voidwave-theme.zip
unzip -t /tmp/voidwave-theme.zip
unzip -p /tmp/voidwave-theme.zip plugin.json | grep version
```

The URL must return HTTP 200, the ZIP test must pass, and the version must be 1.8.0.

## 4. Make Pelican refresh update information

Pelican caches each plugin's `update.json` for 10 minutes. Either wait or clear the cache:

```bash
cd /var/www/pelican
sudo -u www-data php artisan optimize:clear
```

Pelican's update button can now download and replace Voidwave without importing the ZIP again. Pelican still runs `yarn install` and `yarn build` during an update, so the server needs adequate RAM or swap.

## Important Pelican limitation

Pelican deliberately disables plugin update detection when the panel version is `canary`. Use a stable Pelican release if you want the built-in update button. Also, the built-in updater is download-on-click rather than a silent unattended updater.

## Common failures prevented by the workflow

- Uppercase `V` in the release tag
- Missing release asset
- Asset without `.zip`
- Wrong asset filename
- Nested wrapper folder in the ZIP
- Mismatched plugin and updater versions
- Download URL pointing at a different tag
