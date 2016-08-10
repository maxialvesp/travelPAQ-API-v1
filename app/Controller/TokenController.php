<?php

use \Firebase\JWT\JWT;
use \Carbon\Carbon;

App::uses('AppController', 'Controller');

class TokenController extends Controller {

	public $components = array('RequestHandler');
	public $uses = array('User');

	public function create_token(){
		$user_id = $this->request->data['user_id'];
		$password = $this->request->data['password'];

		$this->autoRender = false;
		App::uses('AuthComponent', 'Controller/Component');
		$users = array();
		$user = $this->User->findById($user_id);
		// $now = Carbon::now();
		// $exp = $now->copy();
		// $exp->addMinutes(40);
		$token = array(
		    "i" => $user['User']['id'],
		);
		$encoded_token = JWT::encode($token, 'unacualquiera');
		if($user){
			$hash = AuthComponent::password($password);
			if($hash == $user['User']['password']){
				return json_encode(array('status' => 'OK', 'token' => $encoded_token ));
			} else {
				return json_encode(array('status' => 'ERROR_WRONG_PASSWD', 'message' => 'Clave no válida.'));
			}
		} else {
			return json_encode(array('status' => 'ERROR_USER_NOT_FOUD', 'message' => 'Número de usuario no es correcto.'));
		}
	}
}