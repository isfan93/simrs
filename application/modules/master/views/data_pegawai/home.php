<script type="text/javascript" charset="utf-8">

function reloadTable(){
            var url_hasil="<?php echo base_url()?>master/data_pegawai/loaddata"
            $(".table_pegawai").load(url_hasil);
}

	$(function(){
	      crsf = $('.crsf').val();


		$.ajax({
	          url: '<?php echo base_url()?>master/data_pegawai/loaddata',
	          type: "POST",
	          crossDomain: true,
	          data: "csrf_jike_2012="+crsf,
	          dataType: "html",
	          success: function( data ) {
	             
	            $('.table_pegawai').append(data);
	          }
	        });

		$('.searchname').keyup(function(){
            var search = $('.searchname').val();
            $('.dataTables_filter input').val(search).trigger('keyup');
            //tbldokter.fnDraw();
         })

		$('.tabel-dokter').dataTable( {
              
                "sPaginationType": "bootstrap",
                "bPaginate": true,
                "bFilter": true,
                "bRetrieve": true,
                 "bDestroy": true,
                "bSort": true,
                "aoColumnDefs": [
				      { "bSortable": false, "aTargets": [ 0 ],"sWidth":"5%"  },
				      { "bSortable": false, "aTargets": [ 1 ],"sWidth":"10%"  },
				      { "bSortable": true, "aTargets": [ 2 ],"sWidth":"20%"  },
				      { "bSortable": true, "aTargets": [ 3 ],"sWidth":"20%"  },
				      { "bSortable": true, "aTargets": [ 4 ],"sWidth":"20%"  },
				      { "bSortable": true, "aTargets": [ 5 ],"sWidth":"30%"  },
				      { "bSortable": false, "aTargets": [ 7 ],"sWidth":"10%"  },
				      { "bSortable": false, "aTargets": [ 6 ],"sWidth":"10%"  }
				   ],
                "oLanguage": {
                  "sEmptyTable": "Data pegawai atau dokter tidak ditemukan"
                }
            });
      

		  
		$(".delete_data").on("click",function(e){
			//alert("debug");
			id_array= new Array();
			i=0;
			$("input.chk:checked").each(function(){
				id_array[i] = $(this).val();
				i++;

			})

       $('.tambahData input').val('');
       $('.tambahData select').val('');

			if(id_array!=0){
		       var r = confirm("Anda yakin akan menghapus data obat ini ?");
		          if (r == true) {
		                console.log(id_array);
		        
		                // $(".black_loader").fadeIn(300).fadeOut(function(){
		                   $.ajax({
		                      url: "<?php echo base_url()?>master/data_pegawai/delete_multy",
		                      data: "kode="+id_array+"&csrf_jike_2012="+crsf,
		                      type: "POST",
		                      success: function(){
		                        //alert("");
		                        reloadTable();
		                      }
		                    })
		                // });
		              
		       };
			}else {alert("Silahkan memilih data yang akan dihapus.")}
      return false;
		})
		
		$('.btn_trash').live("click",function(){
        t = this;
        var r = confirm("Anda yakin akan menghapus data ini ?");
        if (r == true) {
          //$(".black_loader").fadeIn(300).fadeOut(function(){
            // console.log($(t).attr('href'));
            $.get($(t).attr('href')).done(function(){
              reloadTable();
            });
          //});
        } 
        return false;
      })

	})
</script>
<style>
    .dataTables_scrollHead{
        margin-bottom: -22px;
    }
    .dataTables_info{
        margin-top: 20px;
    }
</style>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pageheader notab">
		    <h1 class="pagetitle"><?=$title?></h1>
		</div>
	</div>

	 <div class="row-fluid">
        <div class="span7">
            <div class="widgetbox" style="float:left;padding-top:20px;padding-left:20px;">
				<a href="<?php echo base_url()?>master/data_pegawai/add" class="btn btn-success">
						<i class="icon-plus-sign icon-white"></i>Tambah</a>
				<a href="#" class="btn btn-danger delete_data">
						<i class="icon-trash icon-white"></i> Hapus</a>
            </div>
        </div>
        <div class="span5" style="float:right;">
            <div class="widgetbox">
              <input type="hidden" class='crsf' name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" >
                
                 <?=form_open(cur_url().'search',array('class' => 'form-horizontal frm_search stdform','id' => 'form')); ?> 
                    <!--input type='hidden' name='tgl_frm' class='tgl_frm'-->
                    <div class="chatsearch" >
                        <input type="text" class='searchname' name="nama_dokter" placeholder="Cari Nama Dokter / Pegawai" style="width:91%;margin:auto;">
                    </div>
                    <div style='display:none;' id="basic">
                        <input type="text" class="mediuminput" placeholder="masukkan nama dokter" autofocus="autofocus">
                    </div>
                      
                     
                    
                </form>
            </div>
        </div>
    </div>

	<div class="row-fluid table_pegawai">
       
    </div>
</div>