<?php
require_once '../connect/dbcon.php';

$search = $_GET['search'] ?? '';
$type = $_GET['type'] ?? '';
$mainType = '';
$subType = '';

if (strpos($type, '::') !== false) {
    [$mainType, $subType] = explode('::', $type);
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 6;
$offset = ($page - 1) * $perPage;

$sql = "SELECT * FROM food_product WHERE 1";
$params = [];

if ($search !== '') {
    $sql .= " AND (
        rice_variety_th_name LIKE :search
        OR rice_variety_en_name LIKE :search
        OR product_name LIKE :search
    )";
    $params[':search'] = "%$search%";
}

if ($mainType !== '') {
    $sql .= " AND product_group = '" . addslashes($mainType) . "'";
}
if ($subType !== '') {
    $sql .= " AND category = '" . addslashes($subType) . "'";
}

$totalSql = str_replace('SELECT *', 'SELECT COUNT(*)', $sql);
$stmtTotal = $pdo->prepare($totalSql);
$stmtTotal->execute($params);
$totalItems = $stmtTotal->fetchColumn();

// เพิ่ม ORDER BY ที่จัดสินค้ามีรูปขึ้นก่อน
$sql .= " ORDER BY
    (picture IS NOT NULL AND picture != '') DESC,
    picture DESC,
    food_product_id ASC
    LIMIT :limit OFFSET :offset";

$stmt = $pdo->prepare($sql);
foreach ($params as $key => $val) {
    $stmt->bindValue($key, $val);
}
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll();

header('Content-Type: application/json');
echo json_encode([
    'products' => $products,
    'total' => $totalItems,
    'perPage' => $perPage,
    'currentPage' => $page
]);
