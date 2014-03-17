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
		$this->addAssets();
		
		$form_data = array(
			'save_route' => url('save'),
			'cancel_route' => url('create'),
			'data' => array(),
			
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
		
		$company    = Company::find($this->remuneration->company_id);
		$accountant = Accountant::find($this->remuneration->accountant_id);
		
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
		
		$remuneration_data = $input['remuneration'];
		$directors         = $input['directors'];
		$company_data      = $input['company'];
		$accountant_data   = $input['accountant'];
		
		$company = $company_id == 'new' ? new Company() : Company::find($company_id);
		$company_data['user_id'] = Sentry::getUser()->id;
		$company->fill($company_data);
		$company->save();
		
		$accountant = $accountant_id == 'new' ? new Accountant() : Accountant::find($accountant_id);
		$accountant_data['user_id'] = Sentry::getUser()->id;
		$accountant->fill($accountant_data);
		$accountant->save();
		
		$remuneration_data['company_id']    = $company->id;
		$remuneration_data['accountant_id'] = $accountant->id;
		$remuneration_data['user_id']       = Sentry::getUser()->id;
		
		$remuneration = $remuneration_id == 'new' ? new Remuneration() : Remuneration::find($remuneration_id);
		$remuneration->fill($remuneration_data);
		$remuneration->save();
		
		for ($i = $remuneration_data['number_of_director_shareholders']; $i < 4; $i++) {
			unset($directors[$i]);
		}
		
		$remuneration->setDirectors($directors);
		
		return Redirect::to('edit/' . $remuneration->id)
			->with('message', 'Successfully saved remuneration');
	}
	
	protected function isRemunerationOwned ($remuneration) {
		return ($remuneration->user_id == Sentry::getUser()->id) ? true : false;
	}
}
