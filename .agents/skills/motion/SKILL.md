---
name: motion
description: Choose and implement Motion for React component state, presence, gesture, shared-layout, and layout animation. Use only in a compatible React project when animation is driven by application or component state.
---

# Motion

Read `references/LINKS.md` before relying on version-sensitive APIs.

1. Confirm React 18.2+ and inspect the installed Motion version before adding anything.
2. Choose Motion for `AnimatePresence`, `layoutId`, layout animation, gestures, variants,
   menus, overlays, and responsive component-state transitions.
3. Import from `motion/react` and keep state ownership clear.
4. Preserve semantic HTML, keyboard behavior, focus, and reduced-motion alternatives.
5. Avoid duplicating a GSAP timeline or letting two libraries control the same property.
6. Test mount/unmount, interrupted transitions, rapid state changes, layout shifts, and SSR.

Produce a scoped component implementation or motion plan plus QA evidence. Pass the gate
when presence, interruption, accessibility, layout behavior, and fallbacks are verified.

This PHP and vanilla-JavaScript repository is not a compatible Motion target. Follow
`docs/wgs/03-creative/MOTION-AI-KIT-INSTALL.md` if a future React surface is approved.
