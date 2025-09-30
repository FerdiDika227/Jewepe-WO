document.addEventListener("DOMContentLoaded", () => {
  const loginBox = document.querySelector(".login-container");
  
  // fade in saat halaman terbuka
  setTimeout(() => {
    loginBox.classList.add("show");
  }, 200);

  // animasi fade out sebelum pindah halaman
  const links = document.querySelectorAll("form, .btn.back");
  links.forEach(el => {
    el.addEventListener("submit", fadeOutHandler);
    el.addEventListener("click", fadeOutHandler);
  });

  function fadeOutHandler(e) {
    if (el.tagName === "A" || el.tagName === "FORM") {
      e.preventDefault();
      loginBox.classList.remove("show");
      setTimeout(() => {
        if (el.tagName === "A") {
          window.location.href = el.getAttribute("href");
        } else {
          e.target.submit();
        }
      }, 600);
    }
  }
});
