<style>
    .tabs-left > .nav-tabs > li > a{min-width:145px}
</style>

<div class="tabbable tabs-left">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#nursingDiagnosis" data-toggle="tab">Perencanaan Keperawatan</a></li>
        <li class=""><a href="#nursingTreatment" data-toggle="tab">Treatment</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="nursingDiagnosis">
            <?php $this->load->view('nursing_diagnosis',$diagnosis) ?>
        </div>
        <div class="tab-pane" id="nursingTreatment">
            <?php $this->load->view('nursing_treatment',$treatment) ?>
        </div>
    </div>
</div>
<div class='page_footer row-fluid'>
    <?= form_button(array('data-url' => base_url().'rawat_inap/simpan_perencanaan_keperawatan/'.$this->uri->segment(3),'class' => 'btn btn-primary', 'id' => 'submitNPx' , 'type' => 'submit', 'content' => 'Simpan')) ?>
</div>

<script>
    $('#submitNPx').die().live('click', function (e) {
        e.preventDefault();
        var data = $('#nursingDiagnosisForm').serialize();
        data += '&' + $('#nursingTreatmentForm').serialize();
        //data += '&' + $('#prescriptionForm').serialize();
        var url = $(this).attr('data-url');
        $.post(url, data, function (response) {
            response = JSON.parse(response);
            if ("success" === response.success) {
                $("#gritter-notice-wrapper").fadeIn().delay(300).fadeOut(function () {
                    location.reload(true);
                });
            }
        });
    });
</script>