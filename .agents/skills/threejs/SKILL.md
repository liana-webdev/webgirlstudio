---
name: threejs
description: Evaluate or implement custom procedural 3D, shaders, particles, cameras, and interactive WebGL or WebGPU scenes with Three.js. Use when WGS needs code-level control that CSS, Motion, GSAP, or Spline cannot provide efficiently.
---

# Three.js

Read `references/LINKS.md` before implementation.

1. Establish why 3D improves meaning, proof, or interaction rather than adding spectacle.
2. Define the smallest scene, interaction model, camera behavior, and visual fallback.
3. Set budgets for geometry, textures, draw calls, pixel ratio, memory, and loading.
4. Use progressive enhancement and preserve the page without WebGL or JavaScript.
5. Pause rendering offscreen, dispose resources, and handle context loss and resize.
6. Respect reduced motion, keyboard use, touch input, and readable content overlays.
7. Test low-power mobile hardware before approval.

Produce a feasibility note, scene specification, or scoped implementation plus profiling
evidence. Pass the gate only when utility, fallback, disposal, and device budgets hold.

Three.js is not installed in this repository. Do not add it until a specific approved
concept requires custom runtime 3D and the maintenance cost is accepted.
