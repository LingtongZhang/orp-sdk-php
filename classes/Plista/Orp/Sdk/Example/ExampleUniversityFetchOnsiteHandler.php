<?php
namespace Plista\Orp\Sdk\Example;
use Plista\Orp\Sdk\Handle;
use Plista\Orp\Sdk\Recs;

class ExampleUniversityFetchOnsiteHandler implements Handle {

	const SCORE = 2;
	const ITEM = 3;

	public function handle($request) {
		/**
		 * @var ExampleUniversityModel $model
		 */
		$limit = $request['limit'];

		try {
			$model = new ExampleUniversityModel();
			$result = $model->fetch($request, $limit);

			$recs = new Recs($result);
			
			// $model->write_recs($recs); // uncomment this line to have all recs logged to file
			return $recs;

		} catch(ValidationException $e) {
			// catch it ;)
		} catch(Exception $e) {
			// catch it ;)
		}
	}

	public function validate($data) {
		if (empty($data)) {
			throw new ValidationException('Error: request is empty');
		}

		return true;
	}
}
