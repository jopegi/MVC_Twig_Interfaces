<?php

namespace Src\Core;

use Src\Core\Interfaces\IRequest;

/**
 * Clase que se encarga de darnos la ruta en la que estamos en el navegador
 */
class Request implements IRequest
{
    private $route;
    private $params;

    public function __construct()
    {
        //Obtenemos la ruta del navegador
        $rawRoute = $_SERVER["REQUEST_URI"];
        //Separamos la ruta en las diferentes partes que contine separadas por la / de las carpetas
        $rawRouteElements = explode("/", $rawRoute);
        $this->route = "/" . $rawRouteElements[1];
        $this->params = array_slice($rawRouteElements, 2);
        /* echo "<pre>";
        echo "Ruta: ";
        print_r($this->route);
        echo "</pre>";
        echo "<pre>";
        echo "Parámetros:";
        echo "</br></br>";
        print_r($this->params);
        echo "</pre>"; */
        /* die(); */
    }

    /**
     * Get the value of route
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Get the value of parms
     */
    public function getParams()
    {
        return $this->params;
    }
}
