<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Stripe\Stripe;
use Stripe\Exception\CardException;
use Stripe\PaymentIntent;
class stripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        // Set your Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Create a payment intent
            $paymentIntent = PaymentIntent::create([
                'amount' => 100 * 100, // Amount in cents
                'currency' => 'usd',
                'payment_method' => $request->stripePaymentMethod,
                'confirm' => true,
                'description' => 'Test payment from your website.',
                'return_url' => route('home')
            ]);

            // Payment successful, flash success message
            Session::flash('success', 'Payment successful!');
        } catch (CardException $e) {
            // Payment failed, flash error message
            Session::flash('error', $e->getMessage());
        }

        return redirect()->back();
    }
}
