<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\inquiry;
use App\schedule;
use App\newsletter;
use App\post;
use App\banner;
use App\imagetable;
use DB;
use View;
use Session;
use App\Http\Helpers\UserSystemInfoHelper;
use App\Http\Traits\HelperTrait;
use Auth;
use App\Profile;
use App\Page;
use Image;
use App\Mail\NewsletterConfirmation;
use Illuminate\Support\Facades\Mail;


class HomeController extends Controller
{
    use HelperTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // use Helper;

    public function __construct()
    {
        //$this->middleware('auth');

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('product_imagess')
            ->where('id', '!=', 16)   // id 12 ko exclude kar diya
            ->limit(5)                // sirf 5 products laiye
            ->get();
        // dd($products);

        $product2 = DB::table('products')->get();
        return view('welcome', compact('products' , 'product2'));
    }

    public function release_schedule()
    {
        $products = DB::table('products')->get();
        return view('release-schedule', compact('products'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function books()
    {
        return view('books');
    }

    public function bonus_scenes()
    {
        return view('bonus-scenes');
    }

    public function blog()
    {
        return view('blog');
    }
}
