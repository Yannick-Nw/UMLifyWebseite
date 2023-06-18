<?php
$target_dir = "uploads/";
// Loop through all uploaded files
for($i=0; $i<count($_FILES['file']['name']); $i++) {
  $target_file = $target_dir . basename($_FILES["file"]["name"][$i]);
  move_uploaded_file($_FILES["file"]["tmp_name"][$i], $target_file);
  echo $target_file . "<br>";
}
?>