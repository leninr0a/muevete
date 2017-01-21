<?php 
	Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {

	            return Hash::check($value, current($parameters));

	});
?>