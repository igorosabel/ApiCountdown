<?php declare(strict_types=1);

namespace OsumiFramework\App\Module\Action;

use OsumiFramework\OFW\Routing\OModuleAction;
use OsumiFramework\OFW\Routing\OAction;
use OsumiFramework\App\DTO\DeleteDTO;
use OsumiFramework\App\Model\Countdown;

#[OModuleAction(
	url: '/delete-countdown',
	filters: ['login']
)]
class deleteCountdownAction extends OAction {
	/**
	 * Método para borrar una cuenta atrás
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(DeleteDTO $data):void {
		$status = 'ok';

		if (!$data->isValid()) {
			$status = 'error';
		}

		if ($status == 'ok') {
			$c = new Countdown();
			if ($c->find(['id' => $data->getId()])) {
				if ($c->get('id_user') == $data->getIdUser()) {
					$c->delete();
				}
				else {
					$status = 'error';
				}
			}
			else {
				$status = 'error';
			}
		}

		$this->getTemplate()->add('status', $status);
	}
}
