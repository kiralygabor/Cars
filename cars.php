<?php 
//require_once('csv-tools.php');
require_once('db-tools.php');
require_once('MakersDbTools.php');
ini_set('memory_limit','1024M');
$FileName  = "car-db.csv";
$csvData = getCsvData($FileName);
$result = [];
$maker = [];
$makers = [];
$header = $csvData[0];
$idxMaker = array_search ('make', $header);
$idxModel = array_search ('model', $header);
$makersDbTool = new MakersDbTools();

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

function getMakers($csvData)
{
    if (empty($csvData)) {
        echo "Nincs adat.";
        return false;
    }
    $maker = '';
    $header = $csvData[0];
    $idxMaker = array_search ('make', $header);
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
    }
    return $makers;
}

    $truncateMakers = $makersDbTool->truncateMaker($maker);
    $errors = [];
    foreach ($makers as $maker){

        $result = $makersDbTool->createMaker($maker);
        if(!$result){
            $errors[] = $maker;
        }
        echo "$maker\n";
    }
    if (!empty($errors)){
        print_r($erorrs);
    }


if (empty($csvData)) {
    echo "Nincs adat.";
    return false;
}



$csvData = getCsvData($FileName);
$makers = getMakers($csvData);
foreach ($makers as $maker){
    $makersDbTool->createMaker($maker);
}
$allMakers = $makersDbTool->getAllMakers();
$cnt = count($allMakers);
//echo $cnt . "sor van;\n";
$rows =  count($makers);
print_r($rows . " sor van.")

?>