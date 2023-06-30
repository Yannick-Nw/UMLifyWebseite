<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UMLify</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Montserrat:400,700" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://unpkg.com/gojs/release/go.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

</head>
<body>
<div class=img-heading>
  <?php include 'top_navbar.php';
    include 'is_user.php';
  ?>
  <h1 class="text-white">Ihre gespeicherten UML Diagramme</h1>
    </div>
    <div class="container">
    <table class="table table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>Titel</th>
                    <th>UML anzeigen</th>
                </tr>
            </thead>
            <tbody class="table-striped table-hover">
                <?php
                require("dbaccess.php");
                $sql = "SELECT * FROM diagrams WHERE USERNAME = ?";
                $stmt = mysqli_stmt_init($mysqli);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt, "s", $_SESSION["username"]);
                mysqli_stmt_execute($stmt);
                $results = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_assoc($results)) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $row['TITEL'] ?></th>
                        <th scope="row"><a href="showUML.php?id=<?php echo $row["ID"] ?>"><i class="fab fa-bimobject"></i></a></th>
                    <?php
                }
                    ?>
            </tbody>
        </table>
    </div>
</body>
</html>