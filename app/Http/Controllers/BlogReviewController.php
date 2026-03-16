<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Blog;

class BlogReviewController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        DB::table('blog_reviews')->insert([
            'blog_id' => $id,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Your review has been posted successfully!');
    }

    public function reply(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'message' => 'required|string',
            'parent_id' => 'required|integer|exists:blog_reviews,id',
            'blog_id' => 'required|integer|exists:blogs,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', implode('; ', $validator->errors()->all()))
                ->withInput();
        }

        // Get user data from authenticated user
        $user = auth()->user();
        if (!$user) {
            return redirect()->back()
                ->with('error', 'You must be logged in to reply.')
                ->withInput();
        }

        DB::table('blog_reviews')->insert([
            'blog_id' => (int)$request->blog_id,
            'parent_id' => (int)$request->parent_id,
            'name' => $user->name ?? 'Anonymous',
            'email' => $user->email ?? 'anonymous@example.com',
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Reply posted successfully!');
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        $reviews = DB::table('blog_reviews')
            ->where('blog_id', $id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($review) {
                $review->created_at = Carbon::parse($review->created_at);
                return $review;
            });

        return view('blog_detail', compact('blog', 'reviews'));
    }
}