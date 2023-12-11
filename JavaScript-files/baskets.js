function showReviewForm(product1) {
    document.getElementById(`reviewForm${product1}`).style.display = "block";
}

function submitReview(product1) {
    const review = document.getElementById(`review${product1}`).value;
    // Implement your logic to handle the review submission, e.g., send it to a server
    alert(`Review for ${product1}: ${review} submitted successfully!`);
    // Reset the form
    document.getElementById(`reviewForm${product1}`).reset();
    // Hide the form after submission
    document.getElementById(`reviewForm${product1}`).style.display = "none";
}

let basketItems = []; // Simulating the basket as an array

function addToBasket() {
    const productDiv = this.closest('.product1');
    const productName = productDiv.textContent.trim().split(' + ')[0];
    const quantity = parseInt(productDiv.querySelector('.quantity input').value, 10);

    // Check if the product is already in the basket
    const existingItemIndex = basketItems.findIndex(item => item.productName === productName);

    if (existingItemIndex !== -1) {
        // If the product is already in the basket, update the quantity
        basketItems[existingItemIndex].quantity += quantity;
    } else {
        // If the product is not in the basket, add it
        basketItems.push({ productName, quantity });
    }

    updateBasket();
}

function removeFromBasket() {
    const productDiv = this.closest('.product1');
    const productName = productDiv.textContent.trim().split(' + ')[0];

    // Find the index of the product in the basket
    const existingItemIndex = basketItems.findIndex(item => item.productName === productName);

    if (existingItemIndex !== -1) {
        // If the product is in the basket, remove it
        basketItems.splice(existingItemIndex, 1);
        updateBasket();
    }
}

function updateBasket() {
    // Display the updated basket items on the page
    const basketDiv = document.getElementById('basket');
    basketDiv.innerHTML = '';

    basketItems.forEach(item => {
        const itemDiv = document.createElement('div');
        itemDiv.innerText = `${item.productName} - Quantity: ${item.quantity}`;
        basketDiv.appendChild(itemDiv);
    });
}

