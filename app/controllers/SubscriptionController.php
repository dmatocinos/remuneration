<?php

use \Omnipay\Common\GatewayFactory;
use \Carbon\Carbon;

class SubscriptionController extends AuthorizedController {

	protected $layout = 'layout.subscribe';
	protected $user;

	public function __construct()
	{
		parent::__construct();

		$this->user = Auth::user();
	}

	// @todo move to service
	protected function getGateway()
	{
		$gateway = new GatewayFactory();
		$gateway = $gateway->create(Config::get('paypal.gateway'));

		$gateway->setUsername(Config::get('paypal.username'));
		$gateway->setPassword(Config::get('paypal.password')); 
		$gateway->setSignature(Config::get('paypal.signature'));
		$gateway->setTestMode(Config::get('paypal.test_mode'));

		return $gateway;
	}

	// @todo move to service
	protected function getPurchaseData($timestamp, $client_id = null)
	{
		// TODO: why is user->practice_pro_user not working?
		$practicepro_user = User::getPracticeProUser();
		$pricing          = $practicepro_user->pricing;
		if ( ! $pricing) {
			throw new Exception("Unknown membership level: {$practicepro_user->membership_level}");
		}

		//$expiration_date = $pricing->getNewSubscriptionExpiration(Sentry::getUser())->toFormattedDateString();
		
		$paypal_data = array(
			'amount' 	=> $pricing->getDiscountedAmount(),
			'description'	=> Config::get('paypal.description') . " Payment for new Remuneration Report",
			'returnUrl'	=> url('complete_payment', array($timestamp, $client_id)),
			'cancelUrl'	=> url('cancel_payment', array($timestamp, $client_id)),
			'currency'	=> Config::get('paypal.currency')
		);

		return $paypal_data;
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
		$display 	  = $practicepro_user->membership_level_display;
		
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
			'msg'    => $msg,
			'timestamp' => $timestamp,
			'client_id' => $client_id
		);
		
		$this->layout->content = View::make("subscribe.subscribe", $data);
	}
	
	public function startPayment($timestamp, $client_id) 
	{
		$gateway = $this->getGateway();
		
		try {
			$response = $gateway->purchase($this->getPurchaseData($timestamp, $client_id))->send();
			
			if ($response->isRedirect()) {
				// it should redirect to PayPal payment page
				$response->redirect();
			} 
			else {
				throw new Exception($response->getMessage());
			}
		} 
		catch (Exception $e) {
			throw $e;
		}
	}

	public function cancelPayment($timestamp, $client_id)
	{
		return Redirect::to("client_details/existing/{$client_id}?s_timestamp=" . $timestamp)->withInput();
	}

	public function completePayment($timestamp, $client_id)
	{
		$gateway = $this->getGateway();
		
		try {
			$response = $gateway->completePurchase($this->getPurchaseData($timestamp, $client_id))->send();
			
			if ($response->isSuccessful()) {
				try {
					DB::beginTransaction();
					
					$data             = RemunerationSaver::getParamsFromSession($timestamp);
					$remuneration     = RemunerationSaver::save($data);
					$transaction_data = $response->getData();
					
					$payment_data = array(
						'remuneration_id' => $remuneration->id,
						'amount'          => $transaction_data['PAYMENTINFO_0_AMT'],
						'transaction_id'  => $transaction_data['PAYMENTINFO_0_TRANSACTIONID'],
						'order_time'      => $transaction_data['PAYMENTINFO_0_ORDERTIME']
					);
					
					$payment = Payment::create($payment_data);
					$payment->save();
					
					DB::commit();
					
					RemunerationSaver::forgetParams($timestamp);
			
					return Redirect::to('edit/' . $remuneration->id)
						->with('message', 'Successfully saved remuneration');
				}
				catch (Exception $e) {
					DB::rollback();
					//var_dump($remuneration);
					//die;
					throw $e;
				}
			} 
			else {
				throw new Exception($response->getMessage());
			}
		} 
		catch (Exception $e) {
			throw $e;
		}
	}

	public function completeSubscription()
	{
		//
	}
}
