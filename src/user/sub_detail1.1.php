<?php

if ($type === "food") {
    // เตรียมคำสั่ง SQL
    $stmt = $pdo->prepare("SELECT * FROM food_product WHERE food_product_id = :id");
    $stmt->execute(['id' => $id]);

    // ดึงข้อมูล
    $product = $stmt->fetch();

    if ($product) {
        // การเข้าถึงข้อมูล
        $rice_id = $product['rice_id'];
        $thai_name = $product['rice_variety_th_name'];
        $english_name = $product['rice_variety_en_name'];
        $product_name = $product['product_name'];
        $group = $product['product_group'];
        $category = $product['category'];
        $group_th = $product['rice_variety_group_th_name'];
        $group_en = $product['rice_variety_group_en_name'];
        $source_url = $product['source_url'];
        $source = $product['source'];
        $ingredients_and_equipment = $product['ingredients_and_equipment'];
        $instructions = $product['instructions'];
        $picture = $product['picture'];

        // แยกสตริงด้วยเครื่องหมายคอมมา แล้วเอาแค่ตัวแรก
        $rice_id_array = explode(', ', $rice_id);
        $target_rice_id = trim($rice_id_array[0]); // ลบช่องว่างเผื่อมี

        // แปลงเป็น integer ถ้าจำเป็น
        $target_rice_id = (int)$target_rice_id;

        // คำสั่ง SQL พร้อม placeholder
        $sql = "SELECT * FROM rice WHERE rice_id = :rice_id";

        // เตรียมคำสั่ง
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':rice_id', $target_rice_id, PDO::PARAM_INT);

        // ประมวลผล
        $stmt->execute();

        // ตรวจสอบผลลัพธ์
        if ($stmt->rowCount() > 0) {
            $general_info = $stmt->fetch(PDO::FETCH_ASSOC);

            // แยกเก็บข้อมูลในตัวแปร PHP
            $gs_no = !empty($general_info['gs_no']) ? $general_info['gs_no'] : 'ไม่พบข้อมูล';
            $thai_breed_name = !empty($general_info['thai_breed_name']) ? $general_info['thai_breed_name'] : 'ไม่พบข้อมูล';
            $english_breed_name = !empty($general_info['english_breed_name']) ? $general_info['english_breed_name'] : 'ไม่พบข้อมูล';
            $scientific_name = !empty($general_info['scientific_name']) ? $general_info['scientific_name'] : 'ไม่พบข้อมูล';
            $rice_ecosystem = !empty($general_info['rice_ecosystem']) ? $general_info['rice_ecosystem'] : 'ไม่พบข้อมูล';
            $date_of_approval_or_recommendation = !empty($general_info['date_of_approval_or_recommendation']) ? $general_info['date_of_approval_or_recommendation'] : 'ไม่พบข้อมูล';
            $general_status = !empty($general_info['general_status']) ? $general_info['general_status'] : 'ไม่พบข้อมูล';
            $harvest_age_days = !empty($general_info['harvest_age_days']) ? $general_info['harvest_age_days'] : 'ไม่พบข้อมูล';
            $photoperiod_sensitivity = !empty($general_info['photoperiod_sensitivity']) ? $general_info['photoperiod_sensitivity'] : 'ไม่พบข้อมูล';

            $picture_rice = $general_info['picture_rice'] ?? null;
            $link_url = $general_info['link_url'] ?? null;
        } else {
            echo "ไม่พบข้อมูลสำหรับ rice_id = $target_rice_id";
        }
    }
} else if ($type === "cosmetic") {
    // เตรียมคำสั่ง SQL
    $stmt = $pdo->prepare("SELECT * FROM cosmetic_product WHERE cosmetic_product_id = :id");
    $stmt->execute(['id' => $id]);

    // ดึงข้อมูล
    $product = $stmt->fetch();

    if ($product) {
        // การเข้าถึงข้อมูล
        $rice_id = $product['rice_id'];
        $thai_name = $product['rice_variety_th_name'];
        $english_name = $product['rice_variety_en_name'];
        $product_name = $product['product_name'];
        $group = $product['product_group'];
        $category = $product['category'];
        $group_th = $product['rice_variety_group_th_name'];
        $group_en = $product['rice_variety_group_en_name'];
        $source_url = $product['source_url'];
        $source = $product['source'];
        $ingredients_and_equipment = $product['ingredients_and_equipment'];
        $instructions = $product['instructions'];
        $picture = $product['picture'];

        // แยกสตริงด้วยเครื่องหมายคอมมา แล้วเอาแค่ตัวแรก
        $rice_id_array = explode(', ', $rice_id);
        $target_rice_id = trim($rice_id_array[0]); // ลบช่องว่างเผื่อมี

        // แปลงเป็น integer ถ้าจำเป็น
        $target_rice_id = (int)$target_rice_id;

        // คำสั่ง SQL พร้อม placeholder
        $sql = "SELECT * FROM rice WHERE rice_id = :rice_id";

        // เตรียมคำสั่ง
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':rice_id', $target_rice_id, PDO::PARAM_INT);

        // ประมวลผล
        $stmt->execute();

        // ตรวจสอบผลลัพธ์
        if ($stmt->rowCount() > 0) {
            $general_info = $stmt->fetch(PDO::FETCH_ASSOC);

            // แยกเก็บข้อมูลในตัวแปร PHP
            $gs_no = !empty($general_info['gs_no']) ? $general_info['gs_no'] : 'ไม่พบข้อมูล';
            $thai_breed_name = !empty($general_info['thai_breed_name']) ? $general_info['thai_breed_name'] : 'ไม่พบข้อมูล';
            $english_breed_name = !empty($general_info['english_breed_name']) ? $general_info['english_breed_name'] : 'ไม่พบข้อมูล';
            $scientific_name = !empty($general_info['scientific_name']) ? $general_info['scientific_name'] : 'ไม่พบข้อมูล';
            $rice_ecosystem = !empty($general_info['rice_ecosystem']) ? $general_info['rice_ecosystem'] : 'ไม่พบข้อมูล';
            $date_of_approval_or_recommendation = !empty($general_info['date_of_approval_or_recommendation']) ? $general_info['date_of_approval_or_recommendation'] : 'ไม่พบข้อมูล';
            $general_status = !empty($general_info['general_status']) ? $general_info['general_status'] : 'ไม่พบข้อมูล';
            $harvest_age_days = !empty($general_info['harvest_age_days']) ? $general_info['harvest_age_days'] : 'ไม่พบข้อมูล';
            $photoperiod_sensitivity = !empty($general_info['photoperiod_sensitivity']) ? $general_info['photoperiod_sensitivity'] : 'ไม่พบข้อมูล';

            $picture_rice = $general_info['picture_rice'] ?? null;
            $link_url = $general_info['link_url'] ?? null;
        } else {
            echo "ไม่พบข้อมูลสำหรับ rice_id = $target_rice_id";
        }
    }
} else if ($type === "medical") {
    // เตรียมคำสั่ง SQL
    $stmt = $pdo->prepare("SELECT * FROM medical_product WHERE medical_product_id = :id");
    $stmt->execute(['id' => $id]);

    // ดึงข้อมูล
    $product = $stmt->fetch();

    if ($product) {
        // การเข้าถึงข้อมูล
        $rice_id = $product['rice_id'];
        $thai_name = $product['rice_variety_th_name'];
        $english_name = $product['rice_variety_en_name'];
        $product_name = $product['product_name'];
        $group = $product['product_group'];
        $category = $product['category'];
        $group_th = $product['rice_variety_group_th_name'];
        $group_en = $product['rice_variety_group_en_name'];
        $source_url = $product['source_url'];
        $source = $product['source'];
        $ingredients_and_equipment = $product['ingredients_and_equipment'];
        $instructions = $product['instructions'];
        $picture = $product['picture'];

        // แยกสตริงด้วยเครื่องหมายคอมมา แล้วเอาแค่ตัวแรก
        $rice_id_array = explode(', ', $rice_id);
        $target_rice_id = trim($rice_id_array[0]); // ลบช่องว่างเผื่อมี

        // แปลงเป็น integer ถ้าจำเป็น
        $target_rice_id = (int)$target_rice_id;



        // คำสั่ง SQL พร้อม placeholder
        $sql = "SELECT * FROM rice WHERE rice_id = :rice_id";

        // เตรียมคำสั่ง
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':rice_id', $target_rice_id, PDO::PARAM_INT);

        // ประมวลผล
        $stmt->execute();

        // ตรวจสอบผลลัพธ์
        if ($stmt->rowCount() > 0) {
            $general_info = $stmt->fetch(PDO::FETCH_ASSOC);

            // แยกเก็บข้อมูลในตัวแปร PHP
            $gs_no = !empty($general_info['gs_no']) ? $general_info['gs_no'] : 'ไม่พบข้อมูล';
            $thai_breed_name = !empty($general_info['thai_breed_name']) ? $general_info['thai_breed_name'] : 'ไม่พบข้อมูล';
            $english_breed_name = !empty($general_info['english_breed_name']) ? $general_info['english_breed_name'] : 'ไม่พบข้อมูล';
            $scientific_name = !empty($general_info['scientific_name']) ? $general_info['scientific_name'] : 'ไม่พบข้อมูล';
            $rice_ecosystem = !empty($general_info['rice_ecosystem']) ? $general_info['rice_ecosystem'] : 'ไม่พบข้อมูล';
            $date_of_approval_or_recommendation = !empty($general_info['date_of_approval_or_recommendation']) ? $general_info['date_of_approval_or_recommendation'] : 'ไม่พบข้อมูล';
            $general_status = !empty($general_info['general_status']) ? $general_info['general_status'] : 'ไม่พบข้อมูล';
            $harvest_age_days = !empty($general_info['harvest_age_days']) ? $general_info['harvest_age_days'] : 'ไม่พบข้อมูล';
            $photoperiod_sensitivity = !empty($general_info['photoperiod_sensitivity']) ? $general_info['photoperiod_sensitivity'] : 'ไม่พบข้อมูล';

            $picture_rice = $general_info['picture_rice'] ?? null;
            $link_url = $general_info['link_url'] ?? null;
        } else {
            echo "ไม่พบข้อมูลสำหรับ rice_id = $target_rice_id";
        }
    }
} else {
    echo "ไม่พบข้อมูล";
}


