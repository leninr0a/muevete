<?php 

const STATUS_NEW_ACCOUNT = array('missing_fields', 'missing_verify', 'missing_nothing');

function verifyFacebookNewAccount($user){
	if($user->facebook_id != null && ($user->cedula == null || $user->telefono == null || $user->password == null)){
		return STATUS_NEW_ACCOUNT[0];
	}else if($user->facebook_id == null){
		return STATUS_NEW_ACCOUNT[1];
	}else{
		return STATUS_NEW_ACCOUNT[2];
	}
}




?>