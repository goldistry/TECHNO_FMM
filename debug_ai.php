<?php
/**
 * Debug Script untuk AI Chatbot
 * Jalankan dengan: php debug_ai.php
 */

require_once 'vendor/autoload.php';

// Load Laravel environment
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Http\Controllers\AIChatbotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

echo "=== AI Chatbot Debug Script ===\n\n";

// 1. Check Environment Variables
echo "1. Checking Environment Variables:\n";
echo "   OPENROUTER_ENABLED: " . (env('OPENROUTER_ENABLED') ? 'true' : 'false') . "\n";
echo "   OPENROUTER_API_KEY: " . (env('OPENROUTER_API_KEY') ? 'Set (length: ' . strlen(env('OPENROUTER_API_KEY')) . ')' : 'Not set') . "\n";
echo "   OPENAI_API_KEY: " . (env('OPENAI_API_KEY') ? 'Set (length: ' . strlen(env('OPENAI_API_KEY')) . ')' : 'Not set') . "\n";
echo "   OPENROUTER_MODEL: " . (env('OPENROUTER_MODEL') ?: 'Not set') . "\n\n";

// 2. Check Database Connection
echo "2. Checking Database Connection:\n";
try {
    DB::connection()->getPdo();
    echo "   ✅ Database connected\n";
    
    // Check users table
    $userCount = DB::table('users')->count();
    echo "   ✅ Users table accessible ($userCount users)\n";
    
    // Check if coins column exists
    $hasCoins = Schema::hasColumn('users', 'coins');
    echo "   " . ($hasCoins ? '✅' : '❌') . " Coins column " . ($hasCoins ? 'exists' : 'missing') . "\n";
    
} catch (Exception $e) {
    echo "   ❌ Database error: " . $e->getMessage() . "\n";
}
echo "\n";

// 3. Check OpenAI Client
echo "3. Testing AI Client Initialization:\n";
try {
    $controller = new AIChatbotController();
    echo "   ✅ AIChatbotController created successfully\n";
} catch (Exception $e) {
    echo "   ❌ Controller error: " . $e->getMessage() . "\n";
}
echo "\n";

// 4. Test API Connection
echo "4. Testing API Connection:\n";
$useOpenRouter = config('services.openrouter.enabled', false);
echo "   Using: " . ($useOpenRouter ? 'OpenRouter' : 'OpenAI') . "\n";

if ($useOpenRouter) {
    $apiKey = config('services.openrouter.api_key');
    $model = config('services.openrouter.model');
    $baseUrl = 'https://openrouter.ai/api/v1/chat/completions';
} else {
    $apiKey = config('services.openai.api_key');
    $model = 'gpt-3.5-turbo';
    $baseUrl = 'https://api.openai.com/v1/chat/completions';
}

if (!$apiKey) {
    echo "   ❌ API key not configured\n";
} else {
    echo "   ✅ API key configured\n";
    echo "   Model: $model\n";
    
    // Test API call
    echo "   Testing API call...\n";
    
    $data = [
        'model' => $model,
        'messages' => [
            ['role' => 'user', 'content' => 'Test message. Please respond with "API working!"']
        ],
        'max_tokens' => 20
    ];
    
    $headers = [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json'
    ];
    
    if ($useOpenRouter) {
        $headers[] = 'HTTP-Referer: http://localhost';
        $headers[] = 'X-Title: Laravel Debug Test';
    }
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $baseUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error) {
        echo "   ❌ cURL error: $error\n";
    } elseif ($httpCode === 200) {
        $decoded = json_decode($response, true);
        if (isset($decoded['choices'][0]['message']['content'])) {
            echo "   ✅ API working! Response: " . trim($decoded['choices'][0]['message']['content']) . "\n";
        } else {
            echo "   ❌ Unexpected response format\n";
        }
    } else {
        echo "   ❌ HTTP $httpCode: $response\n";
    }
}
echo "\n";

// 5. Check Routes
echo "5. Checking Routes:\n";
try {
    $routes = Route::getRoutes();
    $chatbotRoutes = [];
    
    foreach ($routes as $route) {
        $uri = $route->uri();
        if (strpos($uri, 'chatbot') !== false || strpos($uri, 'ai-mate') !== false) {
            $chatbotRoutes[] = $uri . ' [' . implode(',', $route->methods()) . ']';
        }
    }
    
    if (empty($chatbotRoutes)) {
        echo "   ❌ No chatbot routes found\n";
    } else {
        echo "   ✅ Chatbot routes found:\n";
        foreach ($chatbotRoutes as $route) {
            echo "      - $route\n";
        }
    }
} catch (Exception $e) {
    echo "   ❌ Route check error: " . $e->getMessage() . "\n";
}
echo "\n";

// 6. Recommendations
echo "6. Recommendations:\n";

if (!env('OPENROUTER_API_KEY') && !env('OPENAI_API_KEY')) {
    echo "   🔧 Set up API key in .env file\n";
    echo "      For OpenRouter: OPENROUTER_ENABLED=true, OPENROUTER_API_KEY=sk-or-v1-...\n";
    echo "      For OpenAI: OPENROUTER_ENABLED=false, OPENAI_API_KEY=sk-...\n";
}

if (!Schema::hasColumn('users', 'coins')) {
    echo "   🔧 Add coins column to users table:\n";
    echo "      php artisan tinker\n";
    echo "      DB::statement('ALTER TABLE users ADD COLUMN coins INT DEFAULT 100 AFTER email');\n";
}

echo "   🧪 Test flow:\n";
echo "      1. Open http://localhost:8000/chatbot\n";
echo "      2. Click a category card\n";
echo "      3. Select number of questions\n";
echo "      4. Answer all questions\n";
echo "      5. Click 'Lihat Summary Kategori Ini'\n";
echo "      6. Wait for AI response\n";

echo "\n=== Debug Complete ===\n";
?>
