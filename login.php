<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <script src="animation.js"></script>
</head>
<body>
<?php
$show_form = True;
include 'top_navbar.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
}
?>
    <div class="header">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 my-5">
                <h1 class="title text-center">Log In</h1>
                <form id="login-form" method="POST" action="login.php">
                <input id="input-1" name="username" type="text" placeholder="john" onkeydown="handleUsernameInput(event)" />
                    <label for="input-1">
                        <span class="label-text">Username</span>
                        <span class="nav-dot">Username</span>
                        <div class="login-button-trigger">Log In</div>
                    </label>
                    <input id="input-2" type="password" name="password" placeholder="&#9679;&#9679;EnterYourPassword&#9679;&#9679;" />
                    <label for="input-2">
                        <span class="label-text">Password</span>
                        <span class="nav-dot">Password</span>
                    </label>
                    <?php
                    if (isset($_POST["submit"])) {
                        require("dbaccess.php");
                        $sql = "SELECT USERNAME, PASSWORD, ID FROM accounts WHERE USERNAME = ?";
                        $stmt = mysqli_stmt_init($mysqli);
                        mysqli_stmt_prepare($stmt, $sql);
                        mysqli_stmt_bind_param($stmt, "s", $username);
                        mysqli_stmt_execute($stmt);
                        $results = mysqli_stmt_get_result($stmt);
                        if (!($row = mysqli_fetch_assoc($results))) {
                            ?>
                            <p style="color: yellow; font-size: 20px"> Username existiert nicht!</p>
                            <?php
                        } else if (!password_verify($password, $row["PASSWORD"])) {
                            ?>
                            <p style="color: yellow; font-size: 20px"> Falsches Passwort! </p>
                        <?php } else {
                            $_SESSION["username"] = $row["USERNAME"];
                            $_SESSION["id"] = $row["ID"];
                            echo "<h2 style='color: green; font-size: 20px'>Login erfolgreich</h2>";
                            header('Refresh: 1; URL = index.php');
                        }
                    }
                    ?>
                    <button type="submit" name="submit">Login</button>
                    <p class="tip">Press Enter to log in</p>
                    <div class="login-button">Click here to start</div>
                </form>
            </div>
        </div>
    </div>
    <script>
function handleUsernameInput(event) {
  if (event.keyCode === 13) { // Enter key code
    event.preventDefault();
    document.getElementById('input-2').focus();
  }
}
document.getElementById('login-form').addEventListener('submit', function(event) {
  var usernameInput = document.getElementById('input-1');
  var passwordInput = document.getElementById('input-2');
  
  if (usernameInput.value.trim() === '') {
    alert('Bitte geben Sie einen Benutzernamen ein.');
    usernameInput.focus();
    event.preventDefault();
  } else if (passwordInput.value.trim() === '') {
    alert('Bitte geben Sie ein Passwort ein.');
    passwordInput.focus();
    event.preventDefault();
  }
});
</script>

</body>
</html>