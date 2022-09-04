<section class="tabs-section">
	<div class="tabs-section-nav tabs-section-nav-icons">
		<div class="tbl">
			<ul class="nav" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" href="#">
						<span class="nav-link-in">
							<i class="font-icon font-icon-cogwheel"></i>
							Email Settings
						</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url(env('ADMIN_FOLDER'))?>/siteoptions/email_test">
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
			<div class="col-md-12">
				<form method="post">
					<?php echo validation_errors(); ?>
					<?php if(isset($message)){echo $message;} ?>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Email Method</label>
						<!-- <div class="col-sm-10">
							<p class="form-control-static">
								<label><input type="radio" name="email_function" value="mail" 
									<?=($siteoptions['email_function']=='mail')?'checked':'';?>
									>mail()
								</label>
								<label><input type="radio" name="email_function" value="smtp" 
									<?=($siteoptions['email_function']=='smtp')?'checked':'';?>
									>smtp()
								</label>
							</p>
						</div> -->
						<div class="col-md-6 col-sm-6">
							<div class="checkbox-detailed">
								<input type="radio" name="email_function" id="check-det-1" value="mail" 
								<?=($siteoptions['email_function']=='mail')?'checked':'';?>
								/>
								<label for="check-det-1">
								<span class="checkbox-detailed-tbl">
									<span class="checkbox-detailed-cell">
										<span class="checkbox-detailed-title">mail()</span>
										
									</span>
								</span>
								</label>
							</div>
							<div class="checkbox-detailed">
								<input type="radio" name="email_function" id="check-det-2" value="smtp"
								<?=($siteoptions['email_function']=='smtp')?'checked':'';?>
								/>
								<label for="check-det-2">
								<span class="checkbox-detailed-tbl">
									<span class="checkbox-detailed-cell">
										<span class="checkbox-detailed-title">smtp()</span>
										SMTP protocol
									</span>
								</span>
								</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">email_smtp_from</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="email_smtp_from" placeholder="" value="<?=$siteoptions['email_smtp_from'];?>"></p>
						</div>
					</div>
					<div class="form-group row smtp_options">
						<label class="col-sm-2 form-control-label">email_smtp_hostname</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="email_smtp_hostname" placeholder="" value="<?=$siteoptions['email_smtp_hostname'];?>"></p>
						</div>
					</div>
					<div class="form-group row smtp_options">
						<label class="col-sm-2 form-control-label">email_smtp_port</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="email_smtp_port" placeholder="" value="<?=$siteoptions['email_smtp_port'];?>"></p>
						</div>
					</div>
					<div class="form-group row smtp_options">
						<label class="col-sm-2 form-control-label">email_smtp_username</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="email_smtp_username" placeholder="" value="<?=$siteoptions['email_smtp_username'];?>"></p>
						</div>
					</div>
					<div class="form-group row smtp_options">
						<label class="col-sm-2 form-control-label">email_smtp_password</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="email_smtp_password" placeholder="" value="<?=$siteoptions['email_smtp_password'];?>"></p>
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

<script type="text/javascript">
	$(document).ready(function(){
			var option = '<?=$siteoptions['email_function']?>';
			hide_or_show(option);
		$('input[name=email_function]').click(function(){
			var option = $(this).val();
			hide_or_show(option);
		});
	});
	function hide_or_show(option){
		if(option=='smtp'){
			$('.smtp_options').fadeIn();
		}else if(option=='mail'){
			$('.smtp_options').fadeOut();
		}
	}
</script>
