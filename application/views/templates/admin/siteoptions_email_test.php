<section class="tabs-section">
	<div class="tabs-section-nav tabs-section-nav-icons">
		<div class="tbl">
			<ul class="nav" role="tablist">
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url(env('ADMIN_FOLDER'))?>/siteoptions/email">
						<span class="nav-link-in">
							<i class="font-icon font-icon-cogwheel"></i>
							Email Settings
						</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="#">
						<span class="nav-link-in">
							<span class="glyphicon glyphicon-envelope"></span>
							Send Test Email
						</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</section>

<div class="box-typical box-typical-padding">
	<div class="container">
		<div class="row">
			<?php echo validation_errors(); ?>
			<?php if(isset($message)){echo $message;} ?>
			<form method="post">
			<div class="col-md-12">
				<div class="form-group row">
					<label class="col-sm-2 form-control-label">Email to :</label>
					<div class="col-sm-10">
						<p class="form-control-static"><input type="text" class="form-control" name="test_email_to" placeholder="" value="<?=$user_data['admin_email']?>"></p>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group row">
					<label class="col-sm-2 form-control-label">Email Subject :</label>
					<div class="col-sm-10">
						<p class="form-control-static"><input type="text" class="form-control" name="test_email_subject" placeholder="" value="Test Email from <?=$site_name?>"></p>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group row">
					<label class="col-sm-2 form-control-label">Email Body :</label>
					<div class="col-sm-10">
						<p class="form-control-static"><input type="text" class="form-control" name="test_email_body" placeholder="" value="Test Email from <?=$site_name?>"></p>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group row">
					<label class="col-sm-2 form-control-label"></label>
					<div class="col-sm-10">
						<p class="form-control-static"><input type="submit" class="btn btn-primary" placeholder="Text"></p>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
