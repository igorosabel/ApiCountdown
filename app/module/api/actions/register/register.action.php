<?php declare(strict_types=1);

namespace OsumiFramework\App\Module\Action;

use OsumiFramework\OFW\Routing\OModuleAction;
use OsumiFramework\OFW\Routing\OAction;
use OsumiFramework\App\DTO\RegisterDTO;
use OsumiFramework\App\Model\User;
use OsumiFramework\App\Component\Model\UserComponent;
use OsumiFramework\OFW\Plugins\OToken;

#[OModuleAction(
	url: '/register'
)]
class registerAction extends OAction {
	/**
	 * Función para registrar un nuevo usuario
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(RegisterDTO $data):void {
		$status = 'ok';
		$user_component = new UserComponent(['user' => null]);

		if (!$data->isValid()) {
			$status = 'error';
		}

		if ($status == 'ok') {
			$user = new User();
			if ($user->find(['username' => $data->getUsername()])) {
				$status = 'error-username';
			}
			if ($status == 'ok') {
				$user->set('username', $data->getUsername());
				$user->set('pass', password_hash($data->getPass(), PASSWORD_BCRYPT));
				$user->save();

				$tk = new OToken($this->getConfig()->getExtra('secret'));
				$tk->addParam('id', $user->get('id'));
				$tk->addParam('username', $user->get('username'));
				$user->setToken($tk->getToken());

				$user_component->setValue('user', $user);
			}
		}

		$this->getTemplate()->add('status', $status);
		$this->getTemplate()->add('user',   $user_component);
	}
}
