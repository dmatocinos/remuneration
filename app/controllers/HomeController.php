<?php

class HomeController extends BaseController {


	public function index() 
	{
		$form_data = array();		
		$this->layout->content = View::make("pages.data_entry", $form_data);
	}

}
