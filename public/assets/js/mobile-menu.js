const menuBtn = document.getElementById('nav__mobile__button');
const body = document.body;
const closeMenuElements = [...document.querySelectorAll('[data-close-menu]')]

menuBtn.addEventListener('click', () => {
    body.classList.toggle('menu-open');
})

closeMenuElements.forEach((element) => {
    element.addEventListener('click', () => {
        body.classList.remove('menu-open');
    })
})


window.addEventListener('resize', () => {
    if (window.innerWidth >= 1000) {
        body.classList.remove('menu-open');
    }
})