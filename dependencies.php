<?php
use Slim\Views\Twig;
use \Illuminate\Database\Capsule\Manager;

return function(DI\Container $container){
  //Inject TWIG templates system for the view
  $container->set('view', function() {
    return Twig::create(__DIR__."/templates");
  });

  //Injecte the ORM Eloquent
  $db = require __DIR__."/db_config.php";
  $capsule = new \Illuminate\Database\Capsule\Manager;
  $capsule->addConnection($db);

  $capsule->setAsGlobal();
  $capsule->bootEloquent();

  $container->set('models', function () use ($capsule) {
    return $capsule;
  });
};
?>
