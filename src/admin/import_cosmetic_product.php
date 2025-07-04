<?php
include '../connect/dbcon.php';

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
    exit;
}

if (!isset($_FILES["csv_file"]) || $_FILES["csv_file"]["error"] !== UPLOAD_ERR_OK) {
    echo json_encode(["success" => false, "message" => "Upload failed."]);
    exit;
}

$csvFile = $_FILES["csv_file"]["tmp_name"];

try {
    // เปิดไฟล์ CSV
    if (($handle = fopen($csvFile, "r")) === false) {
        echo json_encode(["success" => false, "message" => "Cannot open CSV file."]);
        exit;
    }

    // อ่าน header (บรรทัดแรก)
    $header = fgetcsv($handle);

    // เตรียม SQL
    $sql = "INSERT INTO cosmetic_product (
        rice_id,
        rice_variety_th_name,
        rice_variety_en_name,
        product_name,
        product_group,
        category,
        rice_variety_group_th_name,
        rice_variety_group_en_name,
        source_url,
        source,
        ingredients_and_equipment,
        instructions,
        ingredients_and_equipment_en,
        instructions_en,
        product_name_th,
        product_name_en,
        picture,
        genbank_url
    ) VALUES (
        :rice_id,
        :rice_variety_th_name,
        :rice_variety_en_name,
        :product_name,
        :product_group,
        :category,
        :rice_variety_group_th_name,
        :rice_variety_group_en_name,
        :source_url,
        :source,
        :ingredients_and_equipment,
        :instructions,
        :ingredients_and_equipment_en,
        :instructions_en,
        :product_name_th,
        :product_name_en,
        :picture,
        :genbank_url
    )";

    $stmt = $pdo->prepare($sql);

    $rowCount = 0;
    while (($data = fgetcsv($handle)) !== false) {
        // สร้าง associative array ตามลำดับคอลัมน์
        $params = [
            ":rice_id" => !empty($data[1]) ? $data[1] : null,
            ":rice_variety_th_name" => $data[2] ?? null,
            ":rice_variety_en_name" => $data[3] ?? null,
            ":product_name" => $data[4] ?? null,
            ":product_group" => $data[5] ?? null,
            ":category" => $data[6] ?? null,
            ":rice_variety_group_th_name" => $data[7] ?? null,
            ":rice_variety_group_en_name" => $data[8] ?? null,
            ":source_url" => $data[9] ?? null,
            ":source" => $data[10] ?? null,
            ":ingredients_and_equipment" => $data[11] ?? null,
            ":instructions" => $data[12] ?? null,
            ":ingredients_and_equipment_en" => $data[13] ?? null,
            ":instructions_en" => $data[14] ?? null,
            ":product_name_th" => $data[15] ?? null,
            ":product_name_en" => $data[16] ?? null,
            ":picture" => (isset($data[17]) && trim($data[17]) !== "") ? $data[17] : null,
            ":genbank_url" => $data[18] ?? null
        ];
        $stmt->execute($params);
        $rowCount++;
    }

    fclose($handle);

    echo json_encode(["success" => true, "message" => "Imported {$rowCount} rows successfully."]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
}
