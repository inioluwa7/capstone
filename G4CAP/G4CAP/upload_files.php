<?php
// upload_files.php
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

// Define the target directory for uploads
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$user_id = $_SESSION['user_id']; // Ensure user_id is stored in session after login

// Validate user_id
if (!isset($user_id)) {
    die("Error: User is not logged in.");
}

// Check if file upload is successful
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO uploads (user_id, file_name, file_path) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("iss", $user_id, basename($_FILES["fileToUpload"]["name"]), $target_file);
        $stmt->execute();
        $stmt->close();
        echo "The file has been uploaded.";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Sorry, there was an error uploading your file.";
}

// Close the database connection
$conn->close();
?>