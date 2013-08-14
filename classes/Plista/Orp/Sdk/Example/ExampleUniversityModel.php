<?php
namespace Plista\Orp\Sdk\Example;
class ExampleUniversityModel  {
	/*
	*  In order to write the array in the specified file, its important to serialize() the array.
	*  If you want to file_get_contents be sure to unserialize() the content again.
	*  Single entries are separated by a "\n"
	*/

	const ITEM = 3;

	// if you want to save the files in a specific directory, you may want to adapt $path
	public $path = '';  // z.B. /home/user/plista/orp/


	public function write_item($item) {

		$today = date("m.d.y");
		// writing items in file
		$res = file_put_contents($this->path . 'items_'. $today . '.txt',  serialize($item) .  "\n", FILE_APPEND | LOCK_EX );

		if (!$res) {
			die ('Error: Unable to write to item file :(');
		}
	}

	public function write_LastItemId($item_id) {
		// writing the current item_id in file
		// the file is supposed to contain only the last ID
		$res = file_put_contents($this->path . 'LastItemId.txt',  $item_id,  LOCK_EX );

		if (!$res) {
			die ('Error: Unable to write to item file :(');
		}
	}

	public function write_statistic($seq) {

		$today = date("m.d.y");
		// writing statistics in file
		$res = file_put_contents($this->path . 'statistic_'. $today . '.txt', serialize($seq).  "\n", FILE_APPEND | LOCK_EX );

		if (!$res) {
			die ('Error: Unable to write to statistic file :(');
		}
	}

	public function write_error($error) {
		$today = date("m.d.y");
		// writing errors in log file
		$res = file_put_contents($this->path . 'error_' . $today . '.txt',   serialize($error).  "\n", FILE_APPEND | LOCK_EX  );
		if (!$res) {
			die ('Error: Unable to write to error file :(');
		}
	}

	public function write_request($request) {
		$today = date("m.d.y");
		// writing requests in file
		$res = file_put_contents($this->path . 'request_'. $today . '.txt',   serialize($request).  "\n", FILE_APPEND | LOCK_EX  );

		if (!$res) {
			die ('Error: Unable to write to request file :(');
		}
	}

	public function getItemId() {
		// reading the last item ID from file
		$item_id  = file_get_contents($this->path . 'LastItemId.txt');
		if (!$item_id) {
			die ('Error: Unable to write to request file :(');
		}
		return $item_id;
	}

	public function fetch($request, $limit) {
		// record the request in file
		$this->write_request($request);
		// getting item_id
		$item_id = $this->getItemId();
		if (!$item_id) {
			die ('Error: $item_id is not supposed to be null :(');
		}
		// using algorithm in order to generate a recommendation
		$result = $this->algorithm($request, $limit);

		$fetchOnsiteHandler = new ExampleUniversityFetchOnsiteHandler();
		$fetchOnsiteHandler->fetchOnsite($item_id, $result);

	}

	public function algorithm($request, $limit) {

		// here goes your algorithm

		return 2; //an example result
	}

}