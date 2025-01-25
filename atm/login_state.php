<?php
    $servername = "localhost";
    $username = "root";  // Your MySQL username
    $password = "";  // Your MySQL password
    $dbname = "client_bank";  // Your database name
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("cant connect to the database". $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nama = $_POST["nama_input"];
        $rekening = $_POST["rekening_input"]; // 
        $pin = $_POST["pin_input"];
        $sql = "SELECT * FROM client_info WHERE nama = '$nama' AND rekening = '$rekening' AND pin ='$pin'";
        $result = $conn->query($sql);
        
        $insertsql = "INSERT INTO temp VALUES('$rekening')";
        $insertdata = $conn->query($insertsql);


        if ($result->num_rows > 0) {
            echo "client found!";
            header("Location: option_state.php");
            exit;
        }
        else{
            echo "client not found!";
        }
    }
    
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <label>masukan nama anda: </label>
        <input name = "nama_input" type = "text">
        <br>
        <label>masukan rekening anda: </label>
        <input name = "rekening_input" type = "text">        
        <br>
        <label>Masukan PIN anda:</label>
        <input name = "pin_input" type = "password" maxlength="6" pattern="\d{6}">
        <button type="submit">Enter</button>
    </form>

</body>
</html>