<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="register2.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="register2.js"></script>
</head>
<body>
<?php
    include 'top_navbar.php';
    include 'functions.php';
    ?>
    <div class="header">
        <div class="row justify-content-center align-items-center">
            <div class="registration-container">
                <div class="form-container">
                    <h1 class="title text-center">Registration</h1>
                    <?php
                        if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
                            $error = false;
                            $username = $_POST['username'];
                            $email = $_POST['email'];
                            $password1 = $_POST['password1'];
                            $password2 = $_POST['password2'];
                            if(check_empty() == true){
                                echo "<p style='color: yellow; font-size: 20px>Bitte füllen Sie alle Felder aus!</p>";
                                $error = true;
                            }
                          }
                        ?>
                    <form method="POST" action="register.php">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input id="username" name="username" type="text" class="form-control" placeholder="john" required />
                        </div>
                        <?php
                            if(isset($username)){
                                if(UserReg($username) !== false){
                                    echo '<p style="color: yellow; font-size: 20px"> Username schon vergeben! </p>';
                                    $error = true;
                                }else if(invalidUsername($username) !== false){
                                    echo '<p style="color: yellow; font-size: 20px">Sonderzeichen sind beim Usernamen nicht erlaubt! </p>';
                                    $error = true;
                                }
                            }
                            ?>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" class="form-control" placeholder="email@address.com" required />
                        </div>
                        <?php
                            if(isset($email)){
                                if(EmailReg($email) !== false){
                                    echo '<p style="color: yellow; font-size: 20px"> Email schon vergeben! </p>';
                                    $error = true;
                                }else if(invalidEmail($email) !== false){
                                    echo '<p style="color: yellow; font-size: 20px"> Bitte eine gültige E-Mail-Adresse eingeben! </p>';
                                    $error = true;
                                }
                            }
                            ?>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password" class="form-control" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required />
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input id="confirmPassword" type="password" name="confirmPassword" class="form-control" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required />
                        </div>
                        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $password1 != $password2) { ?>
                                <p style="color: yellow; font-size: 20px"> Bitte geben Sie zweimal dasselbe Passwort ein. </p>
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
                                    <p style="color: green; font-size: 20px"> Dein Account wurde erstellt! </p>
                                    <?php
                                    header('Refresh: 1; URL = login.php');
                                    mysqli_stmt_close($stmt);
                                } else {
                                    ?>
                                    <p style="color: yellow; font-size: 20px"> Registrierung fehlgeschlagen! </p>
                                    <?php
                                    }
                                }
                            ?>
                        <button type="submit" name="submit" class="btn btn-primary">Create Your Account</button>
                        <p class="tip">Press Enter to submit</p>
                    </form>
                </div>
                
            </div>
            <div class="confirmation-container">
                    <h2 class="text-center">Confirmation</h2>
                    <p class="text-center">Username: <span id="usernameConfirmation"></span></p>
                    <p class="text-center">Email: <span id="emailConfirmation"></span></p>
                    <p class="text-center">Password: <span id="passwordConfirmation"></span></p>
                </div>
        </div>
    </div>
</body>
</html>
