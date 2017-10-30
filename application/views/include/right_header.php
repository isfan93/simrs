<style type="text/css">
    .userinfodrop{
        padding: 0px;
        margin: 0px;
        top: 40px;
    }
    .userdata{
        margin-top: 0px;
    }
    .userdata ul{
        margin-top: 0px;
        margin-bottom: 0px;
        font-family: 'RobotoCondensed', Arial, Helvetica, sans-serif;
    }
    .userinfodrop{
        min-width: 80px;
        margin-left:-80px;
    }
</style>

<div class="userinfo">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <img src="<?=base_url()?>assets/images/thumbs/avatar.png" alt="" />
        <span><?=get_user('user_name')?></span>
    </a>
    <div class="userinfodrop dropdown-menu">
        <div class="userdata">
            <ul style="margin-left:0;padding-left:0;">
                <li><a href="help.html">Help</a></li>
                <li><a href="<?=base_url()?>user/profil">Account Settings</a></li>
                <li><a href="<?=base_url()?>logout">Sign Out</a></li>
            </ul>
        </div>
    </div>
</div>