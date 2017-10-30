<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_management {

    private $menu = array();
    var $html;

    function built_tree($data, $parent = 0) {

        static $i = -1;
        // debug_array($data[$parent]);
        if (isset($data[$parent])) {

            $i++;
            $html = '';
            foreach ($data[$parent] as $v) {

                $jml_child = 0;
                if (isset($data[$v['menu_id']])) {
                    foreach ($data[$v['menu_id']] as $k) {
                        if ($k['menu_parent'] == $v['menu_id']) {
                            $jml_child += 1;
                        }
                    }
                }


                // echo $v['menu_id'];die();
                if ($data['current'] == $v['menu_id']) {
                    $klas = 'current';
                } else {
                    $klas = ' ';
                }

                // debug_array($jml_child,true);

                if ($jml_child == 0) {
                    $html .= "<li class='$klas'><a class='list-menu' href='" . base_url() . $v['menu_url'] . "' ><span class='icon-menu'>&raquo;</span>  <span>" . $v['menu_name'] . "</span></a>";
                } else {
                    $html .= "<li class='submenu $klas'><a class='list-menu'  href='" . base_url() . $v['menu_url'] . "' ><span class='icon-menu'>&raquo;</span> <span>" . $v['menu_name'] . "</span></a><span class='arrow'></span>";
                }

                $child = $this->built_tree($data, $v['menu_id']);
                if ($child) {
                    $html .= "<ul>";
                    $html .= $child;
                    $html .= "</ul>";
                    $i--;
                }
                $html .= "</li>";
            }
            // debug_array($html,true);
            return $html;
        } else {
            return false;
        }
    }

    function get($modul_id, $current) {
        $CI = & get_instance();
//        $CI->db->order_by('menu_id');
//        $ds = $CI->db->get_where('sys_menu', array('menu_status' => 1, 'module_id' => $modul_id));
//        debug_array($ds->result());
                
        //blacklist/whitelist
        $whitelist = $blacklist = array();
        $CI->db
                ->join('sys_menu sm', 'sm.menu_id = smr.menu_id')
                ->where('smr.group_id',$CI->session->userdata('group_id'))
                ->where('sm.modul_id', $modul_id);
        $menu_role = $CI->db->get('sys_menu_role smr')->result_array();
        if (!empty($menu_role)) {
            foreach ($menu_role as $key => $mr) {
                if (1 == $mr['status']) {
                    $whitelist[] = $mr['menu_id'];
                } else if (0 == $mr['status']) {
                    $blacklist[] = $mr['menu_id'];
                }
            }
        }

        $CI->db
                ->where('modul_id', $modul_id)
                ->where('menu_status', 1)
                ->order_by('menu_id');
        $menu = $CI->db->get('sys_menu')->result_array();

        if (!empty($menu)) {
            foreach ($menu as $key => $m) {
                if (!empty($blacklist)) {
                    if (in_array($m['menu_id'], $blacklist)) {
                        unset($menu[$key]);
                    }
                }

                if (!empty($whitelist)) {
                    if (!in_array($m['menu_id'], $whitelist)) {
                        unset($menu[$key]);
                    }
                }
            }
            $menu = array_values($menu);
           
            $data = array();
            foreach ($menu as $row) {
                $data[$row['menu_parent']][] = $row;
            }
            $data['current'] = $current;
        // debug_array($data);
            return $this->built_tree($data);
        }
    }

    // var $ctg = array();
    // var $current;
    // function built_tree($data, $parent = 0) {
    //        static $i = 1;
    // 	$c = '';
    //        $tab = str_repeat("\t\t", $i);
    //        if (isset($data[$parent])) {
    // 		$tlm 	= ($i == 1) ? 'tlm' : '';
    //            $html 	= "\n$tab<ul class='$tlm'>";
    //            $i++;
    //            foreach ($data[$parent] as $v) {
    //            	$child = $this->built_tree($data, $v->menu_id);
    //            	if($child){
    //            		$c = "hasul";
    //            	}else $c='';
    // 			$crt = ($this->current == $v->menu_id) ? 'dh' : '';
    // 			$link = ($v->menu_url == '#') ? '#' : base_url().'admin/'.$v->menu_url;
    //                $html .= "\n\t$tab<li li_id='{$v->menu_id}' class='$c' id='$crt'>";
    //                $html .= '<a id="anchor_'.$v->menu_id.'" href="' .$link . '"><span>' . $v->menu_name . '</span></a>';
    //                if ($child) {
    // 				$i--;
    //                    $html .= $child;
    //                    $html .= "\n\t$tab";
    //                }
    //                $html .= '</li>';
    //            }
    //            $html .= "\n$tab</ul>";
    //            return $html;
    //        } else {
    //            return false;
    //        }
    //    }
    // function get($modul_id)
    // {
    // 	$CI =& get_instance();
    // 	$CI->db->order_by('menu_id');
    // 	$ds = $CI->db->get_where('sys_menu', array('menu_status' => 1,'modul_id' => $modul_id));
    // 	foreach ($ds->result() as $row) {
    // 		$data[$row->menu_parent][] = $row;
    // 	}
    // 	return $this->built_tree($data);
    // }
}
