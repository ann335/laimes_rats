<?php
header('Content-Type: application/json');

// DB konfigurācija
$host = "localhost";
$user = "root";
$pass = "";
$db   = "wheel_db";

// Savienojums
$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "DB connection failed"]);
    exit;
}

// Iegūstam datus
$sql = "SELECT id, title, probability FROM prizes ORDER BY id ASC";
$result = $mysqli->query($sql);

$sectors = [];
while ($row = $result->fetch_assoc()) {
    $sectors[] = [
        "id" => intval($row['id']),
        "title" => $row['title'],
        "probability" => floatval($row['probability'])
    ];
}

// Atgriež JSON
echo json_encode($sectors);
$mysqli->close();
