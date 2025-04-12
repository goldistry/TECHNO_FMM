<?php
namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    // List kategori yang tersedia (misalnya jurusan)
    private $categories = [
        'Teknik Informatika',
        'Sistem Informasi',
        'Teknik Elektro',
        'Teknik Mesin',
        'Manajemen',
    ];

    public function index(Request $request)
    {
        // Jika parameter filter kategori ada, ambil nilai kategorinya
        $filter = $request->get('category');

        if ($filter && $filter !== 'all') {
            $testimonials = Testimonial::where('category', $filter)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
        }

        return view('testimonials.index', [
            'testimonials' => $testimonials,
            'categories'   => $this->categories,
            'filter'       => $filter,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'name'     => 'required|max:255',
            'message'  => 'required',
            'rating'   => 'required|integer|min:1|max:5',
            'category' => 'required|string',
        ]);

        // Simpan ke database
        Testimonial::create([
            'name'     => $request->name,
            'message'  => $request->message,
            'rating'   => $request->rating,
            'category' => $request->category,
        ]);

        return redirect()->route('testimonials.index')->with('success', 'Testimoni berhasil ditambahkan!');
    }
}
