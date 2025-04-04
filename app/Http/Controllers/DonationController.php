<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Donation;
use App\Mail\DonationReceipt;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Gateway;

class DonationController extends Controller
{
    public function processDonation(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'amount' => 'required|numeric|min:1',
        ]);

        // Store user input in session
        $request->session()->put('donation_name', $request->name);
        $request->session()->put('donation_email', $request->email);
        $request->session()->put('donation_phone', $request->phone);

        $gateway = Gateway::automatic()->with('currencies')->where('alias', 'Stripe')->firstOrFail();
        $parameters = collect(json_decode($gateway->parameters));
        $secret_key = $parameters->get('secret_key')->value ?? env('STRIPE_SECRET');

        Stripe::setApiKey($secret_key);

        try {
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => ['name' => 'Donation'],
                            'unit_amount' => $request->amount * 100,
                        ],
                        'quantity' => 1,
                    ]
                ],
                'mode' => 'payment',
                'success_url' => url('success-donation') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('donate.cancel'),
            ]);

            return redirect($session->url);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function success(Request $request)
    {
        if (!$request->has('session_id')) {
            $notify[] = ['error', 'Invalid or expired session.'];
            return redirect()->route('donate.cancel')->withNotify($notify);
        }

        $gateway = Gateway::automatic()->with('currencies')->where('alias', 'Stripe')->firstOrFail();
        $parameters = collect(json_decode($gateway->parameters));
        $secret_key = $parameters->get('secret_key')->value ?? env('STRIPE_SECRET');
        \Stripe\Stripe::setApiKey($secret_key);

        try {
            $session = \Stripe\Checkout\Session::retrieve($request->session_id);
        } catch (\Exception $e) {
            $notify[] = ['error', 'Invalid or expired session.'];
            return redirect()->route('donate.cancel')->withNotify($notify);
        }

        if ($session->payment_status === 'paid') {
            // Retrieve user details stored in session
            $name = $request->session()->get('donation_name');
            $email = $request->session()->get('donation_email');
            $phone = $request->session()->get('donation_phone');

            // Create donation record with user input values
            $donation = Donation::create([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'amount' => $session->amount_total / 100,
                'transaction_id' => $session->payment_intent ?? null,
            ]);

            Mail::to($email)->send(new DonationReceipt($donation));
            $request->session()->forget(['donation_name', 'donation_email', 'donation_phone']);
            // $notify[] = ['success', 'Donation successful!'];

            return redirect()->route('thank_you', $donation->id);
        }

        $notify[] = ['error', 'Payment failed.'];
        return redirect()->route('donation')->withNotify($notify);
    }

    public function cancel()
    {
        $notify[] = ['error', 'Payment cancelled.'];

        return redirect()->route('donation')->withNotify($notify);
    }
    public function allDonations(Request $request)
    {
        $pageTitle = "All Donations";
        $query = Donation::query();

        if ($request->search) {
            $search = $request->search;
            $pageTitle = "Search Result of $search";

            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%");
            });
        }

        $donations = $query->latest()->paginate(15);
        $empty_message = 'No donation available';

        return view('admin.donations.index', compact('pageTitle', 'donations', 'empty_message'));
    }

}
