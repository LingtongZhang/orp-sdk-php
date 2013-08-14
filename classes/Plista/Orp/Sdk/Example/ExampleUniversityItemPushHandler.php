<?php
namespace Plista\Orp\Sdk\Example;
use Plista\Orp\Sdk\Handle;

class ExampleUniversityItemPushHandler implements Handle /*extends \Plista\Orp\Algorithm\Base\PushItem */ {



	public function handle($item) {

		/**
		 * @var ExampleUniversityModel $model
		 */
		$item_id = $item['id'];
		$publisherid = $item['domainid'];

		$model = new ExampleUniversityModel();
		// writing body informations to file
		$model->write_item($item, $publisherid);
		$model->write_publisherid($publisherid);

	}

	public function validate($item) {
		if (empty($item)) {
			throw new Exception('Error: item is empty');
		} else {
			return true;
		}
	}

}