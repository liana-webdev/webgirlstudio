# WGS Motion and Interaction

Choose the least complex tool that can express the approved behaviour.

## CSS

Use for hover colour, simple opacity, basic transforms, and short self-contained
transitions.

## Motion

Use for React component/layout state, shared-element transitions, menus,
overlays, responsive UI transformations, and gestures. The current repository is
not React, so Motion is not installed or applicable to production today.

## GSAP

Use for timelines, scroll choreography, ScrollTrigger, pinned narratives,
scrubbed sequences, and complex coordinated animation. It is not installed in the
current no-npm stack.

## Spline

Use for authored interactive 3D scenes when a contained visual object benefits
from designer-controlled authoring.

## Three.js

Use for custom 3D systems, shaders, particles, procedural graphics, cameras, and
deeply custom WebGL/WebGPU.

## Rules

- Never use two libraries to control the same property on the same element.
- Motion is not decoration. Every animation needs a reason.
- Define reduced-motion behaviour before finaling.
- Do not pin or hijack scroll without a clear narrative benefit and usable mobile fallback.
- Stop off-screen or hidden animation and avoid unnecessary main-thread work.
- Confirm keyboard, focus, content order, and action availability without motion.
