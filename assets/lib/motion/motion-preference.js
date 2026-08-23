export function prefersReducedMotion() {
  return window.matchMedia("(prefers-reduced-motion: reduce)").matches;
}

export function onMotionPreferenceChange(callback) {
  const query = window.matchMedia("(prefers-reduced-motion: reduce)");
  const handleChange = (event) => callback(event.matches);
  query.addEventListener("change", handleChange);
  return () => query.removeEventListener("change", handleChange);
}
