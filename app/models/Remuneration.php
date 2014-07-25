<?php

class Remuneration extends \Eloquent {

	protected $softDelete = true;

	protected $fillable = [
		'user_id',
		'company_id',
		'accountant_id',
		'name',
		'profit_chargeable',
		'corporate_tax_rate',
		'amount_to_distribute',
		'directors_salary',
		'client_id',
	];

	public function company()
	{
		return $this->belongsTo('Company');
	}
	
	public function directors()
	{
		return $this->hasMany('Director');
	}

	public function accountant()
	{
		return $this->belongsTo('Accountant');
	}

	public function getNumberOfDirectorShareholdersAttribute()
	{
		return count($this->directors);
	}
	
	public function setDirectors($new_directors) 
	{
		$directors = $this->directors()->getResults();
		$count_current_directors = count($directors);
		$count = 0;
		
		foreach ($new_directors as $director) {
			if ($count < $count_current_directors) {
				$d = $directors->get($count);
				$d->fill($director);
				$d->update();
			}
			else {
				Director::create(array_merge($director, array('remuneration_id' => $this->id, 'sort_order' => $count + 1)));
			}
			
			$count++;
		}
		
		if ($count < $count_current_directors) {
			for (; $count < $count_current_directors; $count++) {
				$directors->get($count)->delete();
			}
		}
	}
	
	public function deleteDirectors() 
	{
		 Director::where('remuneration_id', '=', $this->id)->delete();
	}
	
	public static function getAll($user_id) 
	{
		return Remuneration::where('user_id', '=', $user_id)->get();
	}
}
