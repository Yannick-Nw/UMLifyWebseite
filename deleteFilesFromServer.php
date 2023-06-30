<?php
$dir_path = 'uploads/' . $_SESSION["id"];

if (is_dir($dir_path)) {
    deleteDirectory($dir_path);
}

function deleteDirectory($dir) {
    if (!is_dir($dir)) {
        return;
    }

    $files = array_diff(scandir($dir), array('.', '..'));
    foreach ($files as $file) {
        $file_path = $dir . '/' . $file;
        if (is_dir($file_path)) {
            deleteDirectory($file_path);
        } else {
            unlink($file_path);
        }
    }
    rmdir($dir);
}
?>
