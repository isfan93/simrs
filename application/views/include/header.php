<br clear='all'>
<div class="header">
    <ul class="headermenu" style="margin-left:2px !important">
        <!-- <li>
            <a href="<?= base_url() ?>" style="min-width:0px !important">
                <img src="<?= base_url() ?>assets/img/icons/24/home.png"> 
            </a>
        </li> -->
        <?php if ($this->module) : ?>
            <?php foreach ($this->module as $module): ?>
                <li>
                    <!-- <img src="<?= base_url() ?>assets/images/icons/star.png" style="margin:6px" />  -->
                    <a href="<?= base_url() ?><?= $module['module_url'] ?>">
                        <?= $module['module_name'] ?>
                    </a>
                </li>
            <?php endforeach ?>
        <?php endif ?>
    </ul>
</div>