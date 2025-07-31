<?php
// รับคำถามจาก POST
$data = json_decode(file_get_contents('php://input'), true);
$message = $data['message'] ?? '';

// เรียก Rasa (เปลี่ยน URL ตาม Docker network)
$url = 'http://rasa:5005/webhooks/rest/webhook';
$payload = json_encode([
    "sender" => "web_user",
    "message" => $message
]);

$options = [
    'http' => [
        'header'  => "Content-type: application/json",
        'method'  => 'POST',
        'content' => $payload
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$response = json_decode($result, true);

// ส่งกลับข้อความแรก
$reply = $response[0]['text'] ?? 'บอทยังไม่มีคำตอบนะครับ';
echo json_encode(['reply' => $reply]);
