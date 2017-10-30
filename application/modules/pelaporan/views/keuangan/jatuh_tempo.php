<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.css" />
<link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.css" />
<script src="<?= base_url() ?>assets/js/select2.js"></script>
<style>
	.table_tr thead th{
		height: 28px;
		vertical-align: middle;
		font-size: 13px;
	}

	.alert{
        background-color: transparent;
        border: 0px;
    }

    #gritter-notice-wrapper{
        right: 13%;
        top: 100px;
    }
    .hiddens{
        display: none;
    }
    .active{
        background: #FFF;
    }
    .black_loader{
        display: block;
        opacity: 0.6;
    }
</style>

<div id="gritter-notice-wrapper" class="alert hide" style="width:750px;position:fixed">
    <div id="gritter-item-1" class="gritter-item-wrapper" style="margin:0 -17px 5px 0">
        <div class="gritter-top"></div>
        <div class="gritter-item">
            <div class="gritter-close" style="display: none; width:50px "></div>
            <img src="<?=base_url()?>assets/img/demo/envelope.png" class="gritter-image">
            <div class="gritter-with-image" style="width:448px">
                <span class="gritter-title" style="margin-left:36px">Message</span>
                <p>Data Berhasil Disimpan   </p>
            </div>
            <div style="clear:both"></div>
        </div>
        <div class="gritter-bottom"></div>
    </div>
</div>

<div class="pageheader notab">
	<div class="row-fluid">
		<div class="span6">
			<h1 class="pagetitle" style="width:50%;"><?=$title?>
			</h1>
		</div>
	</div>
</div>

<style type="text/css">
    .table tr th{
        line-height: 35px;
        font-size: 13px;
    }
</style>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12" style="text-align:center;">
            <div class="title">
                <h3>
                    Rekap Tagihan Jatuh Tempo Rumah Sakit "Intan Husada"
                </h3>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Faktur</th>
                        <th>Supplier</th>
                        <th>Tanggal Faktur</th>
                        <th>Jatuh Tempo</th>
                        <th>Jumlah Tagihan</th>
                        <th>Retur</th>
                        <th>Total Tagihan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($jatuhtempo) && ($jatuhtempo->num_rows() >= 1) ) : ?>
                        <?php foreach ($jatuhtempo->result() as $key => $value) : ?>
                            <tr>
                                <td style="text-align:center;"><?=($key+1)?></td>
                                <td style="text-align:left;">
                                    <?=$value->faktur_id?><br>
                                    <?=$value->faktur_number?><br>
                                </td>
                                <td>
                                    <?=$value->msup_name?>
                                </td>
                                <td>
                                    <?=pretty_date($value->faktur_date,false)?>
                                </td>
                                <td>
                                    <?php
                                        $date1=date_create(date('Y-m-d'));
                                        $date2=date_create($value->faktur_date_maturity);
                                        $diff=date_diff($date1,$date2);
                                    ?>
                                    <b><?=($diff->format('%R%a days'))?></b><br>
                                    <?=pretty_date($value->faktur_date_maturity,false)?>
                                </td>
                                <td style="text-align:right;font-weight:bold;">
                                    <?=number_format($value->faktur_total,0,',','.')?>
                                </td>
                                <td style="text-align:right;font-weight:bold;">
                                    <?=number_format( isset($value->ir_total) ? $value->ir_total : '0' ,0,',','.') ?>
                                </td>
                                <td style="text-align:right;font-weight:bold;">
                                    <?=number_format(($value->faktur_total - (isset($value->ir_total) ? $value->ir_total : '0' )),0,',','.')?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    <?php elseif($jatuhtempo->num_rows() <= 0) :?>
                        <tr>
                            <td colspan="4" style="text-align:center;">
                                Maaf, Tidak Ada data Kunjungan Pasien
                            </td>
                        </tr>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
</div>