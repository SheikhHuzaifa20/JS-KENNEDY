<?php

namespace App\Http\Controllers;

use App\Inquiry;
use App\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class QuotationController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate inputs (reCAPTCHA included)
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name'  => 'required|string|max:255',
                'email'      => 'required|email',
                'type'       => 'required',
                'phone'      => 'required',
                // Agar neeche wala form me captcha nahi chahiye to ye hata do:
                // 'g-recaptcha-response' => 'required|captcha',
            ]);

            // Save quotation
            $quotation = Quotation::create($validated);

            $quotation->is_self = $request->boolean('is_self') ? 'Yes' : 'No';
            $quotation->is_spouse = $request->boolean('is_spouse') ? 'Yes' : 'No';
            $quotation->is_children = $request->boolean('is_children') ? 'Yes' : 'No';
            $quotation->marital_status = $request->get('marital_status');
            $quotation->children = $request->get('children');
            $quotation->save();

            // Send mail
            $html = '';
            $html .= "First name: " . $quotation->first_name . "<br>";
            $html .= "Last name: " . $quotation->last_name . "<br>";
            $html .= "Email: " . $quotation->email . "<br>";
            $html .= "Phone: " . $quotation->phone . "<br>";
            $html .= "Insurance type: " . $quotation->insurance_type . "<br>";
            $html .= "Time to call: " . $quotation->time_to_call . "<br>";
            $html .= "Type: " . $quotation->type . "<br>";
            $html .= "Household size: " . $quotation->household_size . "<br>";
            $html .= "Household income: " . $quotation->household_income . "<br>";
            $html .= "Gender: " . $quotation->gender . "<br>";
            $html .= "Date of birth: " . $quotation->dob . "<br>";
            $html .= "Address: " . $quotation->address . "<br>";
            $html .= "Marital status: " . $quotation->marital_status . "<br>";
            $html .= "For self: " . $quotation->is_self . "<br>";
            $html .= "For spouse: " . $quotation->is_spouse . "<br>";
            $html .= "For children: " . $quotation->is_children . "<br>";
            $html .= "Children: " . $quotation->children . "<br>";

            Mail::html($html, function ($message) {
                $message->to('info@engagehealthinsurance.org')
                    ->from('no-reply@yourdomain.com', 'Engage Health Insurance') // ✅ From add karo
                    ->subject('Engage | Get a Quote');
            });

            return redirect()->back()->with('success', 'Your request for quotation has been submitted!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }



    public function inquiryStore(Request $request)
    {
        $inquiry = Inquiry::create($request->all());

        // 🚫 Mailinator check
        if (str_contains(strtolower($inquiry->email), '@mailinator.com')) {
            return redirect()->back()->with('error', 'Mailinator emails are not allowed.');
        }

        $html = '';
        $html .= "First name: " . $inquiry->fname . "<br>";
        $html .= "Last name: " . $inquiry->lname . "<br>";
        $html .= "Email: " . $inquiry->email . "<br>";
        $html .= "Notes: " . $inquiry->notes . "<br>";
        $html .= "Phone: " . $inquiry->phone . "<br>";
        $html .= "Address: " . $inquiry->address . "<br>";
        $html .= "City: " . $inquiry->city . "<br>";
        $html .= "Zipcode: " . $inquiry->zipcode . "<br>";
        $html .= "Type of insurance: " . $inquiry->type_of_insurance . "<br>";
        $html .= "Suite: " . $inquiry->suite . "<br>";

        // ✅ Checkbox ka data sirf tab add hoga jab tick kiya ho
        if ($request->has('subscribe_updates')) {
            $html .= "Wants Updates/Emails: Yes<br>";
        }

        Mail::html($html, function ($message) use ($inquiry) {
            $message->to('info@engagehealthinsurance.org')
                ->subject('Engage | Contact inquiry')
                ->from('no-reply@engagehealthinsurance.org', 'Engage Website')
                ->replyTo($inquiry->email, $inquiry->fname ?? 'Website User');
        });

        return redirect()->back()->with('success', 'Your contact inquiry has been submitted to administration!');
    }
}
