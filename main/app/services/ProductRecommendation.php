<?php

class ProductRecommendation {

	
	public function recommend($remuneration, $user)
	{
		$db = DB::connection('practicepro_users');
		$client = $remuneration->company->getClient();
		$email_to = $db->table('counties')->where('county', '=', $client->county)->limit(1)->pluck('relationship_manager');

		if ( ! $email_to) {
			return null;
		}

		Mail::send('emails.product_recommendation', ['user' => $user, 'net_profit' => $remuneration->profit_chargeable, 'client' => $client], function($message) use ($email_to)
		{
			$from = Config::get('mail.admin_email');

			$message->to(
				//'dixie.atay@gmail.com', 
				$email_to, 
				'Relationship Manager'
			)->subject('Remuneration Pro - New Product Recommendation');

			$message->from($from['address'], $from['name']);
		});
	}

}
