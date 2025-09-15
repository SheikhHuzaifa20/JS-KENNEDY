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
use App\Mail\InquiryReceived;
use App\Mail\ThankYouMail;

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
        $blogs = DB::table('blogs')->get();

        return view('welcome', compact('products', 'product2', 'blogs'));
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
        $book1 = DB::table('products')->where('id', 10)->first();
        $book2 = DB::table('products')->where('id', 11)->first();
        $book3 = DB::table('products')->where('id', 11)->first();
        $book4 = DB::table('products')->where('id', 11)->first();
        $book5 = DB::table('products')->where('id', 11)->first();
        $book6 = DB::table('products')->where('id', 11)->first();
        // dd($book1);

        return view('books', compact('book1', 'book2', 'book3', 'book4', 'book5', 'book6'));
    }

    public function bonus_scenes()
    {
        return view('bonus-scenes');
    }

    public function blog()
    {
        $blogs = DB::table('blogs')->get();
        return view('blog', compact('blogs'));
    }

    public function inquiry(Request $request)
    {
        $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'notes' => 'required|string',
        ]);

        // Save data into DB
        $inquiry = Inquiry::create($request->all());

        // Send email to Admin
        // Send email to Admin
        Mail::to('info@jskennedy.com')->send(new InquiryReceived($inquiry));

        // Sleep for 10 seconds (avoid Mailtrap free plan rate limit)
        sleep(10);

        // Send Thank You email to User
        Mail::to($inquiry->email)->send(new ThankYouMail($inquiry));

        return back()->with('success', 'Your inquiry has been submitted successfully!');
    }
}
