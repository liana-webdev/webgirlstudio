# WGS Source Manifest

This manifest decides which source wins when WGS instructions overlap.

## Source precedence

1. Current project-specific approved brief or specification
2. Current canonical WGS documents under `docs/wgs/00-start-here` through `07-portfolio`
3. Repository `AGENTS.md`
4. Repo-scoped WGS skills under `.agents/skills`
5. Older reference notes with clear provenance
6. Archive and legacy material under `docs/wgs/99-archive`

A later modification date does not automatically make a source authoritative.
Approval, scope, and the hierarchy above matter more.

## Required start sequence

Before substantial WGS strategy, design, development, outreach, portfolio,
client-delivery, or creative-direction work:

1. Read this manifest.
2. Identify the relevant canonical sources in the routing table below.
3. Read those sources, not only their filenames.
4. Read project-specific sources in `docs/wgs/projects/<project-slug>/`.
5. Use the relevant `.agents/skills` skill.
6. Do not silently invent missing facts or approval.
7. Do not use archived instructions when a newer source exists.
8. Flag conflicts and state which source controls the decision.
9. Run the relevant QA before completion.

## Routing table

| Work | Canonical sources | Primary skills |
|---|---|---|
| Studio positioning and offer | `01-studio/` | `wgs-source-check`, `wgs-strategist` |
| Discovery, UX, conversion | `02-strategy/` | `wgs-strategist` |
| Creative territories and direction | `03-creative/` | `wgs-creative-director`, `wgs-web-art-direction` |
| Motion and interaction | `03-creative/WGS-MOTION-AND-INTERACTION.md` | `wgs-motion-direction`, then tool skill |
| Design systems and components | `04-design/` | `wgs-web-art-direction`, `wgs-qa` |
| Client delivery and QA | `05-delivery/` | `wgs-client-delivery`, `wgs-qa` |
| Outreach and CRM | `06-growth/` | `wgs-outreach`, `wgs-crm-ops` |
| Portfolio and Figma archive | `07-portfolio/` | `wgs-case-study`, `wgs-figma-audit` |

## Current repository truth

- Production stack and deployment: root `README.md`.
- Public offer, package wording, and FAQs: `index.php` until explicitly moved to a content source.
- Portfolio records and truth status: `content/projects.php`.
- Analytics implementation: `components/analytics.php` and `assets/analytics-events.js`.
- Contact security and delivery: `contact.php`.

## Known missing sources

The repository audit on 2026-08-23 found no uppercase `SKILLS` folder, GSAP public
archive, giant WGS/Liana/Yudaev legacy document, current outreach protocol, CRM
sheet schema, or Face Not Fake approved project brief. Their absence must not be
converted into invented policy. See `99-archive/README.md` and incomplete markers
in the relevant canonical documents.
