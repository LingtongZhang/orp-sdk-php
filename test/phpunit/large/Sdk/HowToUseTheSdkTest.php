<?php

namespace PlistaTest\Orp\Large\Sdk;
use Plista\Orp\Sdk;
use Plista\Util\PlistaTest;

require_once __DIR__ . '/../../../bootstrap.php';

/**
 *
 */
class HowToUseTheSdkTest extends PlistaTest {

	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
		parent::tearDown();
	}

	public function testGetEnabledIds() {

		$controller = new Sdk\Controller();

		$handle = new \ExampleUniversityItemPushHandler();
		$controller->setHandler('pushItem', $handle);
		$controller->setHandler('fetchOnsite', $handle);

		$handle->handle();

	}
}
