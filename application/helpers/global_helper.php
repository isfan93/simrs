<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('cur_url')) {

    function cur_url($a = 0) {
        $r = base_url() . uri_string();
        if ($a == 0) {
            return $r . '/';
        } else if ($a == -1) {
            return substr($r, 0, strripos($r, '/')) . '/';
        } else if ($a == -2) {
            $r = substr($r, 0, strripos($r, '/'));
            return substr($r, 0, strripos($r, '/')) . '/';
        } else if ($a == -3) {
            $r = substr($r, 0, strripos($r, '/'));
            $r = substr($r, 0, strripos($r, '/'));
            return substr($r, 0, strripos($r, '/')) . '/';
        }
    }

}

if (!function_exists('debug_array')) {

    function debug_array($a = array(), $b = false) {//format abjad-abjad atau abjad-angka
        echo "<pre>";
        print_r($a);
        echo "</pre>";
        if (!$b)
            die();
        return 0;
    }

}

if (!function_exists('db_conv')) {

    function db_conv($a) {
        if ($a->num_rows() == 1) {
            $a = $a->result();
            $a = $a[0];
            return $a;
        } else
            die("tinjau kembali");
    }

}

//time format
if (!function_exists('format_date_time')) {

    function format_date_time($i, $complete = true) {
        if (($i == '0000-00-00') || empty($i)) {
            return '-';
        } else {
            $a = explode(" ", $i);
            $d = explode("-", $a[0]);
            if ($complete) {
                $t = explode(":", $a[1]);
                return "$d[2]-$d[1]-$d[0] $t[0]:$t[1]";
            } else
                return "$d[2]-$d[1]-$d[0]";
        }
    }

}

function indo_day($d) {
    switch ($d) {
        case 'Sun':return 'Minggu';
            break;
        case 'Mon':return 'Senin';
            break;
        case 'Tue':return 'Selasa';
            break;
        case 'Wed':return 'Rabu';
            break;
        case 'Thu':return 'Kamis';
            break;
        case 'Fri':return 'Jumat';
            break;
        case 'Sat':return 'Sabtu';
            break;
    }
}

//time format
if (!function_exists('pretty_date')) {

    function pretty_date($i, $format = true) {
        if (($i == '0000-00-00') || ($i == '0000-00-00 00:00:00') || empty($i)) {
            return '-';
        } else {
            $date = new DateTime($i);
            $day = indo_day($date->format('D'));

            $a = explode(" ", $i);
            $d = explode("-", $a[0]);
            if ($format === true)
                $j = explode(":", $a[1]);
            $bln = '';
            switch (intval($d[1])) {
                case 1: $bln = 'Januari';
                    break;
                case 2: $bln = 'Februari';
                    break;
                case 3: $bln = 'Maret';
                    break;
                case 4: $bln = 'April';
                    break;
                case 5: $bln = 'Mei';
                    break;
                case 6: $bln = 'Juni';
                    break;
                case 7: $bln = 'Juli';
                    break;
                case 8: $bln = 'Agustus';
                    break;
                case 9: $bln = 'September';
                    break;
                case 10: $bln = 'Oktober';
                    break;
                case 11: $bln = 'November';
                    break;
                case 12: $bln = 'Desember';
                    break;
            }
            if ($format === true)
                return "$day, $d[2] $bln $d[0] $j[0]:$j[1]";
            else if($format == 'date_only')
                return "$d[2] $bln $d[0]";
            else
                return "$day, $d[2] $bln $d[0]";
        }
    }

}

