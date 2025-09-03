<?php
header('Content-Type: application/json');

$jsonUrl = 'https://riceproduct.pcnone.com/data/rice_data.json';

// อ่านจาก URL
$jsonData = file_get_contents($jsonUrl);

if ($jsonData === false) {
    http_response_code(500);
    echo json_encode([
        'json' => [
            'allData' => [],
            'error' => 'Unable to fetch JSON from URL'
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

// ส่งข้อมูลกลับ
echo json_encode([
    'json' => [
        'allData' => $data['allData'] ?? []
    ]
]);
