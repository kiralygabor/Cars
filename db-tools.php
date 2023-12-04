<?php

function createMaker($mysqli, $maker)
{
    $result = $mysqli->query("INSERT INTO makers (name) VALUES ('$maker')");
    if (!$result) {
        echo "Hiba történt a $maker beszúrása közben";

    }
    return $result;
}


?>