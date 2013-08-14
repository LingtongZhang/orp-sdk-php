<?php
namespace Plista\Orp\Sdk\Example;

class ExampleUniversityItemPushHandler /*extends \Plista\Orp\Algorithm\Base\PushItem */ {

	public $item_id;

	public function handle($item) {

		/**
		 * @var ExampleUniversityModel $model
		 */
		$item_id = $item['id'];

		$model = new ExampleUniversityModel();
		// writing body informations to file
		$model->write_item($item);
		$model->write_LastItemId($item_id);

	}

	public function validate($item) {
		if (empty($item)) {
			throw new Exception('Error: item is empty');
		} else {
			return true;
		}
	}

}