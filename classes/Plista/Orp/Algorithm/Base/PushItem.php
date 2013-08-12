<?php
namespace Plista\Orp\Sdk;

use Plista\Orp;
use Plista\Orp\Algorithm;

/**
 * subscription to item updates
 * might be used by content based recommender services like Lucene to update the database
 */
abstract class PushItem {

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


	public function toJSON() {
		$json = json_encode($this->getItem());

		if ($json === false) {
			throw new Exception('Could not encode message to JSON :( .');
		}

		return $json;
	}

	public function getPostData() {
		return array(
			'body' => $this->toJSON()
		);
	}

	public abstract function push();
}