import { prefersReducedMotion } from "./motion-preference.js";

export function createRevealObserver(elements, reveal, options = {}) {
  const targets = [...elements];
  if (!targets.length) return () => {};

  if (prefersReducedMotion() || !("IntersectionObserver" in window)) {
    targets.forEach((element) => reveal(element));
    return () => {};
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) return;
      reveal(entry.target);
      observer.unobserve(entry.target);
    });
  }, { threshold: 0.12, rootMargin: "0px 0px -8%", ...options });

  targets.forEach((element) => observer.observe(element));
  return () => observer.disconnect();
}
