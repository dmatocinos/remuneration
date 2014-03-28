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
	protected function getPurchaseData($timestamp)
	{
		// TODO: why is user->practice_pro_user not working?
		$practicepro_user = User::getPracticeProUser();
		$pricing          = $practicepro_user->pricing;
		/*
		var_dump(DB::connection('practicepro_users')->getQueryLog());
		var_dump(DB::connection()->getQueryLog());
		die();
		 */
		if ( ! $pricing) {
			throw new Exception("Unknown membership level: {$practicepro_user->membership_level}");
		}

		//$expiration_date = $pricing->getNewSubscriptionExpiration(Sentry::getUser())->toFormattedDateString();
		
		$paypal_data = array(
			'amount' 	=> $pricing->getDiscountedAmount(),
			'description'	=> Config::get('paypal.description') . " Payment for new Remuneration Report",
			'returnUrl'	=> url('complete_payment', $timestamp),
			'cancelUrl'	=> url('cancel_payment', $timestamp),
			'currency'	=> Config::get('paypal.currency')
		);

		return $paypal_data;
	}

	/**
	 * Show the PayPal payment screen
	 *
	 */
	public function subscribe()
	{
		$data = Input::old();
		
		unset($data['_method']);
		unset($data['_token']);
		
		$timestamp = SubscriptionController::saveParamsToSession($data);
		
		// TODO: why is user->practice_pro_user not working?
		$practicepro_user = User::getPracticeProUser();
		$pricing          = $practicepro_user->pricing;
		$amount           = $pricing->getAmount();
		$discount         = $pricing->discount * 100;
		$discounted       = $pricing->getDiscountedAmount();
		$level            = $practicepro_user->membership_level;
		$suffix           = "";
		
		switch ($level) {
			case 'Tax Club':
				$msg = "As a Tax Club Member of PracticePro";
				break;
				
			case 'Elite Member':
				$msg = "As an Elite Member of PracticePro";
				
				break;
			
			case 'Pay as you go':
			default:
				$msg    = "As a Pay as you go member of PracticePro";
				$suffix = "However you will get a full refund if you embark on a tax strategy.";
				
				break;
		}
		
		if ($discount > 0) {
			$msg .= ", we are giving you a special " . $discount . "% discount.  You only have to pay &pound" . number_format(round($discounted, 2), 2) . ". Don't let this offer pass!";
		}
		else {
			$msg = "You can continue creating this report for only &pound" . number_format(round($amount, 2), 2) . ".";
		}
		
		$msg .= $suffix == "" ? "" : (" " . $suffix);
		
		$data = array(
			'msg'    => $msg,
			'timestamp' => $timestamp
		);
		
		$this->layout->content = View::make("subscribe.subscribe", $data);
	}
	
	public function startPayment($timestamp) {
		$gateway = $this->getGateway();
		
		try {
			$response = $gateway->purchase($this->getPurchaseData($timestamp))->send();
			
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

	public function cancelPayment($timestamp)
	{
		return Redirect::to("create?s_timestamp=" . $timestamp)->withInput();
	}

	public function completePayment($timestamp)
	{
		$gateway = $this->getGateway();
		
		try {
			$response = $gateway->completePurchase($this->getPurchaseData($timestamp))->send();
			
			if ($response->isSuccessful()) {
				try {
					DB::beginTransaction();
					
					$data             = SubscriptionController::getParamsFromSession($timestamp);
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
	
	public static function saveParamsToSession($data) 
	{
		$date = new DateTime();
		$timestamp = $date->getTimestamp();
		
		Session::put('subscription_data_' . $timestamp, base64_encode(http_build_query($data)));
		
		return $timestamp;
	}
	
	public static function getParamsFromSession($timestamp) 
	{
		$params = base64_decode(Session::get('subscription_data_' . $timestamp));
		parse_str($params, $data);
		
		return $data;
	}
}
