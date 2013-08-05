<?php
namespace Plista\Orp\Sdk;


class Timestamp {

	private $data = array();

	public function __construct($data) {
		$this->data = $data;
	}

	public function getTimestampValue() {
		return $this->data;
	}



}
