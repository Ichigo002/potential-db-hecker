<?php

    $con = false; // If Connected
    $empty_db = false; // If empty db without any tables
    $db_name; // If $con true then it's shown
    $host_details; // If $con true then it's shown
    $list_tab = ''; // List of tables in the db
    $tab_header = ""; // Header of table with the <th>
    $tab_body = ""; // Main data at the table
    $dialog = null; // Dialog form to aciton from buttons

// CONNECT DATABASE
if(get('btn_display_connect_database') != null) {
    $dialog = getDialog("connectDB", $config);
    return 0;
}

if(get('btn_connect_database') != null) {
    global $db;

    $host = get('hostname');
    $user = get('username');
    $pass = get('password');
    $dbname = get('db_name');

    $db = new Database($host, $pass, $user, $dbname);
    
    //Connection active
    $con = true;

    
    $tables = array_column($db->getConn()->query('SHOW TABLES')->fetch_all(), 0);

    // Check is DB empty
    $empty_db = sizeof($tables) == 0;

    //Get Name and Host of DB
    $db_name = $dbname;
    $host_details = $db->getConn()->host_info;

    
    if(!$empty_db) {
        foreach ($tables as $rec) {
            //Get Tables
            $list_tab .= '<form><input type="submit" name="btn_callTable" value="'.$rec.'"/></form>';
        }

        loadTable($tables[0], $db);
    }
    return 0;
}

//CALL TABLE
if(get('btn_callTable') != null && $db != null) {
    $name = get('btn_callTable');

    loadTable($name, $db);
}

// DISCONNECT DATABASE
if(get('btn_disconnect') != null) {

    return 0;
}
// REFRESH
if(get('btn_refresh') != null) {

    return 0;
}
// EXPORT
if(get('btn_export') != null) {

    return 0;
}
if(get('btn_display_export') != null) {

    return 0;
}
// OWN SQL
if(get('btn_ownsql') != null) {

    return 0;
}
if(get('btn_display_ownsql') != null) {

    return 0;
}

function loadTable($table_name, $db) {
    global $tab_header, $tab_body;

    $tab_header = loadHeader($table_name, $db);
    $tab_body = loadTBody($table_name, $db);
}

?>