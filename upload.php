<?php
$upload_dir = "";
if (isset($_SESSION['username'])) {
  // Wenn ein Benutzer eingeloggt ist, erstelle einen Ordner basierend auf dem Benutzernamen
  $upload_dir = "uploads/" . $_SESSION['username'] . "/";
} else {
  // Wenn kein Benutzer eingeloggt ist, generiere einen zufälligen Namen für den Ordner
  $random_name = bin2hex(random_bytes(8));
  $upload_dir = "uploads/" . $random_name . "/";
}

// Erstellen des Upload-Ordners, wenn er nicht bereits existiert
if (!is_dir($upload_dir)) {
  mkdir($upload_dir, 0777, true);
}

// Loop durch alle hochgeladenen Dateien
for($i=0; $i<count($_FILES['file']['name']); $i++) {
  $target_file = $upload_dir . basename($_FILES["file"]["name"][$i]);
  move_uploaded_file($_FILES["file"]["tmp_name"][$i], $target_file);
  echo $target_file . "<br>";
}
echo $upload_dir;
?>