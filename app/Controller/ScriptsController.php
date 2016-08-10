<?php
use \Firebase\JWT\JWT;
use \Carbon\Carbon;

class ScriptsController extends Controller {
	public $uses = array('User');
	public function v1($api_key = null) {
		$this->layout = false;
		$token = $this->request->query['api_key'];
		$newJWT = '';
		try {
			$decoded_token = JWT::decode($token, 'unacualquiera', array('HS256'));
			$this->User->bindModel(["belongsTo" => ['Company'] ]);
			$user = $this->User->findById($decoded_token->i);
			if($this->request->referer() == "/")
				throw new Exception("Error Processing Request", 1);
			if(true || $user['Company']['web'] == $this->request->referer())
			{
				$now = Carbon::now();
				$exp = $now->copy();
				$exp->addSeconds(120);
				$array_token = [
				    "iat" => $now->timestamp,
				    "exp" => $exp->timestamp,
				    "i" => $decoded_token->i
				];
				$newJWT = JWT::encode($array_token, 'ZOlG*IZn)2(hDeWY%kY1r5)pPDmKM&7f');
			}
		} catch (\Firebase\JWT\ExpiredException $e){
			throw new UnauthorizedException('Token expirado.');
		} catch (\Exception $e) {
			throw new InternalErrorException($e->getMessage());
		}
		$this->set('token',$newJWT);
	}
	public function prueba(){
		$this->autoRender = false;
		// try {
		// 	$decoded_token = JWT::decode($token, 'unacualquiera', array('HS256'));
		// 	$this->User->bindModel(["belongsTo" => ['Company'] ]);
		// 	$user = $this->User->findById($decoded_token->i);
		// 	if($this->request->referer() == "/")
		// 		throw new Exception("Error Processing Request", 1);
		// 	if($user['Company']['web'] == $this->request->referer())
		// 		;
		// } catch (\Firebase\JWT\ExpiredException $e){
		// 	throw new UnauthorizedException('Token expirado.');
		// } catch (\Exception $e) {
		// 	throw new InternalErrorException($e->getMessage());
		// }
		echo "hola mundo";
	}

}