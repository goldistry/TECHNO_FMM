<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
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
    }

    public function show($id)
    {
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
    }
}
