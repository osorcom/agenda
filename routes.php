<?php
use Slim\App;

require __DIR__.'/controlers/ControlerResumen.php';
require __DIR__.'/controlers/ControlerContactos.php';
require __DIR__.'/controlers/ControlerNotas.php';
require __DIR__.'/controlers/ControlerCompromisos.php';

return function(Slim\App $app){
  $app->get('/', \ControlerResumen::class);
  $app->get('/contactos', \ControlerContactos::class);
  $app->get('/notas', \ControlerNotas::class);
  $app->get('/compromisos', \ControlerCompromisos::class);
}
?>
