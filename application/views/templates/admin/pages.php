<div class="box-typical box-typical-padding">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h4>Add Page</h4>
				<form method="post">
					<?php echo validation_errors(); ?>
					<?php if(isset($message)){echo $message;} ?>
					<div class="form-group row">
					<label class="col-sm-2 form-control-label">Page Title</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="page_title" placeholder="" value="<?=set_value('page_title');?>"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Page Slug</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="page_slug" placeholder="" value="<?=set_value('page_slug');?>"></p>
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
<?php if((isset($all_pages))&&(count($all_pages))){ ?>
		
	<table id="table-sm" class="table table-bordered table-hover table-sm">
		<thead>
			<tr>
				<th width="1">
					#
				</th>
				<th>Path</th>
				<th>Name</th>
				<th>Active</th>
				<th width="250">
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($all_pages as $key => $row): ?>
			<tr id="trrow_<?=$row['page_id']?>">
				<td><?=$key+1?></td>
				<td class="">
					<?=(!empty($row['page_slug']))?'/'.$row['page_slug']:'/';?>
					<a href="<?=base_url().$row['page_slug']?>" target="_blank">link</a>
				</td>
				<td><?=$row['page_title']?></td>
				<td><?=($row['page_active'])?'<label class="label label-success">Active</label>':'<label class="label label-danger">Inactive</label>';?></td>
				<td class="">
					<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                       <div class="btn-group btn-group-sm" style="float: none;">
                       		<a href="<?=base_url(env('ADMIN_FOLDER'))?>/pages/edit_page/<?=$row['page_id']?>" class="tabledit-edit-button btn btn-sm btn-default" style="float: none;" target="_blank"><span class="glyphicon glyphicon-pencil"></span> Meta</a>
                       		<a href="<?=base_url(env('ADMIN_FOLDER'))?>/pages/edit_page_content/<?=$row['page_id']?>" class="tabledit-edit-button btn btn-sm btn-default" style="float: none;" target="_blank"><span class="glyphicon glyphicon-pencil"></span> Content</a>
                       		<?php if($row['page_reserved']!='1'): ?>
                       		<a href="#" class="tabledit-delete-button btn btn-sm btn-default swal-btn-cancel" style="float: none;" value="<?=$row['page_id']?>"><span class="glyphicon glyphicon-trash"></span></a>
                       		<?php endif; ?>
                       	</div>
                   </div>
				</td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>


<?php }else{ ?>
	<?php echo alert('danger','No Pages'); ?>
<?php } ?>


<script type="text/javascript">
		$('.swal-btn-cancel').click(function(e){
		e.preventDefault();
		var id_to_del = $(this).attr('value');
		swal({
			title: "Are you sure?",
			text: "You will not be able to recover this user!",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "No, cancel plx!",
			closeOnConfirm: false,
			closeOnCancel: false
		},
		function(isConfirm) {
			if (isConfirm) {	
				/*your code here*/
				$.ajax({
					type: "POST",
					dataType: "json",
					url:'<?=base_url(env('ADMIN_FOLDER'))?>/pages/api_delete_page',
					data:{id:id_to_del},
					complete: function(data){
						var json = data.responseJSON;
						if(json.status=='success'){
		       				swal({
								title: "Deleted!",
								text: json.message,
								type: "success",
								confirmButtonClass: "btn-success"
							});
							$('#trrow_'+id_to_del).fadeOut();
		       			}else{
		       				swal({
								title: "Error",
								text: json.message,
								type: "error",
								confirmButtonClass: "btn-danger"
							});
		       			}
					}
				});
			} else {
				swal({
					title: "Cancelled",
					text: "The Page is safe :)",
					type: "error",
					confirmButtonClass: "btn-danger"
				});
			}
		});
	});
</script>