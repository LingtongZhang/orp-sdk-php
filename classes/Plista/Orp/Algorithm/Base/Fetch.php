<?php
namespace Plista\Orp\Algorithm\Base;

use Plista\Orp;
use Plista\Orp\Algorithm;

/**
 * @package Plista\Orp\Algorithm\Base
 */
abstract class Fetch extends Plista\Orp\Sdk\Handle {

	/**
	 * validate the current request
	 * @return boolean
	 */
	public function validate() {
		// every request is valid per default
		return true;
	}

	/**
	 * @param int $limit
	 */
	public abstract function fetch($limit);
}