<?php
include '../connect/dbcon.php';
// การตั้งค่า header สำหรับ API
header("Content-Type: application/json; charset=UTF-8");

// ตรวจสอบ access_token ที่ส่งมา
$headers = getallheaders();
$access_token = isset($headers['Authorization']) ? trim(str_replace('Bearer ', '', $headers['Authorization'])) : null;

if (!$access_token) {
    http_response_code(401);
    echo json_encode(["error" => "Access token required"]);
    exit;
}

// ตรวจสอบว่ามี token นี้ในฐานข้อมูลหรือไม่
$stmt = $pdo->prepare("SELECT * FROM accounts WHERE access_token = ?");
$stmt->execute([$access_token]);
$user = $stmt->fetch();

if (!$user) {
    http_response_code(403);
    echo json_encode(["error" => "Invalid access token"]);
    exit;
}

// ดึงข้อมูลจากตาราง cosmetic_product
$query = "SELECT * FROM cosmetic_product";
$stmt = $pdo->query($query);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ส่งผลลัพธ์
echo json_encode($products, JSON_UNESCAPED_UNICODE);
?>