<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jannik
 * Date: 12.08.13
 * Time: 09:43
 * To change this template use File | Settings | File Templates.
 */

$controller = new \Plista\Orp\Sdk\Controller();

$handleItem = new \ExampleUniversityItemPushHandler();
$handleFetch = new \ExampleUniversityFetchOnsiteHandler();
$handleStatistic = new \ExampleUniversityPushStatisticHandler();
$handleError = new \ExampleUniversityPushError();

$controller->setHandler('pushItem', $handleItem);
$controller->setHandler('fetchOnSite', $handleFetch);
$controller->setHandler('pushStatistic', $handleStatistic);
$controller->setHandler('pushError', $handleError);

//collecting type and body
$type = $_POST['type'];
$body = $_POST['body'];

//checking if either body or type is empty
if (empty($body) || empty($type)) {
	die ('type or body emtpy');
}
// calling controller to handle incoming messages
$controller->handle($type, $body);


/*
$handle = new \ExampleUniversityItemPushHandler();

$controller->setHandler('pushItem', $handle);
$controller->setHandler('fetchOnSite', $handle);
$controller->setHandler('pushStatistic', $handle);
$controller->setHandler('pushError', $handle);
 */