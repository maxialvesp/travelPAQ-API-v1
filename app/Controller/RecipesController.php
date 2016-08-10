<?php
class RecipesController extends AppController {
	public $components = array('RequestHandler');
	public function index() {
		$this->set(array(
            'token' => "qweqw",
            '_serialize' => array('token')
        ));
	}

}