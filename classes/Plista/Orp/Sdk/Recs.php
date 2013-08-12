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

	const SCORE = 2;
	const ITEM = 3;

	private $data = array();

	public function __construct($data) {
		$this->data = $data;
	}

	/**
	 * @return int[]
	 */
	public function getItems() {
		return $this->data['ints'][self::ITEM];
	}

	/**
	 * @return float[]
	 */
	public function getScores() {
		return $this->data['floats'][self::SCORE];
	}
}