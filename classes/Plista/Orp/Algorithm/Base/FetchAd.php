<?php
namespace Plista\Orp\Sdk;

/**
 * fetchs the ad recommendations
 * caching should be done somewhere else
 * @package Plista\Recommender\Algorithm\Base
 */
interface FetchAd {

	/**
	 * @param int $limit
	 */
	public function fetch($limit);

}