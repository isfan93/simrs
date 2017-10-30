<style>
    .tabs-left > .nav-tabs > li > a{min-width:145px}
</style>
<div class="tabbable tabs-left">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#pic" data-toggle="tab">Person in Charge</a></li>
        <li class=""><a href="#subjective" data-toggle="tab">Subjective & Objective</a></li>
        <li class=""><a href="#assessment" data-toggle="tab">Assessment & Procedures</a></li>
        <li class=""><a href="#medications" data-toggle="tab">Medications</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="pic">
            <?php $this->load->view('pic', $pic) ?>
        </div>
        <div class="tab-pane" id="subjective">
            <?php $this->load->view('subjective_objective') ?>
        </div>
        <div class="tab-pane" id="assessment">
            <?php $this->load->view('diagnosis',$patient_data) ?>
        </div>
        <div class="tab-pane" id="medications">
            <?php $this->load->view('medications',$selecttext_rute) ?>
        </div>
    </div>
</div>
<div class='page_footer row-fluid'>
    <?= form_button(array('data-url' => base_url().'rawat_inap/simpan_visite_dokter/'.$this->uri->segment(3),'class' => 'btn btn-primary', 'id' => 'submitVD' , 'type' => 'submit', 'content' => 'Simpan')) ?>
</div>

<script>
    $('#submitVD').die().live('click', function (e) {
        e.preventDefault();
        var data = $('#picForm').serialize();
        data += '&' + $('#subObjForm').serialize();
        data += '&' + $('#diagnoseForm').serialize();
        data += '&' + $('#prescriptionForm').serialize();
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