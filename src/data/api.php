<?php
header('Content-Type: application/json');

// path ของไฟล์ JSON
$jsonFile = __DIR__ . '/rice_data.json';

// ตรวจสอบไฟล์
if (!file_exists($jsonFile)) {
    http_response_code(404);
    echo json_encode([
        'json' => [
            'allData' => [],
            'error' => 'File not found'
        ]
    ]);
    exit;
}

// อ่านไฟล์
$jsonData = file_get_contents($jsonFile);
if ($jsonData === false) {
    http_response_code(500);
    echo json_encode([
        'json' => [
            'allData' => [],
            'error' => 'Unable to read JSON file'
        ]
    ]);
    exit;
}

// แปลง JSON เป็น array
$data = json_decode($jsonData, true);
if ($data === null) {
    http_response_code(500);
    echo json_encode([
        'json' => [
            'allData' => [],
            'error' => 'Invalid JSON format'
        ]
    ]);
    exit;
}

// ส่งข้อมูลกลับ client ตามรูปแบบ
echo json_encode([
    'json' => [
        'allData' => $data['allData'] ?? []
    ]
]);
