document.addEventListener("DOMContentLoaded", () => {
  // animasi fade
  const faders = document.querySelectorAll(".fade");
  const appearOnScroll = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      entry.target.classList.add("show");
      observer.unobserve(entry.target);
    });
  }, { threshold: 0.2 });
  faders.forEach(fader => appearOnScroll.observe(fader));

  // handle form submit
  const form = document.getElementById("orderForm");
  const popup = document.getElementById("popup");

  form.addEventListener("submit", function(e) {
    e.preventDefault();
    const formData = new FormData(form);

    fetch("order_process.php", {
      method: "POST",
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      console.log("Respon dari server:", data); // debug
      if (data.success) {
        popup.style.display = "flex";
      } else {
        alert("Gagal mengirim pesanan: " + (data.error || ""));
      }
    })
    .catch(err => {
      console.error("Fetch error:", err);
      alert("Terjadi kesalahan pada server.");
    });
  });
});
