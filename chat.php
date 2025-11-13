<?php
header('Content-Type: application/json');
require_once 'config.php';

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['messages']) || !is_array($input['messages'])) {
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$messages = $input['messages'];

// Prepare request to OpenRouter
// The full message history is sent to maintain conversation context
$data = [
    'model' => OPENROUTER_MODEL,
    'messages' => $messages
];

$ch = curl_init('https://openrouter.ai/api/v1/chat/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . OPENROUTER_API_KEY,
    'HTTP-Referer: http://localhost',
    'X-Title: ChatHTML'
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
    echo json_encode(['error' => 'API request failed']);
    exit;
}

$result = json_decode($response, true);

if (isset($result['choices'][0]['message']['content'])) {
    echo json_encode(['message' => $result['choices'][0]['message']['content']]);
} else {
    echo json_encode(['error' => 'Invalid API response']);
}
