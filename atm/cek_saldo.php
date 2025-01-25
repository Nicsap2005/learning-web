<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "client_bank";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Query to get data from cek_saldo
$result = $conn->query("SELECT * FROM cek_saldo");

if ($result->num_rows > 0) {
    // Fetch the single row from cek_saldo
    $row = $result->fetch_assoc();

    // Extract the rekening value
    $rekening = $row['rekening']; // Replace 'rekening' with the actual column name

    // Query to get saldo from client_info
    $saldoResult = $conn->query("SELECT saldo FROM client_info WHERE rekening = '$rekening'");

        // Fetch the saldo
    $saldoRow = $saldoResult->fetch_assoc();
    $saldo = $saldoRow['saldo'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $clearall = $conn->query("TRUNCATE TABLE cek_saldo");
    header("Location: login_state.php");
    exit;

}

// Close the connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Saldo</title>
</head>
<body>
    <h1>Cek Saldo</h1>
    <p>Rekening Anda:<?php echo $rekening ; ?> </p>
    <p>Saldo Anda:<?php echo $saldo ; ?> </p>
    <form action="" method="POST">
        <button type="submit">truncate</button>
    </form>
</body>
</html>
