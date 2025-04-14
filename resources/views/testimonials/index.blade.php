@extends('layout')

@section('title', 'Daftar Testimoni')

@section('head')
    <!-- Ensure Bootstrap CSS is loaded in the head section -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Global font family and color changes */
        :root {
            --beige: #F5F2EA;           /* Kalau masih dipakai di tempat lain */
            --light-beige: #F5F2EA;     /* Gantilah ini ke warna yang diambil dari gambar */
            --blue: #0066ff;           /* Contoh variable lain */
            --blue-dark: #0056c9;      /* Contoh variable lain */
            --green: #28a745;          /* Contoh variable lain */
            --primary: #ff5722;        /* Contoh variable lain */
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--light-beige);
            color: #000;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: #000;
        }

        .avatar-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--green);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 20px;
        }

        .testimonial-item {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
            border-radius: 8px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            color: #000;
        }

        .testimonial-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .testimonial-content {
            flex: 1;
        }

        .testimonial-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .testimonial-header .name {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .testimonial-header .time-ago {
            font-size: 0.875rem;
            color: #888;
        }

        .stars {
            color: #f0ad4e;
        }

        .rating i {
            font-size: 24px;
            color: #ccc;
            cursor: pointer;
            margin-right: 5px;
        }

        .rating i.selected {
            color: #f0ad4e;
        }

        .rating i:hover {
            color: #f0ad4e;
        }

        .modal-body {
            padding: 25px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Category Styling (ensure the category text is black and bold) */
        .testimonial-item small.text-muted {
            font-size: 1.1rem;
            font-weight: bold;
            color: #000; /* Ensure the category text is visible */
        }

        .filter-area {
            margin-bottom: 30px;
            padding: 15px;
            border-radius: 8px;
            background-color: var(--light-beige);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Button Styling for Add Testimonial */
        .btn-primary {
            background-color: #0066ff;
            border-color: #0066ff;
        }

        .btn-primary:hover {
            background-color: #0056c9;
            border-color: #0056c9;
        }
           /* Global styles agar konsisten dengan homepage */
           body {
            font-family: 'Arial', sans-serif;
            background-color: var(--light-beige);
            color: #000;
        }
        /* Container utama dengan padding dan margin yang konsisten */
        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        .hero-heading {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--blue);
        }
        /* Area Filter */
        .filter-area {
            background-color: #fff;
            padding: 1.25rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }
        /* Kartu testimoni, mengikuti style card homepage */
        .testimonial-item {
            background-color: #fff;
            border-radius: 1.5rem;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 2rem;
        }
        .testimonial-item:hover {
            transform: scale(1.03);
        }
        /* Avatar lingkaran untuk inisial */
        .avatar-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--green);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 1.25rem;
            flex-shrink: 0;
        }
        /* Tombol, agar sesuai dengan tombol di homepage */
        .btn-primary {
            background-color: var(--blue);
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s ease;
            border: none;
        }
        .btn-primary:hover {
            background-color: var(--blue-dark);
        }
    </style>
@endsection

@section('content')
<div class="container-custom">
<h1 class="mb-8 text-center hero-heading">
    Daftar <span class="text-[var(--primary)]">Testimoni</span>
</h1>

    <!-- Show success message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filter section (Dropdown) -->
    <div class="filter-area">
        <form action="{{ route('testimonials.index') }}" method="GET">
            <div class="d-flex align-items-center">
                <label class="me-2">Jurusan:</label>
                <select name="category" class="form-select" style="width: 200px;" onchange="this.form.submit()">
                    <option value="all" {{ isset($filter) && $filter == 'all' ? 'selected' : '' }}>All categories
                    </option>
                    @if (isset($categories))
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}"
                                {{ isset($filter) && $filter === $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </form>
    </div>

    <!-- Add Testimonial Button -->
    <div class="text-center my-6">
        <button class="btn-primary" data-bs-toggle="modal" data-bs-target="#addTestimonialModal">
            Tambah Testimoni
        </button>
    </div>

    <!-- Testimonial List -->
    <div>
        @forelse($testimonials as $testimonial)
            <div class="testimonial-item flex items-start">
                <!-- Avatar dengan inisial nama -->
                <div class="avatar-circle">
                    {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                </div>
                <div class="flex-1">
                    <div class="flex justify-between items-center mb-1">
                        <span class="font-semibold text-lg">{{ $testimonial->name }}</span>
                        <span class="text-sm text-gray-500">{{ $testimonial->created_at->diffForHumans() }}</span>
                    </div>
                    <!-- Star Rating -->
                    <div class="mb-2">
                        @php
                            $filledStars = $testimonial->rating;
                            $emptyStars = 5 - $testimonial->rating;
                        @endphp
                        @for ($i = 1; $i <= $filledStars; $i++)
                            <i class="fas fa-star text-[var(--primary)]"></i>
                        @endfor
                        @for ($i = 1; $i <= $emptyStars; $i++)
                            <i class="far fa-star text-gray-300"></i>
                        @endfor
                    </div>
                    <!-- Pesan Testimoni -->
                    <p class="mb-2 text-gray-800">
                        {{ $testimonial->message }}
                    </p>
                    <!-- Kategori/Jurusan -->
                    <small class="font-bold text-gray-700">
                        Kategori: {{ $testimonial->category }}
                    </small>
                </div>
            </div>
        @empty
            <p class="text-center">Belum ada testimoni.</p>
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
    <!-- Modal for Adding Testimonial -->
    <div class="modal fade" id="addTestimonialModal" tabindex="-1" aria-labelledby="addTestimonialModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('testimonials.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTestimonialModalLabel">Tambah Testimoni</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Name Input -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <!-- Message Input -->
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea name="message" id="message" class="form-control" rows="3" required></textarea>
                        </div>

                        <!-- Rating Input -->
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

                        <!-- Category Selection -->
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

    <!-- Script for Rating Star -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('#rating i');
            const ratingValueInput = document.getElementById('rating-value');

            // Update star selection
            function updateRating(index) {
                stars.forEach(star => star.classList.remove('selected'));

                for (let i = 0; i < index; i++) {
                    stars[i].classList.add('selected');
                }

                ratingValueInput.value = index;
            }

            stars.forEach(star => {
                star.addEventListener('click', function () {
                    const index = parseInt(star.getAttribute('data-index'));
                    updateRating(index);
                });
            });

            stars.forEach(star => {
                star.addEventListener('mouseover', function () {
                    const index = parseInt(star.getAttribute('data-index'));
                    updateRating(index);
                });

                star.addEventListener('mouseout', function () {
                    updateRating(ratingValueInput.value);
                });
            });
        });
    </script>
@endsection
