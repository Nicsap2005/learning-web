<?php
$servername = "localhost";
$username = "root";  // Your MySQL username
$password = "";  // Your MySQL password
$dbname = "loginpage";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["input_username"];  // Get the input value from the form
    $valid = false;
    for ($i = 0; $i < strlen($username); $i++) {if ($username[$i] == "@"){$valid = true;}}
    if ($username == "" || $valid == false) {
        echo "invalid username\n" ;


    }
    $password = $_POST["input_password"];
    if ($password == "") {
        echo "invalid password\n" ;
    }
    $sql = "SELECT * FROM client WHERE _username = '$username' and _password = '$password'";
    
    // Execute the query
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        header("Location: ../main/main.php");
        exit;
    } else {
        echo "username not found" ;
    }

$conn->close();
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
    <h1>Login Page</h1>
    <form action="" method="POST">
        <label for="">Username: </label>
        <input type="text" id="username_box" name="input_username" required>
        <br>
        <label for="">Password: </label>
        <input type="password" id="password_box" name="input_password"required>
        <br>
        <button type="submit">Submit</button>
    </form>
    <p>Don't have an account? <a href="../register/regis.php">Register here</a></p>

</body>
</html>