<?php 
//require_once('csv-tools.php');
ini_set('memory_limit','560M');
$FileName  = "car-db.csv";
$csvData = getCsvData($FileName);
$result = [];
$maker = [];
$makers = [];
$header = $csvData[0];
$idxMaker = array_search ('make', $header);
$idxModel = array_search ('model', $header);


function getCsvData($FileName)
{

    if (!file_exists($FileName)) {
        echo "$FileName nem található. ";
        return false;
    }
    $csvFile = fopen($FileName, 'r');
    $lines = [];
    while (! feof($csvFile)) {
        $line = fgetcsv($csvFile);
        $lines[] = $line;
    }
    fclose($csvFile);
    return $lines;
}


if (empty($csvData)) {
    echo "Nincs adat.";
    return false;
}
$maker = '';
$model = '';
foreach ($csvData as $idx => $line) {
    if(!is_array($line)){
        continue;
    }
    if ($idx == 0) {
        continue;
    }
    if ($maker != $line[$idxMaker]){
        $maker = $line[$idxMaker];
        $makers[] = $maker;
    }
    if ($model != $line[$idxModel]){
        $model = $line[$idxModel];
        $result[$maker][] = $model;

    }
}
//print_r($result);
print_r($makers)




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