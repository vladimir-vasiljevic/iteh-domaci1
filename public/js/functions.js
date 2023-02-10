function validateForm() {
    if(document.getElementById('first_name').value === '' || document.getElementById('first_name').value.length < 3)
        alert("First Name should be longer than 3 characters.");
    if(document.getElementById('last_name').value === '' || document.getElementById('last_name').value.length < 3)
        alert("Last Name should be longer than 3 characters.");
    if(!document.getElementById('email').value.indexOf('@') ||
        !document.getElementById('email').value.indexOf('.') ||
        (document.getElementById('email').value.indexOf('.') - document.getElementById('email').value.indexOf('@')) <= 2)
        alert("Invalid E-mail address.");
}

<!-- Menu Toggle Script -->
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});