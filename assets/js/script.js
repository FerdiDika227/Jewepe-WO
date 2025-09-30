// Animasi fade out saat scroll
document.addEventListener("DOMContentLoaded", () => {
  const faders = document.querySelectorAll(".fade, .paket-item, .card");

  const options = {
    threshold: 0.2
  };

  const appearOnScroll = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      entry.target.classList.add("show");
      observer.unobserve(entry.target);
    });
  }, options);

  faders.forEach(fader => {
    appearOnScroll.observe(fader);
  });
});
