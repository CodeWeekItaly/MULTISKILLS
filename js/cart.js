const labelTotal = document.querySelector('#cart-total');
const cartItems = document.querySelectorAll('.cart-item-name');
const itemsQty = document.querySelectorAll('.cart-item-quantity-number');
const itemsPrice = document.querySelectorAll('.cart-item-price');
const itemsTotal = document.querySelectorAll('.cart-item-total');

const summaryList = document.querySelector('.cart-summary-list');

window.onload = () => {
    // list all items in cart in summary list
    for (let i = 0; i < cartItems.length; i++) {
        const itemName = cartItems[i].innerText;
        const itemQtyNumber = itemsQty[i].innerHTML;
        const itemPriceNumber = itemsPrice[i].innerHTML;
        const itemTotalNumber = itemsTotal[i].innerHTML;

        const itemList = document.createElement('li');
        itemList.classList.add('cart-summary-item');
        itemList.innerHTML = `(x${itemQtyNumber}) ${itemName} - ${itemTotalNumber}`;
        summaryList.appendChild(itemList);
    }

    // update total price
    let total = 0;
    itemsTotal.forEach(item => {
        total += parseFloat(item.innerText.substr(2));
    });
    labelTotal.innerText = '€ ' + total.toFixed(2);
}
