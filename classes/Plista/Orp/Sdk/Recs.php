<?php

namespace Plista\Orp\Sdk;

class Recs {

	const SCORE = 2;
	const ITEM = 3;

	private $data = array();

	public function __construct($data) {
		// TODO: add a validation here
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