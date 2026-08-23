# Web Girl Studio — lianawebdev repository guide

This repository is the classic-hosting implementation of the Web Girl Studio
website. Reusable studio policy and skills are global; this file describes the
local project layer.

## Required source sequence

1. Use the installed `wgs-source-check` skill.
2. Read the global Source Manifest resolved through its installation locator.
3. Read `docs/wgs-local/SOURCE-OVERLAY.md`.
4. Read the relevant project record under `docs/projects/`.
5. Inspect current implementation truth before proposing changes.

Canonical global source:

`C:\Users\liana\Documents\Web Girl Studio\wgs-studio-os`

Do not treat the newest prompt as the entire source of truth when approved global
or local project sources exist. Flag conflicts and missing approval.

## Local technical rules

- Classic PHP 8+, semantic HTML, standalone CSS, and vanilla JavaScript.
- No package manager, React runtime, or bundler is part of production.
- Shared PHP output belongs in `components/`.
- Shared browser behavior belongs in `assets/`; local foundations live in `assets/lib/`.
- Portfolio data and project status live in `content/projects.php`.
- Public offer and pricing remain implementation truth in `index.php`.
- Preserve form security, analytics, metadata, routes, and accessibility.
- Do not add GSAP, Motion, Three.js, Spline, or another runtime library merely
  because a global skill exists.

## Local project knowledge

- Source overlay: `docs/wgs-local/SOURCE-OVERLAY.md`
- Technical context: `docs/wgs-local/TECHNICAL-CONTEXT.md`
- QA commands: `docs/wgs-local/QA-COMMANDS.md`
- Project records: `docs/projects/<project-slug>/`

Repo-scoped skills are reserved for genuinely lianawebdev-specific workflows.
Do not duplicate the installed global WGS skills under `.agents/skills`.

## Completion gate

- Run the global QA standard and local QA commands relevant to the change.
- Validate responsive behavior and reduced motion where applicable.
- Test forms, routes, analytics, SEO, and performance when touched.
- Report verified behavior, unknowns, and manual steps.
- Do not modify visible production pages unless the task explicitly authorizes it.
