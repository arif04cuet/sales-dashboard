<?php

class Qc extends \Eloquent {

	protected $table = 'qc';
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}