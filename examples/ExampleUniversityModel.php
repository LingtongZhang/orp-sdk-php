<?php

class ExampleUniversityModel  {

	public function write($context) {
		$db_file = "db_file.txt";
		$fh = fopen($db_file, 'w') or die("can't open file");
		$stringData = $context;
		fwrite($fh, $stringData);
		fclose($fh);
	}
}