<?php
use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// Container PHP-DI
$container = new \DI\Container();
AppFactory::setContainer($container);

// Create de App
$app = AppFactory::create();
// this line only in development mode
$app->addErrorMiddleware(true, true, true);

// Inject dependencies.
$dependencies = require __DIR__.'/../dependencies.php';
$dependencies($container);

//Create routes.
$routes = require __DIR__.'/../routes.php';
$routes($app);

// Launch the application.
$app->run();
?>
