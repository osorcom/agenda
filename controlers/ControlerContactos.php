<?php
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use agenda\Models\Contacto as Contacto;

require __DIR__.'/../models/Contacto.php';

class ControlerContactos
{
   private $container;

   public function __construct(ContainerInterface $container)
   {
       $this->container = $container;
   }

   public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
   {
     $contactos = ["contactos" => Contacto::all()];
     return $this->container->get("view")->render($response, "contactos.html.twig", $contactos);
   }
}
?>
