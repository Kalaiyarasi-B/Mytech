<?php
if (isset($_GET["file"])) {
    $file_name = $_GET["file"];

    // Set the appropriate headers for download
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=" . $file_name);

    // Output the encrypted file directly
    readfile("uploads/" . $file_name);
} else {
    echo "File not specified.";
}
?>
