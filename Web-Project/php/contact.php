<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (empty($name) || empty($email) || empty($message)) {
        echo "Please fill in all fields.";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>
    <link rel="stylesheet" href="../CSS/contact.css">
</head>
<body>


<div class="container">
        <h2 style="color: green">Thank you for contacting us!</h2>
        <br>
        <div class="form">
            <p>sending message: <?php echo $message ?></p>
            <br>
            <p>Redirecting in <span id="countdown" style="color:green">5</span> seconds...</p>
            <br>
            <a href="../contact.html?status=cancel" style="text-decoration: none; color: red;">Tap to cancel</a>
        </div>
    </div>


<script>
            let seconds = 5;
            const countdownEl = document.getElementById('countdown');

            const interval = setInterval(() => {
                seconds--;
                countdownEl.textContent = seconds;
                if (seconds <= 0) {
                    clearInterval(interval);
                    window.location.href = "../contact.html?status=success";
                }
            }, 1000);
        </script>
</body>