import { prefersReducedMotion } from "./motion-preference.js";

export function createMagneticLink(element, { strength = 0.16 } = {}) {
  const finePointer = window.matchMedia("(hover: hover) and (pointer: fine)").matches;
  if (!finePointer || prefersReducedMotion()) return () => {};

  const move = (event) => {
    const bounds = element.getBoundingClientRect();
    const x = (event.clientX - bounds.left - bounds.width / 2) * strength;
    const y = (event.clientY - bounds.top - bounds.height / 2) * strength;
    element.style.transform = `translate3d(${x}px, ${y}px, 0)`;
  };
  const reset = () => { element.style.transform = ""; };

  element.addEventListener("pointermove", move, { passive: true });
  element.addEventListener("pointerleave", reset);
  return () => {
    element.removeEventListener("pointermove", move);
    element.removeEventListener("pointerleave", reset);
    reset();
  };
}
