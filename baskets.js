function showReviewForm(product) {
    document.getElementById(`reviewForm${product}`).style.display = "block";
}

function submitReview(product) {
    const review = document.getElementById(`review${product}`).value;
    // Implement your logic to handle the review submission, e.g., send it to a server
    alert(`Review for ${product}: ${review} submitted successfully!`);
    // Reset the form
    document.getElementById(`reviewForm${product}`).reset();
    // Hide the form after submission
    document.getElementById(`reviewForm${product}`).style.display = "none";
}

function addToBasket() {
    const productDiv = this.closest('.product');
    const productName = productDiv.textContent.trim().split(' + ')[0];
    const quantity = productDiv.querySelector('.quantity input').value;
};

function removeFromBasket() {
    const productDiv = this.closest('.product');
    const productName = productDiv.textContent.trim().split(' + ')[0];
};    