<?php
if (isset($cf)) {
    if (!isset($current)) {
        $current = '';
    }
    
    $modul_id = $cf['modul_id'];
    $modul_id = (isset($modul_id)) ? $modul_id : die('anda belum mengeset current page');
    $CI = & get_instance();
    $CI->load->library('menu_management');
    $a = $CI->menu_management->get($modul_id, $current);
    echo "<ul>" . $a . "</ul>";
}