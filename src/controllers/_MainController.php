<?php
namespace Src\Controllers;

use Src\Core\AbstractController;

class MainController extends AbstractController{

    /**
     *  Esta ruta que sale al iniciar la aplicación y que debe listar todos los registros de la BB.DD.
     */
    public function main(){ 
        //Obtenemos la fecha y hora actual
        $fecha = date('d-m-y H:i:s');
        //Cargamos la plantilla inicial y le pasamos la fecha y hora que t.
        $this->render("index.html.twig",[
            'fecha_actual'=> $fecha
        ]);
    }
}