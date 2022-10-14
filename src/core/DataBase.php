<?php

namespace Src\Core;

use \PDO;
use \PDOException;
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
        $db = $this->dbConfig["dbname"];
        $port = $this->dbConfig["port"];

        //Creamos la conexión
        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$db;port=$port", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Conexión a BBDD establecida!";
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
    }

    /**
     * Función que ejecuta cualquier sentencia SQL que recibe y devuelve el resultado en un array asociativo
     * Esta función es obligatoria tenerla porque así esta implementada en la interfaz
     */
    public function executeSQL($sql)
    {
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Se encarga de asegurarse que no se queda la conexión abierta consumiendo recursos
     */
    public function __destruct()
    {
        $this->conn = null;
    }
}
