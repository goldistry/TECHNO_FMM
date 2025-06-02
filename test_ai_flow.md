# 🧪 Testing AI Chatbot Flow

## 📋 **Langkah Testing Lengkap**

### **1. Persiapan**
- ✅ Setup API key di `.env`
- ✅ Clear cache Laravel
- ✅ Server Laravel berjalan di http://localhost:8000

### **2. Flow Testing yang Benar**

#### **Step A: Buka Halaman Chatbot**
1. Buka browser ke `http://localhost:8000/chatbot`
2. Pastikan halaman load tanpa error JavaScript
3. Lihat saldo koin di kanan atas (default: 100 koin)

#### **Step B: Pilih Kategori**
1. **Klik salah satu kategori** (contoh: "Bakat & Minat")
2. **Modal akan muncul** dengan pilihan jumlah pertanyaan
3. **Pilih jumlah pertanyaan** (contoh: "2 Pertanyaan - 30 Koin")

#### **Step C: Jawab Pertanyaan**
1. **Konsol chat akan muncul** dengan pertanyaan pertama
2. **Ketik jawaban** di input box (contoh: "Saya suka coding dan matematika")
3. **Tekan Enter** atau klik "Kirim"
4. **Pertanyaan kedua muncul**, jawab lagi
5. **Setelah semua pertanyaan dijawab**, akan muncul pesan:
   ```
   "Semua pertanyaan untuk kategori ini telah selesai. 
   Klik tombol di bawah untuk melihat summary."
   ```

#### **Step D: Test AI Summary (POIN UTAMA)**
1. **Klik tombol "Lihat Summary Kategori Ini"**
2. **Loading message muncul**: "Memproses summary untuk [Kategori]..."
3. **AI akan memproses** (tunggu 5-15 detik)
4. **Output AI muncul** dalam format HTML dengan rekomendasi jurusan

### **3. Expected Output AI**

Output yang diharapkan dari AI:
```html
<strong>Analisis Rekomendasi Jurusan Berdasarkan Bakat & Minat</strong><br><br>

<strong>JURUSAN YANG MUNGKIN SESUAI BUAT KAMU:</strong><br><br>

<strong>1. Teknik Informatika</strong><br>
&nbsp;&nbsp;Alasan: Berdasarkan minat Anda pada coding dan matematika, jurusan ini sangat cocok karena menggabungkan logika pemrograman dengan konsep matematika yang kuat.<br><br>

<strong>2. Sistem Informasi</strong><br>
&nbsp;&nbsp;Alasan: Cocok untuk yang suka coding tapi juga tertarik pada aspek bisnis dan manajemen data.<br><br>
```

### **4. Debugging Steps**

#### **Jika AI tidak merespons:**

**A. Check Browser Console (F12)**
```javascript
// Buka Developer Tools (F12) > Console
// Lihat apakah ada error seperti:
// - Network errors
// - JavaScript errors
// - API errors
```

**B. Check Network Tab**
```
1. Buka F12 > Network tab
2. Klik "Lihat Summary Kategori Ini"
3. Lihat request ke "/ai-mate/category-summary"
4. Check response:
   - Status 200 = OK
   - Status 500 = Server error
   - Status 402 = Insufficient coins
```

**C. Check Laravel Logs**
```bash
tail -f storage/logs/laravel.log
```

### **5. Common Issues & Solutions**

#### **Issue 1: "Koin tidak cukup"**
```json
{"error": "Koin tidak cukup untuk 2 pertanyaan di kategori ini."}
```
**Solution**: User coins < required coins. Check database atau reset coins.

#### **Issue 2: "OpenAI API Error"**
```json
{"error": "Gagal menghasilkan summary dari AI. Silakan coba lagi nanti."}
```
**Solution**: 
- Check API key validity
- Check internet connection
- Check API rate limits

#### **Issue 3: "Class 'OpenAI' not found"**
```
Class 'OpenAI' not found
```
**Solution**: 
```bash
composer require openai-php/client
```

#### **Issue 4: Modal tidak muncul**
**Solution**: Check JavaScript console untuk errors

### **6. Manual API Testing**

Jika chatbot tidak work, test API secara manual:

```bash
# Test dengan curl
curl -X POST "http://localhost:8000/ai-mate/category-summary" \
  -H "Content-Type: application/json" \
  -H "X-CSRF-TOKEN: your-csrf-token" \
  -d '{
    "categoryId": "bakat_minat",
    "numQuestions": 2,
    "answers": ["Saya suka coding", "Saya suka matematika"]
  }'
```

### **7. Success Indicators**

✅ **Berhasil jika:**
- Modal kategori bisa dibuka/tutup
- Pertanyaan muncul satu per satu
- Input jawaban berfungsi
- Tombol "Lihat Summary" muncul setelah semua pertanyaan dijawab
- **AI response muncul dalam format HTML dengan rekomendasi jurusan**
- Saldo koin berkurang sesuai cost
- Tidak ada error di console/network

### **8. Video Flow Testing**

**Expected Flow:**
```
1. Load page → 2. Click category → 3. Select questions → 
4. Answer questions → 5. Click summary → 6. AI responds
```

**Timing:**
- Step 1-4: Instant
- Step 5: Loading 5-15 seconds  
- Step 6: AI response appears

### **9. Next Steps After Success**

Setelah satu kategori berhasil:
1. Test kategori lain
2. Test "Overall Summary" (butuh minimal 2 kategori)
3. Test dengan jawaban yang berbeda
4. Test edge cases (koin habis, dll)
