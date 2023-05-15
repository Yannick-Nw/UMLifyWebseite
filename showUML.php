<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Ihr UML</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Montserrat:400,700" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="https://unpkg.com/gojs/release/go.js"></script>
	</head>
	<body>
    <?php include 'top_navbar.php';
    
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        require("dbaccess.php");
        $sql = "SELECT UML FROM diagrams WHERE ID = ?";
        $stmt = mysqli_stmt_init($mysqli);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
    
        if ($row) {
            $jsonContent = $row['UML'];
            $jsonFile = 'result.json';
            file_put_contents($jsonFile, $jsonContent);
        } else {
            echo "UML-Daten nicht gefunden.";
        }
    }
    
    ?>
		<div class="container">
			<div class="row mt-3">
				<h2>UML</h2>
			</div>
			<div class="row mb-3 border border-5 border-primary rounded-4 min-vh-100">
				<div id="uml"></div>
                <!--<div id="myDiagramDiv" style="height:70vh; border:1px solid black"></div>-->
			</div>
            <?php
            if (isset($_SESSION["id"])){
                ?>
                    <form method="POST" action="showUML.php">
                        <input type="text" name="titleUML" id="titleUML" placeholder="Titel des UML" required>
                        <input type="submit" name="saveUML" class="btn btn-primary btn-dark" value="UML speichern">
                    </form>

                <?php
                $jsonFile = 'result.json';
                $jsonContent = file_get_contents($jsonFile);

                if ($jsonContent === "") {
                    echo "Fehler beim Parsen der JSON-Datei.";
                }
            }
                if (isset($_POST["saveUML"])) {
                    $title = $_POST['titleUML'];
                    require("dbaccess.php");
                    $sql = "INSERT INTO diagrams (USERNAME, TITEL, UML) VALUES (?,?,?)";
                    $stmt = mysqli_stmt_init($mysqli);
                    mysqli_stmt_prepare($stmt, $sql);
                    mysqli_stmt_bind_param($stmt, "sss", $_SESSION["username"], $title, $jsonContent);
                    mysqli_stmt_execute($stmt);
                    header('Refresh: 1; URL = index.php');
                    ?>
                    <p style="color: green;">UML wurde gespeichert!</p>
                    
                <?php
                }
            ?>
		</div>
        <script src="showUML.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
	</body>
</html>
