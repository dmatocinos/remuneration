<?php

class BaseController extends Controller {

	/**
	 * Message bag.
	 *
	 * @var Illuminate\Support\MessageBag
	 */
	protected $messageBag = null;

	protected $layout = 'layout.base';

	/**
	 * Initializer.
	 *
	 */
	public function __construct()
	{
		$this->session = App::make('session');
		$this->redirect = App::make('redirect');
		$this->view = App::make('view');
		$this->request = App::make('request');
		$this->validator = App::make('validator');

		// @todo: move this to config, start or global
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->messageBag = new Illuminate\Support\MessageBag;
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		/** Start adding styles  **/
		Asset::container('header')->add('bootstrap-css', 'plugins/bootstrap/css/bootstrap.min.css');
		Asset::container('header')->add('fontawesome-css', 'plugins/font-awesome/css/font-awesome.min.css');
	
		if ($this->layout != 'layout.auth' && $this->layout != 'layout.subscribe') {
			Asset::container('header')->add('datepicker-css', 'plugins/datepicker/css/datepicker.css');
			Asset::container('header')->add('sb-admin-css', 'css/base/sb-admin.css');
			Asset::container('header')->add('bootstrap-notify-master-css', 'plugins/bootstrap-notify-master/css/bootstrap-notify.css');
			Asset::container('header')->add('datatables-css', 'plugins/datatable/media/css/demo_table.css');
			Asset::container('header')->add('custom-datatable-css', 'plugins/datatable/media/css/custom_datatable.css');
			Asset::container('header')->add('jquery-ui-css', 'plugins/jquery-ui/css/jquery-ui.css');
		}
		else {
			Asset::container('header')->add('auth-css', 'css/auth/auth.css');
			Asset::container('header')->add('the-big-picture-css', 'css/auth/the_big_picture.css');
		}

		/** End adding styles  **/



		/** Start adding javascripts  **/
		Asset::container('footer')->add('jquery', 'js/core/jquery-1.10.2.min.js');
		Asset::container('footer')->add('jquery-ui-1.9.2-js', 'plugins/jquery-ui/js/jquery-ui-1.9.2.custom.min.js');
		Asset::container('footer')->add('bootstrap-js', 'plugins/bootstrap/js/bootstrap.min.js');
		Asset::container('footer')->add('base-js', 'js/base/base.js');

		if ($this->layout != 'layout.auth' && $this->layout != 'layout.subscribe') {
			Asset::container('footer')->add('angular-js', 'js/core/angular.js');
			Asset::container('footer')->add('datepicker-js', 'plugins/datepicker/js/bootstrap-datepicker.js');
			Asset::container('footer')->add('bootstrap-notify-master-js', 'plugins/bootstrap-notify-master/js/bootstrap-notify.js');
			Asset::container('footer')->add('jquery-dataTables-js', 'plugins/datatable/media/js/jquery.dataTables.js');
			Asset::container('footer')->add('numeric-input-js', 'js/core/numericInput.min.js');
		}
		/** End adding javascripts  **/
		$segment = Request::segment(1);

		$side_nav_css_class = array(
			'item' => ($segment == 'edit') ? 'active' : '',
			'home' => ($segment == 'home') ? 'active' : '',
			'create' => ($segment == 'create') ? 'active' : ''
		);

		View::share('side_nav_css_class', $side_nav_css_class);

		if ($notification = Session::get('notification')) {
			View::share('notification', $notification);
		}

		if (Sentry::check()) {
			View::share('current_clients', Client::getAllCurrentClients());
		}

		$this->layout = View::make($this->layout);
	}

	public function sendEmailSupport()
	{
		$data = Input::all();
		$user = User::getPracticeProUser();
		$subject = $data['subject'];
		Mail::send('emails.support', ['msg' => $data['msg']], function($message) use ($user, $subject)
		{
			$message->to(
				//'dixie.atay@gmail.com', 
				'support@practicepro.co.uk', 
				'Support Team'
			)->subject('Remuneration Pro - ' . $subject);

			$message->from($user->mh2_email, sprintf("%s %s", $user->mh2_fname, $user->mh2_lname));
		});

		return Redirect::back()->with('notification', ['type' => 'success', 'text' => 'You have successfully sent your message to support team.']);
	}

}
