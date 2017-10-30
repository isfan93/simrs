<?php

class Repo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * @param string $table
     * @param mixed $params
     */
    function get($table = NULL, $params = array()) {
        $result = false;
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            if ($query->num_rows() > 1) {
                $result = $query->result();
            } else {
                $result = $query->row();
            }
        }

        return $result;
    }

    function insert($table, $data, $return_boolean = TRUE) {
        $insert = $this->db->insert($table, $data);
        $return = $return_boolean ? $insert : $this->db->insert_id();
        return $return;
    }

    function update($table, $term, $data) {
        $return = $this->db->update($table, $data, $term);
        return $return;
    }

    function delete($table, $term, $soft_delete = TRUE) {
        if ($soft_delete) {
            $data = array('status' => 0);
            $return = $this->update($table, $term, $data);
        } else {
            $return = $this->db->delete($table, $term);
        }
        return $return;
    }

    function rawQuery() {
        
    }

    function getModule($group_id) {
        $whitelist = array();
        //get the blacklisted/whitelisted module
        $this->db
                ->select('smod.module_id,smod.module_name,smod.module_url,smr.status')
                ->join('sys_menu sm', 'sm.menu_id = smr.menu_id')
                ->join('sys_module smod', 'smod.module_id = sm.modul_id')
                ->where('sm.menu_status', 1)
                ->where('smr.group_id', $group_id)
                ->group_by('smr.group_id');
        $menu_role = $this->db->get('sys_menu_role smr')->result_array();
        if (!empty($menu_role)) {
            foreach ($menu_role as $key => $value) {
                if (1 == $value['status']) {
                    unset($menu_role[$key]['status']);
                    $whitelist[$key] = $menu_role[$key];
                }
            }
        }

        $result = false;
//        $this->db->cache_on();
        $this->db
                ->select('smod.module_id,smod.module_name,smod.module_url')
                ->join('sys_module smod', 'smod.module_id = md.module_id')
//                ->join('com_modul cmod', 'cmod.modul_id = md.module_id')
                ->where('md.group_id', $group_id)
                ->where('smod.status', 1);
        $module_role = $this->db->get('sys_module_role md')->result_array();
//        $this->db->cache_off();

        if (!empty($module_role)) {
            $result = array_values($module_role);
            if (!empty($whitelist)) {
                foreach ($whitelist as $key => $ws) {
                    $result[] = $ws;
                }
            }

            usort($result, function($a, $b) {
                return $a['module_id'] - $b['module_id'];
            });
        }

        return $result;
    }

}
