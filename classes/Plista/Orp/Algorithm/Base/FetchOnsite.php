<?php
namespace Plista\Orp\Sdk;

/**
 * fetchs the onsite recommendations
 * caching should be done somewhere else
 * @package Plista\Recommender\Algorithm\Base
 */
interface FetchOnsite {


	/**
	 * @param int $limit
	 */
	public function fetch($limit);
}