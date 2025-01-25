<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "client_bank";

    $conn = new mysqli($servername,$username,$password,$dbname);
    
    $client = "SELECT rekening from temp";
    $result = $conn->query($client);

    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $rekening = $row['rekening'];
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $jumlah_tarik = (int)$_POST["withdraw_input"];
            $sisa = $conn->query("SELECT saldo from client_info where rekening = '$rekening'");
            $row_saldo = $sisa->fetch_assoc();
            $result_saldo = (int)$row_saldo['saldo'];
            if ($result_saldo >= $jumlah_tarik){
                $kurangi_saldo = "UPDATE client_info SET saldo = saldo-$jumlah_tarik where rekening = '$rekening'";
                $conn->query($kurangi_saldo);
            }
            else{
                echo "saldo tidak mencukupi";
            }
            
            $sisa = $conn->query("SELECT saldo from client_info where rekening = '$rekening'");
            $row_saldo = $sisa->fetch_assoc();
            $result_saldo = $row_saldo['saldo'];
            echo " sisa saldo anda: '$result_saldo'";

            }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>tarik tunai</h1>
    <form action = "" method="POST">
        <input name = "withdraw_input">
        <button type="submit">tarik</button>
    </form>
    <p>transaksi lain? <button onclick="location.href='login_state.php'">ya</button></p>
        
</body>
</html>