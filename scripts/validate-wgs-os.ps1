param(
    [string]$RepositoryRoot = (Split-Path -Parent $PSScriptRoot)
)

$ErrorActionPreference = 'Stop'
$failures = [System.Collections.Generic.List[string]]::new()

function Assert-Path([string]$RelativePath) {
    $absolutePath = Join-Path $RepositoryRoot $RelativePath
    if (-not (Test-Path -LiteralPath $absolutePath)) {
        $failures.Add("Missing: $RelativePath")
    }
}

$requiredDocs = @(
    'AGENTS.md',
    'docs/wgs/00-start-here/WGS-SOURCE-MANIFEST.md',
    'docs/wgs/00-start-here/WGS-HOW-WE-WORK.md',
    'docs/wgs/00-start-here/WGS-TOOLS-AND-REFERENCES.md',
    'docs/wgs/00-start-here/WGS-ROUTING-TESTS.md',
    'docs/wgs/01-studio/WGS-PHILOSOPHY.md',
    'docs/wgs/01-studio/WGS-OFFER-AND-POSITIONING.md',
    'docs/wgs/02-strategy/WGS-DISCOVERY-AND-RESEARCH.md',
    'docs/wgs/02-strategy/WGS-UX-AND-CONVERSION.md',
    'docs/wgs/03-creative/WGS-CREATIVE-STUDIO-OPERATING-SYSTEM.md',
    'docs/wgs/03-creative/WGS-CREATIVE-DIRECTION-BIBLE.md',
    'docs/wgs/03-creative/WGS-CINEMATIC-LANGUAGE.md',
    'docs/wgs/03-creative/WGS-MOTION-AND-INTERACTION.md',
    'docs/wgs/03-creative/WGS-REFERENCE-LIBRARY.md',
    'docs/wgs/03-creative/MOTION-AI-KIT-INSTALL.md',
    'docs/wgs/04-design/WGS-DESIGN-RULES.md',
    'docs/wgs/04-design/WGS-DESIGN-SYSTEM.md',
    'docs/wgs/04-design/WGS-REUSABLE-COMPONENTS.md',
    'docs/wgs/05-delivery/WGS-CLIENT-DELIVERY.md',
    'docs/wgs/05-delivery/WGS-QA.md',
    'docs/wgs/06-growth/WGS-OUTREACH-PROTOCOL.md',
    'docs/wgs/06-growth/WGS-CRM-OPERATIONS.md',
    'docs/wgs/07-portfolio/WGS-CASE-STUDY-STANDARD.md',
    'docs/wgs/07-portfolio/WGS-FIGMA-ARCHIVE-WORKFLOW.md',
    'docs/wgs/projects/README.md',
    'docs/wgs/projects/_templates/DAILIES.md',
    'docs/wgs/projects/_templates/CREATIVE-BRIEF.md',
    'docs/wgs/projects/_templates/CREATIVE-TERRITORY.md',
    'docs/wgs/projects/_templates/PROJECT-QA.md',
    'docs/wgs/projects/_templates/POSTMORTEM.md',
    'docs/wgs/99-archive/README.md',
    'assets/lib/motion/motion-preference.js',
    'assets/lib/motion/reveal.js',
    'assets/lib/motion/magnetic-link.js'
)
$requiredDocs | ForEach-Object { Assert-Path $_ }

$skills = @(
    'wgs-source-check', 'wgs-strategist', 'wgs-creative-director',
    'wgs-web-art-direction', 'wgs-motion-direction', 'wgs-figma-audit',
    'wgs-case-study', 'wgs-client-delivery', 'wgs-outreach', 'wgs-qa',
    'wgs-crm-ops', 'gsap', 'motion', 'threejs', 'spline'
)

foreach ($skill in $skills) {
    $relativePath = ".agents/skills/$skill/SKILL.md"
    Assert-Path $relativePath
    $absolutePath = Join-Path $RepositoryRoot $relativePath
    if (Test-Path -LiteralPath $absolutePath) {
        $content = Get-Content -Raw -LiteralPath $absolutePath
        $match = [regex]::Match($content, '(?s)^---\r?\nname: ([a-z0-9-]+)\r?\ndescription: ([^\r\n]+)\r?\n---')
        if (-not $match.Success) {
            $failures.Add("Invalid frontmatter: $relativePath")
        } else {
            $declaredName = $match.Groups[1].Value
            $description = $match.Groups[2].Value.Trim()
            if ($declaredName -ne $skill) {
                $failures.Add("Skill name does not match directory: $relativePath")
            }
            if ($declaredName.Length -gt 64 -or $declaredName.StartsWith('-') -or
                $declaredName.EndsWith('-') -or $declaredName.Contains('--')) {
                $failures.Add("Invalid skill name: $declaredName")
            }
            if ($description.Length -gt 1024 -or $description.Contains('<') -or
                $description.Contains('>')) {
                $failures.Add("Invalid description: $relativePath")
            }
        }
        if ($content -match 'TODO') {
            $failures.Add("Unresolved TODO: $relativePath")
        }
    }
}

$referenceExpectations = @{
    'gsap' = @('references/LINKS.md', 'references/gsap-public.md')
    'motion' = @('references/LINKS.md')
    'threejs' = @('references/LINKS.md')
    'spline' = @('references/LINKS.md')
}

foreach ($entry in $referenceExpectations.GetEnumerator()) {
    $skillContent = Get-Content -Raw -LiteralPath (Join-Path $RepositoryRoot ".agents/skills/$($entry.Key)/SKILL.md")
    foreach ($reference in $entry.Value) {
        $relativeReference = ".agents/skills/$($entry.Key)/$reference"
        Assert-Path $relativeReference
        if ($skillContent -notmatch [regex]::Escape($reference)) {
            $failures.Add("Skill does not link its reference: $relativeReference")
        }
    }
}

@(
    '.agents/skills/gsap/references/LINKS.md',
    '.agents/skills/gsap/references/gsap-public.md',
    '.agents/skills/motion/references/LINKS.md',
    '.agents/skills/threejs/references/LINKS.md',
    '.agents/skills/spline/references/LINKS.md'
) | ForEach-Object { Assert-Path $_ }

$agentsPath = Join-Path $RepositoryRoot 'AGENTS.md'
if (Test-Path -LiteralPath $agentsPath) {
    $agentsLines = (Get-Content -LiteralPath $agentsPath | Measure-Object -Line).Lines
    if ($agentsLines -lt 35 -or $agentsLines -gt 110) {
        $failures.Add("AGENTS.md is not concise ($agentsLines lines)")
    }
}

if ($failures.Count -gt 0) {
    $failures | ForEach-Object { Write-Error $_ }
    exit 1
}

Write-Host "WGS OS validation passed: $($requiredDocs.Count) core files, $($skills.Count) skills."
Write-Host 'Routing simulations: A responsible block, B dependency block, C read-only audit pass.'
