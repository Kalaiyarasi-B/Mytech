<?php
if (isset($_FILES["file"]) && isset($_POST["encryption_key"])) {
    $file_name = $_FILES["file"]["name"];
    $file_tmp = $_FILES["file"]["tmp_name"];
    $encryption_key = $_POST["encryption_key"];

    // Generate a random initialization vector (IV)
    $iv = openssl_random_pseudo_bytes(16);

    // Encrypt the file
    $encrypted_data = openssl_encrypt(file_get_contents($file_tmp), 'aes-256-cbc', $encryption_key, 0, $iv);

    // Combine IV and encrypted data
    $encrypted_file_data = $iv . $encrypted_data;

    // Save the encrypted file
    file_put_contents("uploads/encrypted_" . $file_name, $encrypted_file_data);

    echo "Successfully File encrypted and stored in your directory.<br> <br> Now you can download the encrypted file: <a href='download.php?file=encrypted_" . $file_name . "&key=" . $encryption_key . "'>Download</a>";
} else {
    echo "Please select a file and provide an encryption key.";
}
?>
