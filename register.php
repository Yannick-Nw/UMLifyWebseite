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
                        if (check_empty() !== false) {
                            echo "<p style='color: red'>Bitte füllen Sie alle Felder aus!</p>";
                            $error = true;
                        }
                    }
                    ?>
                    <form>
                        <input id="input-1" type="text" placeholder="John Doe" required />
                        <label for="input-1">
                            <span class="label-text">Full Name</span>
                            <span class="nav-dot"></span>
                            <div class="signup-button-trigger">Sign Up</div>
                        </label>
                        <input id="input-2" type="text" placeholder="john" required />
                        <label for="input-2">
                            <span class="label-text">Username</span>
                            <span class="nav-dot"></span>
                        </label>
                        <input id="input-3" type="email" placeholder="email@address.com" required />
                        <label for="input-3">
                            <span class="label-text">Email</span>
                            <span class="nav-dot"></span>
                        </label>
                        <input id="input-4" type="text" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required />
                        <label for="input-4">
                            <span class="label-text">Password</span>
                            <span class="nav-dot"></span>
                        </label>
                        <input id="input-5" type="text" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required />
                        <label for="input-5">
                            <span class="label-text">Confirm Password</span>
                            <span class="nav-dot"></span>
                        </label>
                        <button type="submit">Create Your Account</button>
                        <p class="tip">Press Tab</p>
                        <div class="signup-button">Sign Up</div>
                    </form>
            </div>
        </div>
    </div>
</body>
</html>
