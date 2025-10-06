<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\orders;
use App\orders_products;
use App\Product;
use App\imagetable;
use App\Attributes;
use App\AttributeValue;
use App\ProductAttribute;
use Illuminate\Http\Request;
use Image;
use File;
use DB;
use Session;

class ProductController extends Controller
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

        $model = str_slug('product', '-');
        if (auth()->user()->permissions()->where('name', '=', 'view-' . $model)->first() != null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $product = Product::where('products.product_title', 'LIKE', "%$keyword%")
                    ->leftjoin('categories', 'products.category', '=', 'categories.id')
                    ->orWhere('products.description', 'LIKE', "%$keyword%")
                    ->paginate($perPage);
            } else {
                $product = Product::paginate($perPage);
            }

            return view('admin.book.index', compact('product'));
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

        $model = str_slug('product', '-');
        if (auth()->user()->permissions()->where('name', '=', 'add-' . $model)->first() != null) {

            $att = Attributes::all();
            $attval = AttributeValue::all();

            // $items = Category::all(['id', 'name']);
            $items = Category::pluck('name', 'id');
            // dd($items);

            return view('admin.book.create', compact('items', 'att', 'attval'));
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
        $model = str_slug('product', '-');
        if (auth()->user()->permissions()->where('name', '=', 'add-' . $model)->first() != null) {
            $this->validate($request, [
                'product_title' => 'required',
                'description' => 'required',
                'banner_content' => 'required',
                'price' => 'required',
                'image' => 'required',
            ]);

            //echo implode(",",$_POST['language']);
            //return;
            $product = new product;

            $product->product_title = $request->input('product_title');
            $product->price = $request->input('price');
            $product->description = $request->input('description');
            $product->banner_content = $request->input('banner_content');
            $product->category = $request->input('category');
            // $product->subcategory = $request->input('subcategory');
            // $product->colors = $request->input('colors');
            // $product->type = 'product';
            $file = $request->file('image');

            //make sure yo have image folder inside your public
            $destination_path = 'uploads/products/';
            $profileImage = date("Ymdhis") . "." . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/products/'), $profileImage);
            // Image::make($file)->save(public_path($destination_path) . DIRECTORY_SEPARATOR. $profileImage);

            $product->image = $destination_path . $profileImage;
            $product->save();


            if (! is_null(request('images'))) {

                $photos = request()->file('images');
                foreach ($photos as $photo) {
                    $destinationPath = 'uploads/products/';

                    $filename = date("Ymdhis") . uniqid() . "." . $photo->getClientOriginalExtension();
                    //dd($photo,$filename);
                    $photo->move(public_path('uploads/products/'), $filename);
                    // Image::make($photo)->save(public_path($destinationPath) . DIRECTORY_SEPARATOR. $filename);

                    DB::table('product_imagess')->insert([

                        ['image' => $destination_path . $filename, 'product_id' => $product->id]

                    ]);
                }
            }
            //$photos->save();
            //$requestData = $request->all();
            //Product::create($requestData);

            $attval = $request->attribute;

            if (is_array($attva)) {
                for ($i = 0; $i < count($attval); $i++) {
                    $product_attributes = new ProductAttribute;
                    $product_attributes->attribute_id = $attval[$i]['attribute_id'];
                    $product_attributes->value = $attval[$i]['value'];
                    $product_attributes->price = $attval[$i]['v-price'];
                    $product_attributes->qty = $attval[$i]['qty'];
                    $product_attributes->product_id = $product->id;

                    $product_attributes->save();
                }
            }





            return redirect('admin/book')->with('message', 'Product added!');
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
        $model = str_slug('product', '-');
        if (auth()->user()->permissions()->where('name', '=', 'view-' . $model)->first() != null) {
            $product = Product::findOrFail($id);
            return view('admin.book.show', compact('product'));
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



        $model = str_slug('product', '-');
        if (auth()->user()->permissions()->where('name', '=', 'edit-' . $model)->first() != null) {

            $att = Attributes::all();
            $product = Product::findOrFail($id);

            $items = Category::pluck('name', 'id');

            $product_images = DB::table('product_imagess')
                ->where('product_id', $id)
                ->get();



            return view('admin.book.edit', compact('product', 'items', 'product_images', 'att'));
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
        $model = str_slug('product', '-');
        if (auth()->user()->permissions()->where('name', '=', 'edit-' . $model)->first() != null) {
            $this->validate($request, [
                'product_title' => 'required',
                'description'   => 'required',
                'banner_content'   => 'required',
                'price'         => 'required',
                'link'         => 'required',
            ]);

            $product = Product::findOrFail($id);

            $product->product_title = $request->input('product_title');
            $product->price         = $request->input('price');
            $product->link         = $request->input('link');
            $product->description   = $request->input('description');
            $product->banner_content   = $request->input('banner_content');
            $product->category      = $request->input('category');

            // === update main image ===
            if ($request->hasFile('image')) {
                // purani image delete
                if ($product->image && File::exists(public_path($product->image))) {
                    File::delete(public_path($product->image));
                }

                $file = $request->file('image');
                $destination_path = 'uploads/products/';
                $profileImage = date("Ymdhis") . "." . $file->getClientOriginalExtension();
                $file->move(public_path($destination_path), $profileImage);

                $product->image = $destination_path . $profileImage;
            }

            $product->save();

            // === additional images (new add karne ke liye) ===
            if ($request->hasFile('images')) {
                $photos = $request->file('images');
                foreach ($photos as $photo) {
                    $destinationPath = 'uploads/products/';
                    $filename = date("Ymdhis") . uniqid() . "." . $photo->getClientOriginalExtension();
                    $photo->move(public_path($destinationPath), $filename);

                    DB::table('product_imagess')->insert([
                        'image'      => $destinationPath . $filename,
                        'product_id' => $product->id,
                    ]);
                }
            }

            return redirect('admin/book')->with('message', 'Product updated!');
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
        $model = str_slug('product', '-');
        if (auth()->user()->permissions()->where('name', '=', 'delete-' . $model)->first() != null) {
            Product::destroy($id);

            return redirect('admin/book')->with('flash_message', 'Product deleted!');
        }
        return response(view('403'), 403);
    }
    public function orderList()
    {

        $orders = orders::select('orders.*')
            ->get();

        return view('admin.ecommerce.order-list', compact('orders'));
    }

    public function orderListDetail($id)
    {

        $order_id = $id;
        $order = orders::where('id', $order_id)->first();
        $order_products = orders_products::where('orders_id', $order_id)->get();



        return view('admin.ecommerce.order-page')->with('title', 'Invoice #' . $order_id)->with(compact('order', 'order_products'))->with('order_id', $order_id);

        // return view('admin.ecommerce.order-page');	
    }

    public function updatestatuscompleted($id)
    {

        $order_id = $id;
        $order = DB::table('orders')
            ->where('id', $id)
            ->update(['order_status' => 'Completed']);


        Session::flash('message', 'Order Status Updated Successfully');
        Session::flash('alert-class', 'alert-success');
        return back();
    }
    public function updatestatusPending($id)
    {

        $order_id = $id;
        $order = DB::table('orders')
            ->where('id', $id)
            ->update(['order_status' => 'Pending']);


        Session::flash('message', 'Order Status Updated Successfully');
        Session::flash('alert-class', 'alert-success');
        return back();
    }
}
