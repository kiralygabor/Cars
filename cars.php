<?php 
//require_once('csv-tools.php');
ini_set('memory_limit','560M');
$FileName  = "car-db.csv";
$csvData = getCsvData($fileName);
$result = [];
$maker = [];
$arr = array ('first' => 'a', 'second' => 'b', );
$key = array_search ('a', $arr);
$header = $csvData[0];
$keyMaker = array_search ('make', $header);
$keyModel = array_search ('model', $header);

for($i = 0; $i < $csvData[-1];$i++){
    if(isset($key)){
        $maker[$i] = $key;
    }
}


function getCsvData($FileName, $withHeader = true){

    if (!file_exists($FileName)) {
        echo "$FileName nem található. ";
        return false;
    }

    if (file_exists($FileName)) {
        $csvFile = fopen($FileName, 'r');
        $header = fgetcsv($csvFile);
        $lines = [];
        if ($withHeader) {
            $lines[] = $header;
        }
        else{
            $lines = [];
        }
        while (! feof($csvFile)) {
            $line = fgetcsv($csvFile);
            $lines[] = $line;
        }
        fclose($csvFile);
        return $lines;
    }
}

if (!empty($csvData)) {
    $maker = '';
    $model = '';
    foreach ($csvData as $idy => $line) {
        if ($idx == 0) {
            continue;
        }
        if ($maker != $liner[$idxMaker]){
            $maker = $line[$idxMaker];
        }
        if ($model != $liner[$idxModel]){
            $model = $line[$idxModel];
            $result[$maker][] = $model;
        }
    }
    print_r($result);
}



/*

$maker = [];
$model = [];
$result = [];

if (($fp = fopen("car-db.csv", "r")) !== FALSE) { 
    while (($record = fgetcsv($fp)) !== FALSE) {
        $row++;
    }
  }

if(file_exists($cars)) {
    for ($i = 0; $i < $row; $i++){
        $filecars = fopen($cars, 'r');
        $maker = fgetcsv($filecars);
        fclose($filecars);
    }    
}

var_dump($maker)
*/
?>