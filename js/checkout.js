// Shipping method selection

const deliveryAtHome = document.querySelector('#athome');
const inStorePickup = document.querySelector('#instorepickup');
const shippingAddressDiv = document.querySelector('#shipping-address-div');


// Payment methods selection

const payInStore = document.querySelector('#pay-in-store');
const payCard = document.querySelector('#pay-with-card');
const payPal = document.querySelector('#pay-with-paypal');

const payInStoreDiv = document.querySelector('.payInStoreDiv');
const payCardDiv = document.querySelector('.payCardDiv');
const payPalDiv = document.querySelector('.payPalDiv');

const radioButtonsShipping = [deliveryAtHome, inStorePickup];
const radioButtonsPayment = [payInStore, payCard, payPal];
const paymentDiv = [payInStoreDiv, payCardDiv, payPalDiv];

//payments data
const username = document.querySelector("#name");
const surname = document.querySelector("#surname");
const city = document.querySelector("#city");
const state = document.querySelector("#state");
const zipcode = document.querySelector("#zipcode");
const address = document.querySelector("address");

//billing data
const card_num = document.querySelector("#card-number");
const card_hold = document.querySelector("#card-holder");
const card_exp = document.querySelector("#card-expire");
const card_cvv = document.querySelector("#card-cvv");


for (let radio of radioButtonsShipping) {
    radio.addEventListener('change', () => {
        if (deliveryAtHome.checked) {
            shippingAddressDiv.classList.remove('hidden');
            payInStore.disabled = true;
            payInStore.parentElement.style.opacity = 0.5;
            payCard.checked = true;
            paymentDiv[0].classList.add('hidden');
            paymentDiv[1].classList.remove('hidden');
            paymentDiv[2].classList.add('hidden');
            username.attributes["required"] = "true";
            surname.attributes["required"] = "true";
            city.attributes["required"] = "true";
            state.attributes["required"] = "true";
            zipcode.attributes["required"] = "true";
            address.attributes["required"] = "true";
        } else if (inStorePickup.checked) {
            shippingAddressDiv.classList.add('hidden');
            payInStore.disabled = false;
            payInStore.parentElement.style.opacity = 1;
            username.attributes["required"] = "false";
            surname.attributes["required"] = "false";
            city.attributes["required"] = "false";
            state.attributes["required"] = "false";
            zipcode.attributes["required"] = "false";
            address.attributes["required"] = "false";
        }
    });
}

for (let i = 0; i < 3; i++) {
    radioButtonsPayment[i].addEventListener('change', () => {
        if (payInStore.checked) {
            paymentDiv[0].classList.remove('hidden');
            paymentDiv[1].classList.add('hidden');
            paymentDiv[2].classList.add('hidden');

            card_num.attributes["required"] = "false";
            card_hold.attributes["required"] = "false";
            card_exp.attributes["required"] = "false";
            card_cvv.attributes["required"] = "false";
        } else if (payCard.checked) {
            paymentDiv[0].classList.add('hidden');
            paymentDiv[1].classList.remove('hidden');
            paymentDiv[2].classList.add('hidden');

            card_num.attributes["required"] = "true";
            card_hold.attributes["required"] = "true";
            card_exp.attributes["required"] = "true";
            card_cvv.attributes["required"] = "true";
        } else if (payPal.checked) {
            paymentDiv[0].classList.add('hidden');
            paymentDiv[1].classList.add('hidden');
            paymentDiv[2].classList.remove('hidden');

            card_num.attributes["required"] = "true";
            card_hold.attributes["required"] = "true";
            card_exp.attributes["required"] = "true";
            card_cvv.attributes["required"] = "true";
        }
    });
}


// Billing address selection

const billingAddressDiv = document.querySelector('.card-billing-info');
const sameBillingAddress = document.querySelector('#card-same-billing-address');

sameBillingAddress.addEventListener('change', () => {
    if (sameBillingAddress.checked) {
        billingAddressDiv.classList.add('hidden');
    } else {
        billingAddressDiv.classList.remove('hidden');
    }
});
