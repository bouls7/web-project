document.addEventListener("scroll", () => {
    const header = document.querySelector(".schedule-header");
    const scheduleContainer = document.querySelector(".schedule-container");
    const containerTop = scheduleContainer.getBoundingClientRect().top + window.scrollY;

    if (window.scrollY >= containerTop && header.dataset.fixed === "false") {
        header.dataset.fixed = "true";
        header.classList.add("fixed");
    } else if (window.scrollY < containerTop && header.dataset.fixed === "true") {
        header.dataset.fixed = "false";
        header.classList.remove("fixed");
    }
});


