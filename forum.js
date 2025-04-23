// Select the "Comment" button
const commentButton = document.querySelector('.btn.comment');

// Add a click event listener to the button
commentButton.addEventListener('click', function () {
    // Navigate to the "submit.html" page
    window.location.href = 'submit.php';
});