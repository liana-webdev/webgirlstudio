---
name: gsap
description: Choose and implement GSAP for timeline-led, scroll-driven, pinned, scrubbed, typographic, or multi-element web motion. Use when WGS motion requires choreography beyond CSS or framework-native state animation.
---

# GSAP

Read `references/LINKS.md` and the provenance note in `references/gsap-public.md`.

1. Confirm that the motion direction has a narrative purpose and reduced-motion behavior.
2. Use CSS for simple transitions; choose GSAP for timelines, ScrollTrigger, sequencing,
   pinning, scrub, complex type, or coordinated unrelated elements.
3. Check the project stack and existing dependencies before proposing installation.
4. If approved in an npm project, install one compatible `gsap` version and register
   ScrollTrigger once; never add a duplicate version.
5. Keep setup scoped and clean up triggers, timelines, listeners, and contexts.
6. Prefer transform and opacity; measure before animating layout-affecting properties.
7. Design safe mobile, low-power, no-JavaScript, and `prefers-reduced-motion` fallbacks.
8. Test resize, refresh, teardown, keyboard interaction, and rapid input.

Produce the implementation plan or scoped animation module plus QA evidence. Pass the
gate only when cleanup, fallbacks, performance, and the motion specification are verified.

This repository currently has no package root and GSAP is not installed. Do not add it
until an implementation task justifies the dependency and the user approves that scope.
