<?php

// for PHPUnit to be able to convert php errors to exceptions, they must not be handled.
// (yes, I tried bubbling errors - but phpunit registers their error handler
// after we register our own, and apparently they avoid to overwrite ther people's error handlers.
//
// what we might be able to do, is to turn all our php errors to exceptions. agh.
//
// until we figure out a good way to address these issues,
// we have to disable our own error handler when running phpunit
// and use error_reporting
if (!defined('DISABLE_ERRORHANDLER')) {
	define('DISABLE_ERRORHANDLER', true);
}

require_once __DIR__ . '/../config.php';

error_reporting(E_ALL | E_STRICT);
