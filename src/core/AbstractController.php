<?php

namespace Src\Core;

abstract class AbstractController
{
    private $twig;
    /**
     * Mediante el contructor cargamos el loader en la variable de la clase abstracta que podremos
     * usar en todas las clases que usen esta clase
     */
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__."/../templates");
        $this->twig = new \Twig\Environment($loader);
        //Para poder usar una variable global de PHP en TWIG deberemos usar las variables globales
        //de TWIG y la forma de hacerlo es usar la propiedad addGlobal de TWIG.
        $this->twig->addGlobal('server_name', $_SERVER['SERVER_NAME']);
    }

    /**
     * Método que se encarga de renderizar el template con los parámetros deseados.
     */
    public function render($template, $params)
    {
        $template = $this->twig->load($template);
        echo $template->render($params);
    }
}
