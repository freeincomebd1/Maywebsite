<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || !isset($_GET['ad_id'])) {
    die("অনুগ্রহ করে লগইন করুন!");
}

$user_id = $_SESSION['user_id'];
$ad_id = $_GET['ad_id'];

$sql = "SELECT reward FROM ads WHERE id='$ad_id'";
$result = $conn->query($sql);
$ad = $result->fetch_assoc();
$reward = $ad['reward'];

// চেক করুন ইউজার আগেই ক্লিক করেছে কিনা
$check = $conn->query("SELECT * FROM clicks WHERE user_id='$user_id' AND ad_id='$ad_id'");
if ($check->num_rows > 0) {
    die("আপনি এই অ্যাড আগেই দেখেছেন!");
}

// ব্যালান্স আপডেট করুন
$conn->query("UPDATE users SET balance = balance + $reward WHERE id='$user_id'");
$conn->query("INSERT INTO clicks (user_id, ad_id) VALUES ('$user_id', '$ad_id')");

echo "আপনি সফলভাবে ক্লিক করেছেন! আপনার ব্যালান্স আপডেট হয়েছে।";
?>