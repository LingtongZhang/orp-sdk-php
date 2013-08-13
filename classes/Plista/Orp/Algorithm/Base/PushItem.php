<?php
//namespace Plista\Orp\Sdk;
namespace Plista\Orp\Algorithm\Base;
use Plista\Orp;
use Plista\Orp\Algorithm;

/**
 * subscription to item updates
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
	 */
	public function validate() {
		return true;
	}

	public abstract function push();

	/*
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

	public function push() {  				 // ursp. public abstract function
		$ItemUpdate = curl_init($this->getPostData());
		curl_exec($ItemUpdate);
			or throw new Exception('Could not response Proposal :( .');
	}
	*/
}