<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jannik
 * Date: 12.08.13
 * Time: 09:43
 * To change this template use File | Settings | File Templates.
 */

$controller = new \Plista\Orp\Sdk\Controller();

$handle = new \ExampleUniversityItemPushHandler();

$controller->setHandler('pushItem', $handle);
$controller->setHandler('fetchOnSite', $handle);
$controller->setHandler('pushStatistic', $handle);
$controller->setHandler('pushError', $handle);

$type = $_POST['type'];
$body = $_POST['body'];

if (empty($body) || empty($type)) {
	die ('type or body emtpy');
}

$controller->handle($type, $body);