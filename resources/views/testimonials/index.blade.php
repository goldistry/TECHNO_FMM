<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Testimoni</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS (untuk ikon bintang) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        /* Avatar circle dengan inisial */
        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ccc;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 10px;
        }

        .testimonial-item {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .testimonial-content {
            flex: 1;
        }

        .testimonial-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .testimonial-header .name {
            font-weight: 600;
        }

        .testimonial-header .time-ago {
            font-size: 0.875rem;
            color: #888;
        }

        .stars {
            color: #f0ad4e; /* Warna bintang kuning/oranye */
        }

        .testimonial-message {
            font-size: 0.95rem;
            color: #555;
        }

        /* Styling bintang */
        .rating i {
            font-size: 24px;
            color: #ccc; /* Warna bintang kosong */
            cursor: pointer;
            margin-right: 5px;
        }

        .rating i.selected {
            color: #f0ad4e; /* Warna bintang terisi */
        }

        .rating i:hover {
            color: #f0ad4e; /* Warna bintang saat hover */
        }

        /* Modal Styling */
        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Warna background cream */
        body {
            background-color: #f9f6f0; /* Cream color for the background */
            color: #333; /* Dark color for text to make it legible */
        }

        .container {
            background-color: #fff; /* White background for the container */
            padding: 20px;
            border-radius: 8px; /* Rounded corners for comfort */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow for a modern feel */
        }
    </style>
</head>
<body>
<div class="container my-4">
    <h1 class="mb-4">Daftar Testimoni</h1>

    <!-- Tampilkan pesan sukses -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filter (Dropdown) - contoh: Kategori Jurusan -->
    <div class="filter-area mb-4">
        <!-- Filter Jurusan -->
        <form action="{{ route('testimonials.index') }}" method="GET">
            <div class="d-flex align-items-center">
                <label class="me-2">Jurusan:</label>
                <select name="category" class="form-select" style="width: 200px;" onchange="this.form.submit()">
                    <option value="all" {{ (isset($filter) && $filter == 'all') ? 'selected' : '' }}>All categories</option>
                    @if(isset($categories))
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ (isset($filter) && $filter === $cat) ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </form>
    </div>

    <!-- Tombol untuk menampilkan modal tambah testimoni -->
    <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addTestimonialModal">
        Tambah Testimoni
    </button>

    <!-- Daftar Testimoni -->
    @forelse($testimonials as $testimonial)
        <div class="testimonial-item">
            <!-- Avatar circle (pakai inisial nama) -->
            <div class="avatar-circle">
                {{ strtoupper(substr($testimonial->name, 0, 1)) }}
            </div>
            <div class="testimonial-content">
                <div class="testimonial-header">
                    <span class="name">{{ $testimonial->name }}</span>
                    <span class="time-ago">
                        {{ $testimonial->created_at->diffForHumans() }}
                    </span>
                </div>
                <!-- Rating Bintang -->
                <div class="stars">
                    @php
                        $filledStars = $testimonial->rating;      // bintang terisi
                        $emptyStars = 5 - $testimonial->rating;   // bintang kosong
                    @endphp
                    @for($i = 1; $i <= $filledStars; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                    @for($i = 1; $i <= $emptyStars; $i++)
                        <i class="far fa-star"></i>
                    @endfor
                </div>
                <!-- Pesan -->
                <div class="testimonial-message mt-2">
                    {{ $testimonial->message }}
                </div>
                <!-- Tampilkan kategori/jurusan jika diperlukan -->
                <small class="text-muted">Kategori: {{ $testimonial->category }}</small>
            </div>
        </div>
    @empty
        <p>Belum ada testimoni.</p>
    @endforelse
</div>

<!-- Modal Tambah Testimoni -->
<div class="modal fade" id="addTestimonialModal" tabindex="-1" aria-labelledby="addTestimonialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('testimonials.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addTestimonialModalLabel">Tambah Testimoni</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Input Nama -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <!-- Input Pesan / Testimoni -->
                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan</label>
                        <textarea name="message" id="message" class="form-control" rows="3" required></textarea>
                    </div>

                    <!-- Input Rating (Bintang) -->
                    <div class="mb-3">
                        <label class="form-label">Rating (1-5)</label>
                        <div class="rating" id="rating">
                            <i class="fa fa-star-o" data-index="1">★</i>
                            <i class="fa fa-star-o" data-index="2">★</i>
                            <i class="fa fa-star-o" data-index="3">★</i>
                            <i class="fa fa-star-o" data-index="4">★</i>
                            <i class="fa fa-star-o" data-index="5">★</i>
                        </div>
                        <input type="hidden" name="rating" id="rating-value" value="0" required>
                    </div>

                    <!-- Input Kategori (Jurusan) -->
                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori (Jurusan)</label>
                        <select name="category" id="category" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Jurusan --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('#rating i'); // Menargetkan bintang dalam modal
        const ratingValueInput = document.getElementById('rating-value');
        
        // Fungsi untuk mengupdate bintang yang dipilih
        function updateRating(index) {
            // Reset semua bintang ke kondisi kosong
            stars.forEach(star => star.classList.remove('selected'));
            
            // Pilih bintang hingga index yang dipilih
            for (let i = 0; i < index; i++) {
                stars[i].classList.add('selected');
            }
            
            // Set nilai rating di hidden input
            ratingValueInput.value = index;
        }

        // Event listener untuk bintang
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const index = parseInt(star.getAttribute('data-index'));
                updateRating(index);
            });
        });

        // Optionally, jika mouse hover ingin memberi preview rating
        stars.forEach(star => {
            star.addEventListener('mouseover', function() {
                const index = parseInt(star.getAttribute('data-index'));
                updateRating(index);
            });

            star.addEventListener('mouseout', function() {
                // Mengembalikan ke rating yang sudah dipilih
                updateRating(ratingValueInput.value);
            });
        });
    });
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
