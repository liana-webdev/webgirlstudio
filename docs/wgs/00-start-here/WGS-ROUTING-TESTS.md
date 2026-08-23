# WGS Routing Tests

These dry runs test source selection and stop conditions. They do not authorize
production, Figma, CRM, or outreach writes.

## A. Creative directions for Face Not Fake

Route:

1. `wgs-source-check`
2. `wgs-strategist`
3. `wgs-creative-director`
4. `wgs-web-art-direction`

Read the source manifest, `01-studio`, `02-strategy`, the creative direction
bible, design rules, and `projects/face-not-fake/00-brief.md`. The routing makes
sense, but the creative gate fails: the only repository facts are a name,
industry label, and draft status. Research, offer, audience, proof, constraints,
and approval are missing. The responsible output is a discovery plan or clearly
labelled hypotheses, not three client-ready directions.

## B. GSAP section with reusable primitives

Route:

1. `wgs-source-check`
2. `wgs-motion-direction`
3. `gsap`
4. reusable-component guidance
5. `wgs-qa`

Read the motion standard, reusable-components standard, GSAP skill references,
the current implementation, and the current project's `06-motion-spec.md`. The
routing makes sense. If no project or motion specification is named, source check
must request or create that scoped specification before implementation. The
dependency gate also fails in this repository because it has no package root and
GSAP is not installed. An implementation task must define the section, justify
GSAP over CSS or the existing vanilla primitives, approve the dependency, and
specify cleanup, reduced-motion, mobile, and no-JavaScript behavior.

## C. Figma case-study archive audit

Route:

1. `wgs-source-check`
2. `wgs-figma-audit`
3. `wgs-case-study`
4. `wgs-creative-director` when visual-direction judgment is needed

Read the Figma archive workflow, case-study standard, current project sources,
and approved Figma file. The routing makes sense. Begin read-only, map pages and
frames to the required archive structure, flag missing rationale or proof, and
require explicit permission before reorganising or deleting Figma nodes.

## Result

All three requests have an unambiguous route. The system deliberately blocks
unsupported client claims, unapproved dependencies, and destructive design-file
changes while still producing a useful next action.
