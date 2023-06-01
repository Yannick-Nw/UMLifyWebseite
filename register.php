<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrierung</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="animation.js"></script>
</head>
<body>
<?php
    include 'top_navbar.php';
    include 'functions.php';
    ?>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 my-5">
                <div class="text-center">
                    <img src="pics/register.jpg" class="img-fluid mb-3" style="max-width: 250px; max-height: 220px;">
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Registrierung</h4>
                        <?php
                        if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
                            $error = false;
                            $username = $_POST['username'];
                            $email = $_POST['email'];
                            $password1 = $_POST['password1'];
                            $password2 = $_POST['password2'];
                            if(check_empty() !== false){
                                echo "<p style='color: red'>Bitte füllen Sie alle Felder aus!</p>";
                                $error = true;
                            }
                          }
                        ?>
                        <form method="POST" action="register.php">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>

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

                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
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

                            <div class="form-group">
                                <label for="password1">Password</label>
                                <input type="password" class="form-control" id="password-reg" name="password1" required>
                            </div>
                            <div class="form-group">
                                <label for="password2">Password again</label>
                                <input type="password" class="form-control" id="password-reg" name="password2" required>
                            </div>
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
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Schon einen Account? <a href="login.php" class="link-danger">Login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>