<?php

namespace Plista\Orp\Sdk;

class Recs {

	const SCORE = 2;
	const ITEM = 3;

	private $data = array();

	public function __construct($data) {
		// TODO: add a validation here, we have to have items and maybe scores
		$this->data['recs']['ints'][self::ITEM] = $data['result'];
		$this->data['recs']['floats'][self::SCORE] = $data['score'];
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

	public function toJSON() {
		// encoding recommendation
		$json_string = json_encode($this->data);

		if ($json_string === false) {
			throw new Exception('Error: Could not encode response to JSON :( .');
		}

		return $json_string;
	}
}