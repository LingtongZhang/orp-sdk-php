<?php

class ExampleUniversityItemPushHandler extends \Plista\Orp\Sdk\Algorithm\Base\PushItem {

	public function push($item) {


		/**
		 * @var ExampleUniversityModel $model
		 */

		$model = new Model(); // dateinamen aus date(d-m-y)
		$model->write_item($item); // file_put_contents(...)





	}
}