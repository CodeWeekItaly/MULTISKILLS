/* ----------------------------------------------------------- */

let password = document.querySelector("#password");
let rpassword = document.querySelector("#rpassword");
let form = document.querySelector("#registration-form")

form.addEventListener("submit", (e) => {
    if (password.value !== rpassword.value) {
        e.preventDefault();
        alert("Passwords are not the same");
    }
});

/* ----------------------------------------------------------- */

const merchantCheck = document.querySelector("#isSeller");
const merchantCompanyName = document.querySelector("#company");
const merchantCompanyCity = document.querySelector("#companylocation");
const merchantCompanyDiv = document.querySelector("#companylocationdiv");

merchantCheck.addEventListener("change", () => {
    if (merchantCheck.checked) {
        merchantCompanyName.required = true;
        merchantCompanyCity.required = true;
        merchantCompanyDiv.classList.remove("hidden");
    } else {
        merchantCompanyName.required = false;
        merchantCompanyCity.required = false;
        merchantCompanyDiv.classList.add("hidden");
    }
});