<?php

function getDialog($name_dialog, $config) {
    return file_get_contents($config['VIEW_PATH'].DS.'dialog'.DS.$name_dialog.'.phtml');
}

// Load header of table
function loadHeader($table_name, $db) {
    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'$table_name';";
    $header_list = array_column($db->getConn()->query($sql)->fetch_all(), 0);
    $sum = '';

    foreach($header_list as $h) {
        $sum .= "<th>$h</th>";
    }
    return $sum;
}

function warning_handler($errno, $errstr) { 
    
}

// Load content of table
function loadTBody($table_name, $db) {
    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'$table_name';";
    $header_list = array_column($db->getConn()->query($sql)->fetch_all(), 0);

    $sum = "";
    $sql = "SELECT * FROM `$table_name`;";

    if($db->query($sql)) {
        while($res = $db->get_single_row()) {
            $sum .= "<tr>";

            foreach ($header_list as $h) {
                set_error_handler("warning_handler", E_WARNING);

                $sum .= "<td>".$res[$h]."</td>";

                restore_error_handler();

            }

            $sum .= "</tr>";
        }
        return $sum;
    }
    return -1;
}

?>