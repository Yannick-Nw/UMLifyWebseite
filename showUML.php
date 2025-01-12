<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Ihr UML</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<!--<script src="https://unpkg.com/gojs/release/go.js"></script>-->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<!--<script src="https://unpkg.com/gojs/release/go.js"></script>-->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html-to-image/1.11.11/html-to-image.js" integrity="sha512-zPMZ/3MBK+R1rv6KcBFcf7rGwLnKS+xtB2OnWkAxgC6anqxlDhl/wMWtDbiYI4rgi/NrCJdXrmNGB8pIq+slJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html-to-image/1.11.11/html-to-image.js" integrity="sha512-zPMZ/3MBK+R1rv6KcBFcf7rGwLnKS+xtB2OnWkAxgC6anqxlDhl/wMWtDbiYI4rgi/NrCJdXrmNGB8pIq+slJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leader-line/1.0.7/leader-line.min.js" integrity="sha512-0dNdzMjpT6pJdFGF1DwybFCfm3K/lzHhxaMXC/92J9/DZujHlqYFqmhTOAoD0o+LkeEsVK2ar/ESs7/Q2B6wJg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="css/style.css">
	</head>
	<body>
    
    <?php include 'top_navbar.php';
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        require("dbaccess.php");
        if(@$_SESSION["username"] == "admin"){
            $sql = "SELECT UML FROM diagrams WHERE ID = ?";
            $stmt = mysqli_stmt_init($mysqli);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
        }else if(isset($_SESSION["username"])){
            $sql = "SELECT UML FROM diagrams WHERE ID = ? AND USERNAME = ?";
            $stmt = mysqli_stmt_init($mysqli);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, "is", $id, $_SESSION["username"]);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
        }else{
            ?>
                <h1 style="color: black">UML Diagramm nicht zu Ihnen zugehörig!!!!!!!</h1>
            <?php
        }
        if (@$row) {
            include 'deleteFilesFromServer.php';
            $jsonContent = $row['UML'];
            $upload_dir = 'uploads/' . $_SESSION["id"] . '/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            file_put_contents($upload_dir . "result.json", $jsonContent);
        } /*else {
            ?>
                <h1 style="color: black">UML Diagramm nicht zu Ihnen zugehörig!!!!!!!</h1>
            <?php
        }*/
    }

    
    ?>
    <div class="outer-container">
		<div class="container-fluid">
			<div class="row m-3">
				<h2 class="col-10">UML</h2>
                <button id="pic" type="button" class="btn btn-primary col-2">Download</button>
			</div>
			<div id="myDiv" class="row mb-3 border border-5 border-primary rounded-4 min-vh-100">
				<div id="uml" class="bg-white"></div>
                 <!--<div id="myDiagramDiv" style="height:90vh; border:1px solid black"></div>-->
			</div>
            <?php
            if (isset($_SESSION["username"])){
                ?>
                    <form method="POST" action="showUML.php">
                        <input type="text" name="titleUML" id="titleUML" placeholder="Titel des UML" required>
                        <input type="submit" name="saveUML" class="btn btn-primary btn-dark" value="UML speichern">
                    </form>

                <?php
                $jsonFile = 'uploads/' . $_SESSION["id"] . '/result.json';
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
            <!-- <button id="pic" type="button" class="btn btn-primary">Download</button> -->
		</div>
        </div>
        <style>
    .outer-container {
        margin-left: 100px;
        margin-right: 100px;
    }
</style>

        
        <script src="showUML.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
	</body>
</html>