<?php
use Slim\App;
use agenda\middleware\MiddlewareVisitas as MiddlewareVisitas;


require __DIR__.'/controlers/ControlerResumen.php';
require __DIR__.'/controlers/ControlerContactos.php';
require __DIR__.'/controlers/ControlerNotas.php';
require __DIR__.'/controlers/ControlerCompromisos.php';
require __DIR__.'/controlers/ControlerDeleteContacto.php';
require __DIR__.'/controlers/ControlerContactoNuevo.php';
require __DIR__.'/middlewares/MiddlewareVisitas.php';


return function(Slim\App $app, DI\Container $container){
  //middleware
  //$app->add(MiddlewareVisitas::class);
  $midVisitas = new MiddlewareVisitas($container->get("view"));

  // routes
  $app->get('/', \ControlerResumen::class)->add($midVisitas);
  $app->get('/contactos', \ControlerContactos::class)->add($midVisitas);
  $app->get('/notas', \ControlerNotas::class)->add($midVisitas);
  $app->get('/compromisos', \ControlerCompromisos::class)->add($midVisitas);
  $app->delete('/contacto/{id}', \ControlerDeleteContacto::class);
  $app->post('/contactos', \ControlerContactoNuevo::class);
}
?>
