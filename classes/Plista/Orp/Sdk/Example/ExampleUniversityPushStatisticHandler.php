<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jannik
 * Date: 12.08.13
 * Time: 16:07
 * To change this template use File | Settings | File Templates.
 */
namespace Plista\Orp\Sdk\Example;
class ExampleUniversityPushStatisticHandler extends \Plista\Orp\Algorithm\Base\PushStatistic {

	public function handle($body) {
		/**
		 * @var ExampleUniversityModel $model
		 */

		$model = new ExampleUniversityModel();
		$model->write_statistic($body);
	}

	public function validate($seq) {
		if (empty($data['notification_type'])) {
			throw new Exception('Error: empty notification type');
		} else {
			return true;
		}
	}
}