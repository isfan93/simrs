<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal_dokter extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('jadwal_dokter_model');
	}
	
	public function index(){
		$key="";$temp="";
		if($this->input->post($key)!=""){$temp=$this->input->post($key);}		
		$data['main_view']	= 'jadwal_dokter/index';
		$data['title']		= 'Jadwal Dokter';
		//$data['current']	= 1;
		$data['current']	= 6;
		$cf					= $this->cf;
		$data['cf']			=  $cf;
		$data['desc']		= 'Description. ';
		$data['konten'] 	= $this->loaddata($temp);
		$this->load->view('template',$data);
	}

	public function get_jadwal_dokter()
	{
		$config['sTable']		= "trx_dr_schedule tds";
		$config['aColumns']		= array("sd_name","description","pl_name","day","shift_nama","shift_start","shift_end");
		$config['aColumns_format']	= array("me.sd_name,mtu.description,mp.pl_name,tds.day,ms.shift_nama,ms.shift_start,ms.shift_end");
		$config['php_format']	= array("strtoupper","strtoupper","strtoupper","strtoupper","strtoupper","","");
		$config['key']			= "me.sd_nip";
		$config['join'][]		= array("mst_employer me","me.id_employe = tds.employe_id");
		$config['join'][]		= array("mst_shift ms","ms.shift_id = tds.sch_shift");
		$config['join'][]		= array("mst_poly mp","mp.pl_id = tds.pl_id");
		$config['join'][]		= array("mst_type_user mtu","me.sd_type_user = mtu.id_type_user");
		$config['searchColumn']	= array("sd_name");
		$config['aksi']			= array(
									'stat'  	=> false,
									// 'key'		=> 'ipo_id',
									// 'pilih'	=> base_url().'gudang/purchase_order/detail/',
									);
		init_datatable($config);
	}

	// SELECT tds.sch_id,me.sd_name,tds.day,ms.shift_start,ms.shift_end,mp.pl_name
	// 		FROM trx_dr_schedule tds
	// 		JOIN mst_employer me ON(me.id_employe=tds.employe_id)
	// 		JOIN mst_shift ms ON(ms.shift_id=tds.sch_shift)
	// 		JOIN mst_poly mp ON(mp.pl_id=tds.pl_id)

	function get_dokter(){
		$query = $this->input->get('q'); 
		$this->db->select('*');
		$this->db->where('sd_type_user','1');
		$this->db->from('mst_employer');
		if($query!=null){
			$this->db->like('sd_name', "$query",'both');
		}
		$data = $this->db->get()->result();
		foreach ($data as $datas) {
			$data['results'][] = array(
				'id'	=> "$datas->id_employ",
				'name'	=> "$datas->sd_name"
			);
		}

		echo json_encode($data);
	}
	
	public function get_dokter2()
	{
		$data = array();
		$q = strtolower($_GET['term']);
		$data = $this->db->select('id_employe as id,sd_name as name')->where('sd_employe_tp','1')->like('lower(sd_name)', $q, 'both')->get('mst_employer',100,0)->result_array();
		// echo json_encode(array('results'=> $data));
		echo json_encode($data);
	}
	
	function loaddata($temp){
		print_r($temp);//die();
		$kolom = array();
        //inisialisasi nilai        
        $result=$this->jadwal_dokter_model->getRows($temp);
        foreach($result as $key => $rows)
        {
            //$kolom1[$rows->kode_obat][$rows->kode_pusk]['kode_obat']=$rows->kode_obat;
            if(isset($kolom1[$rows->shift_id][$rows->day]['konten'])){
            	$kolom1[$rows->shift_id][$rows->day]['konten']=$kolom1[$rows->shift_id][$rows->day]['konten'].'<li>'.$rows->sd_name.'('.$rows->pl_name.')</li>';
            }else {
            	$kolom1[$rows->shift_id][$rows->day]['konten']='<li>'.$rows->sd_name.'('.$rows->pl_name.')</li>';
            }
            //$kolom1[$rows->id_hlp][$rows->dana]['out']=$rows->pemberian;
            //KONTEN KOLOM1

            $kolom1[$rows->shift_id]['durasi']=substr($rows->shift_start,0,5).'-'.substr($rows->shift_end,0,5);
        }
        //print_r($kolom1);//die;
        //HEADER
        $day=$this->jadwal_dokter_model->getDay();        
        //$colspan=sizeof($sumber);
        $tabel='<table style="width:100% !important" border="" id="dyntable" class="table table-bordered table_tr"><thead><tr><th>Shift</th>';
        foreach ($day as $list) {
            $tabel.='<th><center>'.$list->day.'</center></th>';
        }
        $tabel.='</tr></thead><tbody>';
        //KONTEN
        $j=0;
        foreach ($kolom1 as $key => $value) {           
            $tabel.='<tr><td>'.$kolom1[$key]['durasi'].'</td>';            
            foreach ($day as $list) 
            {
                
                $tmp = (isset($kolom1[$key][$list->day]['konten'])) ? $kolom1[$key][$list->day]['konten'] : "(kosong)";
                //$tmp_pemberian = (isset($kolom1[$key][$anggaran->dana]['out'])) ? $kolom1[$key][$anggaran->dana]['out'] : 0;
                //$temp_in=$temp_in+$tmpsedia;
                //$temp_out=$temp_out+$tmp_pemberian;

                $tabel.='<td><ol>'.$tmp.'</ol></td>';
            }
            
            $tabel.='</tr>';
            $j++;
        }
        //print_r($kolom1[$key][$list->day]['konten']);die();            
        $tabel.='</tbody></table>';
        //$data['konten_jadwal']=$tabel;
        //print_r($tabel);die();
        return $tabel;
        //$this->load->view('laporan/stok_generik',$data);
    }

}