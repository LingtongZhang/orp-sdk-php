<?php

class ExampleUniversityModel  {

	const ITEM = 3;

	public function write_item($item) {

		$today = date("m.d.y");
		// writing items in file
		$res = file_put_contents('items_'. $today . '.txt', $item, FILE_APPEND | LOCK_EX );

		if (!$res) {
			die ('Error: Unable to write to item file :(');
		}
	}

	public function write_statistic($seq) {

		$today = date("m.d.y");
		// writing statistics in file
		$res = file_put_contents('statistic_'. $today . '.txt', $seq, FILE_APPEND | LOCK_EX );

		if (!$res) {
			die ('Error: Unable to write to statistic file :(');
		}
	}

	public function write_error($error) {
		$today = date("m.d.y");
		// writing errors in log file
		$res = file_put_contents('log.txt',  $error );
		if (!$res) {
			die ('Error: Unable to write to error file :(');
		}
	}

	public function write_request($request) {
		$today = date("m.d.y");
		// writing requests in file
		$res = file_put_contents('request_'. $today . '.txt',  $request );

		if (!$res) {
			die ('Error: Unable to write to request file :(');
		}
	}

	public function fetch($request, $limit) {
		$this->write_request($request);
		$item_id = $request['recs']['ints'][self::ITEM];

		$result = $this->algorithm($request, $limit);

		$fetchOnsiteHandler = new ExampleUniversityFetchOnsiteHandler();
		$fetchOnsiteHandler->fetchOnsite($item_id, $result);
	}

	public function algorithm($request, $limit) {

		// here goes your algorithm

		return 2; //an example result
	}

}