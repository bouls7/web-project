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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz 2 App</title>
    <link rel="stylesheet" href="../CSS/quiz2.css">
</head>
<body>
        <h1 id="page-title">Welcome to Quiz 2, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p id="prev-score">Your last score: <?php echo htmlspecialchars($score); ?>/8</p>
        <a id="logout" href="logout.php">Logout</a>
    <div class="app">
        <form action="quiz2-A.php" method="POST" class="quiz">
           
            <h2>1. What tag is used to create a line break in HTML?</h2>
            <input type="text" name="q1" placeholder="Type your answer here..." class="text-input" required><br><br>

            
            <h2>2. Which HTML tag is used to insert an image?</h2>
            <input type="text" name="q2" placeholder="Type your answer here..." class="text-input" required><br><br>

            
            <h2>3. In CSS, which property controls the text size?</h2>
            <input type="text" name="q3" placeholder="Type your answer here..." class="text-input" required><br><br>

            
            <h2>4. Which CSS property changes the background color?</h2>
            <input type="text" name="q4" placeholder="Type your answer here..." class="text-input" required><br><br>

            
            <h2>5. Which HTML element is used for the largest heading?</h2>
            <label><input type="radio" name="q5" value="h1" required> h1</label><br>
            <label><input type="radio" name="q5" value="h6"> h6</label><br>
            <label><input type="radio" name="q5" value="heading"> heading</label><br>
            <label><input type="radio" name="q5" value="head"> head</label><br><br>

            
            <h2>6. Which CSS property is used to make text bold?</h2>
            <label><input type="radio" name="q6" value="font-weight" required> font-weight</label><br>
            <label><input type="radio" name="q6" value="text-style"> text-style</label><br>
            <label><input type="radio" name="q6" value="bold"> bold</label><br>
            <label><input type="radio" name="q6" value="font-style"> font-style</label><br><br>

           
            <h2>7. Which HTML tag creates a hyperlink?</h2>
            <label><input type="radio" name="q7" value="a" required> a</label><br>
            <label><input type="radio" name="q7" value="link"> link</label><br>
            <label><input type="radio" name="q7" value="href"> href</label><br>
            <label><input type="radio" name="q7" value="hyperlink"> hyperlink</label><br><br>

           
            <h2>8. Which CSS property adds space inside an element, between content and border?</h2>
            <label><input type="radio" name="q8" value="padding" required> padding</label><br>
            <label><input type="radio" name="q8" value="margin"> margin</label><br>
            <label><input type="radio" name="q8" value="border"> border</label><br>
            <label><input type="radio" name="q8" value="spacing"> spacing</label><br><br>

            <button type="submit" id="next-btn">Submit Quiz</button>
        </form>
    </div>
</body>
</html>
