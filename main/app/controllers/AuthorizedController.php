<?php

class AuthorizedController extends BaseController {

	protected $user;
	protected $remuneration;

	public function __construct()
	{
		$this->beforeFilter(function($route, $request) {
			$id = $route->getParameter('remuneration_id');
			
			if (is_numeric($id)) {
				$this->remuneration = Remuneration::find($id);
			}
		});

		parent::__construct();
	}
}
