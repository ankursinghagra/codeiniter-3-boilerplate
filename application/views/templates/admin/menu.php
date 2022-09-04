<?php if(isset($message)){echo $message;} ?>

<div class="box-typical box-typical-padding">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h4>Add Menu Item</h4>
				<form method="post">
					<?php echo validation_errors(); ?>

					<div class="form-group row">
					<label class="col-sm-2 form-control-label">Title</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="menu_title" placeholder="" value="<?=set_value('menu_title');?>"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label">Url</label>
						<div class="col-sm-10">
							<p class="form-control-static"><input type="text" class="form-control" name="menu_slug" placeholder="" value="<?=set_value('menu_slug');?>"></p>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label"></label>
						<div class="col-sm-10">
							<input type="hidden" name="add" value="1">
							<p class="form-control-static"><input type="submit" class="btn btn-primary" placeholder="Text"></p>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php if((isset($all_menu_items))&&(count($all_menu_items))){ ?>

<?php
	$new_menu = array();
	$childern = array();
	foreach ($all_menu_items as $key => $value) {
	    if($value['menu_parent']==''){
	        $new_menu[$value['menu_id']]= array( 'menu_id'=>$value['menu_id'], 'menu_title'=>$value['menu_title'] , 'menu_slug'=>$value['menu_slug'] );
	    }else{
	        $childern[$value['menu_id']] = array( 'menu_id'=>$value['menu_id'], 'menu_title'=>$value['menu_title'] , 'menu_slug'=>$value['menu_slug'] , 'menu_parent' => $value['menu_parent']);
	    }
	}
	foreach ($childern as $key => $value) {
	    $new_menu[$value['menu_parent']]['menu_childern'][] = $value;
	}
?>
<style type="text/css">
	.dd-handle{
		display: inline-block;
		min-width: 200px;
	}
	.dd-delete{
		display: inline-block;
		max-width: 30px;
	}
	.dd-item > button {
		display: none;
	}
	.dd-list .dd-list {
	    padding-left: 60px;
	}
</style>
<div class="box-typical box-typical-padding">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<div class="dd" id="nestable">
				    <ol class="dd-list">
				    	<?php foreach ($new_menu as $key => $menu_item): ?>
				    		<?php if( isset($menu_item['menu_childern']) && (!empty($menu_item['menu_childern']))): ?>
						        <li class="dd-item" data-id="<?=$menu_item['menu_id']?>">
						            <div class="dd-handle"><?=$menu_item['menu_title']?> <i>(<?=$menu_item['menu_slug']?>)</i> </div>
						            <div class="dd-delete"><a onclick="delete_item(<?=$menu_item['menu_id']?>)"><i class="fa fa-close"></i></a></div>
						            <ol class="dd-list">
						            	<?php foreach($menu_item['menu_childern'] as $child) { ?>
						                <li class="dd-item" data-id="<?=$child['menu_id']?>">
						                    <div class="dd-handle"><?=$child['menu_title']?> <i>(<?=$child['menu_slug']?>)</i></div>
						                    <div class="dd-delete"><a onclick="delete_item(<?=$child['menu_id']?>)"><i class="fa fa-close"></i></a></div>
						                </li>
						                <?php } ?>
						            </ol>
						        </li>
						    <?php else: ?>
						    	<li class="dd-item" data-id="<?=$menu_item['menu_id']?>">
						            <div class="dd-handle"><?=$menu_item['menu_title']?> <i>(<?=$menu_item['menu_slug']?>)</i></div>
						            <div class="dd-delete"><a onclick="delete_item(<?=$menu_item['menu_id']?>)"><i class="fa fa-close"></i></a></div>
						        </li>
				    		<?php endif; ?>
				    	<?php endforeach; ?>
				    </ol>
				</div><!-- dd -->

			</div><!-- col-md-12 -->
			<div class="col-md-12">
				<form method="post">
				<div class="form-group"><br>
					<textarea id="nestable-output" style="display: none;" class="form-control" name="json_order"></textarea>
					<input type="submit" value="Update Menu Order" class="btn btn-primary">
				</div>
				</form>
			</div><!-- col-md-12 -->
		</div><!-- row -->
	</div>
</div>

<?php } ?>
<script type="text/javascript" src="<?=base_url()?>assets/library/jQuery.nestable/jquery.nestable.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		updateOutput($('#nestable').data('output', $('#nestable-output')));
	});
	var updateOutput = function(e){
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    }; 
    updateOutput($('#nestable').data('output', $('#nestable-output')));
	$('#nestable').nestable({
		maxDepth: 2, //not working
	}).on('change', updateOutput);
	function delete_item(id){
		//$('*[data-id="'+id+'"]').hide('slow', function(){ this.remove(); });
		$('*[data-id="'+id+'"]').remove();
		updateOutput($('#nestable').data('output', $('#nestable-output')));
	};
</script>
