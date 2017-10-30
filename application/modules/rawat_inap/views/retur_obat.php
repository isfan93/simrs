<style>
    .tabs-left > .nav-tabs > li > a{min-width:145px}
</style>
<div class="tabbable tabs-left">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#rm" data-toggle="tab">Retur Obat</a></li>
        <li class=""><a href="#rmh" data-toggle="tab">Riwayat Retur Obat</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="rm">
         <?php $this->load->view('returned_medicine',compact('list_of_medicine')) ?>
     </div>
     <div class="tab-pane" id="rmh">
         <?php $this->load->view('returned_medicine_history',compact('returned_medicine_history')) ?>
     </div>
 </div>
</div>
<div class='page_footer row-fluid'>
    <?= form_button(array('id' => 'submit', 'class' => 'btn btn-primary', 'type' => 'submit', 'content' => 'Simpan')) ?>
</div>