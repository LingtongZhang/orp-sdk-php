<?php

class ExampleUniversityModel  {


	public function write_item($item) {

		$today = date("m.d.y");
		file_put_contents('items_'. $today . '.txt', $item, FILE_APPEND | LOCK_EX )
			or die ('Unable to write to item file :(');
	}

	public function write_statistic($seq, $notitype) {

		$today = date("m.d.y");
		file_put_contents('statistic_'. $today . '.txt', $seq, FILE_APPEND | LOCK_EX )
		or die ('Unable to write to statistic file :(');
	}

	public function write_error($error) {
		// writing errors in log file
		file_put_contents('log.txt',  $error )
			or die ('Unable to write to log file :(');
	}

	public function write_request($request) {
		// writing requests in request file
		file_put_contents('request_'. $today . '.txt',  $request )
		or die ('Unable to write to log file :(');
	}

	public function fetch($request, $limit) {
		$this->write_request($request);
		$request_id = $request['recs']['ints'][self::ITEM];

		$result = $this->algorithm($request, $limit);
		/**
		 * @var ExampleUniversityItemPushHandler $fetchHandler
		 */
		$fetchHandler->fetchOnsite($request_id, $result );
	}

	public function algorithm($request, $limit) {

		// here goes your algorithm

		return 2; //an example result
	}

}