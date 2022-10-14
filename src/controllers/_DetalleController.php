<?php

namespace Src\Controllers;

use Src\Core\AbstractController;
use Src\Core\DataBase;
use Src\Models\Tareas;

class DetalleController extends AbstractController
{
    /**
     * Mostraremos la totalidad de los datos de una determinada tarea a partir de su id.
     */
    public function detalleTarea($id = null)
    {
        if (is_null($id)||strcmp("", $id)==0) {
            //No recibe id por lo tanto renderizamos la plantilla pasandos los parámetros como nulos
            $this->render("detail.html.twig",["resultados" =>null]);
        } else {
            //Creamos el modelo para poder acceder a los datos.
            $tarea = new Tareas(new DataBase());
            //Podemos usar sus métodos para poder reutilizar código.
            //El metodo render primero debemos pasarle la plantilla
            $this->render("detail.html.twig",
            //Después pasaremos los parámetros que debe usar la plantilla
            [
                //En este caso pasaremos un array con el detalle de la tarea
                "resultados" => $tarea->findById($id)
            ]);
            
        }
    }
}
