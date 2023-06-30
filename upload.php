<?php
session_start();
include 'deleteFilesFromServer.php';
$upload_dir = "uploads/" . $_SESSION['id'] . "/";

// Erstellen des Upload-Ordners, wenn er nicht bereits existiert
if (!is_dir($upload_dir)) {
  mkdir($upload_dir, 0777, true);
}
$total_size = 0;

for($i = 0; $i < count($_FILES['file']['name']); $i++) {
  $target_file = $upload_dir . basename($_FILES["file"]["name"][$i]);

  // Überprüfe die Dateigröße der aktuellen Datei
  $file_size = $_FILES["file"]["size"][$i];
  $total_size += $file_size; // Addiere die Dateigröße zur Gesamtgröße

  if ($total_size > 1 * 1024 * 1024) {
    echo "error";
    break;
  }

  move_uploaded_file($_FILES["file"]["tmp_name"][$i], $target_file);
  echo $target_file . "<br>";
}

if ($total_size <= 1 * 1024 * 1024) {
  echo $upload_dir;
}
?>