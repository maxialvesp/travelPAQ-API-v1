<?php
class RecipesController extends AppController {

	public function index() {
		$this->set(array(
            'recipes' => ['mmm' => 12, 'jj' => 11],
            '_serialize' => array('recipes')
        ));
	}

}