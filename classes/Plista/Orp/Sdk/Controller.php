<?php
namespace Plista\Orp\Sdk;

use Plista\Orp\Algorithm\Base;
use string;

/**
 * SDK
 */
final class Controller {

	/**
	 * @var Handle[]
	 */
	private $handler = array();

	protected static $algorithm = 'Base';

	/**
	 * subscription to the live statistics from hpt.
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

		$msgtype = $_POST['type'];
		$json_string = $_POST['body'];

		switch ($msgtype) {
			case 'recommendation_request':
				$request = json_decode($json_string);
				$this->fetchOnsite($request);
				break;
			case 'event_notification':
				// parse $json into vectorsequence
				$context = json_decode($json_string);
				// look at notification type
				//$notitype = $context->type;
				$notitype = $context->getType()->getValue();

				switch ($notitype) {
					case 'click':
						// call handler with notification type
						//$handler->handleEvent($context, $notitype);
						$this->pushStatistic($context, $notitype);
						break;
					case 'impression':
						// call handler with notification type
						//$handler->handleEvent($context, $notitype);
						$this->pushStatistic($context, $notitype);
						break;
					case 'engagement':
						// call handler with notification type
						//$handler->handleEvent($context, $notitype);
						$this->pushStatistic($context, $notitype);
						break;
					case 'cpo':
						// call handler with notification type
						//$handler->handleEvent($context, $notitype);
						$this->pushStatistic($context, $notitype);
						break;
				}
				break;
			case 'item_update':
				$item = json_decode($json_string);
				//$handler->handleItem($item);
				$this->pushItem($item);
				break;
			case 'error_notification':
				$error = json_decode($json_string);
				//$handler->handleError($error);
				$this->pushError($error);
				break;
		}


		/*
		 * old json gateway
		 */
		/*
		if( isset($_POST['push'])) {
			$json_string = $_POST['push'];
			$object = VectorSequence::fromJson($json_string);

			if ($object->getType()->getValue() == "item") {
				$item = $object;
				$this->pushItem($algorithm, $item);
			}

			if ($object->getType()->getValue() == "statistic")
				// TODO
				$seq = $object;
				$this->pushStatistic(static::$algorithm, $seq, $action);

			if ($object->getType()->getValue() == "request")
				$context = $object;
				$this->pushRequest($algorithm, $context);

			if ($object->getType()->getValue() == "firc")
				$context = $object;
				$this->pushFirc($algorithm, $context);
		}

		if( isset($_POST['fetch'])) {
			$json_string = $_POST['fetch'];
			$object = VectorSequence::fromJson($json_string);
			if($object->getType()->getValue() == "onsite")
				$context = $object;
				$this->fetchOnsite($algorithm, $context, $limit);
			if($object->getType()->getValue() == "ad")
				$context = $object;
				$this->fetchAd($algorithm, $context, $limit);
		}

		if( isset($_POST['list'])) {
			$json_string = $_POST['list'];
			$object = VectorSequence::fromJson($json_string);
			if($object->getType()->getValue() == "algorithmus")
				$this->listAlgorithms();
		}
		 */

	}

	public function pushStatistic(EventNotification $seq, $notitype) {

		$caller = new $classname($seq);

		//before pushStatistic $caller
		/**
		 * @var /Plista/orp/Sdk/ExampleUniversityPushStatisticHandler $caller
		 */

		/* Exception handling */
		/*

		 if (!$caller->isSupported()) {
			throw new ControllerException('this action is not supported, callering this method was not useful');
		 }
		*/

		$caller->validate($seq);
		$caller->handle($seq, $notitype);
	}

	public function pushItem(ItemUpdate $item) {

		if (isset($this->handler['pushItem'])) {
			$caller = $this->handler['pushItem'];
		} else {
			$classname = '\\Plista\\Orp\\Algorithm\\' . $algorithm . '\\pushItem';

			// before PushItem $caller
			/**
			 * @var /Plista/orp/Sdk/ExampleUniversityItemPushHandler $caller
			 */
			$caller = new $classname($item);
		}

		$caller->validate($item);
		$caller->handle($item);

	}

	public function pushError(ErrorNotification $error) {
		/**
		 * @var /Plista/orp/Sdk/ExampleUniversityPushErrorHandler $caller
		 */
		$caller = new $classname($error);
		$caller->handle($error);
	}


	/**
	 * @param int $limit
	 */


	public function fetchOnsite(RecommendationRequest $request) {


		$classname = '\\Plista\\Orp\\Algorithm\\' . $algorithm . '\\FetchOnsite';

		// before fetchOnsite $caller
		/**
		 * @var /Plista/orp/Sdk/ExampleUniversityFetchOnsiteHandler $caller
		 */
		$caller = new $classname($request);
		$caller->handle($request);

	}


	public function setHandler($method, Handle $object) {
		$this->handler[$method] = $object;

	}

}

