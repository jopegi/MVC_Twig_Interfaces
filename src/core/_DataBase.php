<?php

namespace Src\Core;

use Src\Core\Interfaces\IDataBase;

/**
 * Clase que se encarga de la gestión de la conexión y la obtención de los datos desde
 * una BB.DD. externa, en este caso de MySQL
 */
class DataBase implements IDataBase
{
    private $dbConfig;
    private $conn;
    public function __construct()
    {
        $this->dbConfig = json_decode(file_get_contents(__DIR__."/../../config/dbConfig.json"), true);
        $this->connect();
    }

    /**
     * Genera la conexión a la BB.DD.
     */
    private function connect()
    {
        $servername = $this->dbConfig["server"];
        $username = $this->dbConfig["user"];
        $password = $this->dbConfig["password"];
        $dbName = $this->dbConfig["dbname"];

        //Creamos la conexión
        $this->conn = new \mysqli($servername, $username, $password, $dbName);
    }

    /**
     * Función que ejecuta cualquier sentencia SQL que recibe y devuelve el resultado en un array asociativo
     * Esta función es obligatoria tenerla porque así esta implementada en la interfaz
     */
    public function executeSQL($sql)
    {
        return $this->conn->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Se encarga de asegurarse que no se queda la conexión abierta consumiendo recursos
     */
    public function __destruct()
    {
        if ($this->conn != null) {
            $this->conn->close();
        }
    }
}
