function validateForm() {
    if(document.getElementById('first_name').value === '' || document.getElementById('first_name').value.length < 3)
        alert("Ime mora da bude duže od 2 karaktera..");
    if(document.getElementById('last_name').value === '' || document.getElementById('last_name').value.length < 3)
        alert("Prezime mora da bude duže od 2 karaktera.");
    if(!document.getElementById('email').value.indexOf('@') ||
        !document.getElementById('email').value.indexOf('.') ||
        (document.getElementById('email').value.indexOf('.') - document.getElementById('email').value.indexOf('@')) <= 2)
        alert("Neispravna email adresa.");
}

<!-- Menu Toggle Script -->
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});