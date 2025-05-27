<?php
session_start();

include '../connect/dbcon.php';

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    $query = isset($_GET['q']) ? trim($_GET['q']) : '';

    if ($query !== '') {
        $stmt = $pdo->prepare("SELECT DISTINCT rice_variety_th_name 
                               FROM rice_products 
                               WHERE rice_variety_th_name LIKE :query 
                                  OR rice_variety_en_name LIKE :query 
                               LIMIT 10");
        $searchTerm = "%" . $query . "%";
        $stmt->execute(['query' => $searchTerm]);
        $results = $stmt->fetchAll(PDO::FETCH_COLUMN);
        echo json_encode($results);
    } else {
        echo json_encode([]);
    }

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}
