// Simple Carousel
let index = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;
const prevBtn = document.querySelector('.prev');
const nextBtn = document.querySelector('.next');

function showSlide(i) {
  slides.forEach((slide, idx) => {
    slide.classList.remove('active');
    if (idx === i) slide.classList.add('active');
  });
  document.querySelector('.carousel-container').style.transform = `translateX(-${i * 100}%)`;
}

prevBtn.addEventListener('click', () => {
  index = (index > 0) ? index - 1 : totalSlides - 1;
  showSlide(index);
});

nextBtn.addEventListener('click', () => {
  index = (index + 1) % totalSlides;
  showSlide(index);
});

// Auto-slide every 5s
setInterval(() => {
  index = (index + 1) % totalSlides;
  showSlide(index);
}, 5000);
