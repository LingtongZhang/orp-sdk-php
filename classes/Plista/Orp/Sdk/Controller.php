<?php
namespace Plista\Orp\Sdk;

use Plista\Recommender\Algorithm\Base;
use Plista\Vector\Context;

/**
 * SDK
 */
final class Controller implements API\Service {

	/**
	 * subscription to the live statistics from hpt.
	 *
	 * @param string $algorithm one of the ALGORITHM_* constants
	 * @param \VectorSequence $seq
	 * @param string $action
	 * @throws ControllerException
	 */
	public function pushStatistic($algorithm, \VectorSequence $seq, $action) {

		$classname = '\\Plista\\Recommender\\Algorithm\\' . $algorithm . '\\StatsStream';

		/**
		 * @var \Plista\Recommender\Algorithm\Base\PushStatistic $caller
		 */
		$caller = new $classname($seq, $action);

		if (!$caller->isSupported()) {
			throw new ControllerException('this action is not supported, callering this method was not useful');
		}

		$caller->validate();
		$caller->push();
	}
}