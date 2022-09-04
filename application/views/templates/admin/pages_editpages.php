<div class="box-typical box-typical-padding">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form method="post">
					<?php echo validation_errors(); ?>
					<?php if(isset($message)){echo $message;} ?>
					<div class="form-group row">
					<label class="col-sm-2 form-control-label">Page Title</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="page_title" placeholder="" value="<?=$page['page_title'];?>"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Page Subtitle</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="page_subtitle" placeholder="" value="<?=$page['page_subtitle'];?>"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Meta Title</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="meta_title" placeholder="" value="<?=$page['meta_title']?>"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Meta Keywords</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="meta_keywords" placeholder="" value="<?=$page['meta_keywords']?>"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Meta Description</label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<textarea class="form-control" name="meta_description" placeholder="" rows="2" ><?=set_value('meta_description')?></textarea></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Open graph image / Twitter card image</label>
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
						<label class="col-sm-2 form-control-label">Open Graph Title</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="og_title" placeholder="" value="<?=$page['og_title']?>"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Open Graph Type</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="og_type" placeholder="" value="<?=$page['og_type']?>"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Open Graph Description</label>
						<div class="col-sm-10">
							<p class="form-control-static"><textarea class="form-control" name="og_description" rows="2"><?=$page['og_description']?></textarea></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Twitter Card Title</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="tw_title" placeholder="" value="<?=$page['tw_title']?>"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Twitter Card Type</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="tw_card" placeholder="" value="<?=$page['tw_card']?>"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Twitter Card Description</label>
						<div class="col-sm-10">
							<p class="form-control-static"><textarea class="form-control" name="tw_description" rows="2"><?=$page['tw_description']?></textarea></p>
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