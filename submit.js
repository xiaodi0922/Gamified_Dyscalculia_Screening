const allStars = document.querySelectorAll('.rating .star');
const ratingInput = document.querySelector('.rating input');

allStars.forEach((star, index) => {
    star.addEventListener('click', function () {
        ratingInput.value = index + 1;
        console.log(ratingInput.value);

        allStars.forEach((s, i) => {
            s.classList.replace('bxs-star', 'bx-star');
            s.classList.remove('active');
            if (i <= index) {
                s.classList.replace('bx-star', 'bxs-star');
                s.classList.add('active');
            }
        });
    });
});

// Select the "Cancel" button
const cancelButton = document.querySelector('.btn.cancel');

// Add a click event listener to the button
cancelButton.addEventListener('click', function () {
    // Navigate to the "forum.html" page
    window.location.href = 'forum.html';
});
