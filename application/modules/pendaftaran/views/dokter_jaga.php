<div class="widget-box">
    <div class="widget-title">
        <span class="icon">
            </h5><i class="icon-list-alt"></i></h5>
        </span>
        <h5>Jadwal Dokter Jaga</h5>
    </div>
    <div class="widget-content-no-padding">
        <table id="schedule" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Jadwal Shift</th>
                    <th>Ahad</th>
                    <th>Senin</th>
                    <th>Selasa</th>
                    <th>Rabu</th>
                    <th>Kamis</th>
                    <th>Jumat</th>
                    <th>Sabtu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($shifts as $shift) : ?>
                    <tr>
                        <?php
                            $shift_start = substr($shift->shift_start,0,-3);
                            $shift_end = substr($shift->shift_end,0,-3);
                        ?>
                        <td><?= $shift_start ?> - <?= $shift_end ?></td>                        
                            <?php for ($i = 0; $i < 7; $i++) : ?>
                                <td title=""></td>
                            <?php endfor; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function(){
        var schedules = JSON.parse('<?=$schedules?>');
        var dayConverter = {'Ahad':0,'Senin':1,'Selasa':2,'Rabu':3,'Kamis':4,'Jumat':5,'Sabtu':6};
        $.each(schedules,function(index,value){
            var dayIndex = parseInt(dayConverter[value.day])+1;
            var shiftIndex = parseInt(value.shift_id);
            $('#schedule tr:eq('+shiftIndex+') td:eq('+dayIndex+')').attr('title',value.sd_name).html(value.sd_name);
        });
    });
</script>