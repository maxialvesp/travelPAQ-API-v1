<?php

App::uses('AppController', 'Controller');

class SearchController extends AppController {

	public $uses = array('Package');

	public function getPackageList() {
		if($this->request->is('post')){
			$this->autoRender = false;
			$loginResponse = json_decode($this->login($user_id, $token));
			if($loginResponse['status'] == 'OK'){
				//Chequeo de disponibilidad
			} else {
				return $loginResponse;
			}
		} else {
			echo json_encode(array('status' => 'ERROR_TYPE_REQUEST', 'message' => 'Esta accediendo de manera equivocada al servidor'));
		}
	}

	public function getPackage($user_id, $token, $travelpaq_id){
		if($this->request->is('get')){
			$this->autoRender = false;
			$loginResponse = json_decode($this->login($this->request->data['user_id'], $this->request->data['token']));
			if($loginResponse['status'] == 'OK'){
				//Generacion del Budget
			} else {
				return $loginResponse;
			}

		} else {
			echo json_encode(array('status' => 'ERROR_TYPE_REQUEST', 'message' => 'Esta accediendo de manera equivocada al servidor'));
		}
	}
}
