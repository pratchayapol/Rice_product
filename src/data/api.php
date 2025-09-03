<?php
header('Content-Type: application/json');

$jsonUrl = 'https://riceproduct.pcnone.com/data/rice_data.json';

$ch = curl_init($jsonUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // ตาม redirect ถ้ามี
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0'); // บาง server ต้องมี User-Agent
$jsonData = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($jsonData === false || $httpCode !== 200) {
    http_response_code(500);
    echo json_encode(['json'=>['allData'=>[], 'error'=>'Unable to fetch JSON']]);
    exit;
}

// แปลง JSON
$data = json_decode($jsonData, true);
if ($data === null) {
    http_response_code(500);
    echo json_encode(['json'=>['allData'=>[], 'error'=>'Invalid JSON format']]);
    exit;
}

// ตรวจสอบโครงสร้างจริง
$allData = [];
if (isset($data['allData'])) {
    $allData = $data['allData'];
} elseif (isset($data['json']['allData'])) {
    $allData = $data['json']['allData'];
}

echo json_encode(['json'=>['allData'=>$allData]]);
