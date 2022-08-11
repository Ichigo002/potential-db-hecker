<?php

defined("DEF_ADDRESS") || define("DEF_ADDRESS", "http://localhost/work_logger/index.php");

$config = [
    'MODEL_PATH' => APP_PATH.DS.'model'.DS,
    'VIEW_PATH' => APP_PATH.DS.'view'.DS,
    'LIB_PATH' => APP_PATH.DS.'lib'.DS,
    'CONTROLLERS_PATH' => APP_PATH.DS.'controllers'.DS,
    'JS_PATH' => APP_PATH.DS.'js'.DS,
];

require $config['LIB_PATH'].'func-lib.php';
require $config['LIB_PATH'].'db-lib.php';

$_404  = $config['VIEW_PATH'].DS.'404.html';

$page  = get('pg_v', 'panel');

// Call controllers
if(str_starts_with($page, "%cntl_")) {
    $pos = strpos($page, '_') + 1;
    $controller = $config['CONTROLLERS_PATH'].DS.substr($page, $pos).'.php';
    
    if(file_exists($controller)) {
        require $controller;
    } else {
        require $_404;
    }
    return 0;
}
// Else: Call page

$model = $config['MODEL_PATH'].$page.'.php';
$view  = $config['VIEW_PATH'].$page.'.phtml';

if(file_exists(($model)) && file_exists(($view))) {
    require $model;
    require $view;
    return 0;
}

require $_404;

?>