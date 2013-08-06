<?php
namespace Plista\Orp\Sdk;

use Plista\Orp;
use Plista\Orp\Algorithm;

/**
 * subscription to item updates
 * might be used by content based recommender services like Lucene to update the database
 */
abstract class PushItem extends Algorithm\Handle {

	/**
	 * @var \Item
	 */
	private $item;

	/**
	 * @param \Item $item
	 */
	public function __construct(\Item $item) {
		$this->item = $item;
	}

	/**
	 * @return \Item
	 */
	protected function getItem() {
		return $this->item;
	}

	/**
	 * validate the current request
	 * @return boolean
	 * @throws \Plista\Recommender\Algorithm\Exception
	 */
	public function validate() {
		return true;
	}

	/**
	 * @return void
	 */
	public abstract function push();
}