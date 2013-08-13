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

	/**
	 * subscription to the live statistics from hpt.
	 * @param string $type the type of the incoming message ($_POST['type'])
	 * @param string $body a json encoded message
	 * @throws ControllerException
	 */
	public function handle($type, $body) {
		// Checking if the type of the JSON is supported
		if ($type == 'recommendation_request' || 'event_notification' || 'item_update' || 'error_notification') {
			//if so, decode the json (work with arrays)
			$body = json_decode($body, true);

			//check if the body of the JSON is an array
			if(is_array($body) == false) {
				// if not throw an exception
				throw new Exception ('Error: body is not an array! ');
			}

			// using a gateway to handle the different types
			switch ($type) {
				case 'recommendation_request':
					// checking for emptyness of handler
					if (empty($this->handler['fetchOnsite'])) {
						throw new Exception('Error: no handler registered for fetchOnsite');
					}
					$handler = $this->handler['fetchOnsite'];

					$handler->validate();
					$handler->handle($body);

					break;
				case 'event_notification':
					// checking for emptyness of handler
					if (empty($this->handler['event_notification'])) {
						throw new Exception('Error: no handler registered for event_notification');
					}
					$handler = $this->handler['event_notification'];

					$handler->validate();
					$handler->handle($body);

					// Gateway for notification types
					/*
					// look at notification type
					//$notitype = $context->type;
					$notitype = $body->getType()->getValue();

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

					$handler->validate();
					$handler->handle($body);

					break;
				case 'error_notification':
					// checking for emptyness of handler
					if (empty($this->handler['error_notification'])) {
						throw new Exception('Error: no handler registered for error_notification');
					}
					$handler = $this->handler['error_notification'];

					$handler->validate();
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

