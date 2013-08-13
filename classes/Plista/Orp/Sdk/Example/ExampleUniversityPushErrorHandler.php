<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jannik
 * Date: 12.08.13
 * Time: 16:09
 * To change this template use File | Settings | File Templates.
 */

class ExampleUniversityPushError {

	public function handle($error) {
		/**
		 * @var ExampleUniversityModel $model
		 */

		$model = new ExampleUniversityModel();
		$model->write_error($error);
	}
}