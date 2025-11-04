<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Poll;
use App\Blog;

class PollController extends Controller
{
    public function index()
    {
        $polls = DB::table('polls')->get();
        // dd($blogs);
        return view('admin.poll.index', compact('polls'));
    }
    public function create()
    {
        $blogs = DB::table('blogs')->get();
        // dd($blogs);
        return view('admin.poll.create', compact('blogs'));
    }
    public function edit($id)
    {
        $poll = Poll::findOrFail($id);
        $blogs = Blog::all(); // Ya jo bhi aap ka blog query hai

        // JSON options ko decode karke pass karein
        $poll->options = json_decode($poll->options);

        return view('admin.poll.edit', compact('poll', 'blogs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'blog_id' => 'required|array|min:1',
            'blog_id.*' => 'exists:blogs,id',
            'question' => 'required|string|max:255',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
        ]);

        $poll = Poll::findOrFail($id);
        // dd(implode(',', $request->blog_id));

        $poll->update([
            'blog_id' => implode(',', $request->blog_id), // Ya multiple handle karein
            'question' => $request->question,
            'options' => json_encode($request->options),
        ]);

        return redirect()->back()->with('message', 'Poll updated successfully!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|array|min:1',
            'blog_id.*' => 'exists:blogs,id',
            'question' => 'required|string|max:255',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
        ]);

        // dd(implode(',', $request->blog_id));
        Poll::create([
            'blog_id' => implode(',', $request->blog_id), // "1,2,3"
            'question' => $request->question,
            'options' => json_encode($request->options, JSON_UNESCAPED_UNICODE),
        ]);

        return redirect()->back()->with('message', 'Poll created successfully!');
    }




    public function vote(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Please login to vote!'], 403);
        }

        $request->validate([
            'poll_id' => 'required|exists:polls,id',
            'blog_id' => 'required|exists:blogs,id',
            'vote' => 'required|string'
        ]);

        $blog = Blog::find($request->blog_id);

        // Safely decode existing votes
        $votes = [];
        if (!empty($blog->user_votes)) {
            if (is_string($blog->user_votes)) {
                $decoded = json_decode($blog->user_votes, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $votes = $decoded;
                } else {
                    $unserialized = unserialize($blog->user_votes);
                    if ($unserialized !== false) {
                        $votes = $unserialized;
                    }
                }
            } elseif (is_array($blog->user_votes)) {
                $votes = $blog->user_votes;
            }
        }

        $userId = auth()->id();

        // Initialize user votes if not set
        if (!isset($votes[$userId])) {
            $votes[$userId] = [];
        }

        // Store user's vote for this poll
        $votes[$userId][$request->poll_id] = trim($request->vote);

        // Encode back to JSON
        $blog->user_votes = json_encode($votes);
        $blog->save();

        return redirect()->back()->with(['message' => 'Your vote has been recorded successfully!']);
    }

    public function destroy($id)
    {
        Poll::destroy($id);

        return redirect('admin/poll')->with('flash_message', 'Product deleted!');
    }
}
