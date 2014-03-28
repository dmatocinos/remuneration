<?php

class Payment extends Eloquent {
	protected $guarded = array();

	public static $rules = array();
	
	protected $fillable = [	
		'remuneration_id',
		'amount',
		'transaction_id',
		'order_time'
	];
}
