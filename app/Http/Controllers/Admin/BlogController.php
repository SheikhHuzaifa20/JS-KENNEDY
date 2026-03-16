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
                Mail::to($email)->send(new NewBlogNotification($blog));
                $mailerLite->subscribe($email);
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
        $inquiry = DB::table('blog_reviews')
            ->where('blog_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        // dd($inquiry);

        return view('admin.blog.blog_review', compact('inquiry'));
    }
    public function blog_review($id)
    {
        $inquiry = DB::table('blog_reviews')->where('id', $id)->first();

        return view('admin.blog.review_edit', compact('inquiry'));
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
