// === Carrossel de fundo ===
const images = document.querySelectorAll('.carousel-container img');
let current = 0;

function nextImage() {
    images[current].classList.remove('active');
    current = (current + 1) % images.length;
    images[current].classList.add('active');
}

setInterval(nextImage, 5000); 
