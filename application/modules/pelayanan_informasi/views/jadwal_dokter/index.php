<script type="text/javascript" src='<?=base_url()?>assets/js/modul/informasi/dokter.js'></script> 
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/informasi/style.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/css/chosen.css" />
<script src="<?= base_url() ?>assets/js/jquery.chosen.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.css" />
<script src="<?= base_url() ?>assets/js/select2.js"></script>
<script type="text/javascript">
  $(function(){
  //select2
		$("#doctor_name").select2({
            minimumInputLength: 2,
            width:'60%',
            placeholder : 'Nama Dokter',
            ajax: {
                url: BASE+"pelayanan_informasi/jadwal_dokter/get_dokter2",
                dataType: 'json',
                type: "GET",
                quietMillis: 50,
                data: function (term) {
                    return {
                        term: term
                    };
                },
                results: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
								
                            }
							//
                        })
                    };
					//$('#koef_id').val(data.id)
                }
            }
        });
		$('#dyntable').dataTable({
				"sPaginationType": "bootstrap",
     // "sScrollY": "400px",
        "bPaginate": true,
        "bFilter": true,
        "bRetrieve": true,
        "bDestroy": true,
        "bSort": true,
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              var settings = this.fnSettings();
              var str = settings.oPreviousSearch.sSearch;
              $('td', nRow).each( function (i) {
                  this.innerHTML = aData[i].replace( new RegExp( str, 'i'), function(matched) { return "<span class='highlight'>"+matched+"</span>";} );
              } );
              return nRow;
          },
        "aoColumnDefs": [
				      { "bSortable": false, "aTargets": [ 0 ],"sWidth":"15%"},
  					  { "bSortable": false, "aTargets": [ 1 ],"sWidth":"20%"},
  					  { "bSortable": false, "aTargets": [ 2 ],"sWidth":"20%"},
  					  { "bSortable": false, "aTargets": [ 3 ],"sWidth":"20%"},
  					  { "bSortable": false, "aTargets": [ 4 ],"sWidth":"20%"},
  					  { "bSortable": false, "aTargets": [ 5 ],"sWidth":"20%"}
				   ],
                "oLanguage": {
                  "sEmptyTable": "data tidak tersedia"}
                });

      var d_uri = "<?=base_url()?>pelayanan_informasi/jadwal_dokter/get_jadwal_dokter";
        oTb = $('#dyntableY').dataTable( {
          "bProcessing": true,
          "bServerSide": true,
          "bLengthChange": false,   
          "bFilter": true,
          "sPaginationType": "full_numbers",
          "aoColumns": [null,null,null,null,null,null,null],
          "sAjaxSource": d_uri,
          "fnServerData": function ( sSource, aoData, fnCallback ) {
            var newArray = $.merge(aoData, [{ "name": "<?=$this->security->get_csrf_token_name()?>", "value": "<?=$this->security->get_csrf_hash()?>" }]);
            $.ajax( {
              "dataType": 'json',
              "type": "POST", 
              "url": sSource, 
              "data": aoData, 
              "success": fnCallback
            } );
          },
          "fnDrawCallback": function() {
            $("#dyntable tbody td:nth-child(1)").addClass('center');
            $("#dyntable tbody td:nth-child(2)").addClass('left');
            $("#dyntable tbody td:nth-child(3)").addClass('left');
            $("#dyntable tbody td:nth-child(4)").addClass('center');
            $("#dyntable tbody td:nth-child(5)").addClass('center');
            $("#dyntable tbody td:nth-child(6)").addClass('center');
            $("#dyntable tbody td:nth-child(7)").addClass('center');
          }
        });

        $("#dyntable_filter").hide();
        $(".dataTables_length").hide();
        $(".chatsearch input").keyup(function(e){
          $("#dyntable_filter input").val($(".chatsearch input").val()).trigger('keyup');
        })
  });
</script>


<style>
    .dataTables_scrollHead{
        margin-bottom: -22px;
    }
    .dataTables_info{
        margin-top: 20px;
    }
    .dataTables_filters  input {
        position: absolute;
        top: -20px;
    }
    .table_tr thead th{
      height: 28px;
      vertical-align: middle;
      font-size: 13px;
    }
    .table_tr tbody th{
      height: 28px;
      vertical-align: middle;
      font-size: 13px;
    }
</style>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="pageheader notab">
            <h1 class="pagetitle"><?=$title?>  </h1>
        </div>
        <div class="row-fluid">
          <div class="span5" style="float:right;">
            <div class="widgetbox" style="margin-top:20px;">
              <?=form_open('',array('class'=>'frm_search','id'=>'frm_search'));?>
			  <!--form method="post" action=""-->
                <div id="basic">
                    <div class="chatsearch" >
                        <input type="text" name="" placeholder="Search" style="width:91%;margin:auto;">
						<!--input type="hidden" name="key" id="doctor_name" class="" value="">
						<button type="submit" class="btn-success">Cari</button-->
                    </div>
                </div>
              <?=form_close()?>
            </div>
          </div>
        </div>
    </div>
    <br clear="all">
    <div class="row-fluid">
      <div class="widgetbox">
        <div class="span12">
			<?php echo $konten ?>
          <!--table id="dyntable" class="table table-bordered table_tr">
            <thead>
              <th style="width:20%;">Dokter</th>
              <th style="width:20%;">Spesialistik</th>
              <th style="width:10%;">Poli</th>
              <th style="width:8%;">Hari</th>
              <th style="width:8%;">Shift</th>
              <th style="width:12%;">Waktu Mulai</th>
              <th style="width:12%;">Waktu Selesai</th>
            </thead>
          </table-->
        </div>
      </div>
    </div>
</div>

<style type="text/css">
  .highlight{
    background: #FB9337;
    color: 
  }
</style>