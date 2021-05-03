<?php
namespace agenda\middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use agenda\Models\Estadistica as Estadistica;

class MiddlewareVisitas
{
    private $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }
    /**
     * Example middleware invokable class
     *
     * @param  ServerRequest  $request PSR-7 request
     * @param  RequestHandler $handler PSR-15 request handler
     *
     * @return Response
     */
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = $handler->handle($request);
        $url = $request->getUri()->getPath();
        try {
          $est = Estadistica::find($url);
          if($est){
            $est->total++;
            $est->save();
          }else{
            $est = Estadistica::Create(['url'=>$url, 'total'=>1]);
          }
        } catch (\Exception $e) {
          
        }

        return $response;
    }
}
