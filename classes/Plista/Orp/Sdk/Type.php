<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jannik
 * Date: 05.08.13
 * Time: 14:00
 * To change this template use File | Settings | File Templates.
 */

namespace Plista\Orp\Sdk;


class Type {

	private $data = array();

	public function __construct($data) {
		$this->data = $data;
	}

	public function getTypeValue() {
		return $this->data;
	}
}