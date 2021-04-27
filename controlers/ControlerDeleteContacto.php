<?php
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use agenda\Models\Contacto as Contacto;

require_once __DIR__.'/../models/Contacto.php';

class ControlerDeleteContacto
{
   private $container;

   public function __construct(ContainerInterface $container)
   {
       $this->container = $container;
   }

   public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
   {
     $c = Contacto::find($args['id']);
     $respuesta = ['borrado'=>false];
     if($c) {
       $c->delete();
       $respuesta = ['borrado'=>true];
     }
     $respuesta = json_encode($respuesta);

     $response->getBody()->write($respuesta);
     return $response->withHeader('Content-Type', 'application/json');
   }
}
?>
