<?php

class ExampleUniversityItemPushHandler extends \Plista\Orp\Sdk\Algorithm\Base\PushItem {

	public function push() {
		$model = new Model(); // dateinamen aus date(d-m-y)
		$model->fetch(); // file_put_contents(...)
	}
}