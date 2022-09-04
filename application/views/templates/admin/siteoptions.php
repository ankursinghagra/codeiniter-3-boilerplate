<div class="box-typical box-typical-padding">
	<h5 class="m-t-lg with-border"></h5>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row grid-menu">
					<!-- grid item -->
					<a href="<?=base_url(env('ADMIN_FOLDER'))?>/siteoptions/information">
						<div class="col-md-3 grid-menu-item text-center">
							<div class="icon"><i class="fa fa-info fa-5x"></i></div>
							<div class="caption">Information</div>
						</div>
					</a>
					<!-- grid item -->
					<a href="<?=base_url(env('ADMIN_FOLDER'))?>/siteoptions/settings">
						<div class="col-md-3 grid-menu-item text-center">
							<div class="icon"><i class="fa fa-gear fa-5x"></i></div>
							<div class="caption">Settings</div>
						</div>
					</a>
					<!-- grid item -->
					<?php if(isset($view_permissions->seo)) {?>
					<a href="<?=base_url(env('ADMIN_FOLDER'))?>/siteoptions/seo_settings">
						<div class="col-md-3 grid-menu-item text-center">
							<div class="icon"><i class="fa fa-globe fa-5x"></i></div>
							<div class="caption">Seo Settings</div>
						</div>
					</a>
					<?php }?>
					<!-- grid item -->
					<a href="<?=base_url(env('ADMIN_FOLDER'))?>/siteoptions/email">
						<div class="col-md-3 grid-menu-item text-center">
							<div class="icon"><i class="fa fa-envelope fa-5x"></i></div>
							<div class="caption">Email</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>