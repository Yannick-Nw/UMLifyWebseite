<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registrierung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leader-line/1.0.7/leader-line.min.js" integrity="sha512-0dNdzMjpT6pJdFGF1DwybFCfm3K/lzHhxaMXC/92J9/DZujHlqYFqmhTOAoD0o+LkeEsVK2ar/ESs7/Q2B6wJg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html-to-image/1.11.11/html-to-image.js" integrity="sha512-zPMZ/3MBK+R1rv6KcBFcf7rGwLnKS+xtB2OnWkAxgC6anqxlDhl/wMWtDbiYI4rgi/NrCJdXrmNGB8pIq+slJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/save-svg-as-png/1.4.17/saveSvgAsPng.js" integrity="sha512-eROF+rLuEUiVuYGmMqhsT8/OwSLcVw5RLjhhJrWLTznvDcwG0WtXrV6w7Ko4Nw7LyWzDZOGlQjfzQd7kUYLQcQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/canvg/3.0.7/umd.js" integrity="sha512-9cZtXG4J3AzjYnxA6XDibUfjudIYnMT03CmV8xZzdmFt6V2Fl6C6dxlXbsGTMWoLGRHSC+ljX9hYfPds/tFicg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="css/register.css">
    <script src="reimg.js"></script>
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
                        if (check_empty() == true) {
                            echo "<p style='color: yellow; font-size: 20px>Bitte füllen Sie alle Felder aus!</p>";
                            $error = true;
                        }
                    }
                    ?>
                    <form method="POST" action="register.php">
                        <div class="bg-white mb-3 border border-5 border-primary rounded-4 p-3">
                            <div class="col-6 mb-3">
                                <label for="input-1" class="form-label">Username</label>
                                <input id="input-1" class="form-control" name="username" type="text" placeholder="john" required />
                                <?php
                                if (isset($username)) {
                                    if (UserReg($username) !== false) {
                                        echo '<p style="color: yellow; font-size: 20px"> Username schon vergeben! </p>';
                                        $error = true;
                                    } else if (invalidUsername($username) !== false) {
                                        echo '<p style="color: yellow; font-size: 20px">Sonderzeichen sind beim Usernamen nicht erlaubt! </p>';
                                        $error = true;
                                    }
                                }
                                ?>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="input-2" class="form-label">Email</label>
                                <input id="input-2" class="form-control" type="email" name="email" placeholder="email@address.com" required />
                                <?php
                                if (isset($email)) {
                                    if (EmailReg($email) !== false) {
                                        echo '<p style="color: yellow; font-size: 20px"> Email schon vergeben! </p>';
                                        $error = true;
                                    } else if (invalidEmail($email) !== false) {
                                        echo '<p style="color: yellow; font-size: 20px"> Bitte eine gültige E-Mail-Adresse eingeben! </p>';
                                        $error = true;
                                    }
                                }
                                ?>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="input-3" class="form-label">Password</label>
                                <input id="input-3" class="form-control" type="password" name="password1" placeholder="&#9679;&#9679;DontShareYourPassword&#9679;&#9679;" required />
                            </div>
                            <div class="col-6 mb-3">
                                <label for="input-4" class="form-label">Confirm Password</label>
                                <input id="input-4" class="form-control" type="password" name="password2" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required />
                                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $password1 != $password2) { ?>
                                    <p style="color: yellow; font-size: 20px"> Bitte geben Sie zweimal dasselbe Passwort ein. </p>
                                <?php
                                    $error = true;
                                }
                                ?>
                            </div>
                            <?php
                            if (isset($_POST["submit"])) {
                                if (!$error) {
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
                            <button type="submit" class="btn btn-primary" name="submit">Create Your Account</button>
                        </div>
                    </form>
            </div>
            <div id="sign-up-uml" class="col-md-4 p-4 my-5 bg-white border border-5 border-primary rounded-4 d-none">
            </div>
            <div class="row justify-content-center">
                <button id="pic" type="button" class="btn btn-primary col-2">Download</button>

            </div>
        </div>
    </div>
</body>

</html>