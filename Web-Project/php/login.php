<?php
session_start();

$config = parse_ini_file('../config.ini');

$host = $config['DB_HOST'];
$user = $config['DB_USER'];
$pass = $config['DB_PASS'];
$dbname = $config['DB_NAME'];

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get login data
$username = $_POST['username'];
$password = $_POST['password'];

// Get user by email
$sql = "SELECT id, username, password FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($user_id, $username, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        // Success: set session and redirect
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;

        //echo "Login successful! Welcome, $username.";
        echo "success";
        exit();
    } else {
        echo "Invalid password.";
    }
} else {
    echo "User not found.";
}

$stmt->close();
$conn->close();
?>
