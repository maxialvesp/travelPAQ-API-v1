<?php

use \Firebase\JWT\JWT;

App::uses('AppController', 'Controller');

class TokenController extends Controller {
	public $uses = array('User');

	public function create_token($user_id,$pass){
		$this->autoRender = false;
		if('rhrdn5BxRpgJRqawI5iQ@WP31XM_doe' != $pass)
		{
			die();
		}
		$user = $this->User->findById($user_id);
		$token = array(
		    "i" => $user['User']['id'],
        );
		$encoded_token = JWT::encode($token, 'ZOlG*IZn)2(hDeWY%kY1r5)pPDmKM&7f');
		if($user){
			return json_encode(array('status' => 'OK', 'token' => $encoded_token ));
		 } else {
		   	return json_encode(array('status' => 'ERROR_USER_NOT_FOUD', 'message' => 'Número de usuario no es correcto.'));
		 }
	}
}
