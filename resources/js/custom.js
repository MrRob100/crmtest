//company
function populateEditFields(key) {
    //name
    var nameField = document.getElementById('comp-name-' + key);
    var nameValue = nameField.innerText;

    var nameInput = document.getElementById('name');
    nameInput.value = nameValue;


    //email
    var emailField = document.getElementById('comp-email-' + key);
    var emailValue = emailField.innerText;

    var emailInput = document.getElementById('email');
    emailInput.value = emailValue;


    //website
    var websiteField = document.getElementById('comp-website-' + key);
    var websiteValue = websiteField.innerText;

    var websiteInput = document.getElementById('website');
    websiteInput.value = websiteValue;


    //other
    var modalLabel = document.getElementById('createModalLabel');
    modalLabel.innerText = 'Edit Company'

    var form = document.getElementById('createModalLabel');
    var routName = window.origin;
    form.setAttribute('action', routName);
}

function clearForm() {
    $('.form-control').val('');

    //other
    var modalLabel = document.getElementById('createModalLabel');
    modalLabel.innerText = 'Create new company';
}

