<?php
namespace Plista\Orp\Sdk;

use Plista\Orp;
use Plista\Orp\Algorithm;

/**
 *  This is the base class for any Firc Stream Handle.
 */
abstract class PushFirc extends Algorithm\Handle {

	/**
	 * @var string
	 */
	public $firc_hash = '';

	/**
	 * validate the current request
	 * @return boolean
	 * @throws \Plista\Recommender\Algorithm\Exception
	 */
	public function validate() {
		return true;
	}

	/**
	 * @return void
	 */
	public abstract function push();
}