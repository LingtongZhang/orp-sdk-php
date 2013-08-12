<?php
namespace Plista\Orp\Sdk;


class Type {

	/**
	 * @var string
	 */
	private $data;

	public function __construct($data) {
		$this->data = $data;
	}

	/**
	 * possible values are [impression, click, ...]
	 * @return string
	 */
	public function getValue() {
		return $this->data;
	}
}