<?php
namespace Plista\Orp\Sdk\Example;
class ExampleUniversityModel  {
	/*
	*  In order to write the array in the specified file, its important to serialize() the array.
	*  If you want to file_get_contents be sure to unserialize() the content again.
	*  The single entries are separated by a \n
	*/

	const ITEM = 3;

	public function write_item($item) {

		$today = date("m.d.y");
		// writing items in file
		$res = file_put_contents('items_'. $today . '.txt',  serialize($item) .  "\n", FILE_APPEND | LOCK_EX );

		if (!$res) {
			die ('Error: Unable to write to item file :(');
		}
	}

	public function write_statistic($seq) {

		$today = date("m.d.y");
		// writing statistics in file
		$res = file_put_contents('statistic_'. $today . '.txt', serialize($seq).  "\n", FILE_APPEND | LOCK_EX );

		if (!$res) {
			die ('Error: Unable to write to statistic file :(');
		}
	}

	public function write_error($error) {
		$today = date("m.d.y");
		// writing errors in log file
		$res = file_put_contents('error_' . $today . '.txt',   serialize($error).  "\n", FILE_APPEND | LOCK_EX  );
		if (!$res) {
			die ('Error: Unable to write to error file :(');
		}
	}

	public function write_request($request) {
		$today = date("m.d.y");
		// writing requests in file
		$res = file_put_contents('request_'. $today . '.txt',   serialize($request).  "\n", FILE_APPEND | LOCK_EX  );

		if (!$res) {
			die ('Error: Unable to write to request file :(');
		}
	}

	public function fetch($request, $limit) {
		// record the request in file
		$this->write_request($request);
		// getting item_id
		$item_id = $request['recs']['ints'][self::ITEM];
		// using algorithm in order to generate a recommandation
		$result = $this->algorithm($request, $limit);

		$fetchOnsiteHandler = new ExampleUniversityFetchOnsiteHandler();
		$res = $fetchOnsiteHandler->fetchOnsite($item_id, $result);
		if (!$res) {
			die ('Error: unable to fetchOnsite with $item_id and $result :(');
		}
	}

	public function algorithm($request, $limit) {

		// here goes your algorithm

		return 2; //an example result
	}

}