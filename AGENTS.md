# Web Girl Studio repository guide

This repository belongs to Web Girl Studio (WGS).

Before substantial WGS strategy, design, development, outreach, portfolio,
client-delivery, or creative-direction work:

1. Read `docs/wgs/00-start-here/WGS-SOURCE-MANIFEST.md`.
2. Identify and read the relevant canonical WGS documents.
3. Read the current project-specific approved brief and specification.
4. Use the relevant repo skill in `.agents/skills/`.
5. Inspect the existing implementation before proposing new architecture.

Do not treat the newest user prompt as the entire source of truth when canonical
project sources exist. A new prompt can supersede a source only when it clearly
states that intent or the user resolves the conflict.

## Working principles

- Strategy precedes visual execution.
- Structure precedes polish.
- Purpose precedes decoration.
- Proof precedes claims.
- Mobile is designed, not compressed.
- Motion must orient, reveal, explain, respond, or create useful atmosphere.
- Componentise repeated behaviour, not every visual idea.
- Preserve established WGS decisions unless the task explicitly changes them.
- Do not invent business facts, client approval, outcomes, testimonials, prices,
  research findings, CRM data, or project status.
- Mark unknowns and incomplete decisions clearly.
- Flag source conflicts instead of silently choosing the convenient instruction.
- Never use archive material as current policy when a newer source exists.

## Current technical context

- Classic PHP 8+, semantic HTML, standalone CSS, and vanilla JavaScript.
- No package manager, React runtime, or bundler is currently part of production.
- Shared PHP components live in `components/`.
- Shared browser behaviour lives in `assets/`; reusable foundations belong in
  `assets/lib/` unless the stack changes through an approved project decision.
- Portfolio data and project truth notes live in `content/projects.php`.
- Preserve form security, analytics, metadata, routes, and accessibility.

## Quick routing

- Studio position and offer: `docs/wgs/01-studio/`
- Discovery, UX, and conversion: `docs/wgs/02-strategy/`
- Creative direction and motion: `docs/wgs/03-creative/`
- Design rules and reusable systems: `docs/wgs/04-design/`
- Client delivery and QA: `docs/wgs/05-delivery/`
- Outreach and CRM operations: `docs/wgs/06-growth/`
- Portfolio and Figma archive work: `docs/wgs/07-portfolio/`
- Historical context only: `docs/wgs/99-archive/`

## Completion gate

- Run the QA relevant to the change.
- Validate responsive behaviour and reduced motion where applicable.
- Test forms, routes, analytics, SEO, and performance when touched.
- Report what was verified, what remains unknown, and any manual step.

Start at `docs/wgs/00-start-here/WGS-SOURCE-MANIFEST.md`.
