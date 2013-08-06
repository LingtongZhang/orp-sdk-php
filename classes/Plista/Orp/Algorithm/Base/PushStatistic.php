<?php
namespace Plista\Orp\Sdk;

use Plista\Orp;
use Plista\Orp\Algorithm;

/**
 * subscription to the live statistics from hpt.
 * @package Plista\Recommender\Algorithm\Base
 */
abstract class PushStatistic extends Algorithm\Handle {
	/**
	 * @var string
	 */
	private $action;

	/**
	 * @var string[]
	 */
	protected $action_supported;

	/**
	 * @param \VectorSequence $seq
	 * @param string $action
	 */
	public function __construct(\VectorSequence $seq, $action) {
		$this->seq = $seq;
		$this->action = $action;
	}

	/**
	 * @return string
	 */
	public final function getAction() {
		return $this->action;
	}

	/**
	 * @return bool
	 */
	public final function isSupported() {
		return in_array($this->getAction(), $this->action_supported);
	}

	/**
	 * @throws \Plista\Recommender\Algorithm\Exception
	 */
	public function validate() {
		throw new Algorithm\Exception('StatsStream not supported');
	}

	/**
	 * @return void
	 */
	public abstract function push();
}