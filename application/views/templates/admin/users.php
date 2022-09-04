<div class="box-typical box-typical-padding">
	<h5 class="m-t-lg with-border"></h5>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row grid-menu">
					<?php if(isset($modify_permissions->users)) { ?>
					<a href="<?=base_url(env('ADMIN_FOLDER'))?>/users/add_user">
						<div class="col-md-3 grid-menu-item text-center">
							<div class="icon"><i class="fa fa-plus fa-5x"></i></div>
							<div class="caption">Add Users</div>
						</div>
					</a>
					<?php } ?>
					<?php if(isset($view_permissions->users)){ ?>
					<a href="<?=base_url(env('ADMIN_FOLDER'))?>/users/all_users">
						<div class="col-md-3 grid-menu-item text-center">
							<div class="icon"><i class="fa fa-user fa-5x"></i></div>
							<div class="caption">All Users</div>
						</div>
					</a>
					<?php } ?>
					<?php if(isset($view_permissions->groups)){ ?>
					<a href="<?=base_url(env('ADMIN_FOLDER'))?>/users/add_group">
						<div class="col-md-3 grid-menu-item text-center">
							<div class="icon"><i class="fa fa-plus fa-5x"></i></div>
							<div class="caption">Add Group</div>
						</div>
					</a>
					<?php } ?>
					<?php if(isset($modify_permissions->groups)){ ?>
					<a href="<?=base_url(env('ADMIN_FOLDER'))?>/users/all_groups">
						<div class="col-md-3 grid-menu-item text-center">
							<div class="icon"><i class="fa fa-users fa-5x"></i></div>
							<div class="caption">Groups</div>
						</div>
					</a>
					<?php } ?>
					<?php if(isset($view_permissions->permissions)){ ?>
					<a href="<?=base_url(env('ADMIN_FOLDER'))?>/users/permissions">
						<div class="col-md-3 grid-menu-item text-center">
							<div class="icon"><i class="fa fa-check fa-5x"></i></div>
							<div class="caption">Permissions</div>
						</div>
					</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>