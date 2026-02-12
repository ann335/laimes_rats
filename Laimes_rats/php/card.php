<?php
// card.php
$mysqli = new mysqli("localhost","root","","wheel_db");
if($mysqli->connect_error) die("DB error");

// Saņem sector no URL, default 0
$sector = isset($_GET['sector']) ? intval($_GET['sector']) : 0;

// Iegūst datu no DB
$stmt = $mysqli->prepare("SELECT title, h1, h2, P, image, image1 FROM prizes WHERE id=?");
$stmt->bind_param("i",$sector);
$stmt->execute();
$result = $stmt->get_result();
$prize = $result->fetch_assoc();

if(!$prize) {
    die("Prize nav atrasts");
}
?>
<!DOCTYPE html>
<html lang="lv">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($prize['title']) ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/style_for_cards.css">
</head>
<body>
<div class="top-section"></div>
    <div class="logo"><img src="https://www.rosme.com/image/catalog/logo3.svg" alt="logo"></div>

    <div class="subtitle">Iegriez un laimē!</div>
    <div class="image-container">
<div class="image-container">
    <?php if(!empty($prize['image1'])): ?>
        <img src="../img_for_cards/<?= htmlspecialchars($prize['image1']) ?>" alt="card_img">
    <?php endif; ?>
    <div class="overlay">
    <div>
        <h1><?= htmlspecialchars($prize['h1']) ?></h1>
        <h2><?= htmlspecialchars($prize['h2']) ?></h2>
        <p><?= htmlspecialchars($prize['P']) ?></p>
        <a href="../php/index.php"><button>Restart</button></a>
    </div>
    </div>
</div>
</body>
</html>
<script src="/js/script.js"></script>
</body>
</html>