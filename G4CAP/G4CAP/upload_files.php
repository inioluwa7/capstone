<?php
// upload_files.php
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $uploadDir = "uploads/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
    }

    $filePath = $uploadDir . basename($fileName);

    if (move_uploaded_file($fileTmpName, $filePath)) {
        $sql = "INSERT INTO uploads (filename, filepath) VALUES ('$fileName', '$filePath')";

        if ($conn->query($sql) === TRUE) {
            echo "File uploaded successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}

$conn->close();
?>
