<?php

function getCsvData($filename) {
    if (!file_exists($filename)) {
        echo "$filename nem található";
        return false;
    }
    $csvFile = fopen($filename, 'r');
    $lines = [];
    while (! feof($csvFile)) {
        $line = fgetcsv($csvFile);
        $lines[] = $line;
    }
    fclose($csvFile);

    return $lines;
}

function getMakers($csvData)
{
    $header = $csvData[0];
    $idxMaker = array_search('make', $header);
    //$idxModel = array_search('model', $header);

    $isHeader = true;

   // $result = [];
    $maker = '';
   // $model = '';
    foreach ($csvData as $data) {
        if (!is_array($data)) {
            continue;
        }
        if ($isHeader) 
        {
            $isHeader = false;
            continue;    
        }
        if ($maker != $data[$idxMaker]) {
            $maker = $data[$idxMaker];
            $result[] = $maker;
            
        }
        /*if ($model != $data[$idxModel]) {
            $model = $data[$idxModel];
            $result[$maker][] = $model;
        }*/
    }
    return $result;
    //print_r($result);   
}





?>