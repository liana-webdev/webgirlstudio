# lianawebdev technical context

## Stack

- PHP 8+ rendered pages
- Semantic HTML
- Standalone CSS
- Vanilla browser JavaScript
- Classic-hosting deployment
- No `package.json`, React runtime, bundler, or npm dependency graph

## Architecture

- Shared PHP output: `components/`
- Global page behavior: `assets/app.js`
- Portfolio behavior: `assets/portfolio.js`
- CSS: `assets/styles.css` and `assets/portfolio.css`
- Portfolio data and status: `content/projects.php`
- Form handling and security: `contact.php`
- Analytics: `components/analytics.php` and `assets/analytics-events.js`

## Local reusable behavior foundations

The following vanilla-JavaScript modules are created but not wired into public pages:

- `assets/lib/motion/motion-preference.js`
- `assets/lib/motion/reveal.js`
- `assets/lib/motion/magnetic-link.js`

They are local implementation code, not global WGS policy.

## Creative-development dependencies

GSAP, Motion, Three.js, and Spline are not website dependencies. Their global
skills provide decision guidance only. Installation requires a separate approved
implementation task, compatibility review, performance budget, fallback, and QA.

Motion for React and Motion AI Kit are inapplicable unless an approved future
surface adopts a compatible React architecture.

## Change boundary

Do not refactor production into a framework, add animation/3D libraries, or alter
visible pages as a side effect of Studio OS maintenance.
