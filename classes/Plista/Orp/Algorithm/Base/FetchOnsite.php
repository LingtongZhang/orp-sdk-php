<?php
namespace Plista\Orp\Sdk;

/**
 * fetchs the onsite recommendations
 * caching should be done somewhere else
 * @package Plista\Orp\Algorithm\Base
 */
interface FetchOnsite {


	/**
	 * @param int $limit
	 */
	public function fetch($limit) {

	}

	public function fetchOnsite($limit) {
		return $this->fetch($limit);
	}

	public function validate();


}