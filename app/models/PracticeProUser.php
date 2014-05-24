<?php

/**
 * A wrapper to the practice pro users table 
 *
 * @author mmacaso
 */
 
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class PracticeProUser extends Eloquent implements UserInterface, RemindableInterface {
	/**
	 * Default password
	 *
	 * @var string
	 */
	const APP_PASSWORD = "r3mun3r@t1on!";
	
	/**
	 * The database name used by the model.
	 *
	 * @var string
	 */
	protected $connection = 'mysql_practicepro_users';
	CONST _CONNECTION = 'mysql_practicepro_users';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'practice_pro_login';
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	
	public static function findByEmail($email, $password) {
		// TODO: do we need to use restful?
		// TODO: check also if the user has the permission to use biz val
		return DB::connection(self::_CONNECTION)
			->select(DB::raw("SELECT * FROM practice_pro_login WHERE mh2_email = :email AND mh2_password = :password LIMIT 1"), array(
				'email'    => $email,
				'password' => md5($password)
			));
	}
	
	/**
	 * L4 needs to be updated to 4.1.x for this to work. For now, let's use accessor
	 *
	*/
	public function pricing()
	{
		return $this->belongsTo('Pricing', 'mh2_membership_level', 'membership_level_id');
	}

	public function getPricingAttribute()
	{
		return Pricing::where('membership_level_id', '=', $this->membership_level)
			->where('application_id', '=', function($query)
				{
					$query->select(DB::raw('application_id'))
                      ->from('applications')
                      ->where('application_key', '=', Config::get('app.application_key'));
				})
			->first();
	}

	/**
	 * Alias to mh2_membership_level attribute
	 *
	 * @return string
	 */
	public function getMembershipLevelAttribute()
	{
		return $this->mh2_membership_level;
	}
	
	public function getMembershipLevelDisplayAttribute()
	{
		$result = DB::connection($this->connection)
			->select(DB::raw("SELECT display FROM membership_levels WHERE membership_level_id = :membership_level_id LIMIT 1"), array(
				'membership_level_id' => $this->membership_level
			));
		
		return $result[0]->display;
	}

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->mh2_password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->mh2_email;
	}

	public function getRememberToken()
	{

	}

	public function setRememberToken($value)
	{

	}

	public function getRememberTokenName()
	{

	}

}
