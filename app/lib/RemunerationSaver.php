<?php

/**
 * Money Formatter
 *
 * @package helpers
 * @author Dixie Philamerah J. Atay <dixie.atay@gmail.com>
**/

class RemunerationSaver 
{
	public static function save($input) 
	{
		$remuneration_id = $input['remuneration_id'];
		$company_id      = $input['company_id'];
		$accountant_id   = $input['accountant_id'];
		
		$remuneration_data = $input['remuneration'];
		$directors         = $input['directors'];
		$accountant_data   = $input['accountant'];
		
		$company = $company_id == 'new' ? new Company() : Company::find($company_id);
		$company->user_id = Sentry::getUser()->id;
		$company->save();
		
		$accountant = $accountant_id == 'new' ? new Accountant() : Accountant::find($accountant_id);
		$accountant_data['user_id'] = Sentry::getUser()->id;
		$accountant->fill($accountant_data);
		$accountant->save();
		
		$remuneration_data['company_id']    = $company->id;
		$remuneration_data['accountant_id'] = $accountant->id;
		$remuneration_data['user_id']       = Sentry::getUser()->id;
		
		$remuneration = $remuneration_id == 'new' ? new Remuneration() : Remuneration::find($remuneration_id);
		$prev_net_profit = $remuneration->profit_chargeable;
		$remuneration->fill($remuneration_data);
		$remuneration->save();
		
		for ($i = $remuneration_data['number_of_director_shareholders']; $i < 4; $i++) {
			unset($directors[$i]);
		}
		
		$remuneration->setDirectors($directors);

		if ($remuneration->profit_chargeable >= '100000' && $prev_net_profit < $remuneration->profit_chargeable) {
			$product_recommendation = new ProductRecommendation();
			$product_recommendation->recommend($remuneration, User::getPracticeproUser());
			Session::put('has_recommendation', true);
		}
		
		return $remuneration;
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
	
	public static function forgetParams($timestamp) 
	{
		Session::forget('subscription_data_' . $timestamp);
	}
}
