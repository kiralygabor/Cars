<?php
session_start();
ini_set(option:'memory_limit', value:'-1');
require_once('DBModel.php');
require_once('Page.php');

include 'html-head.php';

$carModel = new DBModel();
$isEmptyDb = $carModel->getCount() === 0;


echo "<body>";
    include 'html-nav.php';
    echo "<h1>Modellek</h1>";
    Page::showExportImportButtons($isEmptyDb);
    
    if(isset($_POST['ch'])) {
        $ch = $_POST['ch'];
        $_SESSION['ch'] = $ch;
    }

    if (isset($_POST['btn-truncate'])) {
        $carModel->truncate();
        $_SESSION['ch'] = '';
        $models = [];
        header(header:"Refresh:0");
    }

    if (isset($_POST['input-file'])) {
        require_once('csv-tools.php');
        $fileName = $_POST['input-file'];
        $csvData = getCsvData($fileName);
        if(empty($csvData)) {
            echo "Nem található adat a csv fájlban.";
            return false;
        }
        $models = getModels($csvData);
        $errors = [];
        foreach ($models as $model) {
            $result = $carModel->create(['name' => $model]);
            if(!$result) {
                $errors[] = $model;
            }
        }
        header(header:"Refresh:0");
    }

    if (isset($_POST['btn-del'])) {
        $id = $_POST['btn-del'];
        $carModel->delete($id);
    }

    if (!$isEmptyDb) {
        Page::showSearchBar();
        $abc = $carModel->getAbc();
        Page::showModelsAbcButtons($abc);
    }

    if(!empty($_SESSION['ch'])) {
        $ch = $_SESSION['ch'];
        $models = $carModel->getByFirstCh($ch);

        Page::showModelsTable($models);
    }


echo "</body>";

include 'html-footer.php';
 
       
  ?>