// ฟังก์ชันเปรียบเทียบแบบไม่สนใจช่องว่างและตัวพิมพ์ใหญ่เล็ก
function compare_names($a, $b)
{
    return trim(mb_strtolower($a)) === trim(mb_strtolower($b));
}

// สร้างตัวแปรสำหรับแสดงผล
if (!empty($thai_name) && !empty($thai_breed_name)) {
    if (compare_names($thai_name, $thai_breed_name)) {
        $display_thai_name = $thai_name; // ชื่อเหมือนกัน แสดงชื่อเดียว
    } else {
        $display_thai_name = $thai_name . ' หรือ ' . $thai_breed_name; // ชื่อไม่เหมือนกัน แสดงทั้งสอง
    }
} else {
    // ถ้ามีแค่ข้อมูลแหล่งใดแหล่งหนึ่ง
    $display_thai_name = !empty($thai_name) ? $thai_name : ($thai_breed_name ?: 'ไม่พบข้อมูล');
}


if (!empty($english_name) && !empty($english_breed_name)) {
    if (compare_names($english_name, $english_breed_name)) {
        $display_english_name = $english_name;
    } else {
        $display_english_name = $english_name . ' AND ' . $english_breed_name;
    }
} else {
    $display_english_name = !empty($english_name) ? $english_name : ($english_breed_name ?: 'ไม่พบข้อมูล');
}


$sql = "SELECT * FROM sampleinfo WHERE rice_id = :rice_id LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':rice_id', $rice_id, PDO::PARAM_INT);
$stmt->execute();

// 3. ดึงข้อมูลออกมา
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sampleinfo_cropSampleID = null;
if ($row) {
    // 4. สร้างตัวแปรแบบ sampleinfo_ชื่อฟิลด์
    foreach ($row as $field => $value) {
        ${"sampleinfo_" . $field} = $value;
    }
    $sampleinfo_cropSampleID;  //เป็น PK ของ sampleinfo เพื่อไปหา fk ของ 4 table ที่เหลือ
} else {
}
