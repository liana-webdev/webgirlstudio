---
name: wgs-qa
description: Run Web Girl Studio preflight, responsive, accessibility, performance, content, analytics, form, and launch-quality checks. Use for implementation review, release readiness, regression testing, or delivery sign-off.
---

# WGS QA

1. Run `wgs-source-check` and read `docs/wgs/05-delivery/WGS-QA.md`.
2. Define the changed surface and the highest-risk user journeys.
3. Run available automated checks before manual review.
4. Test keyboard use, focus, semantics, contrast, reduced motion, and assistive labels.
5. Test narrow mobile, common mobile, tablet, desktop, and large desktop layouts.
6. Verify content truth, links, forms, validation, failure states, analytics, consent, and metadata.
7. Check load behavior, image sizing, layout stability, console errors, and motion performance.
8. Report evidence with severity, reproduction steps, and exact file or route.
9. Re-test resolved issues and state any untested areas explicitly.

Produce a pass/fail report with defects, evidence, coverage, and residual risk. The gate
fails while a critical journey, production integration, or required device remains unverified.
