<?php

class ExampleUniversityItemPushHandler extends \Plista\Orp\Sdk\Algorithm\Base\FetchOnsite {

	const SCORE = 2;
	const ITEM = 3;

	public function handle($request) {
		/**
		 * @var ExampleUniversityModel $model
		 */
		$limit = $request->limit;

		$model = new Model();
		$model->fetch($request, $limit);
	}


	private $data;

	public function fetch($request_id, $result) {

		$this->data['recs']['ints'][self::ITEM] = $request_id;
		$this->data['recs']['floats'][self::SCORE] = $result;
		return $this->data;
	}

	public function fetchOnsite($request_id, $result) {
		$object = $this->fetch($request_id, $result);
		$recommendation_proposal = curl_init($this->getPostData($object));
		curl_exec($recommendation_proposal);
			or throw new Exception('Could not response proposal :( .');
	}

	public function toJSON($object) {
		$json_string = json_encode($object);

		if ($json_string === false) {
			throw new Exception('Could not encode message to JSON :( .');
		}

		return $json_string;
	}

	public function getPostData($object) {
		return array(
			'body' => $this->toJSON($object)
		);
	}

}
