# WGS QA

Select checks in proportion to risk and record evidence in project `09-qa.md`.

## Content and truth

- Approved final copy, labels, links, contact data, legal text, and project status
- No placeholders, fake results, unapproved testimonials, or draft assets

## Structure and accessibility

- Semantic landmarks/headings, keyboard order, visible focus, labels, errors
- Contrast, zoom/reflow, alternative text, disclosure state, reduced motion

## Responsive and browser

- Narrow phone, tablet, desktop, coarse/fine pointer, common browsers
- No overflow, clipping, accidental tiny type, broken image crops, or hidden actions

## Functional

- Navigation, buttons, forms, booking, email/phone links, downloads, interactive demos
- Success, validation, failure, empty, loading, and back/forward states

## Technical

- PHP/JS syntax, console errors, network failures, image dimensions, performance
- Canonical URL, metadata, OG image, indexing rules, redirects, structured data
- Analytics only on intended host; events contain no form values or sensitive data

## Current repository commands

Run PHP lint with an available PHP 8 binary. Start the local server on port 8099
and run `scripts/portfolio-smoke.cjs` and `scripts/analytics-smoke.cjs` with the
documented Playwright module path. Submit a real test enquiry only in an approved
test environment.
