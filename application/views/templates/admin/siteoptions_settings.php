<div class="box-typical box-typical-padding">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form method="post">
					<?php echo validation_errors(); ?>
					<?php if(isset($message)){echo $message;} ?>

					<!-- <div class="form-group row">
						<label class="col-sm-2 form-control-label">Desktop Theme</label>
						<div class="col-sm-4">
							<p class="form-control-static">
								<select class="form-control" name="theme_desktop">
									<option value="0"></option>
									<?php foreach($list_dir as $dir_name) :?>
									<option <?php if($siteoptions['theme_desktop']==$dir_name){echo 'selected';}?> value="<?=$dir_name?>"><?=$dir_name?></option>
									<?php endforeach; ?>
								</select>
							</p>
						</div>
						<div class="col-sm-4">
							
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Mobile Theme</label>
						<div class="col-sm-4">
							<p class="form-control-static">
								<select class="form-control" name="theme_mobile">
									<option value="0"></option>
									<?php foreach($list_dir as $dir_name) :?>
									<option <?php if($siteoptions['theme_mobile']==$dir_name){echo 'selected';}?> value="<?=$dir_name?>"><?=$dir_name?></option>
									<?php endforeach; ?>
								</select>
							</p>
						</div>
						<div class="col-sm-4">
							
						</div>
					</div> -->

					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Maintainence Mode</label>
						<div class="col-sm-4">
							<p class="form-control-static">
								<select class="form-control" name="maintainence_mode">
									<option value="OFF" <?=($siteoptions['maintainence_mode']=='OFF')?'selected':'';?>>OFF</option>
									<option value="ON" <?=($siteoptions['maintainence_mode']=='ON')?'selected':'';?>>ON</option>
								</select>
							</p>
						</div>
						<div class="col-sm-4">
							
						</div>
					</div>



					<div class="form-group row">
						<label class="col-sm-2 form-control-label"></label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="submit" class="btn btn-primary" placeholder="Text"></p>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

