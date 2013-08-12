<?php
namespace Plista\Orp\Sdk;

use Plista\Orp;
use Plista\Orp\Algorithm;

/**
 * describe the recommender in the Fetch class
 *
 * general
 * - ensemble will take care of parallelization
 * - ensemble will take care of caching
 * - more general concepts should be put into extra packages (see kornakapi model)
 *
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
	 * The keys that make the recommendation unique.
	 */
	public abstract function getPersistenceSettings();


	/**
	 * @param int $limit
	 */
	public abstract function fetch($limit);
}