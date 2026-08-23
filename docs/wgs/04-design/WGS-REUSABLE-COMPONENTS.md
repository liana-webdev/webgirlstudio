# WGS Reusable Components

## Componentise behaviour, not every visual idea

WGS projects should remain visually individual. Reuse accessibility, interaction
behaviour, spacing systems, responsive behaviour, media handling, motion
primitives, navigation, buttons, forms, and common technical patterns.

Create a reusable component when behaviour appears repeatedly, abstraction
improves consistency, and the API remains flexible across art directions. Avoid
premature abstraction and identical page compositions.

## Current architecture

This is classic PHP, CSS, and vanilla JS—not React. Shared markup belongs in
`components/`; reusable client behaviour belongs in `assets/lib/`. Existing
production code is not migrated during this infrastructure task.

## Initial behaviour foundations

| Name | Purpose/API | Responsive/accessibility | Motion/reduced motion | Status |
|---|---|---|---|---|
| `motion-preference` | `prefersReducedMotion()`, subscribe to preference changes | Uses the platform media query | Consumers must disable nonessential motion | Created, not wired |
| `createRevealObserver` | Observe a supplied element list and apply a caller callback | No layout assumptions | Resolves immediately under reduced motion | Created, not wired |
| `createMagneticLink` | Optional fine-pointer response for a supplied element | Disabled for coarse pointer/keyboard | Disabled under reduced motion; cleanup returned | Created, not wired |

## Candidate after repeated need

MediaReveal, ParallaxMedia, ProjectTransition, PinnedStory, HorizontalRail, and
AnimatedSectionHeading remain candidates—not approved abstractions. Document any
future component with purpose, API, responsive behaviour, accessibility, motion,
reduced-motion behaviour, and example usage.
