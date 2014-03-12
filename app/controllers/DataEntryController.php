<?php

/**
 * undocumented class
 *
 * @packaged default
 * @author Dixie Philamerah J. Atay <dixie.atay@gmail.com>
 **/
class DataEntryController extends BaseController {

	public function index() 
	{
		$form_data = array();		
		$this->layout->content = View::make("data_entry", $form_data);
	}


}
