<div class="box-typical box-typical-padding">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-right">
				<div class="checkbox-toggle module_switch">
					<input type="checkbox" id="check-toggle" name="module_status" value="1" <?php if($module_status==1){echo 'checked';} ?>>
					<label for="check-toggle">Toggle Module</label>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.module_switch input[type=checkbox]').click(function(){
		var checked = $(this).prop('checked');
		$.ajax({
			type: "POST",
			dataType: "json",
			url:'<?=base_url(env('ADMIN_FOLDER'))?>/team/api_toggle_module',
			data:{checked:checked},
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