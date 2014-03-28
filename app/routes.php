<?php
/*
|--------------------------------------------------------------------------
| Scaffolding/Testing
|--------------------------------------------------------------------------
|
| @todo: comment out on production
|
*/
Route::get('install/{key?}',  array('as' => 'install', function($key = null)
{
       if($key == "where_are_the_cranberries"){
               try {
					
                       echo '<br>init with app tables migrations...';
                       Artisan::call('migrate', [
                               '--package'     => "cartalyst/sentry"
                               ]);
                       echo 'done sentry tables';
                       
                       echo '<br>init with app tables migrations...';
                       Artisan::call('migrate', [
                               '--path'     => "app/database/migrations"
                               ]);
                       echo '<br>done with app tables migrations';
					
                       echo '<br>init with tables seeders...';
                       Artisan::call('db:seed');
                       echo '<br>done with tables seeders...';

               } catch (Exception $e) {
					echo $e->getMessage();
                    Response::make($e->getMessage(), 500);
               }
       }else{
               App::abort(404);
       }
}));

Route::get('install/migrate/{key?}',  array('as' => 'install.migrate', function($key = null)
{
	if ($key == "where_are_the_cranberries"){
                       Artisan::call('migrate', [
                               '--path'     => "app/database/migrations"
                               ]);
                       echo '<br>done with app tables migrations';
	}
}));

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'AuthController@getSignin');

Route::group(["before" => "auth"], function()
{
	Route::get('subscribe', array('as' => 'subscribe', 'uses' => 'SubscriptionController@subscribe'));
	Route::get('start_payment/{timestamp}', array('as' => 'start_payment', 'uses' => 'SubscriptionController@startPayment'));
	Route::get('cancel_payment/{timestamp}', array('as' => 'cancel_payment', 'uses' => 'SubscriptionController@cancelPayment'));
	Route::get('complete_payment/{timestamp}', array('as' => 'complete_payment', 'uses' => 'SubscriptionController@completePayment'));
	Route::get('complete_subscription', array('as' => 'complete_subscription', 'uses' => 'SubscriptionController@completeSubscription'));
	
	Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

	Route::get("home", array('as' => 'home', 'uses' => "HomeController@index"));
	Route::get("create", "DataEntryController@create");
	Route::get('edit/{remuneration_id}', "DataEntryController@edit");
	Route::put("save", "DataEntryController@save");
	Route::get('report/{remuneration_id}', array('uses' => 'ReportController@index', 'as' => 'report'));
	Route::get('report/download/{remuneration_id}', array('uses' => 'ReportController@download', 'as' => 'report.download'));
});

/*
|--------------------------------------------------------------------------
| Authentication and Authorization Routes
|--------------------------------------------------------------------------
*/
Route::group(array(), function() {
	# Login
	Route::get('signin', array('as' => 'signin', 'uses' => 'AuthController@getSignin'));
	Route::post('signin', 'AuthController@postSignin');

	# Register
	Route::get('signup', array('as' => 'signup', 'uses' => 'AuthController@getSignup'));
	Route::post('signup', 'AuthController@postSignup');

	# Account Activation
	Route::get('activate/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));

	# Forgot Password
	Route::get('forgot-password', array('as' => 'forgot-password', 'uses' => 'AuthController@getForgotPassword'));
	Route::post('forgot-password', 'AuthController@postForgotPassword');

	# Forgot Password Confirmation
	Route::get('forgot-password/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
	Route::post('forgot-password/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

	# Logout
	Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));
	
	# Check Auth
	Route::get('check', array('as' => 'check', 'uses' => 'AuthController@checkAuth'));

	//Route::get('paid{user_id}', array('as' => 'paid', 'uses' => 'AuthController@paid'));
	//Route::get('cancel_payment/{user_id}', array('as' => 'cancel_payment', 'uses' => 'AuthController@cancelPayment'));
});

