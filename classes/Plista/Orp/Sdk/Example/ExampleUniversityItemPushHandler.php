<?php
namespace Plista\Orp\Sdk\Example;

class ExampleUniversityItemPushHandler /*extends \Plista\Orp\Algorithm\Base\PushItem */ {

	public function handle($item) {

		/**
		 * @var ExampleUniversityModel $model
		 */

		$model = new ExampleUniversityModel();
		// writing body informations to file
		$model->write_item($item);

	}

	public function validate($item) {
		if (empty($item)) {
			throw new Exception('Error: item is empty');
		} else {
			return true;
		}
	}

}