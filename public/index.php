<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/../vendor/autoload.php';

use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;
use Metinet\Core\Routing\RouteUrlMatcher;
use Metinet\Core\Routing\RouteNotFound;
use Metinet\Core\Routing\JsonFileLoader;
use Metinet\Core\Routing\CsvFileLoader;
use Metinet\Core\Routing\PhpFileLoader;
use Metinet\Core\Routing\ChainLoader;
use Metinet\Core\Controller\ControllerResolver;
use Metinet\Core\Logger\FileLogger;
use Metinet\Core\Logger\SimpleFormatter;

$request = Request::createFromGlobals();

$loader = new ChainLoader([
    new JsonFileLoader([__DIR__ . '/../conf/routing.json']),
    new CsvFileLoader([__DIR__ . '/../conf/routing.csv']),
    new PhpFileLoader([__DIR__ . '/../conf/routing.php'])
]);

$logger = new FileLogger(
    __DIR__ . '/../var/logs/debug.log',
    new SimpleFormatter('%url% -> [%date%] - %message% !!!')
);

try {
    $controllerResolver = new ControllerResolver(new RouteUrlMatcher($loader->load()));
    $callableAction = $controllerResolver->resolve($request);
    $response = call_user_func($callableAction, $request);
} catch (RouteNotFound $e) {
    $logger->log($e->getMessage(), ['url' => $request->getPath()]);
    $response = new Response('Page not found', 404);
} catch (Throwable $e) {
    $logger->log($e->getMessage(), ['url' => $request->getPath()]);
    $response = new Response(sprintf('<p>Error: %s</p>', $e->getMessage()), 500);
}

$response->send();
