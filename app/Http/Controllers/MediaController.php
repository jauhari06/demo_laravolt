<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png|max:5120', 
        ]);

        $path = $request->file('file')->store('uploads', 'public');

        return response()->json([
            'url' => asset('storage/' . $path), 
        ]);
    }
}
