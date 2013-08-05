<?php

namespace Plista\Orp\Sdk\API;

use Plista\Vector\Context;

interface Service extends \Plista\Core\API\Service {

	// push updates to the algorithm

	function pushStatistic($algorithm, \VectorSequence $seq, $action);

	function pushItem($algorithm, \Item $item);

	function pushRequest($algorithm, Context $context);

	function pushFirc($algorithm, Context $context);


	// fetch recommendations

	/**
	 * @param string $algorithm
	 * @param \Plista\Vector\Context $context
	 * @param int $limit
	 * @return \Plista\Recommender\API\Response\ScoredItemList
	 */
	function fetchOnsite($algorithm, Context $context, $limit);

	/**
	 * @param string $algorithm
	 * @param \Plista\Vector\Context $context
	 * @param int $limit
	 * @return \Plista\Recommender\API\Response\ScoredItemList
	 */
	function fetchAd($algorithm, Context $context, $limit);


	// provide general information about the service

	/**
	 * @return string[]
	 */
	function listAlgorithms();

}