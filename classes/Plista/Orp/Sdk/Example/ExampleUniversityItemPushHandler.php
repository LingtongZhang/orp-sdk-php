<?php
namespace Plista\Orp\Sdk\Example;
use Plista\Orp\Sdk\Handle;

class ExampleUniversityItemPushHandler implements Handle {

	public function handle($item) {
		/**
		 * @var ExampleUniversityModel $model
		 */
		$item_id = $item['id'];
		$publisherid = $item['domainid'];

		$model = new ExampleUniversityModel();
		// writing body informations to file
		$model->write_item($item_id , $publisherid);
	}

	public function validate($item) {
		if (empty($item)) {
			throw new Exception('Error: item is empty');
		}

		if (empty($item['id'])) {
			throw new Exception('Error: Item ID is empty');
		}

		if (empty($item['domainid'])) {
			throw new Exception('Error: Domain ID is empty');
		}

		return true;
	}
}