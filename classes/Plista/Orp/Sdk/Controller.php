<?php
namespace Plista\Orp\Sdk;

use Plista\Orp\Algorithm\Base;
use string;

/**
 * This class represents the controller for handling the different types of json data
 */
final class Controller {

	/**
	 * @var Handle[]
	 */
	private $handler = array();

	/**
	 * subscription to the live statistics from hpt.
	 * @param string $type the type of the incoming message ($_POST['type'])
	 * @param string $body a json encoded message
	 * @throws ControllerException
	 */
	public function handle($type, $body) {
		// Checking if the type of the JSON is supported
		if ($type == 'recommendation_request' || $type == 'event_notification' || $type == 'item_update' || $type == 'error_notification') {



			//if so, decode the json (work with arrays)
			$body = json_decode($body,true);

			// catching unexcepted errors during the decoding of the json string
			// may want to enable if json_decode returns null
			/*
			$json_errors = array(
				JSON_ERROR_NONE => 'No error has occurred',
				JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded',
				JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
				JSON_ERROR_SYNTAX => 'Syntax error',
			);
			$res =  'Last error : '. $json_errors[json_last_error()]. PHP_EOL. PHP_EOL;
			echo $res;
			*/

			//check if the body of the JSON is an array
			if( ! is_array($body)) {
				// if not throw an exception
				throw new Exception ('Error: body is not an array! ');
			}

			// using a gateway to handle the different types
			switch ($type) {
				case 'recommendation_request':
					// checking for emptyness of handler
					if (empty($this->handler['recommendation_request'])) {
						throw new Exception('Error: no handler registered for recommendation_request');
					}
					$handler = $this->handler['recommendation_request'];
					// validate the body data regarding the type based specifications
					$handler->validate($body);
					// handling the body data regarding the type based specifications
					$handler->handle($body);

					break;
				case 'event_notification':
					// checking for emptyness of handler
					if (empty($this->handler['event_notification'])) {
						throw new Exception('Error: no handler registered for event_notification');
					}
					$handler = $this->handler['event_notification'];
					// validate the body data regarding the type based specifications
					$handler->validate($body);
					// handling the body data regarding the type based specifications
					$handler->handle($body);

					// Gateway for notification types - optional
					/*
					// get notification type
					$notitype = $body->getType()->getValue();
					// differentiate between the specified notification types
					switch ($notitype) {
						case 'click':
							// call handler with notification type
							$handler->handle($body, $notitype);
							break;
						case 'impression':
							// call handler with notification type
							$handler->handle($body, $notitype);
							break;
						case 'engagement':
							// call handler with notification type
							$handler->handle($body, $notitype);
							break;
						case 'cpo':
							// call handler with notification type
							$handler->handle($body, $notitype);
							break;
					}
					*/

					break;
				case 'item_update':
					// checking for emptyness of handler
					if (empty($this->handler['item_update'])) {
						throw new Exception('Error: no handler registered for item_update');
					}
					$handler = $this->handler['item_update'];
					// validate the body data regarding the type based specifications
					$handler->validate($body);
					// handling the body data regarding the type based specifications
					$handler->handle($body);

					break;
				case 'error_notification':
					// checking for emptyness of handler
					if (empty($this->handler['error_notification'])) {
						throw new Exception('Error: no handler registered for error_notification');
					}
					$handler = $this->handler['error_notification'];
					// validate the body data regarding the type based specifications
					$handler->validate($body);
					// handling the body data regarding the type based specifications
					$handler->handle($body);

					break;
			}
		} else {
			// if type is not supported, throw an exception
		 	throw new Exception ('Error: the type is not supported');
		}
	}

	public function setHandler($method, Handle $object) {
		$this->handler[$method] = $object;
	}

}

