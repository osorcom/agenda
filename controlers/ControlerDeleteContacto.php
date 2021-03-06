<?php
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use agenda\Models\Contacto as Contacto;

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
     $out = ['error'=>true, 'message'=>'No se ha podido borrar. Contacto no encontrado.'];
     if($c) {
       try {
         $c->delete();
         $out['error'] = false;
         $out['message'] = "Contacto borrado.";
       } catch (\Exception $e) {
         $out['message'] = $e->getMessage();
       }
     }

     $response->getBody()->write(json_encode($out));
     return $response->withHeader('Content-Type', 'application/json');
   }
}
?>
