<?php
namespace Plista\Orp\Sdk\API\Response;

/**
 * Class ScoredItemList
 * @package Plista\Recommender\Response
 */
class ScoredItemList extends \Plista\Core\API\Provider\Response {

	/**
	 * @var array
	 */
	private $array;

	/**
	 * keys will be ids, values will be scores
	 * @param array $array flat array
	 */
	public function __construct(array $array) {
		$this->array = $array;
	}

	/**
	 * @return array
	 */
	public function getArray() {
		return $this->array;
	}

	/**
	 * @return string a json representation of this object
	 */
	function toJSON() {
		return json_encode($this);
	}
}