<div class="box-typical box-typical-padding">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form method="post">
					<?php echo validation_errors(); ?>
					<?php if(isset($message)){echo $message;} ?>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Name</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="admin_name" placeholder="Name" value="<?=$user['admin_name']?>"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Email</label>
						<div class="col-sm-10">
							<p class="form-control-static" style="padding: 15px;"><?=$user['admin_email']?></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Password</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="password" placeholder="Password" value=""></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Password</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="password2" placeholder="Repeat Password" value=""></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Photo</label>
						<div class="col-sm-10">
							<p class="form-control-static"><img src="<?=main_url()?>uploads/admins/<?=$user['admin_photo']?>" style="max-width: 250px;"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label"></label>
						<div class="col-sm-10">
							<p class="form-control-static">
							<a href="#" data-toggle="modal" data-target=".bd-example-modal-lg">Change Image</a>
							<input type="hidden" name="x" id="x" >
	                        <input type="hidden" name="y" id="y" >
	                        <input type="hidden" name="w" id="w" >
	                        <input type="hidden" name="h" id="h" >
	                        <input type="hidden" name="orignal_path" id="orignal_path">
	                        <input type="hidden" name="file_name" id="file_name">
	                        <span id="upload_end_status"></span>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Group</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<select class="form-control" name="admin_group" >
									<option value=""></option>
									<?php foreach ($possible_admin_groups as $key => $row): ?>
										<?php if($row['admin_group_id']==$user['admin_group']): ?>
											<option value="<?=$row['admin_group_id']?>" selected><?=$row['group_name']?></option>
										<?php else: ?>
											<option value="<?=$row['admin_group_id']?>"><?=$row['group_name']?></option>
										<?php endif; ?>
									<?php endforeach ?>
								</select>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Author: Name</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="author_name" placeholder="Name" value="<?=$user['author_name']?>"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Author: Short Description</label>
						<div class="col-sm-10">
							<p class="form-control-static"><textarea class="form-control" name="author_short_description" placeholder="Write a Short Description"><?=$user['author_short_description']?></textarea></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Author: Facebook Link</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="author_facebook_link" placeholder="Facebook Link" value="<?=$user['author_facebook_link']?>"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Author: Twitter Link</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="author_twitter_link" placeholder="Twitter Link" value="<?=$user['author_twitter_link']?>"></p>
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