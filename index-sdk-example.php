<?php
require_once(__DIR__ . '/config.php');

use Plista\Orp\Sdk\Example;
use Plista\Orp\Sdk\Example\ExampleUniversityItemPushHandler;
use Plista\Orp\Sdk\Example\ExampleUniversityFetchOnsiteHandler;
use Plista\Orp\Sdk\Example\ExampleUniversityPushErrorHandler;
use Plista\Orp\Sdk\Example\ExampleUniversityPushStatisticHandler;

// defining controller
$controller = new \Plista\Orp\Sdk\Controller();

//defining the handles
$handleItem = new ExampleUniversityItemPushHandler();
$handleRequest = new ExampleUniversityFetchOnsiteHandler();
$handleError = new ExampleUniversityPushErrorHandler();
$handleNotify = new ExampleUniversityPushStatisticHandler();

// assigning type to handle
$controller->setHandler('item_update', $handleItem);
$controller->setHandler('recommendation_request', $handleRequest);
$controller->setHandler('event_notification', $handleNotify);
$controller->setHandler('error_notification', $handleError);

// checking if either body or type is empty
if (empty($_POST['body'])) {
	die ('Warning: body is empty :(');
}

if (empty($_POST['type'])) {
	die ('Warning: type is empty :(');
}

// collecting type and body
$type = $_POST['type'];
$body = $_POST['body'];

// calling controller to handle incoming messages
$result = $controller->handle($type, $body);

// if the request was a recommendation request and we got results, print them out
if ($result instanceof \Plista\Orp\Sdk\Recs) {
	echo $result->toJSON();
}