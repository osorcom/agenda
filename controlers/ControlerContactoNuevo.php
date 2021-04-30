<?php
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use agenda\Models\Contacto as Contacto;

class ControlerContactoNuevo
{
   private $container;

   public function __construct(ContainerInterface $container)
   {
       $this->container = $container;
   }

   public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
   {
     $datos = $request->getParsedBody();
     $out = ["error"=>false, 'message'=>'Contacto creado.'];
     try {
       $contacto = Contacto::Create($datos);
       $out['contacto'] = $contacto;
     } catch (\Exception $e) {
       $out['error'] = true;
       $out['message'] = $e->getMessage();
     }
     $response->getBody()->write(json_encode($out));
     return $response->withHeader('Content-Type', 'application/json');
   }
}
?>
