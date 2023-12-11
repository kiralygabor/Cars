<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autók</title>

    <script src="js/jsquery-3.7.1.js" type="text/javascript"></script>
    <script src="js/cars.js" type="text/javascript"></script>

    <link rel="stylesheet" href="fontawesome/css/all.css" type="text/css">
    <link rel="stylesheet" href="css/cars.css" type="text/css">
</head>
<body>
    <nav>
        <a href="index.php"><i class="fa fa-home" title="Kezdőlap"></i></a>
        <a href="makers.php"><button>Gyártók</button></a>
        <a href="models.php"><button>Modellek</button></a>
    </nav>
    <h1>Gyártók</h1>

    <?php
      require_once('DBMaker.php');
      $carMaker = new DBMaker();
      $abc = $carMaker->getABC();
      //var_dump($abc);
      //return;
     
      echo "<div style = 'display: flex'>";
      foreach($abc as $char)
      {
          echo "<form method='post' action='makers.php'>
                  <input type='hidden' name='abc' value='{$char['abc']}'>
                  <button type='submit'>{$char['abc']}</button>&nbsp;
                  </form>";
      }

      echo "</div><br>";

      if (isset($_POST['abc']))
      {
        echo "<table>
                <thead>
                    <tr>
                        <th>#</th><th>Megnevezés</th><th>Művelet</th>
                    </tr>
                    <tr>,
                        <th colspan='3'><input type='search' name = 'needle'><button id = 'btn-add' title = 'Új'><i class = 'fa fa-plus'></i></button>
                    </tr>
                    <tr id='editor' style = 'display:none'>
                        <input id='id' type='hidden' name = 'id'>
                        <th colspan='3'> 
                        <input type = 'search' id = 'edit-box' name = 'name'>
                        <button id = 'btn-save' title = 'Ment'>
                        <i class='fa fa-save'></i>
                        </button>
                        <button id='btn-cancel' title= 'Mégse'>
                            <i class = 'fa fa-cancel'>
                        </button>
                        </th>
                    </tr>
                </thead>
                <tbody>";
                $ch = $_POST['abc'];
                $makers = $carMaker->getByFirstCh($ch);
                foreach($makers as $maker) 
                {
                    $id = $maker['id'];
                    $name = $maker['name'];
                    echo "<tr>
                    <td>$id</td>
                    <td>$name</td>
                    <td>
                        <button id='mod'><i class='fa fa-edit'></i></button>
                        <button id = 'del'><i class='fa fa-trash'></i></button>
                    </td>
                  </tr>";
                }
                echo " 
                </tbody> 
            </table>";
        }
      echo "</tbody>
      </table>
  </body>
  <footer>

  </footer>
  </html>";
    ?>
</body>
</html>