<?php
namespace Plista\Orp\Sdk;

use Plista\Orp\Sdk\API\Response\ScoredItemList;
use Plista\Recommender\Algorithm\Base;
use Plista\Vector\Context;
use string;

/**
 * SDK
 */
final class Controller implements API\Service {  //ursprünglich ohne abstract

	/**
	 * subscription to the live statistics from hpt.
	 *
	 * @param string $algorithm one of the ALGORITHM_* constants
	 * @param \VectorSequence $seq
	 * @param string $action
	 * @throws ControllerException
	 */
	public function pushStatistic($algorithm, \VectorSequence $seq, $action) {

		$classname = '\\Plista\\Recommender\\Algorithm\\' . $algorithm . '\\StatsStream';

		/**
		 * @var \Plista\Recommender\Algorithm\Base\PushStatistic $caller
		 */
		$caller = new $classname($seq, $action);

		if (!$caller->isSupported()) {
			throw new ControllerException('this action is not supported, callering this method was not useful');
		}

		$caller->validate();
		$caller->push();
	}
	public function handle() {
		/**
		 * 	OAuth authentification
		 */
		//	POST https://orp.plista.com/api?id=ResearcherID
		//	Authorization: /* OAuth 2.0 token here */
		//	Content-Type: application/json

		//$json_string = file_get_contents("php://orp.plista.com/api.php?id=yourID");


		if( isset($_POST['push']))
		{
			$json_string = $_POST['push'];
			$object = VectorSequence::fromJson($json_string);
			if($object->getType()->getTypeValue() == "item")
				pushItem($object);
			if($object->getType()->getTypeValue() == "request")
				pushRequest($object);
			if($object->getType()->getTypeValue() == "firc")
				pushFirc($object);
		}
		if( isset($_POST['fetch']))
		{
			$json_string = $_POST['fetch'];
			$object = VectorSequence::fromJson($json_string);
			if($object->getType()->getTypeValue() == "onsite")
				fetchOnsite($object);
			if($object->getType()->getTypeValue() == "ad")
				fetchAd($object);
		}
		if( isset($_POST['list']))
		{
			$json_string = $_POST['list'];
			$object = VectorSequence::fromJson($json_string);
			if($object->getType()->getTypeValue() == "algorithmus")
				listAlgorithms($object);
		}
	}

	function pushItem($algorithm, \Item $item) {
		// TODO: Implement pushItem() method.


		/**
		 * if user want to store data in database..
		 */
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
			$db_query= "INSERT INTO user (ISP, OS)  VALUES ('$object->getContext()->getIsp()', '$object->getContext()->getOs()')";
			if(mysql_query($db_query) === TRUE) {
				echo '<font color="#008000">Writing SQL Data was successful ! </font>';
			}
			else{
				echo '<font color="#ff0000">Unable to insert data in specified table: </font>' . mysql_error();
			}

			// terminate the db connection
			$db_close = mysql_close($dbhandle);


		}

		return new $item;

	}

	function pushRequest($algorithm, Context $context) {
		// TODO: Implement pushRequest() method.
		//$context;

		return new $context;


	}

	function pushFirc($algorithm, Context $context) {
		// TODO: Implement pushFirc() method.

		return new $context;
	}

	/**
	 * @param string $algorithm
	 * @param \Plista\Vector\Context $context
	 * @param int $limit
	 * @return \Plista\Recommender\API\Response\ScoredItemList
	 */
	function fetchOnsite($algorithm, Context $context, $limit) {
		// TODO: Implement fetchOnsite() method.

		//using $algorithm to get $limit of $context

		return new $limit;
	}

	/**
	 * @param string $algorithm
	 * @param \Plista\Vector\Context $context
	 * @param int $limit
	 * @return \Plista\Recommender\API\Response\ScoredItemList
	 */
	function fetchAd($algorithm, Context $context, $limit) {
		// TODO: Implement fetchAd() method.

		// using $algorithmus to get $limit of $context

		return new ScoredItemList();
	}

	/**
	 * @return string[]
	 */
	function listAlgorithms() {
		// TODO: Implement listAlgorithms() method.

		return new string[];
	}
}