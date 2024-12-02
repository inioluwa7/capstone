<?php
// login_user.php
$servername = "g4cap-sqlr"; // Replace with your Linux SQL Server details
$username = "g4adm";        // Replace with your SQL username
$password = "Secret55!";            // Replace with your SQL password
$dbname = "g4capdb";         // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT password FROM users WHERE username='$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            header("Location: upload.html");
            exit();
        } else {
            echo "Invalid password. <a href='login.html'>Try again</a>";
        }
    } else {
        echo "User not found. <a href='register.html'>Register here</a>";
    }
}

$conn->close();
?>
