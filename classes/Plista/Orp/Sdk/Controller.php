<?php
namespace Plista\Orp\Sdk;

use Plista\Orp\Algorithm\Base;
use Plista\Vector\Context;
use string;

/**
 * SDK
 */
final class Controller implements API\Service {  //ursprünglich ohne abstract

	/**
	 * @var Handle[]
	 */
	private $handler = array();

	/**
	 * subscription to the live statistics from hpt.
	 *
	 * @param string $algorithm one of the ALGORITHM_* constants
	 * @param \VectorSequence $seq
	 * @param string $action
	 * @throws ControllerException
	 */

	public function handle() {
		/**
		 * 	OAuth authentification
		 */
		//	POST https://orp.plista.com/api?id=ResearcherID
		//	Authorization: /* OAuth 2.0 token here */
		//	Content-Type: application/json

		// to get value as string from remote site
		// $json_string = file_get_contents("php://orp.plista.com/api.php?id=yourID");

		// values not specified which are supposed to check
		// @todo: discuss with tobi, how this data is provided
		if( isset($_POST['push']))
		{
			$json_string = $_POST['push'];
			$object = VectorSequence::fromJson($json_string);
			if($object->getType()->getValue() == "item")
				$item = $object;
				$this->pushItem($algorithm, $item);
			if($object->getType()->getValue() == "statistic")
				$seq = $object;
				$this->pushStatistic($algorithm, $seq, $action);
			if($object->getType()->getValue() == "request")
				$context = $object;
				$this->pushRequest($algorithm, $context);
			if($object->getType()->getValue() == "firc")
				$context = $object;
				$this->pushFirc($algorithm, $context);
		}
		if( isset($_POST['fetch']))
		{
			$json_string = $_POST['fetch'];
			$object = VectorSequence::fromJson($json_string);
			if($object->getType()->getValue() == "onsite")
				$context = $object;
				$this->fetchOnsite($algorithm, $context, $limit);
			if($object->getType()->getValue() == "ad")
				$context = $object;
				$this->fetchAd($algorithm, $context, $limit);
		}
		if( isset($_POST['list']))
		{
			$json_string = $_POST['list'];
			$object = VectorSequence::fromJson($json_string);
			if($object->getType()->getValue() == "algorithmus")
				$this->listAlgorithms();
		}
	}
	public function pushStatistic($algorithm, \VectorSequence $seq, $action) {

		$classname = '\\Plista\\Orp\\Algorithm\\' . $algorithm . '\\pushStatistic';

		$caller = new $classname($seq, $action);
		/**
		 * @var pushStatistic $caller
		 */
		if (!$caller->isSupported()) {
			throw new ControllerException('this action is not supported, callering this method was not useful');
		}

		$caller->validate();
		$caller->push();
	}

	function pushItem($algorithm, \Item $item) {

		if (isset($this->handler['pushItem'])) {
			$caller = $this->handler['pushItem'];
		} else {
			$classname = '\\Plista\\Orp\\Algorithm\\' . $algorithm . '\\pushItem';

			/**
			 * @var PushItem $caller
			 */
			$caller = new $classname($item);
		}


		$caller->validate();
		$caller->push();

		/**
		 * if user want to store data in database..
		 *  ... under construction...
		 */

		/*
		if(sql_storage === True)
		{
			//specify DB settings
			$db_username = "plista_orp_user";
			$db_database = "plista_orp";
			$db_host = "localhost"; // in general localhost is used
			$db_password = "123456";


			// conntecting to MySQL DB
			$db_connect = mysql_connect($db_host, $db_username, $db_password)
			or die('<font color="#ff0000">Unable to connect to MySQL: </font> '  . mysql_error() );
			echo '<font color="#008000">Connected to MySQL successfully! </font><br><br>';

			// choose and select Database
			mysql_select_db($db_database, $db_connect)
			or die('<font color="#ff0000">Could not select database. Please have a look at your configs </font>.. :(');

			// writing data in MySQL DB
			// manually and local assignment of numbers to original name
			$db_query= "INSERT INTO user (ISP, OS)  VALUES ('$object->getContext()->getIsp()', '$object->getContext()->getOs()')"; //add additionally values
			if(mysql_query($db_query) === TRUE) {
				echo '<font color="#008000">Writing SQL Data was successful ! </font>';
			}
			else{
				echo '<font color="#ff0000">Unable to insert data in specified table: </font>' . mysql_error();
			}

			// terminate the db connection
			$db_close = mysql_close($dbhandle);


		}
		*/
	}

	function pushRequest($algorithm, Context $context) {

		$classname = '\\Plista\\Orp\\Algorithm\\' . $algorithm . '\\pushRequest';

		/**
		 * @var pushRequest $caller
		 */
		$caller = new $classname($context);
		$caller->validate();
		$caller->push();
	}

	function pushFirc($algorithm, Context $context) {

		$classname = '\\Plista\\Orp\\Algorithm\\' . $algorithm . '\\PushFirc';

		/**
		 * @var pushFirc $caller
		 */
		$caller = new $classname($context);
		$caller->validate();
		$caller->push();
	}

	/**
	 * @param string $algorithm
	 * @param \Plista\Vector\Context $context
	 * @param int $limit
	 * @return \Plista\Recommender\API\Response\ScoredItemList
	 */


	function fetchOnsite($algorithm, Context $context, $limit) {

		$classname = '\\Plista\\Orp\\Algorithm\\' . $algorithm . '\\FetchOnsite';

		/**
		 * @var fetchOnsite $caller
		 */
		$caller = new $classname($context);
		$caller->validate();

		return $caller->fetch($limit);
	}


	/**
	 * @param string $algorithm
	 * @param \Plista\Vector\Context $context
	 * @param int $limit
	 * @return \Plista\Recommender\API\Response\ScoredItemList
	 */
	function fetchAd($algorithm, Context $context, $limit) {

		$classname = '\\Plista\\Orp\\Algorithm\\' . $algorithm . '\\FetchAd';

		/**
		 * @var fetchAd $caller
		 */
		$caller = new $classname($context);
		$caller->validate();

		return $caller->fetchAd($limit);
	}

	/**
	 * @return string[]
	 */
	function listAlgorithms() {

		$class = new \ReflectionClass($this);
		$constants = $class->getConstants();

		return array_values($constants);
	}


	public function setHandler($method, Handle $object) {
		$this->handler[$method] = $object;

	}

}

