<?php
class ModelsDbTools {
    const DBTABLE = 'models';

    private $mysqli;

    function __construct($host = 'localhost', $user = 'root', $password = null, $db = 'cars')
    {
        $this->mysqli = new mysqli($host, $user, $password, $db);
        if ($this->mysqli->connect_errno){
            throw new Exception($this->mysqli->connect_errno);
        }
    }

    function __destruct()
    {
        $this->mysqli->close();
    }

    function createModel($model)
    {
        $result = $this->mysqli->query("INSERT INTO " . self::DBTABLE . " (name) VALUES ('$model')");
        if (!$result) {
            echo "Hiba történt a $model beszúrása közben";

        }
        return $result;
    }

    function updateModel($data)
    {
    $modelName = $data['name'];
    $result = $this->mysqli->query("UPDATE " . self::DBTABLE ." SET name = $modelName");
    if (!$result) {
        echo "Hiba történt a $modelName beszúrása közben";
        return $result;
    }
    $model = getModelByName($modelName);
    return $result;
    }

    function getModel($id)
    {   
    $result = $this->mysqli->query("SELECT * FROM " . self::DBTABLE . " WHERE id = $id");
    $model = $result->fetch_assoc();
    $result ->  free_result();
    return $model;
    }

    function getModelByName($name)
    {
    $result =$this->mysqli->query("SELECT * FROM " . self::DBTABLE . " WHERE name = $name");
    $model = $result->fetch_assoc();
    return $model;
    }

    function getAllModels()
    {
        $result = $this->mysqli->query("SELECT * FROM " . self::DBTABLE);
        $model = $result->fetch_all(MYSQLI_ASSOC);
        $result ->  free_result();
        return $model;
    }

    function delModel($id)
    {
    $result = $this->mysqli->query("DELETE {self::DBTABLE} WHERE id = $id");
    return $result;
    }

    function truncateModel()
    {
        $result = $this->mysqli->query("TRUNCATE TABLE " . self::DBTABLE);
        return $result;
    }

}

?>