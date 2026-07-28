<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class PublicReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'starts' => 'required|integer|between:1,5',
            'review' => 'required|string',
        ]);

        Review::create([
            'nama' => $request->nama,
            'review' => $request->review,
            'starts' => $request->starts,
            'pekerjaan' => $request->pekerjaan ?? '-',
            'status' => 'Pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih! Review Anda berhasil dikirim dan menunggu persetujuan admin.'
        ]);
    }
}