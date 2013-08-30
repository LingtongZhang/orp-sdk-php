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
			throw new ValidationException('Error: error_message is empty');
		}

		return true;
	}
}