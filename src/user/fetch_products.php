<?php
require_once __DIR__ . '/../vendor/autoload.php';
include '../connect/dbcon.php';

use JasonGrimes\Paginator;

$search = $_GET['search'] ?? '';
$type = $_GET['type'] ?? '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$limit = 6;
$offset = ($page - 1) * $limit;

// นับจำนวนทั้งหมดเพื่อใช้ทำ pagination
$countSql = "SELECT COUNT(*) FROM food_product WHERE 1";
$dataSql = "SELECT * FROM food_product WHERE 1";
$params = [];

if ($search !== '') {
    $countSql .= " AND product_name LIKE :search";
    $dataSql .= " AND product_name LIKE :search";
    $params[':search'] = "%$search%";
}

if ($type !== '') {
    $countSql .= " AND category = :type";
    $dataSql .= " AND category = :type";
    $params[':type'] = $type;
}

$totalItems = $pdo->prepare($countSql);
$totalItems->execute($params);
$totalCount = $totalItems->fetchColumn();

// ดึงข้อมูลรายการในหน้านั้น
$dataSql .= " ORDER BY food_product_id LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($dataSql);
foreach ($params as $key => $val) {
    $stmt->bindValue($key, $val);
}
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll();

// ส่ง response
echo json_encode([
    'products' => $products,
    'total' => $totalCount,
    'perPage' => $limit,
    'currentPage' => $page
]);
