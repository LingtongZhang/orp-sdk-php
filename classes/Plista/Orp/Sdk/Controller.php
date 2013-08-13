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

		if ($type == 'recommendation_request' || 'event_notification' || 'item_update' || 'error_notification') {

			$body = json_decode($body, true);

			if(is_array($body) == false) {
				throw new Exception ('Error: body is not an array! ');
			}


			switch ($type) {
				case 'recommendation_request':
					if (empty($this->handler['fetchOnsite'])) {
						throw new Exception('Error: no handler registered for fetchOnsite');
					}
					$handler = $this->handler['fetchOnsite'];

					$handler->validate();
					$handler->handle($body);

					break;
				case 'event_notification':

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
							//$handler->handleEvent($context, $notitype);
							$this->pushStatistic($body, $notitype);
							break;
						case 'impression':
							// call handler with notification type
							//$handler->handleEvent($context, $notitype);
							$this->pushStatistic($body, $notitype);
							break;
						case 'engagement':
							// call handler with notification type
							//$handler->handleEvent($context, $notitype);
							$this->pushStatistic($body, $notitype);
							break;
						case 'cpo':
							// call handler with notification type
							//$handler->handleEvent($context, $notitype);
							$this->pushStatistic($body, $notitype);
							break;
					}
					*/

					break;
				case 'item_update':
					if (empty($this->handler['item_update'])) {
						throw new Exception('Error: no handler registered for item_update');
					}
					$handler = $this->handler['item_update'];

					$handler->validate();
					$handler->handle($body);

					break;
				case 'error_notification':
					if (empty($this->handler['error_notification'])) {
						throw new Exception('Error: no handler registered for error_notification');
					}
					$handler = $this->handler['error_notification'];

					$handler->validate();
					$handler->handle($body);

					break;
			}
		} else {
		 	throw new Exception ('Error: the type is not supported');
		}


	}

	public function setHandler($method, Handle $object) {
		$this->handler[$method] = $object;
	}

}

