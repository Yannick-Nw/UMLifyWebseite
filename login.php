<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/form.css">
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
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 my-5">
                <div class="text-center">
                    <img src="pics/login.png" class="img-fluid mb-3" style="max-width: 150px; max-height: 150px;">
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Login</h4>
                        <form method="post" action="login.php">
                            <div class="form-group">
                                <label for="email">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
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
                                    <p style="color: red;"> Username existiert nicht!</p>
                                    <?php
                                } else if (!password_verify($password, $row["PASSWORD"])) {
                                    ?>
                                    <p style="color: red;"> Falsches Passwort! </p>
                                <?php } else {
                                    $_SESSION["username"] = $row["USERNAME"];
                                    $_SESSION["id"] = $row["ID"];
                                    echo "<h2 style='color: green'>Login erfolgreich</h2>";
                                    header('Refresh: 1; URL = index.php');
                                }
                            }
                            ?>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Noch keinen Account? <a href="registrierung.php" class="link-danger">Registieren</a>
                        </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>