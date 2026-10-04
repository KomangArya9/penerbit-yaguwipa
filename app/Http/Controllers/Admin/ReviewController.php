<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review; // Menggunakan model Review
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->get();
        return view('admin.review.index', compact('reviews'));
    }

    public function toggleStatus($id)
    {
        $review = Review::findOrFail($id);
        $review->status = ($review->status == 'Show') ? 'Hide' : 'Show';
        $review->save();

        return redirect()->back()->with('success', 'Status review berhasil diubah!');
    }

    public function updateStatus(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $review->status = $request->status ?? 'Show';
        $review->save();

        return redirect()->back()->with('success', 'Status review berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Review berhasil dihapus!');
    }
}