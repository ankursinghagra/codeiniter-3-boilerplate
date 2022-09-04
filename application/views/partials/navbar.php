<nav class="side-menu">
        <div class="side-menu-avatar">
            <div class="avatar-preview avatar-preview-100">
                <a href="<?=base_url()?>profile"><img src="<?=base_url()?>uploads/admins/<?=$user_data['admin_photo']?>" alt=""></a>
            </div>
            <div class="avatar-info text-center">
                <h4 class="lbl"><?=$user_data['admin_name']?></h4>
                <p class="small"><?=$user_data['admin_email']?></p>
            </div>
        </div>
        <ul class="side-menu-list">
            <li class="blue">
                <a href="<?=base_url(env('ADMIN_FOLDER').'/dashboard')?>">
                    <i class="font-icon font-icon-dashboard"></i>
                    <span class="lbl">Dashboard</span>
                </a>
            </li>
            <?php if(isset($view_permissions->siteoptions)) {?>
            <li class="blue">
                <a href="<?=base_url(env('ADMIN_FOLDER').'/siteoptions')?>">
                    <i class="font-icon font-icon-cogwheel"></i>
                    <span class="lbl">Site Settings</span>
                </a>
            </li>
            <?php } ?>
            <?php if( isset($view_permissions->users)||isset($view_permissions->groups)||isset($view_permissions->permissions) ) {?>
            <li class="blue">
                <a href="<?=base_url(env('ADMIN_FOLDER').'/users')?>">
                    <i class="font-icon font-icon-users"></i>
                    <span class="lbl">Users</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($view_permissions->pages)) {?>
            <li class="blue">
                <a href="<?=base_url(env('ADMIN_FOLDER').'/pages')?>">
                    <i class="glyphicon glyphicon-duplicate"></i>
                    <span class="lbl">Pages</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($view_permissions->menu)) {?>
            <li class="blue">
                <a href="<?=base_url(env('ADMIN_FOLDER').'/menu')?>">
                    <i class="font-icon font-icon-burger"></i>
                    <span class="lbl">Menu</span>
                </a>
            </li>
            <?php } ?>
            <?php if (isset($view_permissions->footer)) {?>
            <li class="blue">
                <a href="<?=base_url(env('ADMIN_FOLDER').'/footer')?>">
                    <i class="font-icon font-icon-burger"></i>
                    <span class="lbl">Footer</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($view_permissions->slider)) {?>
            <li class="blue <?php if(!$modules['slider']['module_status']){echo 'disabled';} ?>">
                <a href="<?=base_url(env('ADMIN_FOLDER').'/slider')?>">
                    <i class="font-icon font-icon-picture-2"></i>
                    <span class="lbl">Slider</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($view_permissions->blog)) {?>
            <li class="blue <?php if(!$modules['blog']['module_status']){echo 'disabled';} ?>">
                <a href="<?=base_url(env('ADMIN_FOLDER').'/blog')?>">
                    <i class="glyphicon glyphicon-list-alt"></i>
                    <span class="lbl">Blog</span>
                </a>
            </li>
            <?php } ?>

            <?php if (isset($view_permissions->portfolio)) {?>
            <li class="blue <?php if(!$modules['portfolio']['module_status']){echo 'disabled';} ?>">
                <a href="<?=base_url(env('ADMIN_FOLDER').'/portfolio')?>">
                    <i class="font-icon font-icon-picture-2"></i>
                    <span class="lbl">Portfolio</span>
                </a>
            </li>
            <?php } ?>
            <?php if (isset($view_permissions->photos)) {?>
            <li class="blue <?php if(!$modules['photos']['module_status']){echo 'disabled';} ?>">
                <a href="<?=base_url(env('ADMIN_FOLDER').'/photos')?>">
                    <i class="font-icon font-icon-picture-2"></i>
                    <span class="lbl">Photos Gallery</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($view_permissions->videos)) {?>
            <li class="blue <?php if(!$modules['videos']['module_status']){echo 'disabled';} ?>">
                <a href="<?=base_url(env('ADMIN_FOLDER').'/videos')?>">
                    <i class="fa fa-youtube"></i>
                    <span class="lbl">Videos Gallery</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($view_permissions->team)) {?>
            <li class="blue <?php if(!$modules['team']['module_status']){echo 'disabled';} ?>">
                <a href="<?=base_url(env('ADMIN_FOLDER').'/team')?>">
                    <i class="font-icon font-icon-users"></i>
                    <span class="lbl">Team Members</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($view_permissions->visitors)) {?>
            <li class="blue <?php if(!$modules['visitors']['module_status']){echo 'disabled';} ?>">
                <a href="<?=base_url(env('ADMIN_FOLDER').'/visitors')?>">
                    <i class="fa fa-envelope"></i>
                    <span class="lbl">Visitor Messages</span>
                </a>
            </li>
            <?php } ?>

            <!-- <li class="purple with-sub">
                <span>
                    <i class="font-icon font-icon-comments active"></i>
                    <span class="lbl">Messages</span>
                </span>
                <ul>
                    <li><a href="#"><span class="lbl">Inbox</span><span class="label label-custom label-pill label-danger">4</span></a></li>
                    <li><a href="#"><span class="lbl">Sent mail</span></a></li>
                    <li><a href="#"><span class="lbl">Bin</span></a></li>
                </ul>
            </li> -->

        </ul>
    </nav><!--.side-menu-->