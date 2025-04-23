// Select elements
const menuIcon = document.querySelector('#menu-icon');
const navbar = document.querySelector('.navbar');
const navbg = document.querySelector('.nav-bg');
const testimonialContainer = document.querySelector(".testimonial-container");
const testimonialBoxes = document.querySelectorAll(".testimonial-box");
const subscribeBtn = document.getElementById("subscribe-btn");
const closePopupBtn = document.getElementById("close-popup");
const subscribePopup = document.getElementById("subscribe-popup");

// Toggle menu functionality
menuIcon.addEventListener('click', () => {
  menuIcon.classList.toggle('bx-x');
  navbar.classList.toggle('active');
  navbg.classList.toggle('active');
});

// Subscribe pop-up functionality
if (subscribeBtn && subscribePopup && closePopupBtn) {
  // Show pop-up
  subscribeBtn.addEventListener("click", function (event) {
    event.preventDefault();
    subscribePopup.style.display = "flex";
  });

  // Close pop-up
  closePopupBtn.addEventListener("click", function () {
    subscribePopup.style.display = "none";
  });

  // Close pop-up when clicking outside the pop-up
  window.addEventListener("click", function (event) {
    if (event.target === subscribePopup) {
      subscribePopup.style.display = "none";
    }
  });
} else {
  console.error("Subscribe button, pop-up, or close button not found in the DOM.");
}

// Testimonial slider functionality
let currentSlide = 0;
function showslide(index) {
  if (testimonialBoxes.length === 0) return;
  const offset = -index * testimonialBoxes[0].offsetWidth;
  testimonialContainer.style.transform = `translateX(${offset}px)`;
}

function showPreviousSlide() {
  currentSlide = (currentSlide - 1 + testimonialBoxes.length) % testimonialBoxes.length;
  showslide(currentSlide);
}

function showNextSlide() {
  currentSlide = (currentSlide + 1) % testimonialBoxes.length;
  showslide(currentSlide);
}

showslide(currentSlide);
