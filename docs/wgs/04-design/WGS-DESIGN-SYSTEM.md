# WGS Design System

WGS needs a flexible foundation, not one visual skin imposed on every project.

## System layers

1. **Accessibility foundation:** semantic HTML, focus, contrast, keyboard access,
   reduced motion, labels, error handling.
2. **Tokens:** colour roles, type roles, spacing rhythm, layout widths, borders,
   motion durations/easing, and z-index roles.
3. **Behaviour:** navigation, disclosure, media loading, form state, reveal,
   focus management, and responsive transformation.
4. **Project expression:** art direction, composition, image treatment, geometry,
   and motion grammar specific to the brief.

## Current implementation

- Global/project CSS: `assets/styles.css`, `assets/portfolio.css`.
- Shared PHP output: `components/`.
- Existing JS behaviours: `assets/app.js`, `assets/portfolio.js`.
- Reusable future behaviour modules: `assets/lib/`.

Do not refactor production into a new framework or token format without a scoped
implementation task and regression plan.

## Incomplete

Token names, browser-support policy, and a formal component catalogue require a
future implementation decision. Current CSS values remain production truth.
