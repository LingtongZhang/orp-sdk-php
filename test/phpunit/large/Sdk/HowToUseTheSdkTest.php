<?php

namespace PlistaTest\Orp\large\Sdk;

use Plista\Orp\Sdk\Example\ExampleUniversityItemPushHandler;
use Plista\Orp\Sdk\Example\ExampleUniversityFetchOnsiteHandler;
use Plista\Orp\Sdk\Example\ExampleUniversityPushErrorHandler;
use Plista\Orp\Sdk\Example\ExampleUniversityPushStatisticHandler;
use Plista\Orp\Sdk;

require_once __DIR__ . '/../../../bootstrap.php';

class HowToUseTheSdkTest extends \PHPUnit_Framework_TestCase {
	//sample data

	//event notification
	private $body_notify = '{"context":{"simple":{"4":154136,"56":1138207,"29":17332,"27":1677,"52":1,"14":74964,"39":10018,"16":48811,"7":18975,"25":135672799,"42":0,"19":52193,"24":0,"6":431260,"5":655,"47":504183,"18":0,"37":1521522,"59":1275566,"17":48985,"22":1192744,"31":0,"13":2,"9":26886,"23":13,"49":27,"35":315003,"57":0},"lists":{"8":[18841,18842,48511],"10":[4,5,10],"11":[13836]},"clusters":{"46":{"472366":255,"761805":255,"472364":255},"33":{"120979":8,"32942589":7,"467281":5,"97641":4,"6039":3,"781282":2,"2514003":2,"126430":2,"19565752":2,"19370":2,"252613":1,"176903":1,"106968":1,"32941951":1,"31926":1,"2068209":0},"51":{"1":255},"1":{"7":255},"2":[11,11,61,60,61,26,21],"3":[55,28,34,91,23,21]}},"recs":{"ints":{"3":[135417935]}},"notification_type":"impression","timestamp":1376047873577}';
	private $type_notify = "event_notification";

	//item_update
	private $body_item = '{"id":"130952812","domainid":"418","created_at":"2012-11-07 16:47:43","updated_at":"2013-06-26 10:56:51","flag":4,"title":"ORP stands for Open Recommendation Platform","text":"This article contains some UTF-8 encoded char\u00e4\u00f6cters.","url":"http://plista.com","img":"","version":2}';
	private $type_item = "item_update";

	//error_notification
	private $body_error = '{"id": 1114,"code": 440,"timestamp": 1376482070,"message": "empty response"}';
	private $type_error = "error_notification";

	//recommendation request
	private $body_request = '{"context":{"simple":{"4":40293,"56":1138207,"29":17332,"27":"13554","52":true,"14":33331,"39":"8448","16":48811,"7":18850,"25":"75888272","42":0,"19":52193,"24":1,"6":10,"5":48,"47":654013,"18":null,"37":1521522,"59":1275566,"17":48985,"22":61958,"31":null,"13":1,"9":26886,"23":13,"49":27.2,"57":"559141434"},"lists":{"8":[18841,18842],"10":[1,"10","12"],"11":[213466]},"clusters":{"46":{"472374":255,"472366":255,"472596":255},"33":{"63753":8.94,"9667055":7.81,"118":5.99,"5018":3.88,"2335":3.77,"12232093":3.39,"33017311":3.02,"7953467":2.19,"2483":2.12,"1218":1.7,"381":1.49,"3759":1.48,"2166648":1.4,"30608":1.23,"13717":1.06,"9441716":1.02,"17135":0.85,"67246":0.8,"13409":0.8,"32948":0.68,"2241179":0.6},"51":{"19":255}}},"limit":6,"vectors":[3]}';
	private $type_request = "recommendation_request"; //

	public function testGetEnabledIds() {
		// for annotation have a look at Example\index.php

		$controller = new \Plista\Orp\Sdk\Controller();

		$handleItem = new ExampleUniversityItemPushHandler();
		$handleRequest = new ExampleUniversityFetchOnsiteHandler();
		$handleError = new ExampleUniversityPushErrorHandler();
		$handleNotify = new ExampleUniversityPushStatisticHandler();

		$controller->setHandler('item_update', $handleItem);
		$controller->setHandler('recommendation_request', $handleRequest);
		$controller->setHandler('event_notification', $handleNotify);
		$controller->setHandler('error_notification', $handleError);

		// testing handling with sample data
		$controller->handle($this->type_item, $this->body_item); // is working -> writing item to  file
		$controller->handle($this->type_error, $this->body_error); // is working -> writing error to log file
		$controller->handle($this->type_notify, $this->body_notify); // is working -> writing notify to file
		$result = $controller->handle($this->type_request, $this->body_request); //is working -> writing request to file and prints {"recs":{"ints":{"3":null},"floats":{"2":2}}} as answer

		// TODO: do some checks on the $result
		// TODO: look at the generated files using $this->assertFileContents() or similar
		// TODO: then make sure all generated files are deleted again
	}
}
