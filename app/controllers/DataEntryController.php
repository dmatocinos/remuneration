<?php

/**
 * undocumented class
 *
 * @packaged default
 * @author Dixie Philamerah J. Atay <dixie.atay@gmail.com>
 **/
class DataEntryController extends AuthorizedController {

	protected function addAssets() {
		Asset::container('header')->add('data_entry-index-css', 'css/data_entry/index.css');
		
		Asset::container('footer')->add('data_entry-index-js', 'js/data_entry/index.js');
		Asset::container('footer')->add('change-listener-js', 'js/core/change_listener.js');
	}
	
	public function edit()
	{
		if (!$this->isRemunerationOwned($this->remuneration)) {
			return Redirect::to('')
				->with('message', 'You cannot make changes to this remuneration');
		}
		
		$company    = $this->remuneration->company;
		$accountant = $this->remuneration->accountant;
		
		$directors_data = array();
		
		for ($i = 0; $i < 4; $i++) {
			$director = $this->remuneration->directors->get($i);
			
			if ($director) {
				$directors_data[] = $director->toArray();
			}
		}
		$client = Client::on('practicepro_users')->find($this->remuneration->client_id);

		$data = array(
			'data' => [
				'remuneration_id' => $this->remuneration->id,
				'remuneration'    => $this->remuneration->toArray(),
				'company'         => $company->toArray(),
				'accountant'      => $accountant->toArray(),
				'directors'       => $directors_data
			],
			'edit_remuneration' => true,			
			'client_data'     => $client->getAttributes(),
		);

		$this->setupData($data + Input::get());
	}

    public function delete()
	{
		if (!$this->isRemunerationOwned($this->remuneration)) {
			return Redirect::to('home')
				->with('message', 'You cannot make changes to this remuneration');
		}

        $this->remuneration->delete();
		
		return Redirect::to('home')
				->with('message', 'Successfully deleted remuneration');
	}

	protected function isRemunerationOwned ($remuneration) 
	{
		return ($remuneration->user_id == Sentry::getUser()->id) ? true : false;
	}

	public function addClient()
	{
		$input = Input::all();
		if ($input['select_by'] == 'existing') {
			return Redirect::to('client_details/existing/' . $input['client_id']);
		}
		else {
			return Redirect::to('client_details/new');
		}
	}

	private function setupData($data)
	{
		if (isset($data['s_timestamp'])) {
			$timestamp = $data['s_timestamp'];
			$data = RemunerationSaver::getParamsFromSession($timestamp);
			RemunerationSaver::forgetParams($timestamp);
		}
		
		$this->addAssets();
		Asset::container('footer')->add('client-index-js', 'js/data_entry/client.js');
		
		$db = DB::connection('practicepro_users');
		$data['currencies'] = $db->table('currencies')->lists('name', 'id');
		$data['counties']   = ['' => ''] + $db->table('counties')->lists('county', 'county');
		$data['countries']  = ['' => ''] + $db->table('countries')->lists('country_name', 'country_name');


		$this->layout->content = View::make("pages.data_entry", $data);
	}

	public function newClient()
	{
		$client = new Client;
		$this->setupData(['client_data' => array_fill_keys($client->getFillable(), null)]);
	}

	public function existingClient($client_id)
	{
		$client = Client::on('practicepro_users')->find($client_id);
		$this->setupData(['client_data' => $client->getAttributes()]);
	}


	public function createClient() 
	{
		$input = Input::all();
		$validator = Validator::make($input, Client::$rules);
		if ($validator->passes()) {
			$input['period_start_date'] = date('Y-m-d H:i:a', strtotime($input['period_start_date']));
			$input['period_end_date'] = date('Y-m-d H:i:a', strtotime($input['period_end_date']));

			$client = Client::create($input);	

			$pp_user = User::getPracticeProUser();
			$accountant_data = [
				'practice_name' 	   => $pp_user->mh2_company_name,
				'address'		   => $pp_user->mh2_company_address,
				'telephone_number' 	   => $pp_user->work_phone_number,
				'email'		           => $pp_user->email_code,
				'website'	   	   => $pp_user->web_url,	
				'contact_name'	   	   => $pp_user->mh2_fname . ' ' . $pp_user->mh2_lname,
				'contact_telephone_number' => $pp_user->mh2_lname
			];

			// save to existing app data
			$data = $input + [
				'accountant' => $accountant_data,
			];

			return $this->save($data, $client->id);

		}
		else {
			return Redirect::to('client_details/new')
				->withInput()
				->withErrors($validator)
				->with('message', 'Please correct the field(s) below marked in red');
		}
	}

	public function updateClient() 
	{
		$input = Input::all();

		$validator = Validator::make($input, Client::$rules);
		if ($validator->passes()) {
			$input['period_start_date'] = date('Y-m-d H:i:a', strtotime($input['period_start_date']));
			$input['period_end_date'] = date('Y-m-d H:i:a', strtotime($input['period_end_date']));

			$client = Client::find($input['id']);
			$client->update($input);

			$pp_user = User::getPracticeProUser();
			$accountant_data = [
				'practice_name' 	   => $pp_user->mh2_company_name,
				'address'		   => $pp_user->mh2_company_address,
				'telephone_number' 	   => $pp_user->work_phone_number,
				'email'		           => $pp_user->email_code,
				'website'	   	   => $pp_user->web_url,	
				'contact_name'	   	   => $pp_user->mh2_fname . ' ' . $pp_user->mh2_lname,
				'contact_telephone_number' => $pp_user->mh2_lname
			];

			// save to existing app data
			$data = $input + [
				'accountant' => $accountant_data,
			];

			return $this->save($data, $client->id);

		}
		else {
			return Redirect::to('client_details/existing/' . $input['id'])
				->withInput()
				->withErrors($validator)
				->with('message', 'Please correct the field(s) below marked in red');
		}
		
	}

	private function save($data, $client_id)
	{
		$remuneration_id = $data['remuneration_id'];
		$company_id      = $data['company_id'];
		$accountant_id   = $data['accountant_id'];

		$data['remuneration']['client_id'] = $client_id;
		if ($remuneration_id == 'new' && User::needSubscription()) {
			// need to ask for payment
			return Redirect::to('subscribe/' . $client_id)->withInput($data);
		}

		$remuneration = RemunerationSaver::save($data);
		$route = isset($data['save_next_page']) 
		       ? 'report/' . $remuneration->id
		       : 'edit/' . $remuneration->id;

		return Redirect::to($route)->with('message', 'Successfully saved changes.');

	}
}
