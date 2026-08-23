# lianawebdev WGS source overlay

## Global source

- Canonical WGS Studio OS: `C:\Users\liana\Documents\Web Girl Studio\wgs-studio-os`
- Installed skill locator: `C:\Users\liana\.codex\skills\wgs-source-check\references\WGS-STUDIO-OS-ROOT.md`

## Local precedence

1. Approved project brief or specification under `docs/projects/`
2. This overlay and current implementation truth
3. Canonical global WGS documents
4. Root `AGENTS.md`
5. Installed WGS skills
6. Git history and other archive material

## Repository purpose

This repository builds and deploys the public Web Girl Studio website for a
classic PHP host. It also contains public portfolio routes and interactive
independent studies.

## Business and content truth

- Public offer, package wording, pricing, and FAQs: `index.php`
- Portfolio records, labels, and publication state: `content/projects.php`
- Deployment and public routes: `README.md`
- Face Not Fake local record: `docs/projects/face-not-fake/00-brief.md`

## Implementation truth

- Technical architecture: `docs/wgs-local/TECHNICAL-CONTEXT.md`
- Local checks: `docs/wgs-local/QA-COMMANDS.md`
- Analytics: `components/analytics.php` and `assets/analytics-events.js`
- Contact security and delivery: `contact.php`

## Approved global exceptions

None recorded. Local technical facts select the implementation approach without
changing global WGS studio policy.

## Migration record

Global WGS documents, templates, and reusable skills were moved to the canonical
Studio OS on 2026-08-23. No uppercase `SKILLS` folder, original GSAP archive, or
giant WGS/Liana/Yudaev source was present in this repository or its reachable Git
history. Commit `fc17fe9` contains removed outreach-feature code, not current policy.
