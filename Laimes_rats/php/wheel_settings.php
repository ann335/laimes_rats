<?php
$mysqli = new mysqli("localhost", "root", "", "wheel_db");
if ($mysqli->connect_error) {
    http_response_code(500);
    echo json_encode(['success' => false]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $spin_count = intval($input['spin_count'] ?? 1);

    $stmt = $mysqli->prepare("UPDATE wheel_settings SET spin_count=? WHERE id=1");
    $stmt->bind_param("i", $spin_count);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit;
}

// GET pieprasījums – atgriež JSON ar spin_count
$res = $mysqli->query("SELECT spin_count FROM wheel_settings WHERE id=1");
$row = $res->fetch_assoc();
echo json_encode(['spin_count' => intval($row['spin_count'] ?? 1)]);
