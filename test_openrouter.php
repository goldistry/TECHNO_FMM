<?php

/**
 * Test Script untuk OpenRouter API
 * Jalankan dengan: php test_openrouter.php
 */

// Ganti dengan API key OpenRouter Anda
$apiKey = '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';
$model = 'google/gemma-2-9b-it:free';

function testOpenRouter($apiKey, $model)
{
    $url = 'https://openrouter.ai/api/v1/chat/completions';

    $data = [
        'model' => $model,
        'messages' => [
            [
                'role' => 'user',
                'content' => 'Hello! Please respond with "OpenRouter is working!" if you can see this message.'
            ]
        ],
        'max_tokens' => 50
    ];

    $headers = [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json',
        'HTTP-Referer: http://localhost',
        'X-Title: Laravel Chatbot Test'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo "=== OpenRouter API Test ===\n";
    echo "HTTP Code: $httpCode\n";
    echo "Response: $response\n";

    if ($httpCode === 200) {
        $decoded = json_decode($response, true);
        if (isset($decoded['choices'][0]['message']['content'])) {
            echo "\n✅ SUCCESS! AI Response: " . $decoded['choices'][0]['message']['content'] . "\n";
            return true;
        }
    }

    echo "\n❌ FAILED! Check your API key and try again.\n";
    return false;
}

// Test API
if ($apiKey === 'sk-or-v1-your-api-key-here') {
    echo "❌ Please update the API key in this file first!\n";
    echo "Get your API key from: https://openrouter.ai/settings/keys\n";
} else {
    testOpenRouter($apiKey, $model);
}

echo "\n=== Available Free Models ===\n";
echo "1. nousresearch/hermes-3-llama-3.1-405b:free\n";
echo "2. microsoft/phi-3-mini-128k-instruct:free\n";
echo "3. google/gemma-2-9b-it:free\n";
echo "4. meta-llama/llama-3.1-8b-instruct:free\n";
echo "\nUpdate your .env file with:\n";
echo "OPENROUTER_ENABLED=true\n";
echo "OPENROUTER_API_KEY=your-actual-key\n";
echo "OPENROUTER_MODEL=nousresearch/hermes-3-llama-3.1-405b:free\n";
