<div class="box-typical box-typical-padding">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form method="post">
					<?php echo validation_errors(); ?>
					<?php if(isset($message)){echo $message;} ?>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Group Name</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="group_name" placeholder="Group Name" value="<?=$group['group_name'];?>"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Group Color</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="group_color" placeholder="Group Color" value="<?=$group['group_color'];?>"></p>
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