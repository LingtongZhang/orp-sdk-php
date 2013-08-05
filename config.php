<?php

// plista library configuration
require_once __DIR__ . '/../library/config/config.php';

$classLoader = new SplClassLoader('Plista\\Orp\\Sdk', __DIR__.'/classes');
$classLoader->register(true);
unset($classLoader);
