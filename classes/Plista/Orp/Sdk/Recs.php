<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jannik
 * Date: 05.08.13
 * Time: 13:34
 * To change this template use File | Settings | File Templates.
 */

namespace Plista\Orp\Sdk;


class Recs {

	const VALUE = 3;

	private $data = array();

	public function __construct($data) {
		$this->data = $data;
	}

	public function getRecsValue() {
		return $this->data['ints'][self::VALUE];
	}
}