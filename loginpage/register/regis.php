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
    $password = $_POST["input_password"];
    $valid = false;
    for($i=0;$i<strlen($username)-1;$i++){if($username[$i] == "@"){$valid = true;}}
    if ($username == "" || $valid == false){
        echo"username invalid";
    }
    else{
        $sql = "INSERT INTO client (_username, _password) VALUES ('$username', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

$conn->close();
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
</head>
<body>
    <h1>Register Page</h1>
    <form action="" method="POST">
        <label for="">Username: </label>
        <input type="text" id="username_box" name="input_username" required>
        <br>
        <label for="">Password: </label>
        <input type="text" id="password_box" name="input_password" required>
        <br>
        <button type="submit">Submit</button>
    </form>
    <p>Already have an account? <a href="../login/login.php">login here</a></p>
</body>
</html>