<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'header.php'
    ?>
    <title>Alle Users</title>
</head>

<body>
    <div class=img-heading>
        <?php
        include 'top_navbar.php';
        include 'is_admin.php';
        ?>

        <h1 class="text-white">Alle User und ihre UMLs</h1>
    

    <div class="container">
        <form method="GET" action="">
            <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Benutzername:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Benutzername eingeben">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary">Suchen</button>
                </div>
            </div>
        </form>

        <table class="table table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>UML Name</th>
                    <th>UML anzeigen</th>
                </tr>
            </thead>
            <tbody class="table-striped table-hover">
                <?php
                require("dbaccess.php");
                if (isset($_GET['username'])) {
                    $username = $_GET['username'];
                    $sql = "SELECT * FROM diagrams WHERE USERNAME = ?";
                    $stmt = mysqli_stmt_init($mysqli);
                    mysqli_stmt_prepare($stmt, $sql);
                    mysqli_stmt_bind_param($stmt, 's', $username);
                    mysqli_stmt_execute($stmt);
                    $results = mysqli_stmt_get_result($stmt);
                } else {
                    $sql = "SELECT * FROM diagrams";
                    $stmt = mysqli_stmt_init($mysqli);
                    mysqli_stmt_prepare($stmt, $sql);
                    mysqli_stmt_execute($stmt);
                    $results = mysqli_stmt_get_result($stmt);
                }

                while ($row = mysqli_fetch_assoc($results)) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $row['ID'] ?></th>
                        <td><?php echo $row["USERNAME"] ?></td>
                        <td><?php echo $row["TITEL"] ?></td>
                        <th scope="row"><a href="showUML.php?id=<?php echo $row["ID"] ?>"><i class="fab fa-bimobject"></i></a></th>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
