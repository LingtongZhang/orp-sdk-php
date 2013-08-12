<?php
namespace Plista\Orp\Sdk;

use Plista\Orp;
use Plista\Orp\Algorithm;

/**
 * subscription for all events when this recommender is being used
 * might be used to trigger updates of the model (based on priority)
 */
abstract class PushRequest extends Algorithm\Handle {

	/**
	 * subscription to recommendation requests
	 * @throws \Plista\Recommender\Algorithm\Exception
	 */
	public function validate() {
		// TODO: please clarify the intention of this method! is it used to validate a specific request passed
		// in the constructor or is it used to indicate whether a certain algorithm supports these kinds of updates?
		// the latter would imply that every algorithm needs to implement this class, which i am strongly against.
		throw new Algorithm\Exception('PushRequests not supported');
	}

	/**
	 * @return void
	 */
	abstract public function push();
}