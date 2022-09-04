<?php $i=1; ?>
<?php foreach ($user_groups as $row): ?>
	
	<div class="box-typical box-typical-padding"><br>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="row grid-menu">
						<!--  -->
						<div class="col-md-12">
							<section class="card">
								<header class="card-header color-<?=$row['group_color']?>">
									<h4><?=$row['group_name']?></h4>
								</header>
								<div class="row card-block" >
									<div class="col-md-4">
										<h5>View Permissions</h5>
										<form method="post" action="">
											<input type="hidden" name="parent" value="<?=$row['admin_group_id']?>">
											<input type="hidden" name="type" value="view_permissions">
											<ul>
												<?php $view_permissions = json_decode($row['view_permissions'],TRUE); ?>
												<?php foreach ($default_view_permissions as $key => $value): ?>
													<li>
														<div class="checkbox-toggle">
															<input type="checkbox" id="check-toggle-<?=$i?>" name="permissions" value="<?=$key?>" <?php if(isset($view_permissions[$key])&&($view_permissions[$key])){echo 'checked';} ?>>
															<label for="check-toggle-<?=$i?>"><?=$value?></label>
														</div>
													</li>
													<?php $i++; ?>
												<?php endforeach ?>
											</ul>
										</form>
									</div>
									<div class="col-md-4">
										<h5>Modify Permissions</h5>
										<form method="post" action="">
											<input type="hidden" name="parent" value="<?=$row['admin_group_id']?>">
											<input type="hidden" name="type" value="modify_permissions">
											<ul>
												<?php $modify_permissions = json_decode($row['modify_permissions'],TRUE); ?>
												<?php foreach ($default_modify_permissions as $key => $value): ?>
													<li>
														<div class="checkbox-toggle">
															<input type="checkbox" id="check-toggle-<?=$i?>" name="permissions" value="<?=$key?>" <?php if(isset($modify_permissions[$key])&&($modify_permissions[$key])){echo 'checked';} ?>>
															<label for="check-toggle-<?=$i?>"><?=$value?></label>
														</div>
													</li>
													<?php $i++; ?>
												<?php endforeach ?>
											</ul>
										</form>
									</div>
								</div>
							</section>
						</div>
						<!--  -->
					</div>
					<br>
				</div>
			</div>
		</div>
	</div>
<?php endforeach ?>

<script type="text/javascript">

		$('input').click(function(){
			var checked = $(this).prop('checked');
			var permission_text = $(this).val(); 
			var type = $(this).parent().parent().parent().parent().children('input[name=type]').val();
			var group_id = $(this).parent().parent().parent().parent().children('input[name=parent]').val();
			console.log({"checked":checked,"permission_text":permission_text,"type":type,"group_id":group_id});
			$.ajax({
				type: "POST",
				dataType: "json",
				url:'<?=base_url(env('ADMIN_FOLDER'))?>/users/api_permissions',
				data:{checked:checked,permission_text:permission_text,type:type,group_id:group_id},
				complete: function(data){
       				console.log(data.responseText);
					//var json = $.parseJSON(data.responseText); 
					var json = data.responseJSON; 
       				$.notify({
       					//options
			            icon: 'glyphicon glyphicon-star',
			            title: json.title,
			            message: json.message
			        },{
						// settings
						type: json.status,
						delay: 400,
						animate: {
							enter: 'animated fadeInDown',
							exit: 'animated fadeOutUp'
						}
					});
       				//alert(json);
				}
			});
		});

</script>