<?php declare(strict_types=1);

namespace OsumiFramework\App\Service;

use OsumiFramework\OFW\Core\OService;
use OsumiFramework\OFW\DB\ODB;
use OsumiFramework\App\Model\Countdown;

class webService extends OService {
	function __construct() {
		$this->loadService();
	}

	/**
	 * Obtiene la lista de cuentas atrás de un usuario
	 *
	 * @param int $id_user Id del usuario del que obtener la lista
	 *
	 * @return array Lista de cuentas atrás
	 */
	public function getCountdowns(int $id_user): array {
		$db = new ODB();
		$sql = "SELECT * FROM `countdown` WHERE `id_user` = ? ORDER BY `end_date` DESC";

		$ret = [];
		$db->query($sql, [$id_user]);

		while ($res=$db->next()) {
			$c = new Countdown();
			$c->update($res);

			array_push($ret, $c);
		}

		return $ret;
	}
}
