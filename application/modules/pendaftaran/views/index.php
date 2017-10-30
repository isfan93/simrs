<style>
    .page_footer{background-color:#CDCDCD;}
    .page_footer button{float:right;margin:10px;}
</style>
<div class="pageheader notab">
    <h1 class="pagetitle"><?= $title ?></h1>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span8 offset2">
            <?= form_open('', array('id' => 'searchForm', 'class' => 'form-horizontal')) ?>
            <div class="row-fluid">
                <div class="span11">
                    <div class="chatsearch">
                        <input type="text" name="searchInput" style="width:93%;margin:auto;" placeholder="Masukkan nomor kartu, nomor rekam medis, atau nama pasien">
                    </div>
                    <div>
                        <button class="btn btn-link" id="advancedSearchButton" style="text-decoration:none;margin-right:10px"><i class="icon-chevron-down"></i> Pencarian Spesifik</button>
                        <button class="btn btn-link pendaftaran-umum" style="text-decoration:none;margin-right:10px">Pendaftaran Pasien Umum / Rujukan</button>
                    </div>
                    <div id="advancedSearch" style="display:none;margin-top:10px;width:70%">
                        <div class="widget-box">
                            <label class="control-label">Tanggal Lahir</label>
                            <div class="controls">
                                <select  name="day" style="float:left;min-width:30px;width:90px" class="chosen-select">
                                    <option value="" >-- tgl --</option>
                                    <?= get_hari() ?>
                                </select>
                                <select name="month" style="width:90px" class="chosen-select">
                                    <option value="">-- bln --</option>
                                    <?= get_bulan() ?>
                                </select>
                                <select name="year" style="width:90px" class="chosen-select">
                                    <option value="">-- thn --</option>
                                    <?= get_tahun() ?>
                                </select>
                            </div>
                            <label class="control-label">Kota/Kabupaten</label>
                            <div class="controls">
                                <select name="regency" class="chosen-select">
                                    <option value="">-- Pilih Kabupaten --</option>
                                    <?php foreach ($regency as $key) : ?>
                                        <option value="<?= $key->mre_id ?>"><?= $key->mre_name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <label class="control-label">No. Telepon</label>
                            <div class="controls">
                                <?= form_input(array('name' => 'phone')) ?>
                            </div>
                            <!--                        <div class="page_footer row-fluid">
                                                        <button class="btn btn-primary" id="resetSearchButton">Reset</button>
                                                    </div>-->
                        </div>
                    </div>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?= base_url() ?>assets/css/jquery.gritter.css" />
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="" style="margin-top:0px">
                <div class="pendaftaran-content"></div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?= base_url() ?>assets/css/chosen.css" />
<script src="<?= base_url() ?>assets/js/jquery.chosen.js"></script>
<script>
    $(document).ready(function() {
        $('input[name=searchInput]').prop('disabled', false).focus();
        $('.chosen-select').chosen({no_results_text: "data tidak ditemukan!"});
        $('#advancedSearchButton').click(function(e) {
            e.preventDefault();
            if ($('#advancedSearch').is(':hidden')) {
                $('#advancedSearchButton>i').attr('class', 'icon-chevron-up');
            } else {
                $('#advancedSearchButton>i').attr('class', 'icon-chevron-down');
            }
            $('#advancedSearch').toggle({'drop': 'down'});
        });

//        $('#resetSearchButton').click(function(){
//           $('#searchForm')[0].reset();
//        });

        //setup before functions
        var typingTimer;                //timer identifier
        var doneTypingInterval = 600;  //time in ms, 5 second for example

        //on keyup, start the countdown
        $('.chatsearch input').keyup(function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        });

        //on keydown, clear the countdown
        $('.chatsearch input').keydown(function() {
            clearTimeout(typingTimer);
        });

        //user is "finished typing," do something
        function doneTyping() {
            if ('' !== $('input[name=searchInput]').val()) {
                $.ajax({
                    url: "<?= base_url() ?>pendaftaran/getPatientData",
                    type: 'post',
                    data: $('#searchForm').serialize(),
                    success: function(result) {
                        if ("" === result) {
                            $('.pendaftaran-content').load('<?= base_url() ?>pendaftaran/pendaftaran_baru');
                        } else {
                            $('.pendaftaran-content').html(result);
                        }
                    }
                });
            }
        }

        $('.pendaftaran-umum').click(function(){
            $('.pendaftaran-content').load('<?= base_url() ?>pendaftaran/pilih_layanan/');
            return false;
        });
    });
</script>



