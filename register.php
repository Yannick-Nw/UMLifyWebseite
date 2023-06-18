<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrierung</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/register.css">
    <script src="animation.js"></script>
</head>
<body>
<?php
    include 'top_navbar.php';
    include 'functions.php';
    ?>
    <div class="header">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 my-5">
                    <h1 class="title text-center">Registrierung</h4>
                        <?php
                        if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
                            $error = false;
                            $username = $_POST['username'];
                            $email = $_POST['email'];
                            $password1 = $_POST['password1'];
                            $password2 = $_POST['password2'];
                            if(check_empty() == true){
                                echo "<p style='color: red'>Bitte füllen Sie alle Felder aus!</p>";
                                $error = true;
                            }
                          }
                        ?>
                    <form method="POST" action="register.php">
                        
                        <input id="input-1" name="username" type="text" placeholder="john" required />
                        <label for="input-1">
                            <span class="label-text">Username</span>
                            <span class="nav-dot">Username</span>
                            <div class="signup-button-trigger">Sign Up</div>
                        </label>
                        <?php
                            if(isset($username)){
                                if(UserReg($username) !== false){
                                    echo '<p style="color: red;"> Username schon vergeben! </p>';
                                    $error = true;
                                }else if(invalidUsername($username) !== false){
                                    echo '<p style="color: red;">Sonderzeichen sind beim Usernamen nicht erlaubt! </p>';
                                    $error = true;
                                }
                            }
                            ?>
                        <input id="input-2" type="email" name="email" placeholder="email@address.com" required />
                        <label for="input-2">
                            <span class="label-text">Email</span>
                            <span class="nav-dot">Email</span>
                        </label>
                        <?php
                            if(isset($email)){
                                if(EmailReg($email) !== false){
                                    echo '<p style="color: red;"> Email schon vergeben! </p>';
                                    $error = true;
                                }else if(invalidEmail($email) !== false){
                                    echo '<p style="color: red;"> Bitte eine gültige E-Mail-Adresse eingeben! </p>';
                                    $error = true;
                                }
                            }
                            ?>
                        <input id="input-3" type="password" name="password1" placeholder="&#9679;&#9679;&#9679;DontShareYourPassword&#9679;&#9679;&#9679;" required />
                        <label for="input-3">
                            <span class="label-text">Password</span>
                            <span class="nav-dot">Password</span>
                        </label>
                        <input id="input-4" type="password" name="password2" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required />
                        <label for="input-4">
                            <span class="label-text">Confirm Password</span>
                            <span class="nav-dot">Confirm password</span>
                        </label>
                        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $password1 != $password2) { ?>
                                <p style="color: red;"> Bitte geben Sie zweimal dasselbe Passwort ein. </p>
                            <?php
                                $error = true;
                            }
                            ?>
                            <?php
                            if(isset($_POST["submit"])){
                                if(!$error){
                                    require("dbaccess.php");
                                    //User anlegen
                                    $hash = password_hash($password1, PASSWORD_BCRYPT);
                                    $sql = "INSERT INTO accounts (USERNAME, EMAIL, PASSWORD) VALUES (?,?,?)";
                                    $stmt = mysqli_stmt_init($mysqli);
                                    mysqli_stmt_prepare($stmt, $sql);
                                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hash);
                                    mysqli_stmt_execute($stmt);
                                    ?>
                                    <p style="color: green;"> Dein Account wurde erstellt! </p>
                                    <?php
                                    mysqli_stmt_close($stmt);
                                } else {
                                    ?>
                                    <p style="color: red;"> Registrierung fehlgeschlagen! </p>
                                    <?php
                                    }
                                }
                            ?>
                        <button type="submit" name="submit">Create Your Account</button>
                        <p class="tip">Press Enter to submit</p>
                        <div class="signup-button">Sign Up</div>
                    </form>
                    </div>
        </div>
    </div>
</body>
</html>