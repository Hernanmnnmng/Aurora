<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('gebruiker')->latest()->get();
        return view('reviews', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'gebruiker_id' => Auth::id(),
            'content' => $request->content,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with('success', 'Bedankt voor je review!');
    }
}