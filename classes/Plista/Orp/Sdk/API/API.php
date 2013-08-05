<?php

namespace Plista\Orp\Sdk\API;

use Plista\Vector\Context;

class API extends \Plista\Core\API\Consumer\API implements Service {

	function pushStatistic($algorithm, \VectorSequence $seq, $action) {
		throw new Exception('not implemented here');
	}

	function pushItem($algorithm, \Item $item) {
		throw new Exception('not implemented here');
	}

	function pushRequest($algorithm, Context $context) {
		throw new Exception('not implemented here');
	}

	function pushFirc($algorithm, Context $context) {
		throw new Exception('this method can not be called remotely');
	}

	function fetchOnsite($algorithm, Context $context) {
		// TODO: Implement fetchOnsite() method.
	}

	function fetchAd($algorithm, Context $context) {
		// TODO: Implement fetchAd() method.
	}

	function listAlgorithms() {
		// TODO: call remote service and ask for algorithms

	}
}
