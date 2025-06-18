<?php
include '../connect/dbcon.php'; // ใช้ไฟล์เชื่อมต่อฐานข้อมูลของคุณ

$q = $_GET['q'] ?? '';
$q = trim($q);

if ($q === '') {
    echo json_encode([]);
    exit;
}

$stmt = $pdo->prepare("SELECT rice_id, thai_breed_name, english_breed_name FROM rice WHERE thai_breed_name LIKE ? OR english_breed_name LIKE ? LIMIT 10");
$stmt->execute(["%$q%", "%$q%"]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$response = array_map(function ($row) {
    $label = $row['thai_breed_name'];
    if (!empty($row['english_breed_name'])) {
        $label .= ' (' . $row['english_breed_name'] . ')';
    }
    return [
        "id" => $row['rice_id'],
        "label" => $label,
        "thai" => $row['thai_breed_name'],
        "english" => $row['english_breed_name']
    ];
}, $results);

header('Content-Type: application/json');
echo json_encode($response);