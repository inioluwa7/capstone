<?php
// register_user.php
$servername = "localhost"; // Replace with your Linux SQL Server details
$username = "root";        // Replace with your SQL username
$password = "";            // Replace with your SQL password
$dbname = "g4cap";         // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful. <a href='login.html'>Click here to login</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>