<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jannik
 * Date: 12.08.13
 * Time: 09:43
 * To change this template use File | Settings | File Templates.
 */
use Plista\Orp\Sdk\Example;
use Plista\Orp\Sdk\Example\ExampleUniversityItemPushHandler;
use Plista\Orp\Sdk\Example\ExampleUniversityFetchOnsiteHandler;
use Plista\Orp\Sdk\Example\ExampleUniversityPushErrorHandler;
use Plista\Orp\Sdk\Example\ExampleUniversityPushStatisticHandler;

// defining controller
$controller = new \Plista\Orp\Sdk\Controller();

//defining the handle
$handleItem = new ExampleUniversityItemPushHandler();
$handleRequest = new ExampleUniversityFetchOnsiteHandler();
$handleError = new ExampleUniversityPushErrorHandler();
$handleNotify = new ExampleUniversityPushStatisticHandler();

// assigning type to handle
$controller->setHandler('item_update', $handleItem);
$controller->setHandler('recommendation_request', $handleRequest);
$controller->setHandler('event_notification', $handleNotify);
$controller->setHandler('error_notification', $handleError);

// collecting type and body
$type = $_POST['type'];
$body = $_POST['body'];

// checking if either body or type is empty
if (empty($body) || empty($type)) {
	die ('type or body emtpy');
}
// calling controller to handle incoming messages
$controller->handle($type, $body);


