<?php

namespace App\Http\Controllers;

use App\Services\MailerLiteService;
use Illuminate\Http\Request;
use App\Inquiry;
use App\schedule;
use App\newsletter;
use App\post;
use App\banner;
use App\Models\Poll;
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
use Axlon\MailCheck\MailCheck;

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
        $banner = DB::table('banners')->where('status', 'active')->get();
        $product2 = DB::table('products')->get();
        $blogs = DB::table('blogs')->get();
        $testimonials = DB::table('testimonials')->get();
        $facebook = DB::table('m_flag')->where('id', 2)->first();
        $instagram = DB::table('m_flag')->where('id', 3)->first();
        // dd($product2);

        return view('welcome', compact('banner', 'product2', 'blogs', 'testimonials', 'facebook', 'instagram'));
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
        // $book1 = DB::table('products')->where('id', 10)->first();
        // $book2 = DB::table('products')->where('id', 11)->first();
        // $book3 = DB::table('products')->where('id', 12)->first();
        // $book4 = DB::table('products')->where('id', 13)->first();
        // $book5 = DB::table('products')->where('id', 14)->first();
        // $book6 = DB::table('products')->where('id', 15)->first();
        // // dd($book1);

        // return view('books', compact('book1', 'book2', 'book3', 'book4', 'book5', 'book6'));
        $books = DB::table('products')
            ->orderBy('id', 'asc')
            ->get();


        return view('books', compact('books'));
    }

    public function bonus_scenes()
    {
        return view('bonus-scenes');
    }

    public function secret_santa()
    {
        return view('secret_santa');
    }

    public function new_arrivals()
    {
        return view('new_arrivals');
    }

    public function blog()
    {
        $blogs = DB::table('blogs')->get();
        return view('blog', compact('blogs'));
    }

    public function blogdetail($id)
    {
        $reviews = DB::table('blog_reviews')->where('blog_id', $id)->latest()->get();
        $blog = Blog::findOrFail($id);
        $polls = Poll::where('blog_id', $blog->id)->get();

        $allVotes = json_decode($blog->user_votes, true) ?? [];
        $pollResults = [];

        foreach ($polls as $poll) {
            // JSON options ko safely decode karein
            $options = [];

            if (is_string($poll->options)) {
                $decoded = json_decode($poll->options, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $options = $decoded;
                } else {
                    $options = explode(',', $poll->options);
                }
            } elseif (is_array($poll->options)) {
                $options = $poll->options;
            } else {
                $options = ['Option 1', 'Option 2'];
            }

            $options = array_map('trim', $options);
            $options = array_filter($options);

            $voteCount = array_fill(0, count($options), 0);
            $totalVotes = 0;

            // Loop over each user's votes
            foreach ($allVotes as $userId => $userPolls) {
                // Check if user voted for this poll
                if (isset($userPolls[$poll->id])) {
                    $selectedOptionText = $userPolls[$poll->id];
                    $optionIndex = array_search(trim($selectedOptionText), $options);

                    if ($optionIndex !== false) {
                        $voteCount[$optionIndex]++;
                        $totalVotes++;
                    }
                }
            }

            // Calculate percentages
            $percentages = [];
            foreach ($voteCount as $index => $count) {
                $percent = $totalVotes > 0 ? round(($count / $totalVotes) * 100, 1) : 0;
                $percentages[$index] = $percent;
            }

            $pollResults[$poll->id] = [
                'total' => $totalVotes,
                'percentages' => $percentages
            ];
        }

        return view('blog_detail', compact('blog', 'reviews', 'polls', 'pollResults', 'allVotes'));
    }

    public function inquiry(Request $request, MailerLiteService $mailerLite)
    {
        $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'string|nullable',
            'notes' => 'required|string',
        ]);

        $inquiry = Inquiry::create($request->all());

        try {
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new InquiryReceived($inquiry));
            sleep(3);
            Mail::to($inquiry->email)->send(new ThankYouMail($inquiry));

            $response = $mailerLite->subscribe($request->email, $request->fname . ' ' . $request->lname);

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


    public function newsletterSubmit(Request $request, MailerLiteService $mailerLite)
    {
        $request->validate([
            'newsletter_email' => 'required|email'
        ]);

        $email = $request->newsletter_email;

        // ✅ Real mailbox check
        if (!MailCheck::check($email)->isValid()) {
            return response()->json([
                'message' => 'Please enter a valid and existing email address.',
                'status' => false
            ]);
        }

        // Duplicate check
        if (newsletter::where('newsletter_email', $email)->exists()) {
            return response()->json([
                'message' => 'Email already subscribed.',
                'status' => false
            ]);
        }

        // Save and send mails
        $newsletter = newsletter::create(['newsletter_email' => $email]);

        try {
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new NewsletterSubscribedAdmin($email));
            sleep(5);
            Mail::to($email)->send(new NewsletterConfirmation($email));
        } catch (\Exception $e) {
            \Log::error("Mail failed for {$email}: " . $e->getMessage());
            return response()->json([
                'message' => 'Subscription saved but confirmation email could not be sent.',
                'status' => true
            ]);
        }

        try {
            $mailerLite->subscribe($email);
        } catch (\Exception $e) {
            \Log::error("MailerLite subscribe failed for {$email}: " . $e->getMessage());
        }

        return response()->json([
            'message' => 'Thank you for subscribing! Confirmation email sent.',
            'status' => true
        ]);
    }
}
