<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jannik
 * Date: 12.08.13
 * Time: 16:07
 * To change this template use File | Settings | File Templates.
 */

class ExampleUniverstiyPushStatistic extends \Plista\Orp\Sdk\Algorithm\Base\PushStatistic {

	public function handle($seq, $notitype) {
		/**
		 * @var ExampleUniversityModel $model
		 */

		$model = new Model(); // dateinamen aus date(d-m-y)
		$model->write_statistic($seq, $notitype); // file_put_contents(...)

	}
}