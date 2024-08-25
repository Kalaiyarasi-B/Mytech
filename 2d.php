<?php
if (isset($_FILES["encrypted_file"]) && isset($_POST["decryption_key"])) {
    $file_name = $_FILES["encrypted_file"]["name"];
    $file_tmp = $_FILES["encrypted_file"]["tmp_name"];
    $decryption_key = $_POST["decryption_key"];

    // Read the encrypted file
    $encrypted_data = file_get_contents($file_tmp);

    // Extract IV and encrypted data
    $iv = substr($encrypted_data, 0, 16);
    $encrypted_data = substr($encrypted_data, 16);

    // Decrypt the file
    $decrypted_data = openssl_decrypt($encrypted_data, 'aes-256-cbc', $decryption_key, 0, $iv);

    // Provide the decrypted file for download
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=decrypted_" . $file_name);
    echo $decrypted_data;
} else {
    echo "Please select an encrypted file and provide the decryption key.";
}
?>
