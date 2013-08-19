<?php
namespace Plista\Orp\Sdk;

class Timestamp {

	private $data = array();

	public function __construct($data) {
		// TODO: add a validation here
		$this->data = $data;
	}

	public function getTimestampValue() {
		return $this->data;
	}
}
