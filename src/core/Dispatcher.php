<?php

namespace Src\Core;

use Src\Core\Interfaces\IRequest;
use Src\Core\Interfaces\IRoute;

/**
 * Para que funciones el Dispacher debemos lanzar rutas con la forma:
 * localhost:8000/detalle/1
 */
class Dispatcher
{
    private $routeList;
    private IRequest $currentRequest;
    /**
     * Para poder crear un objeto Dispatcher debemos enviar las rutas de la aplicación y la ruta del navegador
     * para que el dispatcher pueda redirigir al lugar controller correcto con los parametros adecuados.
     */
    public function __construct(IRoute $routeCollection, IRequest $request)
    {
        $this->routeList = $routeCollection->getRoutes();
        /* echo "<pre>";
        echo "Rutas: ";
        print_r($this->routeList);
        echo "</pre>"; */
        $this->currentRequest = $request;
        echo "<pre>";
        /* echo "currentRequest: "; */
        /* print_r($this->currentRequest);
        echo "<br>";
        echo "</pre>"; */
        //die();
        $this->dispatch();
    }

    /**
     * Redirigimos la aplicación al controlador adecuado.
     */
    private function dispatch()
    {
        //Verificamos que la ruta que hemos recibido esta dentro de las rutas de la aplicación
        if (isset($this->routeList[$this->currentRequest->getRoute()])) {
            $controllerClass = "Src\\Controllers\\".$this->routeList[$this->currentRequest->getRoute()]["controller"];
           /*  echo "<pre>";
            print_r($controllerClass);
            echo "<br>";
            echo "</pre>"; */
            
            //Creamos un nuevo controlador mediante el contenido del nombre del controlador en la variable
            $controller = new $controllerClass();
            $action = $this->routeList[$this->currentRequest->getRoute()]["action"];
            //lanzamos la acción que vamos a realizar del controlador pertinene
            $controller->$action(...$this->currentRequest->getParams());
        } else {
            //En el caso que la ruta que solicitamos no este definida en la lista de rutas de la aplicación
            echo "La ruta no esta definda";
        }
    }
}
