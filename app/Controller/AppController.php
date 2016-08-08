<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $uses = array('Package');


	public function login($user_id, $token){
		$this->autoRender = false;
		App::uses('AuthComponent', 'Controller/Component');
		$users = array();
		$users = $this->Package->query("SELECT username, password FROM users AS User where id = " . $user_id);

		if(count($users) > 0){
			$user = $users[0];
			$tokenGenerated = AuthComponent::password($user['User']['username'] + $user['User']['password']);
			if($token === $tokenGenerated){
				return json_encode(array('status' => 'OK'));
			} else {
				return json_encode(array('status' => 'ERROR_WRONG_TOKEN', 'message' => 'El token es incorrento'));
			}

		} else {
			return json_encode(array('status' => 'ERROR_USER_NOT_FOUD', 'message' => 'Número de usuario no es correcto'));
		}
	}

	public function accesTokenUser($user_id){
		$this->autoRender = false;
		App::uses('AuthComponent', 'Controller/Component');
		$users = array();
		$users = $this->Package->query("SELECT username, password FROM users AS User where id = " . $user_id);

		if(count($users) > 0){
			$user = $users[0];
			$tokenGenerated = AuthComponent::password($user['User']['username'] + $user['User']['password']);
			return json_encode(array('status' => 'OK', 'token' => $tokenGenerated));

		} else {
			return json_encode(array('status' => 'ERROR_USER_NOT_FOUD', 'message' => 'Número de usuario no es correcto'));
		}
	}

	public $components = array(
        'Auth' => array(
            'className' => 'StatelessAuth.StatelessAuth',
            'authenticate' => array(
                'className' => 'StatelessAuth.Token',

                // Additional examples:

                // 'userModel' => 'User',
                // 'tokenField' => 'token',
                // 'recursive' => -1,
                // 'contain' => array('Permission'),
                // 'conditions' => array('User.is_active' => true),
                // 'passwordHasher' => 'Blowfish',
            ),
        )
    );
}
