<?php
use Slim\App;

require __DIR__.'/controlers/ControlerResumen.php';
require __DIR__.'/controlers/ControlerContactos.php';
require __DIR__.'/controlers/ControlerNotas.php';
require __DIR__.'/controlers/ControlerCompromisos.php';
require __DIR__.'/controlers/ControlerDeleteContacto.php';
require __DIR__.'/controlers/ControlerContactoNuevo.php';

return function(Slim\App $app){
  $app->get('/', \ControlerResumen::class);
  $app->get('/contactos', \ControlerContactos::class);
  $app->get('/notas', \ControlerNotas::class);
  $app->get('/compromisos', \ControlerCompromisos::class);
  $app->delete('/contacto/{id}', \ControlerDeleteContacto::class);
  $app->post('/contactos', \ControlerContactoNuevo::class);
}
?>
