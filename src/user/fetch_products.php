<?php
require_once '../connect/dbcon.php';

$search = $_GET['search'] ?? '';
$type = $_GET['type'] ?? '';

$sql = "SELECT * FROM food_product WHERE 1";
$params = [];

if ($search !== '') {
    $sql .= " AND product_name LIKE :search";
    $params[':search'] = "%$search%";
}

if ($type !== '') {
    $sql .= " AND category = :type"; // สมมุติว่าคุณมี column `category` ระบุว่าเป็นอาหาร/ขนม/เครื่องดื่ม
    $params[':type'] = $type;
}

$sql .= " ORDER BY food_product_id LIMIT 50"; // limit ความเร็ว

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();

header('Content-Type: application/json');
echo json_encode($products);
?>