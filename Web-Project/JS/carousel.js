import { state } from "./variables.js";

document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.querySelector('.carousel');
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');
    const pageNumber = document.getElementById('page-number');
    const totalPages = 3;

    function updateCarousel() {
        carousel.style.transform = `translateX(${-state.index * 100}%)`;
    }

    function updatePageNumber() {
        pageNumber.textContent = state.currentPage + "/" + totalPages;
    }

    nextButton.addEventListener('click', () => {
        if (state.index < 2) {
            state.index++;
            updateCarousel();
        }
        if (state.currentPage < totalPages) {
            state.currentPage++;
            updatePageNumber();
        }
    });

    prevButton.addEventListener('click', () => {
        if (state.index > 0) {
            state.index--;
            updateCarousel();
        }
        if (state.currentPage > 1) {
            state.currentPage--;
            updatePageNumber();
        }
    });
});

