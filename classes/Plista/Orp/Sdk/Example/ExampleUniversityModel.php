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

	public function write_item($item_id , $publisherid) {

		$today = date("m.d.y");
		// writing items in file
		$res = file_put_contents($this->path . $publisherid . '_items_'. $today . '.txt',  $item_id .  "\n", FILE_APPEND | LOCK_EX );

		if (!$res) {
			die ('Error: Unable to write to item file :(');
		}
	}

	public function write_publisherId($publisherid) {
		// writing the current item_id in file
		// the file is supposed to contain only the last ID
		$res = file_put_contents($this->path . 'publisherID.txt',   $publisherid,  LOCK_EX );

		if (!$res) {
			die ('Error: Unable to write to publisherID file :(');
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
		/* optional - if all request should be save to a file
		$today = date("m.d.y");
		// writing requests in file
		$res = file_put_contents($this->path . 'request_'. $today . '.txt',   serialize($request).  "\n", FILE_APPEND | LOCK_EX  );

		if (!$res) {
			die ('Error: Unable to write to request file :(');
		}
		*/
	}


	public function getPublisherId() {
		// reading the last item ID from file
		$publisherid  = file_get_contents($this->path . 'publisherID.txt');
		if (!$publisherid) {
			die ('Error: Unable to write to request file :(');
		}
		return $publisherid;
	}

	public function fetch($request, $limit) {
		// record the request in file
		$this->write_request($request);
		// getting item_id
		$publisherid = $this->getPublisherId();
		if (!$publisherid) {
			die ('Error: $item_id is not supposed to be null :(');
		}
		// using algorithm in order to generate a recommendation
		$item = $this->algorithm_item($request, $limit);
		$score = $this->algorithm_score($request, $limit);

		$fetchOnsiteHandler = new ExampleUniversityFetchOnsiteHandler();
		$fetchOnsiteHandler->fetchOnsite($score, $item);

	}

	/*
	 * Here goes your algorithm.
	 * You may want to have a look at current methodes like
	 * http://en.wikipedia.org/wiki/Collaborative_filtering
	 * http://en.wikipedia.org/wiki/Behavioral_targeting
	 */
	public function  algorithm_score($request, $limit) {
		// here goes your algorithm
		$c = 0;
		$score = array();
		// getting decreasing score
		while($c < $limit) {
			// handling if $c==0 to avoid dividing with 0
			if ($c==0) {
				$v =1;
			} else {
			$v = 1/$c;
			}
			$score[] = $v;
			$c++;
		}
		return $score;
	}

	public function algorithm_item($request, $limit) {
		// here goes your algorithm

		$item = array();
		$today = date("m.d.y");
		$publisherid = $this->getPublisherId();
		if (!$publisherid) {
			die ('Error: $item_id is not supposed to be null :(');
		}
		$file = file($this->path . $publisherid . '_items_'. $today . '.txt');
		$c = count($file)-$limit;
		$tc = count($file);
		// if the item file is empty or has less then $limit entries, PHP error will occur
		if ($tc < $limit) {
			throw new Exception ('Error: not enough entries in item file :(');
		}
		// getting the last $limit entries of file
		for (; $c < $tc; $c++) {
			$object = $file[$c];
			// getting rid of "\n"
			$item[] = rtrim($object);
		}
		return $item;
	}
}