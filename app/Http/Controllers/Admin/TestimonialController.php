<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Testimonial;
use Illuminate\Http\Request;
use Image;
use File;

class TestimonialController extends Controller
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
        $model = str_slug('testimonial', '-');
        if (auth()->user()->permissions()->where('name', '=', 'view-' . $model)->first() != null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $testimonial = Testimonial::where('name', 'LIKE', "%$keyword%")
                    ->orWhere('verified', 'LIKE', "%$keyword%")
                    ->orWhere('comments', 'LIKE', "%$keyword%")
                    ->orWhere('image', 'LIKE', "%$keyword%")
                    ->paginate($perPage);
            } else {
                $testimonial = Testimonial::paginate($perPage);
            }

            return view('admin.testimonial.index', compact('testimonial'));
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
        $model = str_slug('testimonial', '-');
        if (auth()->user()->permissions()->where('name', '=', 'add-' . $model)->first() != null) {
            return view('admin.testimonial.create');
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
        $model = str_slug('testimonial', '-');
        if (auth()->user()->permissions()->where('name', '=', 'add-' . $model)->first() != null) {
            $this->validate($request, [
                'name' => 'required',
                'comments' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $requestData = $request->all();

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileNameExt = $file->getClientOriginalName();
                $fileNameForm = str_replace(' ', '_', $fileNameExt);
                $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
                $fileExt = $file->getClientOriginalExtension();
                $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;

                // Save file to uploads/testimonials
                $pathToStore = public_path('uploads/testimonials/');
                $file->move($pathToStore, $fileNameToStore);

                $requestData['image'] = 'uploads/testimonials/' . $fileNameToStore;
            }

            Testimonial::create($requestData);

            return redirect('admin/testimonial')->with('flash_message', 'Testimonial added!');
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
        $model = str_slug('testimonial', '-');
        if (auth()->user()->permissions()->where('name', '=', 'view-' . $model)->first() != null) {
            $testimonial = Testimonial::findOrFail($id);
            return view('admin.testimonial.show', compact('testimonial'));
        }
        return response(view('403'), 403);
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
        $model = str_slug('testimonial', '-');
        if (auth()->user()->permissions()->where('name', '=', 'edit-' . $model)->first() != null) {
            $testimonial = Testimonial::findOrFail($id);
            return view('admin.testimonial.edit', compact('testimonial'));
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
        $model = str_slug('testimonial', '-');
        if (auth()->user()->permissions()->where('name', '=', 'edit-' . $model)->first() != null) {
            $this->validate($request, [
                'name' => 'required',
                'comments' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $testimonial = Testimonial::findOrFail($id);
            $requestData = $request->all();

            if ($request->hasFile('image')) {
                // Delete old image
                $image_path = public_path($testimonial->image);
                if ($testimonial->image && File::exists($image_path)) {
                    File::delete($image_path);
                }

                // Upload new image
                $file = $request->file('image');
                $fileNameExt = $file->getClientOriginalName();
                $fileNameForm = str_replace(' ', '_', $fileNameExt);
                $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
                $fileExt = $file->getClientOriginalExtension();
                $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;

                $pathToStore = public_path('uploads/testimonials/');
                $file->move($pathToStore, $fileNameToStore);

                $requestData['image'] = 'uploads/testimonials/' . $fileNameToStore;
            }

            $testimonial->update($requestData);

            return redirect('admin/testimonial')->with('flash_message', 'Testimonial updated!');
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
        $model = str_slug('testimonial', '-');
        if (auth()->user()->permissions()->where('name', '=', 'delete-' . $model)->first() != null) {
            Testimonial::destroy($id);

            return redirect('admin/testimonial')->with('flash_message', 'Testimonial deleted!');
        }
        return response(view('403'), 403);
    }
}
