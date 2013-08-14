<?php
namespace Plista\Orp\Sdk;


class VectorSequence {

	/**
	 * @var string
	 */
	public $type;
	/**
	 * @var array
	 */
	public $context = array();
	/**
	 * @var array
	 */
	public $recs  = array();
	/**
	 * @var string
	 */
	public $timestamp;


	public function __construct() {
	}

	/**
	 * @param string $str
	 * @return \Plista\Orp\Sdk\VectorSequence
	 */
	public static function fromJson($str) {

		$data = json_decode($str, true);

		$instance = new self();
		$instance->setType($data['type']);
		$instance->setContext($data['context']);
		$instance->setRecs($data['recs']);
		$instance->setTimestamp($data['timestamp']);

		return $instance;
	}

	/**
	 * @param $type
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * @param $context
	 */
	public function setContext($context) {
		$this->context = $context;

	}

	/**
	 * @param $recs
	 */
	public function setRecs($recs) {
		$this->recs = $recs;

	}

	/**
	 * @param $timestamp
	 */
	public function setTimestamp($timestamp) {
		$this->timestamp = $timestamp;
	}

	/**
	 * @return Type
	 */
	public function getType() {
		return new Type($this->type);
	}
	/**
	 * @return Context
	 */
	public function getContext() {
		return new Context($this->context);
	}

	/**
	 * @return Recs
	 */
	public function getRecs() {
		return new Recs($this->recs);
	}

	/**
	 * @return Timestamp
	 */
	public function getTimestamp() {
		return new Timestamp($this->timestamp);
	}

}