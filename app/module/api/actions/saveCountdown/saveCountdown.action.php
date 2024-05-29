<?php declare(strict_types=1);

namespace OsumiFramework\App\Module\Action;

use OsumiFramework\OFW\Routing\OModuleAction;
use OsumiFramework\OFW\Routing\OAction;
use OsumiFramework\App\DTO\CountdownDTO;
use OsumiFramework\App\Model\Countdown;

#[OModuleAction(
	url: '/save-countdown',
	filters: ['login'],
	services: ['web']
)]
class saveCountdownAction extends OAction {
	/**
	 * Método para guardar una cuenta atrás
	 *
	 * @param CountdownDTO $data Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(CountdownDTO $data):void {
		$status = 'ok';

		if (!$data->isValid()) {
			$status = 'error';
		}

		if ($status == 'ok') {
			$c = new Countdown();
			$c->set('id_user', $data->getIdUser());
			$c->set('end_date', $data->getEndDate());
			$c->save();
		}

		$this->getTemplate()->add('status', $status);
	}
}
