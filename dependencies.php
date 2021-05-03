<?php
use Slim\Views\Twig;
use \Illuminate\Database\Capsule\Manager;
use agenda\Models\Estadistica as Estadistica;

require __DIR__.'/models/Estadistica.php';

return function(DI\Container $container){
  //Injecte the ORM Eloquent
  $db = require __DIR__."/db_config.php";
  $capsule = new \Illuminate\Database\Capsule\Manager;
  $capsule->addConnection($db);

  $capsule->setAsGlobal();
  $capsule->bootEloquent();

  $container->set('models', function () use ($capsule) {
    return $capsule;
  });

  //Inject TWIG templates system for the view
  $container->set('view', function() {
    $twig = Twig::create(__DIR__."/templates");
    //add data statistics to template
    $twig->getEnvironment()->addGlobal('estatistics',Estadistica::all());
    return $twig;
  });
};
?>
