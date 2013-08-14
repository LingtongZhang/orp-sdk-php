<?php
namespace Plista\Orp\Sdk\Example;
use Plista\Orp\Sdk\Handle;

class ExampleUniversityPushErrorHandler implements Handle  {

	public function handle($error) {
		/**
		 * @var ExampleUniversityModel $model
		 */

		$model = new ExampleUniversityModel();
		// writing body informations to file
		$model->write_error($error);
	}

	public function validate($error) {
		if (empty($error)) {
			throw new Exception('Error: error_message is empty');
		} else {
			return true;
		}
	}
}