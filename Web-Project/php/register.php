<?php

$config = parse_ini_file('../config.ini');


// Database config
$host = $config['DB_HOST'];
$user = $config['DB_USER'];
$pass = $config['DB_PASS'];
$dbname = $config['DB_NAME'];

// Connect to MySQL
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure hash

// Check if username exists
$check_username = $conn->prepare("SELECT 1 FROM users WHERE username = ?");
$check_username->bind_param("s", $name);
$check_username->execute();
$check_username->store_result();
if ($check_username->num_rows > 0) {
    echo "Username already taken.";
    $check_username->close();
    $conn->close();
    exit();
}
$check_username->close();

// Check if email exists
$check_email = $conn->prepare("SELECT 1 FROM users WHERE email = ?");
$check_email->bind_param("s", $email);
$check_email->execute();
$check_email->store_result();
if ($check_email->num_rows > 0) {
    echo "Email already used.";
    $check_email->close();
    $conn->close();
    exit();
}
$check_email->close();

// Insert into DB
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();