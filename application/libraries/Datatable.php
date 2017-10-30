<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Data table Class
 * Support datatable plugin for jquery
 * @author		agus dwi prayogo
 * @link		agusdwi89@gmail.com
 *
 * @edited 24 april 2011		group, left join @hanief
 */
class Datatable {

    var $aColumns = array(); // kolom yang di select
    var $aColumns_format = array(); // kolom yang di select
    var $sTable = "";  //table yang digunakan
    var $searchColumn = array();  //kolom yang di cari
    var $aksi = array();
    var $php_format = array();
    var $join = array();
    var $leftjoin = array(); //added 24 april 2011
    var $where = array(); //added 15 april 2011
    var $key = '';
    var $group = ''; //added 24 april 2011
    var $sOrder = ''; //added 24 april 2011

    function Datatable($params = array()) {
        if (count($params) > 0) {
            $this->initialize($params);
        }
        log_message('debug', "Data table Class Initialized");
    }

    function initialize($params = array()) {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (isset($this->$key)) {
                    $this->$key = $val;
                }
            }
        }
    }

    function get_json() {
        /* cek formatting //added 16 april 2011 */
        $this->aColumns_format = (empty($this->aColumns_format)) ? $this->aColumns : $this->aColumns_format;

        /* Paging */
        $sLimit = "";
        if (isset($_POST['iDisplayStart']) && $_POST['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . $_POST['iDisplayLength'] . " OFFSET " . $_POST['iDisplayStart'];
        }
        /* order */
        $sOrder = "";
        if (isset($_POST['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_POST['iSortingCols']); $i++) {
                if ($_POST['bSortable_' . intval($_POST['iSortCol_' . $i])] == "true") {
                    $sOrder .= $this->aColumns[intval($_POST['iSortCol_' . $i])] . "
                        " . $_POST['sSortDir_' . $i] . ", ";
                }
            }
            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }
        $sWhere = "";
        if (isset($_POST['sSearch'])) {
            $stWhere = "WHERE ";
            foreach ($this->searchColumn as $r) {
                $stWhere .= 'lower(' . $r . ") LIKE lower('%" . $_POST['sSearch'] . "%') or ";
            }
            $stWhere = substr($stWhere, 0, -3);
            if ($_POST['sSearch'] != "") {
                $sWhere = $stWhere;
            }
        }
        /* order added date 24 dec 2014 sigidhanafi */
        // if(!empty($this->sOrder))
        // {
        //     $order = '';
        //     foreach ($this->sOrder as $key => $value) {
        //         $order .= implode(" ,", $value);
        //     }
        //     if ($sWhere == '') {
        //         $sOrder .= "ORDER BY " . $order;
        //     } else {
        //         $sOrder .= ", " . $order;
        //     }
        // }
        /* where added date : 15 april 2011 */
        if (!empty($this->where)) {
            $whpp = implode(" and ", $this->where);
            if ($sWhere == '') {
                $whpp = "where " . $whpp;
                $sWhere = $whpp;
            } else {
                $sWhere .= " and " . $whpp;
            }
        }

        /* join added date : 31 maret 2011 */
        $sJoin = '';
        if (!empty($this->join)) {
            foreach ($this->join as $a) {
                $sJoin .= ' join ' . $a[0] . ' on ' . $a[1] . ' ';
            }
        }

        /* left join added date : 24 april 2011 */
        $sGroup = '';
        if (!empty($this->group)) {
            $sGroup .= ' GROUP BY ' . $this->group;
        }

        /* left join added date : 24 april 2011 */
        $sleftJoin = '';
        if (!empty($this->leftjoin)) {
            foreach ($this->leftjoin as $b) {
                $sleftJoin .= ' left join ' . $b[0] . ' on ' . $b[1] . ' ';
            }
        }

        /* ci db */
        $CI = & get_instance();
        if ($this->key != '')
            $this->key.=',';
        $sQuery = "
			SELECT {$this->key} " . str_replace(" , ", " ", implode(", ", $this->aColumns_format)) . "
			FROM   {$this->sTable}
			$sJoin
			$sleftJoin
			$sWhere
			$sGroup
			$sOrder ";
        $sQuery_all = $sQuery . $sLimit;
        $rResult = $CI->db->query($sQuery_all);

        //secho
        if (isset($_POST['sEcho'])) {
            $sEcho = intval($_POST['sEcho']);
        } else {
            $sEcho = "10";
        }

        /* Data set length after filtering */
        $iFilteredTotal = $CI->db->query($sQuery)->num_rows();
        $iTotal = $iFilteredTotal; //$CI->db->get($this->sTable)->num_rows();
        /** Output */
        $sOutput = '{';
        $sOutput .= '"sEcho": ' . $sEcho . ', ';
        $sOutput .= '"iTotalRecords": ' . $iTotal . ', ';
        $sOutput .= '"iTotalDisplayRecords": ' . $iFilteredTotal . ', ';
        $sOutput .= '"aaData": [ ';
        foreach ($rResult->result() as $aRow) {
            $sOutput .= "[";
            for ($i = 0; $i < count($this->aColumns); $i++) {
                $col = $this->aColumns;
                //$sOutput .= '"'.str_replace('"', '\"', $aRow->$col[$i] ).'",';
                $sOutput .= '"' . str_replace('"', '\"', $this->col_format($aRow->$col[$i], $i)) . '",';
            }
            if ($this->aksi['stat']) {
                $aksi = '';
                $id = $this->aksi['key']; //was changed 15 mei 2011
                $id = isset($this->aksi['key']) ? $this->aksi['key'] : ""; //changed Sep 5,2014
                /* @hanief | haniefhan@gmail.com
                 * edited 24 nov 2012 for simrs
                 */
                if (!empty($this->aksi['edit']))
                    $aksi .= '<a title="edit" class="btn btn-small btn-info edit" title="Edit" href="' . $this->aksi['edit'] . $aRow->$id . '">Edit</a>'; //<img src="'.base_url().'assets/images/edit-ikon.png">
                if (!empty($this->aksi['delete']))
                    $aksi .= '<a class="btn btn-small btn-danger delete" title="Delete" href="' . $this->aksi['delete'] . $aRow->$id . '">Delete</a>'; //<img src="'.base_url().'assets/images/delete-ikon.png">
                if (!empty($this->aksi['detail']))
                    $aksi .= '<a rel="simpledialog" title="Detail" class="btn btn-small detail" href="' . $this->aksi['detail'] . $aRow->$id . '">Detail</a>'; //<img src="'.base_url().'assets/images/detail-ikon.png">
                if (!empty($this->aksi['pilih']))
                    $aksi .= '<a title="Pilih" class="btn btn-small btn-primary pilih" href="' . $this->aksi['pilih'] . $aRow->$id . '">Pilih</a>'; //<img src="'.base_url().'assets/images/detail-ikon.png">

                    /* Added by Wahyudi Wibowo Sep 5,2014
                     * Description : Now we can create custom properties as needed for action button
                     */

                if (!empty($this->aksi['custom'])) {
                    foreach ($this->aksi['custom'] as $custom) {
                        $title = isset($custom['title']) ? $custom['title'] : '';
                        $class = isset($custom['class']) ? $custom['class'] : '';
                        $href = '';
                        if (isset($custom['href'])) {
                            $uid = isset($custom['href']['uid']) && $custom['href']['uid'] != "" ? $aRow->$custom['href']['uid'] : '';
                            $uri_segment = isset($custom['href']['uri_segment']) && !empty($custom['href']['uri_segment']) ? $custom['href']['uri_segment'] : array();
                            $href = $custom['href']['url'];
                            foreach ($uri_segment as $uri) {
                                $href .= $aRow->$uri . '/';
                            }
                            $href .= $uid;
                        }
                        $attributes = '';
                        if (isset($custom['attributes'])) {
                            switch ($custom['attributes']['type']) {
                                case 'openInNewTab':
                                    $uid = $custom['attributes']['uid'] != "" ? $aRow->$custom['attributes']['uid'] : '';
                                    $uri_segment = isset($custom['attributes']['uri_segment']) && !empty($custom['attributes']['uri_segment']) ? $custom['attributes']['uri_segment'] : array();
                                    $url = $custom['attributes']['url'];
                                    foreach ($uri_segment as $uri) {
                                        $url .= $aRow->$uri . '/';
                                    }
                                    $url .= $uid;
                                    $attributes = "onClick=\"window.open('" . $url . "','_blank')\"";
                                    break;
                            }
                        }
                        $text = isset($custom['text']) ? $custom['text'] : '';
                        $aksi .= "<a title='{$title}' class='btn btn-small {$class}' href='{$href}' {$attributes}>{$text}</a>";
                    }
                }
                $sOutput .= '"' . str_replace('"', '\"', $aksi) . '",';
            }
            $sOutput = substr_replace($sOutput, "", -1);
            $sOutput .= "],";
        }
        $sOutput = substr_replace($sOutput, "", -1);
        $sOutput .= '] }';
        echo $sOutput;
    }

    // --------------------------------------------------------------------
    function col_format($value, $i) {
        if (count($this->php_format) !== 0) {
            if ($this->php_format[$i] == "money")
                return int_to_money($value);
            elseif ($this->php_format[$i] == "float")
                return ((float) $value);
            elseif ($this->php_format[$i] == "date")
                return pretty_date($value, false);
            elseif ($this->php_format[$i] == "datetime")
                return pretty_date($value, true);
            elseif ($this->php_format[$i] == "strtoupper")
                return strtoupper($value);
            elseif ($this->php_format[$i] == "titlecase")
                return ucwords(strtolower($value));
            elseif ($this->php_format[$i] == "statusverbose") {
                if ($value == 0) {
                    return '<i>Tidak Aktif</i>';
                } else {
                    return '<i>Aktif</i>';
                }
            } else
                return $value;
        }
        else {
            return $value;
        }
    }

}
