<?php

namespace Src\Models;

use Src\Core\Interfaces\IDataBase;

/**
 * Clase que modela una tarea de la BB.DD. que están dentro de
 * la tabla Tarea
 */
class ListaProductos
{
    private IDataBase $database;
    public function __construct(IDataBase $database)
    {
        $this->database = $database;
    }

    /**
     * Función que nos devuelve todos los registros de la tabla Producto
     */
    public function findAll()
    {
        $sql = "SELECT * FROM producto;";
        return $this->database->executeSQL($sql);
    }

}
