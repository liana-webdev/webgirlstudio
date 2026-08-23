# Motion AI Kit — Deferred Installation

The current WGS production repository has no `package.json`, React, or agent
package configuration. Motion for React requires React 18.2+, so neither Motion
nor Motion AI Kit was installed.

If an approved future project adopts React 18.2+:

1. Confirm the project-level package root and React version.
2. Check that `motion` is not already installed.
3. Run `npm install motion` in that project only.
4. Import from `motion/react`.
5. Run `npx motion-ai@latest` from the project root.
6. Select the project-level/custom-agent setup; do not write into unrelated projects.
7. Keep credentials or Motion+ tokens out of Git.
8. Validate the installed integration against <https://motion.dev/docs/ai-kit-install>.

Do not perform these steps in this classic PHP repository unless its approved
technical architecture changes.
