<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jannik
 * Date: 12.08.13
 * Time: 16:09
 * To change this template use File | Settings | File Templates.
 */
namespace Plista\Orp\Sdk\Example;
class ExampleUniversityPushErrorHandler {

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