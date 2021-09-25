function featureNotAvailable() {
    alert("Feature not available yet")
}

/* ------------------------------------------------------------ */

const params = new URLSearchParams(window.location.search);

const qtySelector = document.querySelector('#quantity');
const addToCartBtn = document.querySelector('#add-to-cart-btn');

qtySelector.addEventListener('change', () => {
    let urlButton = `php/cart.php?action=add&id=${params.get('id')}&quantity=${qtySelector.value}`
    addToCartBtn.href = urlButton;
});

/* ------------------------------------------------------------ */

const addReviewBtn = document.querySelector('#add-review-btn');
const reviewForm = document.querySelector('.review-box');

let isFormVisible = false;

addReviewBtn.addEventListener('click', () => {
    if (!isFormVisible) {
        isFormVisible = true;
        addReviewBtn.classList.remove('btn-outline-primary');
        addReviewBtn.classList.add('btn-outline-danger');
        addReviewBtn.innerText = "Cancel review";
    } else {
        isFormVisible = false;
        addReviewBtn.classList.remove('btn-outline-danger');
        addReviewBtn.classList.add('btn-outline-primary');
        addReviewBtn.innerText = "Add a review";
    }    
    reviewForm.classList.toggle('hidden');
});