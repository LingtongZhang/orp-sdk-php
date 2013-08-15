<?php
namespace Plista\Orp\Sdk\Example;
use Plista\Orp\Sdk\Handle;

class ExampleUniversityFetchOnsiteHandler  implements Handle /*extends \Plista\Orp\Algorithm\Base\FetchOnsite*/ {

	const SCORE = 2;
	const ITEM = 3;

	public function handle($request) {
		/**
		 * @var ExampleUniversityModel $model
		 */
		$limit = $request['limit'];

		$model = new ExampleUniversityModel();
		$model->fetch($request, $limit);
	}


	private $data;

	public function fetch($item_id, $result) {
		// collecting item_id and result (recommendation)
		$this->data['recs']['ints'][self::ITEM] = $result;
		$this->data['recs']['floats'][self::SCORE] = $item_id;
		return $this->data;
	}

	public function fetchOnsite($item_id, $result) {
		// building structure of json response
		$object = $this->fetch($item_id, $result);
		// wrapping things up and getting ready to transmit
		$recommendation_proposal = $this->getPostData($object);
		//providing recommendation to plista
		print ($recommendation_proposal);
	}

	public function toJSON($object) {
		// encoding recommendation
		$json_string = json_encode($object);

		if ($json_string === false) {
			throw new Exception('Error: Could not encode response to JSON :( .');
		}
		return $json_string;
	}

	public function getPostData($object) {
		// returning json string
		return $this->toJSON($object);
	}

	public function validate($data) {
		if (empty($data)) {
			throw new Exception('Error: request is empty');
		} else {
			return true;
		}
	}

}
