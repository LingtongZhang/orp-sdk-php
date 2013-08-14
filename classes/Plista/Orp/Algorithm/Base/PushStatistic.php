<?php
//namespace Plista\Orp\Sdk;
namespace Plista\Orp\Algorithm\Base;

use Plista\Orp;
use Plista\Orp\Algorithm;

/**
 * subscription to the live statistics from hpt.
 * @package Plista\Orp\Algorithm\Base
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
	public function __construct(EventNotification $seq, $notitype) {
		$this->seq = $seq;
		$this->notitype = $notitype;
	}

	/**
	 * @return string
	 */
	public final function getType() {
		return $this->notitype;
	}


	/**
	 * @throws \Plista\Orp\Algorithm\Exception
	 */
	public function validate() {
		throw new Algorithm\Exception('StatsStream not supported');
	}

	/**
	 * @return void
	 */
	public abstract function handle();
}