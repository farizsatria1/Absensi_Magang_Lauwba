const navbar = document.querySelector('.navbar');
const toggle = document.querySelector('.navbar-toggle');

toggle.addEventListener('click', () => {
  navbar.classList.toggle('navbar-active');
});
