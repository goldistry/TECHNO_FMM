<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $majors = Major::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->get();

        return view('infoJurusan', compact('majors'));
    }

    public function show($id)
    {
        $major = Major::findOrFail($id);
        return view('infoJurusan', compact('major'));
    }
}
