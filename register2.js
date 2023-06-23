$(document).ready(function () {
    $('#username, #email, #password').on('input', function () {
        var value = $(this).val();
        var targetId = $(this).attr('id') + 'Confirmation';
        var isValid = validateInput($(this).attr('id'), value);
        updateConfirmation(targetId, isValid);
    });
});

function validateInput(fieldId, value) {
    // Perform validation logic here
    // You can check if the value is in the accepted format or already in use
    // Return true if the value is accepted, false otherwise
    // Example validation logic for username, email, and password fields:
    switch (fieldId) {
        case 'username':
            // Validate username format
            return /^[a-zA-Z0-9_]+$/.test(value);
        case 'email':
            // Validate email format
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
        case 'password':
            // Validate password format
            return value.length >= 8;
        default:
            return true;
    }
}

function updateConfirmation(targetId, isValid) {
    var confirmationElement = $('#' + targetId);
    confirmationElement.removeClass('valid invalid');
    confirmationElement.text(isValid ? '✓' : '✕');
    confirmationElement.addClass(isValid ? 'valid' : 'invalid');
}
