<?php declare(strict_types=1);

namespace OsumiFramework\App\DTO;

use OsumiFramework\OFW\Core\ODTO;
use OsumiFramework\OFW\Web\ORequest;

class DeleteDTO implements ODTO{
	private ?int $id_user  = null;
	private ?int $id = null;

	public function getIdUser(): ?int {
		return $this->id_user;
	}
	private function setIdUser(?int $id_user): void {
		$this->id_user = $id_user;
	}
	public function getId(): ?int {
		return $this->id;
	}
	private function setId(?int $id): void {
		$this->id = $id;
	}

	public function isValid(): bool {
		return (
			!is_null($this->getIdUser()) &&
      !is_null($this->getId())
		);
	}

	public function load(ORequest $req): void {
		$filter = $req->getFilter('login');

		$this->setIdUser(array_key_exists('id', $filter) ? $filter['id'] : null);
		$this->setId($req->getParamInt('id'));
	}
}
