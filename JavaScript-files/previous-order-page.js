// Function to show the review form
function showReviewForm(product) {
    const reviewForm = document.getElementById(`reviewForm${product}`);
    reviewForm.style.display = "block";
}

// Function to submit a review
function submitReview(product) {
    const reviewInput = document.getElementById(`review${product}`);
    const review = reviewInput.value;

    if (review.trim() !== "") {

        const url = `previous-order-page.php?product=${product}&review=${encodeURIComponent(review)}`;

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            
        })
        .then(response => response.json())
        .then(data => {
            alert(`Review for ${product} submitted successfully!`);
            // Optionally, update the UI or take other actions based on the server's response
        })
        .catch(error => {
            console.error('Error submitting review:', error);
            // Handle error scenarios
        });

        // Reset the form
        reviewInput.value = "";
        // Hide the form after submission
        document.getElementById(`reviewForm${product}`).style.display = "none";
    } else {
        alert("Please enter a valid review before submitting.");
    }
}

