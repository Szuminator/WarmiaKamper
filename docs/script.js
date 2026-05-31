const heroImage = document.querySelector('.hero-image');

const heroImages = [
  'images/hero.webp',
  'images/gallery-6.webp',
  'images/gallery-7.webp',
  'images/gallery-8.webp',
  'images/gallery-10.webp',
  'images/gallery-12.webp'
];

let heroIndex = 0;

setInterval(() => {

  heroImage.style.opacity = 0;

  setTimeout(() => {

    heroIndex++;

    if (heroIndex >= heroImages.length) {
      heroIndex = 0;
    }

    heroImage.src = heroImages[heroIndex];

    heroImage.style.opacity = 1;

  }, 300);

}, 3000);

const header = document.querySelector('.header');

window.addEventListener('scroll', () => {

  if (window.scrollY > 40) {
    header.style.background = 'rgba(255,255,255,0.98)';
  } else {
    header.style.background = 'rgba(255,255,255,0.95)';
  }

});

/*const galleryImages = document.querySelectorAll('.gallery-grid img');

const lightbox = document.getElementById('lightbox');
const lightboxImage = document.querySelector('.lightbox-image');
const lightboxClose = document.querySelector('.lightbox-close');
const prevBtn = document.querySelector('.lightbox-prev');
const nextBtn = document.querySelector('.lightbox-next');

let currentIndex = 0;


galleryImages.forEach((image, index) => {
  image.addEventListener('click', () => {
    currentIndex = index;
    openLightbox();
  });
});

lightboxClose.addEventListener('click', () => {
  lightbox.classList.remove('active');
});

lightbox.addEventListener('click', (e) => {

  if (e.target !== lightboxImage) {
    lightbox.classList.remove('active');
  }

});*/
const galleryImages = document.querySelectorAll('.gallery-grid img');

const lightbox = document.getElementById('lightbox');
const lightboxImage = document.querySelector('.lightbox-image');
const lightboxClose = document.querySelector('.lightbox-close');
const prevBtn = document.querySelector('.lightbox-prev');
const nextBtn = document.querySelector('.lightbox-next');

let currentIndex = 0;

// otwieranie
galleryImages.forEach((img, index) => {
  img.addEventListener('click', () => {
    currentIndex = index;
    openLightbox();
  });
});

function openLightbox() {
  lightbox.classList.add('active');
  updateImage();
}

function updateImage() {
  lightboxImage.src = galleryImages[currentIndex].src;
}

// next
function showNext() {
  currentIndex = (currentIndex + 1) % galleryImages.length;
  updateImage();
}

// prev
function showPrev() {
  currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
  updateImage();
}

nextBtn.addEventListener('click', (e) => {
  e.stopPropagation();
  showNext();
});

prevBtn.addEventListener('click', (e) => {
  e.stopPropagation();
  showPrev();
});

// close
lightboxClose.addEventListener('click', () => {
  lightbox.classList.remove('active');
});

// klik w tło (ale NIE w strzałki)
/*
lightbox.addEventListener('click', (e) => {
  if (
    e.target === lightbox ||
    e.target === lightboxImage
  ) {
    lightbox.classList.remove('active');
  }
});

lightbox.addEventListener('click', (e) => {
  const isNav = e.target === nextBtn || e.target === prevBtn;

  if (isNav) return;

  if (e.target === lightbox) {
    lightbox.classList.remove('active');
  }
});*/

lightbox.addEventListener('click', (e) => {
  if (e.target === lightbox) {
    lightbox.classList.remove('active');
  }
});

document.addEventListener('DOMContentLoaded', () => {

  const menuToggle = document.querySelector('.menu-toggle');
  const navLinks = document.querySelector('.nav-links');

  // otwieranie / zamykanie menu
  menuToggle.addEventListener('click', () => {
    navLinks.classList.toggle('active');
  });

  // zamykanie po kliknięciu w link
  document.querySelectorAll('.nav-links a').forEach(link => {
    link.addEventListener('click', () => {
      navLinks.classList.remove('active');
    });
  });

});

function openLightbox() {
  lightbox.classList.add('active');
  updateImage();
}

function updateImage() {
  lightboxImage.src = galleryImages[currentIndex].src;
}

