<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT balance FROM users WHERE id='$user_id'");
$row = $result->fetch_assoc();
$balance = $row['balance'];
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <title>ড্যাশবোর্ড</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h2>স্বাগতম, <?php echo $_SESSION['name']; ?>!</h2>
    <p>আপনার ব্যালান্স: <?php echo number_format($balance, 2); ?> টাকা</p>
    <a href="ads.php">অ্যাড দেখুন</a> | <a href="logout.php">লগআউট</a>
</body>
</html>