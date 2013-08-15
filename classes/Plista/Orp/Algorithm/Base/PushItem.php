<?php
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
	 * @param $item \Item $item
	 */
	public function handle(\Item $item) {


	}

	/**
	 * validate the current request
	 * @param \Item $item
	 * @return boolean
	 */
	public function validate($item) {
		return true;
	}

}