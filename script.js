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
