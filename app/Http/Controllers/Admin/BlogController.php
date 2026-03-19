<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Blog;
use Illuminate\Http\Request;
use Image;
use File;
use Carbon\Carbon;
use App\newsletter;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewBlogNotification;
use App\Services\MailerLiteService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        $model = str_slug('blog', '-');
        if (auth()->user()->permissions()->where('name', '=', 'view-' . $model)->first() != null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $blog = Blog::where('name', 'LIKE', "%$keyword%")
                    ->orWhere('short_detail', 'LIKE', "%$keyword%")
                    ->orWhere('detail', 'LIKE', "%$keyword%")
                    ->orWhere('image', 'LIKE', "%$keyword%")
                    ->paginate($perPage);
            } else {
                $blog = Blog::paginate($perPage);
            }

            return view('admin.blog.index', compact('blog'));
        }
        return response(view('403'), 403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = str_slug('blog', '-');
        if (auth()->user()->permissions()->where('name', '=', 'add-' . $model)->first() != null) {
            return view('admin.blog.create');
        }
        return response(view('403'), 403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request, MailerLiteService $mailerLite)
    {
        $this->validate($request, [
            'name' => 'required',
            'short_detail' => 'required',
            'detail' => 'required',
            'inner_detail' => 'nullable',
            'event_datetime' => 'required',
            'image' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $blog = new blog;

            $blog->event_datetime = Carbon::parse($request->event_datetime, 'America/Toronto')
                ->setTimezone('America/Toronto');

            $blog->name = $request->input('name');
            $blog->short_detail = $request->input('short_detail');
            $blog->detail = $request->input('detail');
            $blog->inner_detail = $request->input('inner_detail');
            $blog->event_datetime = $request->event_datetime;

            $file = $request->file('image');
            $destination_path = 'uploads/blogs/';
            $fileName = $file->getClientOriginalName();
            $profileImage = date("Ymd") . $fileName . "." . $file->getClientOriginalExtension();
            $file->move(public_path($destination_path), $profileImage);

            $blog->image = $destination_path . $profileImage;
            $blog->save();

            // -------------------------------
            // SEND EMAIL TO ALL NEWSLETTER SUBSCRIBERS
            // -------------------------------
            $subscribers = newsletter::pluck('newsletter_email');

            foreach ($subscribers as $email) {

                // ✅ Email format check
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    Log::warning("Invalid email skipped: " . $email);
                    continue;
                }

                try {
                    // ✅ DEBUG (check loop chal raha hai ya nahi)
                    Log::info("Trying to send mail to: " . $email);

                    Mail::to($email)->send(new NewBlogNotification($blog));

                    // ✅ DEBUG (mail send ho gayi)
                    Log::info("Mail sent successfully to: " . $email);

                    $mailerLite->subscribe($email);
                } catch (\Exception $e) {
                    // ❌ ERROR LOG
                    Log::error("Mail failed for: " . $email . " | Error: " . $e->getMessage());
                }
            }
        }

        return redirect('admin/blog')->with('message', 'Blog added and newsletter sent!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $model = str_slug('blog', '-');
        if (auth()->user()->permissions()->where('name', '=', 'view-' . $model)->first() != null) {
            $blog = Blog::findOrFail($id);
            return view('admin.blog.show', compact('blog'));
        }
        return response(view('403'), 403);
    }

    public function blog_reviewDelete($id)
    {

        $del = DB::table('blog_reviews')->where('id', $id)->delete();

        if ($del) {
            return redirect()->back()->with('flash_message', 'Blog Review deleted!');
        }
    }

    public function blogshow($id)
    {
        $blog = Blog::findOrFail($id);

        // Get all main comments
        $inquiry = DB::table('blog_reviews')
            ->where('blog_id', $id)
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($comment) {
                $comment->has_admin_reply = DB::table('blog_reviews')
                    ->where('parent_id', $comment->id)
                    ->where('name', 'Admin')
                    ->exists();
                return $comment;
            });

        // Get parent comments for reply form (only main comments without admin replies)
        $parentComments = DB::table('blog_reviews')
            ->where('blog_id', $id)
            ->whereNull('parent_id')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('blog_reviews as r2')
                    ->whereRaw('r2.parent_id = blog_reviews.id')
                    ->where('r2.name', 'Admin');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.blog.blog_review', compact('inquiry', 'blog', 'parentComments'));
    }


    public function storeReply(Request $request)
    {
        // Validate the request
        $request->validate([
            'parent_id' => 'required|integer|exists:blog_reviews,id',
            'blog_id' => 'required|integer|exists:blogs,id',
            'message' => 'required|string|max:1000',
        ]);

        try {
            // Get parent comment to get name and email (optional)
            $parentComment = DB::table('blog_reviews')->where('id', $request->parent_id)->first();

            // Insert the reply
            DB::table('blog_reviews')->insert([
                'blog_id' => $request->blog_id,
                'parent_id' => $request->parent_id,
                'name' => auth()->user()->name ?? 'Admin', // Get from logged in user
                'email' => auth()->user()->email ?? 'admin@example.com', // Get from logged in user
                'message' => $request->message,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Redirect back with success message
            return redirect()->route('blog.review.show', $request->blog_id)->with('success', 'Reply posted successfully!');
        } catch (\Exception $e) {
            // If there's an error, redirect back with error message
            return redirect()->back()
                ->with('error', 'Failed to post reply. Please try again.')
                ->withInput();
        }
    }



    public function blog_review($id)
    {
        $inquiry = DB::table('blog_reviews')->where('id', $id)->first();

        // Get all replies for this comment (admin responses)
        $replies = DB::table('blog_reviews')
            ->where('parent_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.blog.review_edit', compact('inquiry', 'replies'));
    }


    public function updateReply(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        try {
            // Get the reply
            $reply = DB::table('blog_reviews')->where('id', $id)->first();

            if (!$reply) {
                return redirect()->back()->with('error', 'Reply not found!');
            }

            // Update the reply
            DB::table('blog_reviews')->where('id', $id)->update([
                'message' => $request->message,
                'updated_at' => now(),
            ]);

            // Get the parent comment's blog_id to redirect back
            $parent = DB::table('blog_reviews')->where('id', $reply->parent_id)->first();

            // Redirect back to the parent comment view
            return redirect()->route('blog.review.view', $reply->parent_id)
                ->with('success', 'Reply updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update reply. Please try again.')
                ->withInput();
        }
    }

    public function blogupdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        DB::table('blog_reviews')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Review updated successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $model = str_slug('blog', '-');
        if (auth()->user()->permissions()->where('name', '=', 'edit-' . $model)->first() != null) {
            $blog = Blog::findOrFail($id);
            return view('admin.blog.edit', compact('blog'));
        }
        return response(view('403'), 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $model = str_slug('blog', '-');

        if (auth()->user()->permissions()->where('name', '=', 'edit-' . $model)->first() != null) {

            // ✅ Validation (no past date allowed)
            $this->validate($request, [
                'name' => 'required',
                'short_detail' => 'required',
                'detail' => 'required',
                'inner_detail' => 'nullable',
                'event_datetime' => 'required',
            ]);

            $requestData = $request->all();

            // ✅ Image upload check
            if ($request->hasFile('image')) {
                $blog = Blog::where('id', $id)->first();

                // delete old image if exists
                $image_path = public_path($blog->image);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                // upload new image
                $file = $request->file('image');
                $fileNameExt = $file->getClientOriginalName();
                $fileNameForm = str_replace(' ', '_', $fileNameExt);
                $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
                $fileExt = $file->getClientOriginalExtension();
                $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;

                $pathToStore = public_path('uploads/blogs/');
                $file->move($pathToStore, $fileNameToStore);

                $requestData['image'] = 'uploads/blogs/' . $fileNameToStore;
            }

            // ✅ Update blog with new data
            $blog = Blog::findOrFail($id);
            $blog->name = $requestData['name'];
            $blog->short_detail = $requestData['short_detail'];
            $blog->detail = $requestData['detail'];
            $blog->inner_detail = $requestData['inner_detail'];
            $blog->event_datetime = $requestData['event_datetime'];

            if (isset($requestData['image'])) {
                $blog->image = $requestData['image'];
            }

            $blog->save();

            return redirect('admin/blog')->with('message', 'Blog updated successfully!');
        }

        return response(view('403'), 403);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $model = str_slug('blog', '-');
        if (auth()->user()->permissions()->where('name', '=', 'delete-' . $model)->first() != null) {
            Blog::destroy($id);

            return redirect('admin/blog')->with('flash_message', 'Blog deleted!');
        }
        return response(view('403'), 403);
    }
}
