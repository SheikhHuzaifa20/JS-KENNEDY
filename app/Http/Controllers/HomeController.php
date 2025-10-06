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
use App\Blog;
use Image;
use App\Mail\NewsletterConfirmation;
use Illuminate\Support\Facades\Mail;
use App\Mail\InquiryReceived;
use App\Mail\ThankYouMail;
use App\Mail\NewsletterSubscribed;
use App\Mail\NewsletterSubscribedAdmin;

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
        $testimonials = DB::table('testimonials')->get();
        $facebook = DB::table('m_flag')->where('id', 2)->first();
        $instagram = DB::table('m_flag')->where('id', 3)->first();
        // dd($testimonials);

        return view('welcome', compact('products', 'product2', 'blogs', 'testimonials', 'facebook', 'instagram'));
    }

    public function release_schedule()
    {
        return view('release-schedule');
    }

    public function contact()
    {
        return view('contact');
    }

    public function books()
    {
        $book1 = DB::table('products')->where('id', 10)->first();
        $book2 = DB::table('products')->where('id', 11)->first();
        $book3 = DB::table('products')->where('id', 12)->first();
        $book4 = DB::table('products')->where('id', 13)->first();
        $book5 = DB::table('products')->where('id', 14)->first();
        $book6 = DB::table('products')->where('id', 15)->first();
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

    public function blogdetail($id)
    {
        $blog = blog::findOrFail($id);

        return view('blog_detail', compact('blog'));
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

        $inquiry = Inquiry::create($request->all());

        try {
            Mail::to('mikehuckabee42@gmail.com')->send(new InquiryReceived($inquiry));
            sleep(3);
            Mail::to($inquiry->email)->send(new ThankYouMail($inquiry));

            return response()->json([
                'status' => 'success',
                'message' => 'Your inquiry has been submitted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }



    // public function inquiry(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'fname' => 'required|string',
    //             'lname' => 'required|string',
    //             'email' => 'required|email',
    //             'phone' => 'required|string',
    //             'notes' => 'required|string',
    //         ]);

    //         $inquiry = Inquiry::create($request->all());

    //         Mail::to('mikehuckabee42@gmail.com')->send(new InquiryReceived($inquiry));
    //         sleep(3);
    //         Mail::to($inquiry->email)->send(new ThankYouMail($inquiry));

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Your inquiry has been submitted successfully!'
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Something went wrong: ' . $e->getMessage()
    //         ]);
    //     }
    // }


    public function newsletterSubmit(Request $request)
    {
        $request->validate([
            'newsletter_email' => 'required|email'
        ]);

        $is_email = newsletter::where('newsletter_email', $request->newsletter_email)->count();

        if ($is_email == 0) {
            $inquiry = new newsletter;
            $inquiry->newsletter_email = $request->newsletter_email;
            $inquiry->save();


            Mail::to('mikehuckabee42@gmail.com')->send(new NewsletterSubscribedAdmin($request->newsletter_email));
            sleep(10);
            Mail::to($request->newsletter_email)->send(new NewsletterConfirmation($request->newsletter_email));



            return response()->json([
                'message' => 'Thank you for subscribing. A confirmation email has been sent!',
                'status' => true
            ]);
        } else {
            return response()->json([
                'message' => 'Email already exists',
                'status' => false
            ]);
        }
    }
}
