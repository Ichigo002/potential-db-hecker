<?php

// get sent data from POST or GET protocole
function get($name, $def='') {
    return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $def;
}

// Redirect under the address with array of arguments
function redirect($address, $v_get_array = null) {
    header("Location: ".mk_ready_redirect($address, $v_get_array));
}

// Make ready redirect
function mk_ready_redirect($address, $v_get_array = null) {
    $r = $address;

    if($v_get_array != null) {
        $r .= "?";
        foreach ($v_get_array as $namev => $val) {
            $r .= $namev . "=" . $val . "&";
        }
    }
    return $r;
}

// Check does haystack contains any character from string_chars;
function str_contains_any($haystack, $string_chars) {
    for ($i=0; $i < strlen($string_chars) ; $i++) { 
        if(str_contains($haystack, $string_chars[$i])) {
            return true;
        }
    }
    return false;
}

// encrypt ID to send
function encryptID($id) {
    return intval($id) * 3 - 14;
}

// decrypt ID after sending
function decryptID($id) {
    return (intval($id) + 14) / 3;
}


function checkTypeErr($no_t, $err) {
    if(isset($err)) {
        return $err[0] == $no_t;
    }
    return false;
}

// Here you can create more useful functions for your needs
    

?>