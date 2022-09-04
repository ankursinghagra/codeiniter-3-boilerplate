<?php if((isset($all_groups))&&(count($all_groups))){ ?>
		
	<table id="table-sm" class="table table-bordered table-hover table-sm">
		<thead>
			<tr>
				<th width="1">
					#
				</th>
				<th>Name</th>
				<th>Color</th>
				<th width="120">
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($all_groups as $key => $row): ?>
			<tr id="trrow_<?=$row['admin_group_id']?>">
				<td><?=$key+1?></td>
				<td>
					<?=$row['group_name']?>
				</td>
				<td class="">
					<?=$row['group_color']?>
				</td>
				<td class="">
					<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                       <div class="btn-group btn-group-sm" style="float: none;">
                       		<a href="<?=base_url()?>admin/users/edit_group/<?=$row['admin_group_id']?>" class="tabledit-edit-button btn btn-sm btn-default" style="float: none;"><span class="glyphicon glyphicon-pencil"></span></a>
                       		<a href="#" class="tabledit-delete-button btn btn-sm btn-default swal-btn-cancel" style="float: none;" value="<?=$row['admin_group_id']?>"><span class="glyphicon glyphicon-trash"></span></a>
                       	</div>
                   </div>
				</td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>


	<?php }else{ ?>
		<?php echo alert('danger','No Groups Found'); ?>
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
					url:'<?=base_url()?>admin/users/api_delete_group',
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
					text: "The Group is safe :)",
					type: "error",
					confirmButtonClass: "btn-danger"
				});
			}
		});
	});
</script>