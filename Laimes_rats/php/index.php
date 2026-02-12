<?php
$host = 'localhost';
$db   = 'wheel_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;charset=$charset"; 
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    $dbExists = $pdo->query("SHOW DATABASES LIKE '$db'")->fetch();

    if (!$dbExists) {
     
        $pdo->exec("CREATE DATABASE `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        echo "Datubāze izveidota.<br>";
    }

    
    $pdo->exec("USE `$db`");

    
    $sqlFile = 'wheel_db.sql'; 
    if (file_exists($sqlFile)) {
        $sql = file_get_contents($sqlFile);
        $pdo->exec($sql);
    } else {
        echo "SQL fails nav atrasts.<br>";
    }

} catch (\PDOException $e) {
    die("Savienojuma kļūda: " . $e->getMessage());
}

$stmt = $pdo->query("SELECT * FROM prizes ORDER BY id");
$prizes = [];

while ($row = $stmt->fetch()) {
    $prizes[$row['id']] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laimes rats</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="top-section"></div>

    <div class="logo">
        <img src="https://www.rosme.com/image/catalog/logo3.svg" alt="logo">
    </div>

    <div class="subtitle">Iegriez un laimē!</div>

    <div class="wheel-wrapper">
        <div class="back-circle"></div>

        <svg class="wheel" viewBox="0 0 505 505" xmlns="http://www.w3.org/2000/svg">
            <g transform="translate(252,252)">

            <!-- 1 -->
                <g class="sector-1" transform="rotate(0)">
                    <path d="M243.485,-65.242C254.936,-22.503 254.937,22.497 243.486,65.236L0,0Z"/>
                    <text class="sector-text" x="180" y="15" transform="rotate(-100deg)"><?= htmlspecialchars($prizes[1]['title'] ?? '') ?></text>
                    <?php if (!empty($prizes[1]['image'])): ?>
                        <image class="icon" x="160" y="-50" href="../svg icons/<?= htmlspecialchars($prizes[1]['image']) ?>" />
                    <?php endif; ?>
                </g>

            <!-- 2 -->
            <g class="sector-2" transform="rotate(30)">
                <path d="M243.485,-65.242C254.936,-22.503 254.937,22.497 243.486,65.236L0,0Z"/>
                <?php if (!empty($prizes[2]['image'])): ?>
                    <image class="icon" x="160" y="-50" href="../svg icons/<?= htmlspecialchars($prizes[2]['image']) ?>" />
                <?php else: ?>
                    <text class="sector-text" x="180" y="15"><?= htmlspecialchars($prizes[2]['title'] ?? '') ?></text>
                <?php endif; ?>
            </g>

            <!-- 3 -->
            <g class="sector-3" transform="rotate(60)">
                <path d="M243.485,-65.242C254.936,-22.503 254.937,22.497 243.486,65.236L0,0Z"/>
                <?php if (!empty($prizes[3]['image'])): ?>
                    <image class="icon" x="160" y="-50" href="../svg icons/<?= htmlspecialchars($prizes[3]['image']) ?>" />
                <?php else: ?>
                    <text class="sector-text" x="180" y="15"><?= htmlspecialchars($prizes[3]['title'] ?? '') ?></text>
                <?php endif; ?>
            </g>

            <!-- 4 -->
            <g class="sector-4" transform="rotate(90)">
                <path d="M243.485,-65.242C254.936,-22.503 254.937,22.497 243.486,65.236L0,0Z"/>
                <?php if (!empty($prizes[4]['image'])): ?>
                    <image class="icon" x="160" y="-50" href="../svg icons/<?= htmlspecialchars($prizes[4]['image']) ?>" />
                <?php else: ?>
                    <text class="sector-text" x="180" y="15"><?= htmlspecialchars($prizes[4]['title'] ?? '') ?></text>
                <?php endif; ?>
            </g>

            <!-- 5 -->
            <g class="sector-5" transform="rotate(120)">
                <path d="M243.485,-65.242C254.936,-22.503 254.937,22.497 243.486,65.236L0,0Z"/>
                <?php if (!empty($prizes[5]['image'])): ?>
                    <image class="icon" x="160" y="-50" href="../svg icons/<?= htmlspecialchars($prizes[5]['image']) ?>" />
                <?php else: ?>
                    <text class="sector-text" x="180" y="15"><?= htmlspecialchars($prizes[5]['title'] ?? '') ?></text>
                <?php endif; ?>
            </g>

            <!-- 6 -->
            <g class="sector-6" transform="rotate(150)">
                <path d="M243.485,-65.242C254.936,-22.503 254.937,22.497 243.486,65.236L0,0Z"/>
                <?php if (!empty($prizes[6]['image'])): ?>
                    <image class="icon" x="160" y="-50" href="../svg icons/<?= htmlspecialchars($prizes[6]['image']) ?>" />
                <?php else: ?>
                    <text class="sector-text" x="180" y="15"><?= htmlspecialchars($prizes[6]['title'] ?? '') ?></text>
                <?php endif; ?>
            </g>

            <!-- 7 -->
            <g class="sector-7" transform="rotate(180)">
                <path d="M243.485,-65.242C254.936,-22.503 254.937,22.497 243.486,65.236L0,0Z"/>
                <?php if (!empty($prizes[7]['image'])): ?>
                    <image class="icon" x="160" y="-50" href="../svg icons/<?= htmlspecialchars($prizes[7]['image']) ?>" />
                <?php else: ?>
                    <text class="sector-text" x="180" y="15"><?= htmlspecialchars($prizes[7]['title'] ?? '') ?></text>
                <?php endif; ?>
            </g>

            <!-- 8 -->
            <g class="sector-8" transform="rotate(210)">
                <path d="M243.485,-65.242C254.936,-22.503 254.937,22.497 243.486,65.236L0,0Z"/>
                <?php if (!empty($prizes[8]['image'])): ?>
                    <image class="icon" x="160" y="-50" href="../svg icons/<?= htmlspecialchars($prizes[8]['image']) ?>" />
                <?php else: ?>
                    <text class="sector-text" x="180" y="15"><?= htmlspecialchars($prizes[8]['title'] ?? '') ?></text>
                <?php endif; ?>
            </g>

            <!-- 9 -->
            <g class="sector-9" transform="rotate(240)">
                <path d="M243.485,-65.242C254.936,-22.503 254.937,22.497 243.486,65.236L0,0Z"/>
                <?php if (!empty($prizes[9]['image'])): ?>
                    <image class="icon" x="160" y="-50" href="../svg icons/<?= htmlspecialchars($prizes[9]['image']) ?>" />
                <?php else: ?>
                    <text class="sector-text" x="180" y="15"><?= htmlspecialchars($prizes[9]['title'] ?? '') ?></text>
                <?php endif; ?>
            </g>

            <!-- 10 -->
            <g class="sector-10" transform="rotate(270)">
                <path d="M243.485,-65.242C254.936,-22.503 254.937,22.497 243.486,65.236L0,0Z"/>
                <?php if (!empty($prizes[10]['image'])): ?>
                    <image class="icon" x="160" y="-50" href="../svg icons/<?= htmlspecialchars($prizes[10]['image']) ?>" />
                <?php else: ?>
                    <text class="sector-text" x="180" y="15"><?= htmlspecialchars($prizes[10]['title'] ?? '') ?></text>
                <?php endif; ?>
            </g>

            <!-- 11 -->
            <g class="sector-11" transform="rotate(300)">
                <path d="M243.485,-65.242C254.936,-22.503 254.937,22.497 243.486,65.236L0,0Z"/>
                <?php if (!empty($prizes[11]['image'])): ?>
                    <image class="icon" x="160" y="-50" href="../svg icons/<?= htmlspecialchars($prizes[11]['image']) ?>" />
                <?php else: ?>
                    <text class="sector-text" x="180" y="15"><?= htmlspecialchars($prizes[11]['title'] ?? '') ?></text>
                <?php endif; ?>
            </g>

            <!-- 12 -->
            <g class="sector-12" transform="rotate(330)">
                <path d="M243.485,-65.242C254.936,-22.503 254.937,22.497 243.486,65.236L0,0Z"/>
                <?php if (!empty($prizes[12]['image'])): ?>
                    <image class="icon" x="160" y="-50" href="../svg icons/<?= htmlspecialchars($prizes[12]['image']) ?>" />
                <?php else: ?>
                    <text class="sector-text" x="180" y="15"><?= htmlspecialchars($prizes[12]['title'] ?? '') ?></text>
                <?php endif; ?>
            </g>

        </g>
    </svg>

    <div class="arrow">
        <img src="../arrow/arrow.svg" alt="Arrow">
    </div>

    <div class="center-circle">ROSME</div>
</div>

<script src="../js/script.js"></script>
</body>
</html>
