<?php
namespace Plista\Orp\Sdk\Example;

class ExampleUniversityItemPushHandler extends \Plista\Orp\Algorithm\Base\PushItem {

	public function handle($item) {

		/**
		 * @var ExampleUniversityModel $model
		 */

		$model = new ExampleUniversityModel();
		$model->write_item($item);

	}
}