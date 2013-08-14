<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jannik
 * Date: 12.08.13
 * Time: 16:07
 * To change this template use File | Settings | File Templates.
 */
namespace Plista\Orp\Sdk\Example;
class ExampleUniversityPushStatisticHandler /* extends \Plista\Orp\Algorithm\Base\PushStatistic */ {

	public function handle($body) {
		/**
		 * @var ExampleUniversityModel $model
		 */

		$model = new ExampleUniversityModel();
		// writing body informations to file
		$model->write_statistic($body);
	}

	public function validate($body) {
		// checking if body contains a notification type
		// additionally one is able to differentiate between a click, impression, engagement and cpo
		// for futher details may have a look at the controller gateway for notification types
		if (empty($body['notification_type'])) {
			throw new Exception('Error: empty notification type');
		} else {
			return true;
		}
	}
}