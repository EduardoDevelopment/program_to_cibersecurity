const openNavButton = document.getElementById('openNav');
const closeNavButton = document.getElementById('closeNav');
const responsiveNav = document.getElementById('responsiveNav');
const mainContent = document.querySelector('main');

openNavButton.addEventListener('click', () => {
    responsiveNav.classList.remove('translate-x-full');
});

closeNavButton.addEventListener('click', () => {
    responsiveNav.classList.add('translate-x-full');
});

// Cerrar el menú al dar clic en un link
const links = document.querySelectorAll('#responsiveNav a');
links.forEach(link => {
    link.addEventListener('click', () => {
        responsiveNav.classList.add('translate-x-full');
    });
});

// Cerrar el menú al dar clic fuera del menú
document.addEventListener('click', (event) => {
    if (!responsiveNav.contains(event.target) && !openNavButton.contains(event.target)) {
        responsiveNav.classList.add('translate-x-full');
    }
});

// Cerrar el menú deslizándose o tocando fuera del menú
let startX = 0;
let dist = 0;

document.addEventListener('touchstart', (event) => {
    const touch = event.touches[0];
    startX = touch.clientX;
});

document.addEventListener('touchmove', (event) => {
    const touch = event.touches[0];
    dist = touch.clientX - startX;
});

document.addEventListener('touchend', () => {
    if (dist > 50) {
        responsiveNav.classList.add('translate-x-full');
    }
});