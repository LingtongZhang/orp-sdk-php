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
abstract class Fetch extends Algorithm\Handle {

	/**
	 * validate the current request
	 * @return boolean
	 * @throws \Plista\Recommender\Algorithm\Exception
	 */
	public function validate() {
		// every request is valid per default
		return true;
	}

	/**
	 * The keys that make the recommendation unique.
	 * @return Recommender\Ensemble\Persistence\Settings|null
	 */
	public abstract function getPersistenceSettings();


	/**
	 * @param int $limit
	 * @return Recommender\API\Response\ScoredItemList
	 */
	public abstract function fetch($limit);
}