<?php
    $con = false;
    $empty_db = false;
    $db_name = "N/a Database";
    $host_details = "N/a Host Details";
    $list_tab = '<div class="left-option" onclick="callTable(`1`);"><i class="icon-table"></i> Other Table</div>';
    $tab_header = "";
    $tab_body = "";

    function defultTabHeader($no_h) {
        global $tab_header;
    
        for ($i=0; $i < $no_h; $i++) { 
            $tab_header .= '<th>Header</th>';
        }
    }
    
    function defualtTabBody() {
        global $tab_body;
    
    
    }

    defultTabHeader(4);


if(get('connect_db') != null) { 
    $host = get('hostname');
    $user = get('username');
    $pass = get('password');
    $dbname = get('db_name');

    $db = new Database($host, $pass, $user, $dbname);


}

?>