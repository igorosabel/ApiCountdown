<?php declare(strict_types=1);

namespace OsumiFramework\App\DTO;

use OsumiFramework\OFW\Core\ODTO;
use OsumiFramework\OFW\Web\ORequest;

class RegisterDTO implements ODTO{
	private ?string $username  = null;
	private ?string $pass      = null;
  private ?string $conf      = null;

	private function setUsername(?string $username) {
		$this->username = $username;
	}
	public function getUsername(): ?string {
		return $this->username;
	}
	private function setPass(?string $pass) {
		$this->pass = $pass;
	}
	public function getPass(): ?string {
		return $this->pass;
	}
	private function setConf(?string $conf) {
		$this->conf = $conf;
	}
	public function getConf(): ?string {
		return $this->conf;
	}

	public function isValid(): bool {
		return (
			!is_null($this->getUsername()) &&
      !is_null($this->getPass()) &&
      !is_null($this->getConf()) &&
      ($this->getPass() === $this->getConf())
		);
	}

	public function load(ORequest $req): void {
		$this->setUsername($req->getParamString('username'));
		$this->setPass($req->getParamString('pass'));
		$this->setConf($req->getParamString('conf'));
	}
}