function smart_trim($text, $max_len, $trim_middle = false, $trim_chars = '...') {
    $text = strip_tags($text);
    $text = trim($text);

    if (strlen($text) < $max_len) {

        return $text;
    } elseif ($trim_middle) {

        $hasSpace = strpos($text, ' ');
        if (!$hasSpace) {
            /**
             * The entire string is one word. Just take a piece of the
             * beginning and a piece of the end.
             */
            $first_half = substr($text, 0, $max_len / 2);
            $last_half = substr($text, -($max_len - strlen($first_half)));
        } else {
            /**
             * Get last half first as it makes it more likely for the first
             * half to be of greater length. This is done because usually the
             * first half of a string is more recognizable. The last half can
             * be at most half of the maximum length and is potentially
             * shorter (only the last word).
             */
            $last_half = substr($text, -($max_len / 2));
            $last_half = trim($last_half);
            $last_space = strrpos($last_half, ' ');
            if (!($last_space === false)) {
                $last_half = substr($last_half, $last_space + 1);
            }
            $first_half = substr($text, 0, $max_len - strlen($last_half));
            $first_half = trim($first_half);
            if (substr($text, $max_len - strlen($last_half), 1) == ' ') {
                /**
                 * The first half of the string was chopped at a space.
                 */
                $first_space = $max_len - strlen($last_half);
            } else {
                $first_space = strrpos($first_half, ' ');
            }
            if (!($first_space === false)) {
                $first_half = substr($text, 0, $first_space);
            }
        }

        return $first_half . $trim_chars . $last_half;
    } else {

        $trimmed_text = substr($text, 0, $max_len);
        $trimmed_text = trim($trimmed_text);
        if (substr($text, $max_len, 1) == ' ') {
            /**
             * The string was chopped at a space.
             */
            $last_space = $max_len;
        } else {
            /**
             * In PHP5, we can use 'offset' here -Mike
             */
            $last_space = strrpos($trimmed_text, ' ');
        }
        if (!($last_space === false)) {
            $trimmed_text = substr($trimmed_text, 0, $last_space);
        }
        return remove_trailing_punctuation($trimmed_text) . $trim_chars;
    }
}

function remove_trailing_punctuation($text) {
    return preg_replace("'[^a-zA-Z_0-9]+$'s", '', $text);
}

function get_bulan($x = '') {
    $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    $r = "";
    $bi = 0;

    foreach ($bulan as $rr) {
        $bi++;

        $check = '';
        if ($x == $bi) {
            $check = "selected=selected";
        }

        $r .= "<option $check value='$bi'>$rr</option>";
    }
    return $r;
}

function get_hari($x = '') {
    $hri = "";
    for ($i = 1; $i < 32; $i++) {
        $check = '';
        if ($x == $i) {
            $check = "selected=selected";
        }

        $hri .= "<option $check value='$i'>$i</option>";
    }
    return $hri;
}

function get_tahun($x = '') {
    $thn = "";
    $now = DATE('Y');
    $hundredyearsago = DATE('Y') - 100;
    for ($i = $now; $i >= $hundredyearsago; $i--) {
        $check = '';
        if ($x == $i) {
            $check = "selected=selected";
        }

        $thn .= "<option $check value='$i'>$i</option>";
    }
    return $thn;
}

function get_tahun_next($x = '') {
    $thn = "";
    $now = DATE('Y');
    $hundredyearsago = DATE('Y') + 100;
    for ($i = $now; $i <= $hundredyearsago; $i++) {
        $check = '';
        if ($x == $i) {
            $check = "selected=selected";
        }

        $thn .= "<option $check value='$i'>$i</option>";
    }
    return $thn;
}

function compose_url($ds, $l) {
    $mn = array();
    $l+=1;
    for ($i = 1; $i < $l; $i++) {
        $c = "menu_uri$i";
        if ($ds->$c != '') {
            $mn[$i] = $ds->$c;
        }
    }
    return implode("/", $mn);
}

function get_loader($id) {
    return base_url("assets/images/loaders/loader$id.gif");
}

function int_to_money($int) {
    $curr = "Rp.";
    return $curr . ' ' . number_format($int, 2, ',', '.');
}

function money_to_int($money) {
    return preg_replace('/[^0-9]/', '', $money) / 100; // substract with 100 if money format like Rp. 500.000,00
}

// manual nextval for transactional table
function get_next_val($tbl = "trx_dr_schedule", $col = "sch_id") {
    $date = date('ym');
    $sql = "select 
			cast(substring($col from 5 for 8) as numeric) as nv 
				from $tbl where (substring($col from 1 for 4) = '$date')
					order by nv desc limit 1";
    $CI = & get_instance();
    $ds = $CI->db->query($sql);
    if ($ds->num_rows() == 1) {
        $ds = db_conv($ds)->nv;
        $ds++;
        return $date . str_pad((int) $ds, 4, "0", STR_PAD_LEFT);
    } else {
        return $date . '0001';
    }
}

function init_datatable($config) {
    $CI = & get_instance();
    $CI->load->library('datatable');
    $CI->datatable->initialize($config);
    $CI->datatable->get_json();
}
