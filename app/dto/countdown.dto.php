<?php declare(strict_types=1);

namespace OsumiFramework\App\DTO;

use OsumiFramework\OFW\Core\ODTO;
use OsumiFramework\OFW\Web\ORequest;

class CountdownDTO implements ODTO{
	private ?int $id_user  = null;
	private ?int $end_date = null;

	public function getIdUser(): ?int {
		return $this->id_user;
	}
	private function setIdUser(?int $id_user): void {
		$this->id_user = $id_user;
	}
	public function getEndDate(): ?int {
		return $this->end_date;
	}
	private function setEndDate(?int $end_date): void {
		$this->end_date = $end_date;
	}

	public function isValid(): bool {
		return (
			!is_null($this->getIdUser()) &&
      !is_null($this->getEndDate())
		);
	}

	public function load(ORequest $req): void {
		$filter = $req->getFilter('login');

		$this->setIdUser(array_key_exists('id', $filter) ? $filter['id'] : null);
		$this->setEndDate($req->getParamInt('endDate'));
	}
}
