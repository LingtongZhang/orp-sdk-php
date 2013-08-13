<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jannik
 * Date: 12.08.13
 * Time: 09:43
 * To change this template use File | Settings | File Templates.
 */

$handle = new \ExampleUniversityItemPushHandler();
$controller->setHandler('pushItem', $handle);
$controller->setHandler('fetchOnSite', $handle);
$controller->setHandler('pushStatistic', $handle);
$controller->setHandler('pushError', $handle);

$handle->handle();