<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}

$config = parse_ini_file('../config.ini');
$host = $config['DB_HOST'];
$user = $config['DB_USER'];
$pass = $config['DB_PASS'];
$dbname = $config['DB_NAME'];

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the user's last score
$user_id = $_SESSION['user_id'];
$score = 0;  // Default score

$sql = "SELECT score FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($score);
$stmt->fetch();
$stmt->close();
$conn->close();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="../CSS/quiz.css">
</head>
<body>
  <h1 id="page-title">Welcome to Quiz 1, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
  <p id="prev-score">Your last score: <?php echo htmlspecialchars($score); ?>/8</p>
  <a id="logout" href="logout.php">Logout</a>

  <div class="app">
        <h1>Simple Quiz</h1>
        <div class="quiz">
            <h2 id="question">Question goes here</h2>
            <div id="answer-buttons">
                <button class="btn">Answer 1</button>
                <button class="btn">Answer 2</button>
                <button class="btn">Answer 3</button>
                <button class="btn">Answer 4</button>
            </div>
            <button id="next-btn">Next</button>
        </div>
     </div>
   <script src="../JS/quiz.js"></script>
</body>
</html>
