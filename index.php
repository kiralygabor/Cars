<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars</title>
</head>
<body>
    <h1>Cars</h1>
    <select id="carsDropdown" name="carsDropdown">
            <option value="">Válassz kocsit</option>
            <?php
            require_once('MakersDbTools.php');

            $makersDbTools = new MakersDbTools();
            //
            $makers = $makersDbTools->getAllCounties();

            foreach ($counties as $county) {
                echo '<option value="' . $county['id'] . '">' . $county['name'] . '</option>';
            }
            ?>
        </select>
</body>
</html>