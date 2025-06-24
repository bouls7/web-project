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


$answers = [
    'q1' => 'br',
    'q2' => 'img',
    'q3' => 'font-size',
    'q4' => 'background-color',
    'q5' => 'h1',
    'q6' => 'font-weight',
    'q7' => 'a',
    'q8' => 'padding'
];

$score = 0;
$total = count($answers);
$userAnswers = [];


foreach ($answers as $key => $correct) {
    $user = isset($_POST[$key]) ? trim(strtolower($_POST[$key])) : '';
    $userAnswers[$key] = $user;
    if ($user === strtolower($correct)) {
        $score++;
    }
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("UPDATE users SET score = ? WHERE id = ?");
$stmt->bind_param("ii", $score, $user_id);
$stmt->execute();
$stmt->close();

$questions = [
    'q1' => "What tag is used to create a line break in HTML?",
    'q2' => "Which HTML tag is used to insert an image?",
    'q3' => "In CSS, which property controls the text size?",
    'q4' => "Which CSS property changes the background color?",
    'q5' => "Which HTML element is used for the largest heading?",
    'q6' => "Which CSS property is used to make text bold?",
    'q7' => "Which HTML tag creates a hyperlink?",
    'q8' => "Which CSS property adds space inside an element, between content and border?"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz 2 Results</title>
    <link rel="stylesheet" href="../CSS/quiz2.css">
</head>
<body>
        <div class="app">
        <h1>Quiz 2 Results</h1>
        <h2>You scored <?php echo $score; ?> out of <?php echo $total; ?>!</h2>
        <div class="quiz">
            <?php foreach ($questions as $key => $q): ?>
                <div style="margin-bottom:18px;">
                    <strong><?php echo $q; ?></strong><br>
                    <span class="answer <?php echo ($userAnswers[$key] === strtolower($answers[$key])) ? 'correct' : 'incorrect'; ?>">
                        Your answer: <?php echo htmlspecialchars($userAnswers[$key]); ?>
                    </span>
                    <?php if ($userAnswers[$key] !== strtolower($answers[$key])): ?>
                        <br>
                        <span class="correct">Correct answer: <?php echo $answers[$key]; ?></span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="quiz2.php"><button id="next-btn">Try Again</button></a>
    </div>
</body>
</html>
