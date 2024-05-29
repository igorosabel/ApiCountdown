<?php declare(strict_types=1);

namespace OsumiFramework\App\Module\Action;

use OsumiFramework\OFW\Routing\OModuleAction;
use OsumiFramework\OFW\Routing\OAction;
use OsumiFramework\OFW\Web\ORequest;
use OsumiFramework\App\Component\Model\CountdownListComponent;

#[OModuleAction(
	url: '/get-countdowns',
	services:	['web'],
	filters: ['login']
)]
class getCountdownsAction extends OAction {
	/**
	 * Método para obtener el listado de cuentas atrás de un usuario
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(ORequest $req):void {
		$filter = $req->getFilter('login');
		$status = 'ok';
		$countdown_list_component = new CountdownListComponent(['list' => []]);

		if (!array_key_exists('id', $filter)) {
			$status = 'error';
		}

		if ($status == 'ok') {
			$countdown_list_component->setValue('list', $this->web_service->getCountdowns($filter['id']));
		}

		$this->getTemplate()->add('status', $status);
		$this->getTemplate()->add('list',   $countdown_list_component);
	}
}
