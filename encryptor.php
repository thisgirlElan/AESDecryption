<?php

$aesKey = "QweRty09Gdjs$39tm@NNgZF88Ybf!s@Q";

function encryptData($data, $key) {
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    
    $encryptedData = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
    
    return base64_encode($encryptedData . '::' . $iv);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];

    $dataToEncrypt = json_encode(['name' => $name, 'age' => $age]);

    $encryptedData = encryptData($dataToEncrypt, $aesKey);

    // echo "<h2>Encrypted Data:</h2>";
    // echo "<p>" . htmlentities($encryptedData) . "</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encrypted</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Encrypted Data</h1>
        <!-- <form action="decryptor.php" method="POST"> -->
            <div class="form-group">
                <input disabled type="text" id="encrypted_data" name="encrypted_data" value="<?php echo htmlspecialchars($encryptedData); ?>" required> <!-- enable input when decrypting -->
            </div>
            <!-- <button type="submit">Decrypt</button> -->
        </form>
    </div>
</body>
</html>