<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Blog;
use Illuminate\Http\Request;
use Image;
use File;

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
    public function store(Request $request)
    {
        $model = str_slug('blog', '-');
        if (auth()->user()->permissions()->where('name', '=', 'add-' . $model)->first() != null) {
            $this->validate($request, [
                'name' => 'required',
                'short_detail' => 'required',
                'detail' => 'required',
                'inner_detail' => 'required',
                'image' => 'required'
            ]);

            if ($request->hasFile('image')) {
                $blog = new blog;


                $blog->name = $request->input('name');
                $blog->short_detail = $request->input('short_detail');
                $blog->detail = $request->input('detail');
                $blog->inner_detail = $request->input('inner_detail');
                $file = $request->file('image');

                //make sure yo have image folder inside your public
                $destination_path = 'uploads/blogs/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd") . $fileName . "." . $file->getClientOriginalExtension();


                $file->move(public_path('uploads/blogs/'), $profileImage);

                $blog->image = $destination_path . $profileImage;
                $blog->save();
            }

            return redirect('admin/blog')->with('message', 'Blog added!');
        }
        return response(view('403'), 403);
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
            'rating' => 'required|integer|min:1|max:5',
        ]);

        DB::table('blog_reviews')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'rating' => $request->rating,
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
            $this->validate($request, [
                'name' => 'required',
                'short_detail' => 'required',
                'detail' => 'required',
                'inner_detail' => 'required',
            ]);
            $requestData = $request->all();


            if ($request->hasFile('image')) {

                $blog = blog::where('id', $id)->first();
                $image_path = public_path($blog->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $file = $request->file('image');
                $fileNameExt = $request->file('image')->getClientOriginalName();
                $fileNameForm = str_replace(' ', '_', $fileNameExt);
                $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
                $fileExt = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;
                $pathToStore = public_path('uploads/blogs/');
                $file->move($pathToStore, $fileNameToStore);

                $requestData['image'] = 'uploads/blogs/' . $fileNameToStore;
            }


            $blog = Blog::findOrFail($id);
            $blog->update($requestData);

            return redirect('admin/blog')->with('message', 'Blog updated!');
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
