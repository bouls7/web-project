<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in";
    exit();
}
$config = parse_ini_file('../config.ini');

$host = $config['DB_HOST'];
$user = $config['DB_USER'];
$pass = $config['DB_PASS'];
$dbname = $config['DB_NAME'];

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the score from the POST request
$score = isset($_POST['score']) ? (int)$_POST['score'] : 0;
$user_id = $_SESSION['user_id'];  // Get logged-in user's ID

// Debugging: Check if user_id and score are correct
var_dump($user_id, $score);

// Insert the score into the database for the logged-in user
$sql = "UPDATE users SET score = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $score, $user_id);

if ($stmt->execute()) {
    echo "Score saved successfully!";
} else {
    echo "Error saving score: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
