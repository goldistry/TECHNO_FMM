<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
<<<<<<< HEAD
     public function index(Request $request)
    {
        $search = $request->query('search');
        $category = $request->query('category');

        $majorsQuery = Major::query();

        if ($search) {
            $majorsQuery->where('title', 'like', '%' . $search . '%')
                        ->orWhere('short_desc', 'like', '%' . $search . '%');
        }

        if ($category && $category !== 'all') {
            $majorsQuery->where('category', $category);
        }

        $majors = $majorsQuery->get();

        $categories = Major::select('category')->distinct()->pluck('category')->filter()->values()->toArray();
        array_unshift($categories, 'all');

        return view('majors', compact('majors', 'categories', 'category'));
=======
    public function index(Request $request)
    {
        $search = $request->input('search');
        $majors = Major::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->get();

        return view('infoJurusan', compact('majors'));
>>>>>>> 0a7de8735cd3d3a6bef56ec649323bcd3b01ae43
    }

    public function show($id)
    {
<<<<<<< HEAD
        $major = Major::find($id);

        if (!$major) {
            abort(404);
        }

        // --- PASTIKAN BAGIAN INI ADA DAN BENAR ---
        // Decode JSON string menjadi array PHP
        if (!empty($major->required_skills)) {
            $major->required_skills = json_decode($major->required_skills, true);
        } else {
            $major->required_skills = [];
        }

        if (!empty($major->career_prospects)) {
            $major->career_prospects = json_decode($major->career_prospects, true);
        } else {
            $major->career_prospects = [];
        }
        // --- AKHIR BAGIAN KRUSIAL ---

        return view('major_detail', compact('major'));
=======
        $major = Major::findOrFail($id);
        return view('infoJurusan', compact('major'));
>>>>>>> 0a7de8735cd3d3a6bef56ec649323bcd3b01ae43
    }
}
