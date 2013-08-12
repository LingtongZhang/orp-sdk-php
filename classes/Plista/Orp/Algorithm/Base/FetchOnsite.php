<?php
namespace Plista\Orp\Sdk;

/**
 * fetchs the onsite recommendations
 * caching should be done somewhere else
 * @package Plista\Orp\Algorithm\Base
 */
abstract class FetchOnsite {



	/**
	 * @param int $limit
	 */
	abstract public function fetch() {

	}

	abstract public  function fetchOnsite($limit) {

	}

	public function validate();


}
