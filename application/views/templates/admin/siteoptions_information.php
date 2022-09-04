<div class="box-typical box-typical-padding">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form method="post">
					<?php echo validation_errors(); ?>
					<?php if(isset($message)){echo $message;} ?>
					<h4>Information for bills</h4>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Company Name</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="site_name" placeholder="" value="<?=$siteoptions['site_name'];?>"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Company Address Line 1</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input class="form-control" name="address_1" value="<?=$siteoptions['address_1'];?>"></textarea></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Company Address Line 2</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input class="form-control" name="address_2" value="<?=$siteoptions['address_2'];?>"></textarea></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Company Phone No</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input class="form-control" name="phone_number" value="<?=$siteoptions['phone_number'];?>"></textarea></p>
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

