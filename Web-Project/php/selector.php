<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Quiz</title>
    <link rel="stylesheet" href="../CSS/selector.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>Select a quiz to begin:</p>
        <br><br>
        <a href="quiz.php" class="quiz-button">Take Quiz 1</a>
        <a href="quiz2.php" class="quiz-button">Take Quiz 2</a>
        <a id="logout" href="logout.php">Logout</a>
    </div>
</body>
</html>
