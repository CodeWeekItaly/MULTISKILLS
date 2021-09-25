/* Show/hide panels for email/password changing */

const changeEmailBtn = document.querySelector('#change-email-btn');
const changePasswordBtn = document.querySelector('#change-password-btn');
const changeEmailPopup = document.querySelector('#email-change');
const changePasswordPopup = document.querySelector('#password-change');
const changeProfilePicBtn = document.querySelector('#change-photo-btn');
const changeProfilePicPopup = document.querySelector('#profilepic-change');

const cancelEmailBtn = document.querySelector('#cancel-email-btn');
const cancelPassowrdBtn = document.querySelector('#cancel-password-btn');
const cancelProfilePicBtn = document.querySelector('#cancel-profilepic-btn');

changeEmailBtn.addEventListener('click', () => {
    changeEmailPopup.classList.remove('hidden');
});

changePasswordBtn.addEventListener('click', () => {
    changePasswordPopup.classList.remove('hidden');
});

changeProfilePicBtn.addEventListener('click', () => {
    changeProfilePicPopup.classList.remove('hidden');
});

cancelEmailBtn.addEventListener('click', () => {
    changeEmailPopup.classList.add('hidden');
});

cancelPassowrdBtn.addEventListener('click', () => {
    changePasswordPopup.classList.add('hidden');
});

cancelProfilePicBtn.addEventListener('click', () => {
    changeProfilePicPopup.classList.add('hidden');
});