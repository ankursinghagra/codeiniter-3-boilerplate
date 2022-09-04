<style type="text/css">
	.present-attendence{
		color:#0ed00e !important;
	}
	.absent-attendence{
		color:#fb2d2d !important;
	}
</style>

<?php /* ?>
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-3">
				<section class="widget widget-simple-sm">
					<div class="widget-simple-sm-statistic">
						<div><?=$count_est_client_cost_past?>-<?=$count_est_cost_past?>=</div>
						<div class="number"><?=$count_est_business_past?></div>
						<div class="caption color-blue">Last Month Revenue</div>
					</div>
				</section>
			</div><!-- col-md-3 -->
			<div class="col-md-3">
				<section class="widget widget-simple-sm">
					<div class="widget-simple-sm-statistic">
						<div><?=$count_est_client_cost?>-<?=$count_est_cost?>=</div>
						<div class="number"><?=$count_est_business?></div>
						<div class="caption color-purple">This Month Revenue (estimated)</div>
					</div>
				</section>
			</div><!-- col-md-3 -->
			<div class="col-md-3">
				<section class="widget widget-simple-sm">
					<div class="widget-simple-sm-statistic">
						<div class="number"><?=$count_employees?></div>
						<div class="caption color-red">Employees</div>
					</div>
				</section>
			</div><!-- col-md-3 -->
			<div class="col-md-3">
				<section class="widget widget-simple-sm">
					<div class="widget-simple-sm-statistic">
						<div class="number"><?=$count_locations?></div>
						<div class="caption color-green">Client Locations</div>
					</div>
				</section>
			</div><!-- col-md-3 -->
		</div><!-- row -->
	</div><!-- col-md-12 -->
	<div class="col-md-6">
		<section class="widget widget-activity">
			<header class="widget-header">
				Update Recent Duties
				<span class="label label-pill label-primary"><?=(count($results_unknown_duties)>=20)?"20 +":count($results_unknown_duties);?></span>
			</header>
			<div>
				<?php foreach ($results_unknown_duties as $key => $duty) : ?>
				<div class="widget-activity-item">
					<div class="user-card-row">
						<div class="tbl-row">
							<div class="tbl-cell tbl-cell-photo">
								<a href="#">
									<img src="img/photo-64-2.jpg" alt="">
								</a>
							</div>
							<div class="tbl-cell">
								<p>
									<a href="#" class="semibold"><?=$duty['employees_name']?></a>
									attended duty at
									<a href="#"><?=$duty['location_address']?></a> on <?=$duty['duties_day']?>/<?=$duty['duties_month']?>/<?=$duty['duties_year']?>
								</p>
								<p><a href="javascript:change_duty_status(<?=$duty['duties_id']?>);" class="present-attendence">Yes, I approve.</a>. <a href="#" class="absent-attendence">No, mark absent.</a></p>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</section><!--.widget-tasks-->
	</div><!-- col-md-6 -->
	<div class="col-md-6">
		<section class="widget widget-activity">
			<header class="widget-header">
				Set Duties (Today)
				<span class="label label-pill label-primary"><?=count($results_requirements_today);?></span>
			</header>
			<div>
				<?php foreach ($results_requirements_today as $key => $requirements) : ?>
				<div class="widget-activity-item">
					<div class="user-card-row">
						<div class="tbl-row">
							<div class="tbl-cell tbl-cell-photo">
								<a href="#">
									<img src="img/photo-64-2.jpg" alt="">
								</a>
							</div>
							<div class="tbl-cell">
								<p>
									Need a 
									<a href="#" class="semibold"><?=$requirements['guard_type_title']?></a>
									at
									<a href="#"><?=$requirements['location_address']?></a> owned by <a href="#"><?=$requirements['clients_name']?></a>
								</p>
								<p><a href="<?=base_url()?>locations/schedule_month/<?=$requirements['location_id']?>">Take me there.</a></p>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</section><!--.widget-tasks-->

		<section class="widget widget-activity">
			<header class="widget-header">
				Set Duties (Tommorow)
				<span class="label label-pill label-primary"><?=count($results_requirements_tommorow);?></span>
			</header>
			<div>
				<?php foreach ($results_requirements_tommorow as $key => $requirements) : ?>
				<div class="widget-activity-item">
					<div class="user-card-row">
						<div class="tbl-row">
							<div class="tbl-cell tbl-cell-photo">
								<a href="#">
									<img src="img/photo-64-2.jpg" alt="">
								</a>
							</div>
							<div class="tbl-cell">
								<p>
									Need a 
									<a href="#" class="semibold"><?=$requirements['guard_type_title']?></a>
									at
									<a href="#"><?=$requirements['location_address']?></a> owned by <a href="#"><?=$requirements['clients_name']?></a>
								</p>
								<p><a href="<?=base_url()?>locations/schedule_month/<?=$requirements['location_id']?>">Take me there.</a></p>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</section><!--.widget-tasks-->
	</div><!-- col-md-6 -->
</div>


<style type="text/css">
	#duties_form_block{
		display: none;
	}
</style>
<div class="modal fade bd-location-modal-lg"
             tabindex="-1"
             role="dialog"
             aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>
                <h4 class="modal-title" id="myModalLabel">Duty Status</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                	<div class="col-md-12" id="duties_loading_block">
                		Loading...
                	</div>
                    <div class="col-md-12" id="duties_form_block">
                    	<form method="post" id="duties_form" >
                    		<input type="hidden" name="duties_id" value="">
                    		
                    		<div class="form-group">
                    			<label>Duty Status</label>
                    			<select name="duties_done" class="form-control duties_done">
                    				<option value="0">UNKNOWN</option>
                    				<option value="1">Present</option>
                    				<option value="2">Absent</option>
                    			</select>
                    		</div>
		                    		
                    		<div class="form-group">
                    			<input type="submit" class="btn btn-primary" value="Save">
                    		</div>
                    	</form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div><!--.modal-->


<script type="text/javascript">
	function change_duty_status(duty_id)
	{
		$('#duties_loading_block').show();
		$('#duties_form_block').hide();
		$('#duty_status_span').html('');
		$('input[name=duties_id]').val(duty_id);
		$('.bd-location-modal-lg').modal('show');

		$('select[name=duties_done]').val(0);

		$('#duties_loading_block').hide();
		$('#duties_form_block').show();
	}
</script>
<?php */ ?>