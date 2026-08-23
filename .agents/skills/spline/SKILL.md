---
name: spline
description: Evaluate and integrate contained, art-directed Spline scenes for WGS web projects. Use when authored interactive 3D is valuable but a custom Three.js runtime would add unnecessary engineering cost.
---

# Spline

Read `references/LINKS.md` before integration.

1. Confirm the scene has a defined communication or interaction role.
2. Prefer Spline for bounded authored scenes; prefer Three.js for procedural or deeply custom behavior.
3. Establish export method, loading state, interaction boundary, and static fallback.
4. Budget export size, textures, lighting, event listeners, and device pixel ratio.
5. Keep essential content and navigation outside the scene.
6. Respect reduced motion and provide touch, keyboard, low-power, and no-WebGL behavior.
7. Measure real-device performance and remove the scene if it harms the primary journey.

Produce a scene integration specification or scoped embed plus QA evidence. Pass the gate
only when purpose, loading, fallback, accessibility, and real-device performance hold.

Spline is not installed or embedded in this repository. An approved concept and asset
source are required before adding runtime code.
