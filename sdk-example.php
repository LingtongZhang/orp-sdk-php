<?php

$type = $_POST['type'];
$body = $_POST['body'];

$controller = new \Plista\Orp\Sdk\Controller();
$controller->handle($type, $body);

//$controller->setHandler();

// version 1
// standard set an klassen bereit stellen, damit man damit arbeiten kann

// version 2
// researcher wollen änderungen machen!!! sie wollen eigene datenbanken integrieren, etc
// etwa so $controller->setHandler();






