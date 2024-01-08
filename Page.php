<?php

class Page
{
    static function showExportBtn()
    {
        echo '
            <form method="post" action="export2csv.php">
                <button id="btn-export" name="btn-export" title="Export to .CSV">
                    <i class="fa fa-file-excel"></i>&nbsp;Export CSV</button>
            </form>';
    }

    static function showImportBtn()
    {
        echo '
            <button id="btn-import" name="btn-import" title="Import CSV">
                <i class="fa fa-file-import"></i>&nbsp;Import CSV</button>
        ';
    }

    static function showTruncateBtn()
    {
        echo '
            <form method="post" action="">
                <button id="btn-truncate" name="btn-truncate" title="Gyártók törlés">
                <i class="fa fa-trash"></i>&nbsp;Gyártók törlése</button>
            </form>';
    }
    static function showMakersTableHead()
    {
        echo '
        <thead>
            <tr>
                <th class="id-col">#</th><th>Megnevezés</th>
                <th style="float: right; display: flex">
                    Művelet&nbsp;
                    <button id="btn-add" title="Új"><i class="fa fa-plus"></i></button>
                </th>
            </tr>
            <tr id="editor" class="hidden"">
                <form method="post" action="#">
                    <th><input type="hidden" id="id" name="id"></th>
                    <th><input type="search" id="name" name="name" placeholder="Gyártó"></th>
                    <th class="flex">
                        <button type="submit" id="btn-save" name="btn-save" title="Ment">
                            <i class="fa fa-save"></i></button>
                        <button type="button" id="btn-cancel" title="Mégse">
                            <i class="fa fa-cancel"></i></button>
                    </th>
                </form>
            </tr>
        </thead>
        ';
    }

    static function showMakersTableBody(array $makers)
    {
        echo '<tbody>';
        $i = 0;
        foreach ($makers as $maker) {
            $onClick = sprintf('btnEditOnClick(%d, "%s")', $maker['id'], $maker['name']);
            echo "
            <tr class='" . (++$i % 2 ? "odd" : "even") . "'>
                <td>{$maker['id']}</td>
                <td>{$maker['name']}</td>
                <td class='flex float-right'>
                    <button type='button' id='btn-edit' onclick='$onClick' title='Módosít'><i class='fa fa-edit'></i></button>
                    <form method='post' action=''>
                        <button type='submit' id='btn-del' name='btn-del' value='{$maker['id']}' title='Töröl'><i class='fa fa-trash'></i></button>
                    </form>
                </td>
            </tr>";
        }
        echo '</tbody>';
    }

    static function showMakersTable($makers)
    {
        echo '<table id="makers-table">';
        self::showMakersTableHead();
        self::showMakersTableBody($makers);
        echo "</table>";
    }

    static function showAbcButtons(array $abc)
    {
        echo "<div style='display: flex'>";
        foreach ($abc as $ch) {
            echo "
            <form method='post' action='makers.php'>
                <input type='hidden' name='ch' value='$ch'>
                <button type='submit'>$ch</button>&nbsp;
            </form>
            ";
        }
        echo "</div><br>";
    }

    static function showSearchBar()
    {
        echo '
        <form method="post" action="#">
            <input type="search" name="needle" placeholder="Keres">
                <button type="submit" id="btn-search" name="btn-search" title="Keres">
                    <i class="fa fa-search"></i>
                </button>
        </form>
        <br>';
    }

    static function showCsvImport()
    {
        echo '
            <div id="import" class="hidden">
                <form method="post" action="">
                    <input type="file" name="input-file">
                    <button type="submit" value="open-file">Import</button>
                    <button type="button" id="btn-cancel-import" title="Mégse"><i class="fa fa-cancel"></i></button>
                </form> 
                <br>
            </div>
        ';
    }

    static function showExportImportButtons($isEmptyDb)
    {
        echo '<div style="display: flex">';
        if (!$isEmptyDb) {
            self::showExportBtn();
            self::showTruncateBtn();
        }
        else {
            self::showImportBtn();
        }
        echo '</div><br>';
        self::showCsvImport();
    }
}