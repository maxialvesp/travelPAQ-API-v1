<?php
class RecipesController extends AppController {

	public function index() {
		$this->set(array(
            'token' => $this->decoded_token,
            '_serialize' => array('token')
        ));
	}

}