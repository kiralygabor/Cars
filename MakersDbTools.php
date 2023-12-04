<?php
class MakersDbTools {
    const DBTABLE = 'makers';

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

    function createMaker($maker)
    {
        $result = $this->mysqli->query("INSERT INTO makers (name) VALUES ('$maker')");
        if (!$result) {
            echo "Hiba történt a $maker beszúrása közben";

        }
        return $result;
    }

    function updateMaker($data)
    {
    $makerName = $data['name'];
    $result = $this->mysqli->query("UPDATE makers SET name = $makerName");
    if (!$result) {
        echo "Hiba történt a $makerName beszúrása közben";
        return $result;
    }
    $maker = getMakerByName($mysqli, $makerName);
    return $result;
    }

    function getMaker($id)
    {   
    $result = $this->mysqli->query("SELECT * FROM makers WHERE id = $id");
    $maker = $result->fetch_assoc();
    $result ->  free_result();
    return $maker;
    }

    function getMakerByName($name)
    {
    $result =$this->mysqli->query("SELECT * FROM makers WHERE name = $name");
    $maker = $result->fetch_assoc();
    return $maker;
    }

    function getAllMakers()
    {
        $result = $this->mysqli->query("SELECT * FROM makers");
        $maker = $result->fetch_all(MYSQLI_ASSOC);
        $result ->  free_result();
        return $maker;
    }

    function delMaker($id)
    {
    $result = $this->mysqli->query("DELETE makers WHERE id = $id");
    return $result;
    }

    function truncateMaker($maker)
    {
        $result = $this->mysqli->query("TRUNCATE TABLE makers");
        return $result;
    }

}

?>