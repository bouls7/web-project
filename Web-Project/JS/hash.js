import { state } from "./variables.js";

window.checkHash = function () {
   if (localStorage.getItem('navigateToMember2') === 'true') {
        state.index = 1;
        state.currentPage = 2;
        document.querySelector('.carousel').style.transform = `translateX(${-state.index * 100}%)`;
        document.getElementById('page-number').textContent = state.currentPage + "/3";
        localStorage.removeItem('navigateToMember2');
    } else if (localStorage.getItem('navigateToMember3') === 'true') {
        state.index = 2;
        state.currentPage = 3;
        document.querySelector('.carousel').style.transform = `translateX(${-state.index * 100}%)`;
        document.getElementById('page-number').textContent = state.currentPage + "/3";
        localStorage.removeItem('navigateToMember3');
    }
};