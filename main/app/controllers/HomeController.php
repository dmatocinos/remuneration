<?php

class HomeController extends AuthorizedController {


	public function index() 
	{
		Asset::container('footer')->add('home-index-js', 'assets/js/home/index.js');
		
		$form_data = array(
			'remunerations' => Remuneration::getAll(Sentry::getUser()->id)
		);
		
		$this->layout->content = View::make("pages.list", $form_data);
	}

}
