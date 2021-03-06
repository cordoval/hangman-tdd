<?php

use Symfony\Component\HttpFoundation\Request;

$loader = require_once __DIR__.'/../vendor/autoload.php';

$kernel = new AppKernel('prod', false);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
