<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\imagetable;
use App\Banner;
use Illuminate\Http\Request;
use Image;
use File;

class BannerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $logo = imagetable::select('img_path')
            ->where('table_name', '=', 'logo')
            ->first();

        $favicon = imagetable::select('img_path')
            ->where('table_name', '=', 'favicon')
            ->first();

        View()->share('logo', $logo);
        View()->share('favicon', $favicon);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        $model = str_slug('banner', '-');
        if (auth()->user()->permissions()->where('name', '=', 'view-' . $model)->first() != null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $banner = Banner::where('title', 'LIKE', "%$keyword%")
                    ->paginate($perPage);
            } else {
                $banner = Banner::paginate($perPage);
            }

            return view('admin.banner.index', compact('banner'));
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
        $model = str_slug('banner', '-');
        if (auth()->user()->permissions()->where('name', '=', 'add-' . $model)->first() != null) {
            return view('admin.banner.create');
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
        $model = str_slug('banner', '-');
        if (auth()->user()->permissions()->where('name', '=', 'add-' . $model)->first() != null) {
            $this->validate($request, [
                'title' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,gif|required|max:10000'
            ]);
            // $requestData = $request->all();
            $banner = new banner;

            $banner->title = $request->input('title');
            $banner->description = $request->input('description');
            $file = $request->file('image');
            $destination_path = 'uploads/banner/';
            $profileImage = date("Ymd") . "." . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/banner/'), $profileImage);
            // Image::make($file)->save(public_path($destination_path) . DIRECTORY_SEPARATOR. $profileImage);
            $banner->image = $destination_path . $profileImage;
            $banner->save();
            return redirect('admin/banner')->with('message', 'Banner added!');
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
        $model = str_slug('banner', '-');
        if (auth()->user()->permissions()->where('name', '=', 'view-' . $model)->first() != null) {
            $banner = Banner::findOrFail($id);
            return view('admin.banner.show', compact('banner'));
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
        $model = str_slug('banner', '-');
        if (auth()->user()->permissions()->where('name', '=', 'edit-' . $model)->first() != null) {
            $banner = Banner::findOrFail($id);


            return view('admin.banner.edit', compact('banner'));
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
        $model = str_slug('banner', '-');

        if (auth()->user()->permissions()->where('name', '=', 'edit-' . $model)->first() != null) {

            // ✅ Validation
            $this->validate($request, [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'link' => 'nullable|url', // optional but must be valid URL if provided
                'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            ]);

            // ✅ Collect form data
            $requestData = [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'link' => $request->input('link'), // can be null
            ];

            // ✅ Handle image upload if provided
            if ($request->hasFile('image')) {
                $banner = Banner::findOrFail($id);

                // Delete old image if it exists
                $oldImagePath = public_path($banner->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }

                // Handle new image upload
                $file = $request->file('image');
                $destinationPath = 'uploads/banner/';
                $fileNameToStore = date("YmdHis") . '.' . $file->getClientOriginalExtension();

                // Move uploaded image (no Intervention Image)
                $file->move(public_path($destinationPath), $fileNameToStore);

                // Store new image path in DB
                $requestData['image'] = $destinationPath . $fileNameToStore;
            }

            // ✅ Update banner record
            Banner::where('id', $id)->update($requestData);

            session()->flash('message', 'Successfully updated the Banner');
            return redirect('admin/banner');
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
        // $model = str_slug('banner','-');
        // if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
        Banner::destroy($id);

        return redirect('admin/banner')->with('flash_message', 'Banner deleted!');
        // }
        // return response(view('403'), 403);

    }
}
