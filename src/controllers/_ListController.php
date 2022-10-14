<?php

namespace Src\Controllers;

use Src\Core\AbstractController;
use Src\Core\DataBase;
use Src\Models\Tareas;

class ListController extends AbstractController{
    /**
     * Vamos a mostrar un listado con todas las tareas
     */
    public function listadoTarea(){
        //Creamos el modelo para poder acceder a los datos
        $tareas = new Tareas(new DataBase);
        //Como hemos abstraido de la clase abstracta AbstractController
        //Podemos usar sus métodos para poder reutilizar código.
        //El metodo render primero debemos pasarle la plantilla
        $this->render("list.html.twig",
        //Después pasaremos los parámetros que debe usar la plantilla
        [
            //En este caso pasaremos un array de todos los objetos desde el modelo
            "resultados" => $tareas->findAll()
        ]);
    }
}