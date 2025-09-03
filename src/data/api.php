<?php
header('Content-Type: application/json');

$jsonUrl = 'https://riceproduct.pcnone.com/data/rice_data.json';

// ใช้ cURL โหลด JSON
$ch = curl_init($jsonUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$jsonData = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($jsonData === false || $httpCode !== 200) {
    http_response_code(500);
    echo json_encode([
        'json' => [
            'allData' => [],
            'error' => 'Unable to fetch JSON from URL'
        ]
    ]);
    exit;
}

// แปลง JSON
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

// ส่งกลับ client
echo json_encode([
    'json' => [
        'allData' => $data['allData'] ?? []
    ]
]);
