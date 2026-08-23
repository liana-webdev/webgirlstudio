param(
    [string]$RepositoryRoot = (Split-Path -Parent $PSScriptRoot),
    [string]$StudioRoot = 'C:\Users\liana\Documents\Web Girl Studio\wgs-studio-os',
    [string]$SkillsRoot = (Join-Path $env:USERPROFILE '.codex\skills')
)

$ErrorActionPreference = 'Stop'
$root = (Resolve-Path -LiteralPath $RepositoryRoot).Path
$globalRoot = (Resolve-Path -LiteralPath $StudioRoot).Path
$failures = [System.Collections.Generic.List[string]]::new()

foreach ($relative in @(
    'AGENTS.md',
    'docs/wgs-local/SOURCE-OVERLAY.md',
    'docs/wgs-local/TECHNICAL-CONTEXT.md',
    'docs/wgs-local/QA-COMMANDS.md',
    'docs/projects/face-not-fake/00-brief.md'
)) {
    if (-not (Test-Path -LiteralPath (Join-Path $root $relative) -PathType Leaf)) {
        $failures.Add("Missing local file: $relative")
    }
}

if (Test-Path -LiteralPath (Join-Path $root 'docs/wgs')) {
    $failures.Add('Duplicate global docs remain under docs/wgs')
}

$globalManifestPath = Join-Path $globalRoot 'wgs-studio-os.json'
if (-not (Test-Path -LiteralPath $globalManifestPath -PathType Leaf)) {
    $failures.Add('Global WGS Studio OS manifest is unavailable')
} else {
    $manifest = Get-Content -Raw -LiteralPath $globalManifestPath | ConvertFrom-Json
    foreach ($skill in $manifest.skills) {
        if (-not (Test-Path -LiteralPath (Join-Path $SkillsRoot $skill) -PathType Container)) {
            $failures.Add("Missing user-level WGS skill: $skill")
        }
        if (Test-Path -LiteralPath (Join-Path $root ".agents/skills/$skill")) {
            $failures.Add("Duplicate repo-scoped global skill: $skill")
        }
    }
}

$locator = Join-Path $SkillsRoot 'wgs-source-check/references/WGS-STUDIO-OS-ROOT.md'
if (-not (Test-Path -LiteralPath $locator -PathType Leaf)) {
    $failures.Add('Missing global WGS root locator')
} elseif ((Get-Content -Raw -LiteralPath $locator) -notmatch [regex]::Escape($globalRoot)) {
    $failures.Add('Installed WGS root locator points elsewhere')
}

if ($failures.Count) {
    $failures | ForEach-Object { Write-Error $_ }
    exit 1
}

& (Join-Path $globalRoot 'validation/validate-installed-skills.ps1') -StudioRoot $globalRoot -SkillsRoot $SkillsRoot
Write-Host 'lianawebdev WGS integration validation passed.'
