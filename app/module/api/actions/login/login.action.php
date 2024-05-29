<?php declare(strict_types=1);

namespace OsumiFramework\App\Module\Action;

use OsumiFramework\OFW\Routing\OModuleAction;
use OsumiFramework\OFW\Routing\OAction;
use OsumiFramework\OFW\Web\ORequest;
use OsumiFramework\App\Model\User;
use OsumiFramework\App\Component\Model\UserComponent;
use OsumiFramework\OFW\Plugins\OToken;

#[OModuleAction(
	url: '/login'
)]
class loginAction extends OAction {
	/**
	 * Método para iniciar sesión
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(ORequest $req):void {
		$status   = 'ok';
		$username = $req->getParamString('username');
		$pass     = $req->getParamString('pass');
		$user_component = new UserComponent(['user' => null]);

		if (is_null($username) || is_null($pass)) {
			$status = 'error';
		}

		if ($status=='ok') {
			$user = new User();
			if ($user->login($username, $pass)) {
				$tk = new OToken($this->getConfig()->getExtra('secret'));
				$tk->addParam('id', $user->get('id'));
				$tk->addParam('username', $user->get('username'));
				$tk->setEXP(time() + (60*60*24));
				$user->setToken($tk->getToken());

				$user_component->setValue('user', $user);
			}
			else {
				$status = 'error';
			}
		}

		$this->getTemplate()->add('status', $status);
		$this->getTemplate()->add('user',   $user_component);
	}
}
