# lianawebdev QA commands

Apply the global WGS QA standard, then use the checks relevant to this repository.

## Studio OS integration

```powershell
powershell -NoProfile -ExecutionPolicy Bypass -File scripts/validate-wgs-integration.ps1
```

## Syntax

Run PHP lint over changed PHP files with an available PHP 8 binary. Check changed
browser modules with Node's `--check` command when Node is available.

## Portfolio smoke test

Start the PHP development server on port 8099, set the bundled Playwright modules,
then run:

```powershell
$env:WGS_NODE_MODULES = 'path-to-bundled-node_modules'
node scripts/portfolio-smoke.cjs
```

## Analytics regression

Start the same local server with `WGS_TEST_MODE=1`, then run:

```powershell
$env:WGS_NODE_MODULES = 'path-to-bundled-node_modules'
node scripts/analytics-smoke.cjs
```

## Manual checks

- Narrow phone, tablet, desktop, keyboard, focus, zoom, and reduced motion
- Navigation, portfolio routes, media, controls, back/forward behavior
- Contact validation, success, failure, rate limiting, and approved test delivery
- Metadata, canonical URL, indexing, social preview, performance, and console

Submit a real enquiry only in an approved test environment.
