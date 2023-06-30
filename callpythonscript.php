<?php
if (isset($_POST['upload_dir'])) {
    $upload_dir = $_POST['upload_dir'];
    $folder_name = basename($upload_dir); // Extrahiere den Ordnername aus dem Pfad
    $file_path = "uploads/" . $folder_name;
    $files = 0;
    foreach (glob($file_path . "/*.h") as $filename) {
        $files++;
    }
    if ($files > 0) {
        exec('python python-script/main.py "' . $folder_name . '"');
        $jsonData = file_get_contents("uploads/" . $folder_name . '/result.json');
        $data = json_decode($jsonData, true);
        echo $data;
    }else{
        echo "error";
    }
}

?>