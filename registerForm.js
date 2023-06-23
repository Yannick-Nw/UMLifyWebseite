document.getElementById('register-form').addEventListener('submit', function(e) {
    e.preventDefault();
  
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
  
    var inputDisplay = document.getElementById('input-display');
    inputDisplay.innerHTML += "<p>Username: " + username + ", Password: " + password + "</p>";
  
    // Clear the form fields
    document.getElementById('username').value = '';
    document.getElementById('password').value = '';
  });
  