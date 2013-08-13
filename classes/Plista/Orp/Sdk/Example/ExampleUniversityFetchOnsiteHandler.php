<?php
//namespace Plista\Orp\Sdk\Example;
class ExampleUniversityFetchOnsiteHandler extends \Plista\Orp\Sdk\Algorithm\Base\FetchOnsite {

	const SCORE = 2;
	const ITEM = 3;

	public function handle($request) {
		/**
		 * @var ExampleUniversityModel $model
		 */
		$limit = $request->limit;

		$model = new ExampleUniversityModel();
		$model->fetch($request, $limit);
	}


	private $data;

	public function fetch($item_id, $result) {

		$this->data['recs']['ints'][self::ITEM] = $item_id;
		$this->data['recs']['floats'][self::SCORE] = $result;
		return $this->data;
	}

	public function fetchOnsite($item_id, $result) {
		$object = $this->fetch($item_id, $result);
		$recommendation_proposal = $this->getPostData($object);
		return $recommendation_proposal;
	}

	public function toJSON($object) {
		$json_string = json_encode($object);

		if ($json_string === false) {
			throw new Exception('Error: Could not encode response to JSON :( .');
		}

		return $json_string;
	}

	public function getPostData($object) {
		return array(
			'body' => $this->toJSON($object)
		);
	}

}
