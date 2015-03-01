<?php

class SubscriptionController extends AuthorizedController {

	protected $layout = 'layout.subscribe';
	protected $user;

	public function __construct()
	{
		parent::__construct();

		$this->user = Auth::user();
	}

	
	/**
	 * Show the PayPal payment screen
	 *
	 */
	public function subscribe($client_id)
	{
		$data = Input::old();

		unset($data['_method']);
		unset($data['_token']);
		
		$timestamp = RemunerationSaver::saveParamsToSession($data);
		
		// TODO: why is user->practice_pro_user not working?
		$practicepro_user = User::getPracticeProUser();
		$pricing          = $practicepro_user->pricing;
		$amount           = $pricing->getAmount();
		$discount         = $pricing->discount * 100;
		$discounted       = $pricing->getDiscountedAmount();
		$level            = $practicepro_user->membership_level;
		$display 	      = $practicepro_user->membership_level_display;
		
		$msg = sprintf("As a %s Member of PracticePro", $display);
		$suffix = "However you will get a full refund if you embark on a tax strategy.";
		
		if ($discount > 0) {
			$msg .= ", you are entitled to a " . $discount . "% discount of all software, and therefore your {$display} preferential price is only &pound" . number_format(round($discounted, 2), 2) . " per valuation";

			if ($display == 'Pro Active') {
				$upgrade_link = link_to('http://www.practicepro.co.uk/package-comparison/', 'here');
				$msg .= "<br><br> You can receive an even more incentive with Remuneration by upgrading to a Professional subscription. <br> Click {$upgrade_link} to learn more about the benefits of upgrading.”";
			}
		}
		else {
			$msg .= " you are required to pay an amount of &pound" . number_format(round($amount, 2), 2) . " to fully manage the report.";

			$upgrade_link = link_to('http://www.practicepro.co.uk/package-comparison/', 'here');
			$msg .= "<br><br> You can receive more incentive Remuneration by upgrading your subscription. <br> Click {$upgrade_link} to learn more about the benefits of upgrading.”";
		}
		
		$msg .= $suffix == "" ? "" : (" " . $suffix);
		
		$data = array(
			'msg'       => $msg,
			'timestamp' => $timestamp,
			'client_id' => $client_id
		);

        Asset::container('footer')->add('payment-js', 'assets/js/payment/stripe.js');
        
		$this->layout->content = View::make("payment.index", $data);
	}
	
	public function cancelPayment($timestamp, $client_id)
	{
		return Redirect::to("client_details/existing/{$client_id}?s_timestamp=" . $timestamp)->withInput();
	}

	public function completePayment()
	{
        $user = $this->user;

        App::bind('Payment\Payment\PaymentInterface', 'Payment\Payment\StripePayment');

        $payment      = App::make('Payment\Payment\PaymentInterface');
        $pp_user      = User::getPracticeProUser();
		$pricing      = $pp_user->pricing;
        $discounted   = $pricing->getDiscountedAmount();
        $data         = ['token'  => Input::get('stripe-token'), 'amount' => $discounted, 'email' => Input::get('email')];
        $token        = $payment->charge($data);
        $timestamp    = Input::get('timestamp');
        $data         = RemunerationSaver::getParamsFromSession($timestamp);
        $remuneration = RemunerationSaver::save($data);
        
        $payment_data = array(
            'remuneration_id' => $remuneration->id,
            'amount'         => $discounted,
            'transaction_id' => $token->id,
            'order_time'     => date('Y-m-d H:i:a')
        );

		$payment = Payment::create($payment_data);
		$payment->save();
        
        RemunerationSaver::forgetParams($timestamp);

        return Redirect::to('edit/' . $remuneration->id)
            ->with('message', 'Successfully saved remuneration');
	}
}
