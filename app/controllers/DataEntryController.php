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
	
	public function create() 
	{
		$data = Input::get();
		
		if (isset($data['s_timestamp'])) {
			$data = SubscriptionController::getParamsFromSession($data['s_timestamp']);
		}
		
		/*echo "<pre>";
		var_dump($data);
		echo "</pre>";
		die;*/
		
		$this->addAssets();
		
		$form_data = array(
			'save_route' => url('save'),
			'cancel_route' => url('create'),
			'data' => $data,
			
		);
		
		$this->layout->content = View::make("pages.data_entry", $form_data);
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function edit()
	{
		if (!$this->isRemunerationOwned($this->remuneration)) {
			return Redirect::to('')
				->with('message', 'You cannot make changes to this remuneration');
		}
		
		$this->addAssets();
		
		/*echo '<pre>';
		print_r($this->remuneration->company_id);
		echo '</pre>';
		die;*/
		
		$company    = $this->remuneration->company;
		$accountant = $this->remuneration->accountant;
		
		$directors_data = array();
		
		for ($i = 0; $i < 4; $i++) {
			$director = $this->remuneration->directors->get($i);
			
			if ($director) {
				$directors_data[] = $director->toArray();
			}
		}
		
		$data = array(
			'remuneration_id' => $this->remuneration->id,
			'remuneration'    => $this->remuneration->toArray(),
			'company'         => $company->toArray(),
			'accountant'      => $accountant->toArray(),
			'directors'       => $directors_data
		);
		
		$form_data = array(
			'save_route'        => url('save'),
			'cancel_route'      => url('edit/' . $this->remuneration->id),
			'data'              => $data
		);
		
		View::share('edit_remuneration', $this->remuneration->name);
		
		$this->layout->content = View::make("pages.data_entry", $form_data);
	}

	public function save() {
		$input = array_except(Input::all(), '_method');
		/*echo '<pre>';
		print_r(Sentry::get());
		echo '</pre>';
		die;*/
		
		$remuneration_id = $input['remuneration_id'];
		$company_id      = $input['company_id'];
		$accountant_id   = $input['accountant_id'];
		
		if ($remuneration_id == 'new' && User::needSubscription()) {
			// need to ask for payment
			return Redirect::to(url('subscribe'))->withInput();
		}
		
		/*echo '<pre>';
		print_r($input);
		echo '</pre>';
		die;*/
		
		$remuneration = RemunerationSaver::save($input);
		
		return Redirect::to('edit/' . $remuneration->id)
			->with('message', 'Successfully saved remuneration');
	}
	
	protected function isRemunerationOwned ($remuneration) {
		return ($remuneration->user_id == Sentry::getUser()->id) ? true : false;
	}
}
