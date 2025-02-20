<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
}

$ads = $conn->query("SELECT * FROM ads");
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <title>অ্যাড দেখুন</title>
</head>
<body>
    <h2>অ্যাড ক্লিক করুন</h2>
    <?php while ($ad = $ads->fetch_assoc()): ?>
        <p>
            <a href="click.php?ad_id=<?php echo $ad['id']; ?>" target="_blank">
                <?php echo $ad['url']; ?>
            </a> (<?php echo $ad['reward']; ?> টাকা)
        </p>
    <?php endwhile; ?>
</body>
</html>