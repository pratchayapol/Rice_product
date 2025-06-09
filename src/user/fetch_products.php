<?php
require_once '../connect/dbcon.php';

$search = $_GET['search'] ?? '';
$type = $_GET['type'] ?? '';
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 6;
$offset = ($page - 1) * $limit;

// สร้าง SQL พื้นฐาน
$sql = "FROM food_product WHERE 1";
$params = [];

if ($search !== '') {
    $sql .= " AND product_name LIKE :search";
    $params[':search'] = "%$search%";
}

if ($type !== '') {
    $sql .= " AND category = :type";
    $params[':type'] = $type;
}

// 1. ดึงจำนวนทั้งหมด
$countStmt = $pdo->prepare("SELECT COUNT(*) $sql");
$countStmt->execute($params);
$total = $countStmt->fetchColumn();

// 2. ดึงข้อมูลเฉพาะหน้า
$dataStmt = $pdo->prepare("SELECT * $sql ORDER BY food_product_id DESC LIMIT :limit OFFSET :offset");
foreach ($params as $key => $val) {
    $dataStmt->bindValue($key, $val);
}
$dataStmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$dataStmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$dataStmt->execute();
$products = $dataStmt->fetchAll();

// 3. ส่งกลับ
echo json_encode([
    'products' => $products,
    'total' => $total,
    'perPage' => $limit,
    'currentPage' => $page
]);
