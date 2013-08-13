<?php

class ExampleUniversityItemPushHandler extends \Plista\Orp\Sdk\Algorithm\Base\PushItem {

	public function handle($item) {

		/**
		 * @var ExampleUniversityModel $model
		 */

		$model = new ExampleUniversityModel();
		$model->write_item($item);



	}
}