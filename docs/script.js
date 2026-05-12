const header = document.querySelector('.header');

window.addEventListener('scroll', () => {

  if (window.scrollY > 40) {
    header.style.background = 'rgba(255,255,255,0.98)';
  } else {
    header.style.background = 'rgba(255,255,255,0.95)';
  }

});

const galleryImages = document.querySelectorAll('.gallery-grid img');

const lightbox = document.getElementById('lightbox');
const lightboxImage = document.querySelector('.lightbox-image');
const lightboxClose = document.querySelector('.lightbox-close');

galleryImages.forEach(image => {

  image.addEventListener('click', () => {

    lightbox.classList.add('active');

    lightboxImage.src = image.src;
  });

});

lightboxClose.addEventListener('click', () => {
  lightbox.classList.remove('active');
});

lightbox.addEventListener('click', (e) => {

  if (e.target !== lightboxImage) {
    lightbox.classList.remove('active');
  }

});

const menuToggle = document.querySelector('.menu-toggle');
const navLinks = document.querySelector('.nav-links');

menuToggle.addEventListener('click', () => {
  navLinks.classList.toggle('active');
});