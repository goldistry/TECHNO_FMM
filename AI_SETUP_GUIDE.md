# 🤖 AI LLM Setup Guide untuk Laravel Chatbot

Panduan lengkap untuk menggunakan berbagai API LLM gratis dengan aplikasi chatbot Laravel Anda.

## 🚀 Opsi API LLM yang Tersedia

### 1. **OpenRouter (Recommended)** 🌟
- **Status**: Gratis dengan model tertentu
- **URL**: https://openrouter.ai
- **Keuntungan**: 
  - Compatible dengan OpenAI API
  - Banyak model gratis tersedia
  - Rate limit yang wajar
  - Mudah setup

### 2. **Ollama (Fully Local)** 🏠
- **Status**: 100% gratis, offline
- **URL**: https://ollama.com
- **Keuntungan**:
  - Tidak perlu internet setelah download
  - Privacy terjamin
  - Unlimited usage

### 3. **LM Studio (Local dengan GUI)** 💻
- **Status**: Gratis
- **URL**: https://lmstudio.ai
- **Keuntungan**:
  - User-friendly interface
  - Compatible dengan OpenAI API
  - Download model dari Hugging Face

### 4. **Hugging Face Inference API** 🤗
- **Status**: Free tier 30k characters/month
- **URL**: https://huggingface.co
- **Keuntungan**:
  - Ribuan model tersedia
  - Mudah digunakan

## 📋 Setup Guide

### Option 1: OpenRouter (Tercepat untuk Testing)

#### Step 1: Daftar OpenRouter
1. Kunjungi https://openrouter.ai
2. Daftar akun gratis
3. Dapatkan API key dari dashboard

#### Step 2: Update .env
```env
# Aktifkan OpenRouter
OPENROUTER_ENABLED=true
OPENROUTER_API_KEY=sk-or-v1-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
OPENROUTER_MODEL=nousresearch/hermes-3-llama-3.1-405b:free
```

#### Step 3: Model Gratis yang Tersedia
- `nousresearch/hermes-3-llama-3.1-405b:free`
- `microsoft/phi-3-mini-128k-instruct:free`
- `google/gemma-2-9b-it:free`
- `meta-llama/llama-3.1-8b-instruct:free`

### Option 2: Ollama (Local Setup)

#### Step 1: Install Ollama
```bash
# Windows
winget install Ollama.Ollama

# macOS
brew install ollama

# Linux
curl -fsSL https://ollama.com/install.sh | sh
```

#### Step 2: Download Model
```bash
ollama pull llama3.1:8b
ollama pull mistral:7b
ollama pull codellama:7b
```

#### Step 3: Start Server
```bash
ollama serve
# Server akan berjalan di http://localhost:11434
```

#### Step 4: Update Laravel Controller
```php
// Untuk Ollama, update constructor:
$this->openaiClient = OpenAI::factory()
    ->withBaseUri('http://localhost:11434/v1')
    ->withApiKey('ollama') // Dummy key untuk Ollama
    ->make();
```

### Option 3: LM Studio

#### Step 1: Download LM Studio
1. Download dari https://lmstudio.ai
2. Install aplikasi

#### Step 2: Download Model
1. Buka LM Studio
2. Search model (contoh: "llama-3.1-8b")
3. Download model

#### Step 3: Start Server
1. Buka tab "Developer"
2. Load model
3. Start server di port 1234

#### Step 4: Update .env
```env
# Untuk LM Studio
OPENROUTER_ENABLED=false
OPENAI_API_KEY=lm-studio
# Update base URL di controller ke http://localhost:1234/v1
```

## 🔧 Testing API

### Test OpenRouter
```bash
curl -X POST "https://openrouter.ai/api/v1/chat/completions" \
  -H "Authorization: Bearer YOUR_API_KEY" \
  -H "Content-Type: application/json" \
  -d '{
    "model": "nousresearch/hermes-3-llama-3.1-405b:free",
    "messages": [{"role": "user", "content": "Hello!"}]
  }'
```

### Test Ollama
```bash
curl -X POST "http://localhost:11434/v1/chat/completions" \
  -H "Content-Type: application/json" \
  -d '{
    "model": "llama3.1:8b",
    "messages": [{"role": "user", "content": "Hello!"}]
  }'
```

## 🎯 Rekomendasi untuk Development

1. **Untuk Testing Cepat**: Gunakan OpenRouter
2. **Untuk Development Offline**: Gunakan Ollama
3. **Untuk UI yang Bagus**: Gunakan LM Studio
4. **Untuk Production**: Gunakan OpenAI API (berbayar tapi reliable)

## 🔄 Switch Between APIs

Aplikasi sudah dikonfigurasi untuk mudah switch antara provider:

```env
# Gunakan OpenRouter
OPENROUTER_ENABLED=true

# Gunakan OpenAI
OPENROUTER_ENABLED=false
```

## 📊 Perbandingan

| Provider | Cost | Setup | Performance | Offline |
|----------|------|-------|-------------|---------|
| OpenRouter | Free* | Easy | Good | No |
| Ollama | Free | Medium | Good | Yes |
| LM Studio | Free | Easy | Good | Yes |
| OpenAI | Paid | Easy | Excellent | No |

*Free dengan rate limits

## 🆘 Troubleshooting

### Error: "Connection refused"
- Pastikan server lokal berjalan (Ollama/LM Studio)
- Check port yang digunakan

### Error: "Invalid API key"
- Pastikan API key benar
- Check format API key

### Error: "Model not found"
- Pastikan model sudah di-download (untuk local)
- Check nama model yang digunakan

## 🎉 Ready to Test!

Setelah setup, aplikasi chatbot Anda siap menggunakan AI LLM gratis untuk testing!
