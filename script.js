function changeImage(imageSrc) {
    document.getElementById('main-image').src = imageSrc;
}
document.querySelector('a[href="./contact.php"] button').onclick = function() {
    const price = document.getElementById('price').innerText;
    document.getElementById('price-input').value = price.replace('₹ ', '');
};
function showAlert() {
    alert("Thanks to Subscribe Kamalkishor Store!");
    return false; 
}
const stripe = Stripe('pk_test_51OyUMHSBMjjIWhVuN8BJtkbwC9ZqOVRN6GCKCOix3JqAdqHK8mHMcZddNEbN5GxIaSe4uIIVQ0vzxcSnb5MEnJTg00cMZopyo5pk_test_51OyUMHSBMjjIWhVuN8BJtkbwC9ZqOVRN6GCKCOix3JqAdqHK8mHMcZddNEbN5GxIaSe4uIIVQ0vzxcSnb5MEnJTg00cMZopyo5'); // Replace with your Stripe public key

