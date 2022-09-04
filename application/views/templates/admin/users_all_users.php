<?php if((isset($all_users))&&(count($all_users))){ ?>
		
	<table id="table-sm" class="table table-bordered table-hover table-sm">
		<thead>
			<tr>
				<th width="1">
					#
				</th>
				<th>Name</th>
				<th>Email</th>
				<th>Group</th>
				<th width="120">Email Verified</th>
				<th width="120">
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($all_users as $key => $row): ?>
			<tr id="trrow_<?=$row['admin_id']?>">
				<td><?=$key+1?></td>
				<td><img class="img-responsive img-circle" src="<?=base_url()?>uploads/admins/<?=$row['admin_photo']?>" style="max-width: 30px;"> 
					<?=$row['admin_name']?>
					<?php if($user_data['admin_id']==$row['admin_id']){echo '<label class="label label-success">YOU</label>';} ?>
				</td>
				<td class="">
					<?=$row['admin_email']?>
				</td>
				<td><?=$row['group_name']?></td>
				<td><?=($row['admin_email_verified']==1)?'<label class="label label-success"><i class="fa fa-check"></i></label>':'<label class="label label-danger"><i class="fa fa-close"></i></label>';?></td>
				<td class="">
					<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                       <div class="btn-group btn-group-sm" style="float: none;">
                       		<?php if(($user_data['admin_group']<$row['admin_group'])){ ?>
                       		<a href="<?=base_url(env('ADMIN_FOLDER'))?>/users/edit_user/<?=$row['admin_id']?>" class="tabledit-edit-button btn btn-sm btn-default" style="float: none;"><span class="glyphicon glyphicon-pencil"></span></a>
                       		<?php } ?>
                       		<?php if(
                       			($user_data['admin_id']!=$row['admin_id']) 
                       			&& ($user_data['admin_group']<$row['admin_group'])
                       		){ ?>
                       		<a href="#" class="tabledit-delete-button btn btn-sm btn-default swal-btn-cancel" style="float: none;" value="<?=$row['admin_id']?>"><span class="glyphicon glyphicon-trash"></span></a>
                       		<?php } ?>
                       	</div>
                   </div>
				</td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>


<?php }else{ ?>
	<?php echo alert('danger','No Users'); ?>
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
					url:'<?=base_url(env('ADMIN_FOLDER'))?>/users/api_delete_user',
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
					text: "The User is safe :)",
					type: "error",
					confirmButtonClass: "btn-danger"
				});
			}
		});
	});
</script>