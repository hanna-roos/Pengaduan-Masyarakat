window.addEventListener("load", () => {
  setTimeout(() => {
    const preloader = document.getElementById("preloader");
    preloader.style.opacity = "0";
    preloader.style.transition = "opacity 0.8s ease";
    setTimeout(() => {
      preloader.style.display = "none";
    }, 800);
  }, 1000);
});
