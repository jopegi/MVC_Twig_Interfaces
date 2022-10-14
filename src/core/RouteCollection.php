<?php

namespace Src\Core;

use Src\Core\Interfaces\IRoute;

/**
 * Clase que se encarga de obtener las rutas por defecto que tiene la aplicación
 */
class RouteCollection implements IRoute
{
    private $routes;
    /**
     * Cargamos en la variable routes los datos de las rutas que tiene la aplicación definidas como posibles rutas accesibles
     */
    public function __construct()
    {
        $this->routes = json_decode(file_get_contents(__DIR__."/../../config/routes.json"), true);
    }
    /**
     * Get the value of routes
     */
    public function getRoutes()
    {
        return $this->routes;
    }
}
