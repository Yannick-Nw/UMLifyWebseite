<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <div class="container">
    <div class="left-form">
      <h2>Registration Form</h2>
      <form id="register-form">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Register</button>
      </form>
    </div>
    <div class="right-form">
      <h2>Input Display</h2>
      <div id="input-display"></div>
    </div>
  </div>
  <script src="script.js"></script>
</body>
</html>
