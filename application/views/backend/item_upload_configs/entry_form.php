<?php
$attributes = array('id' => 'item-config-form','enctype' => 'multipart/form-data');
echo form_open( '', $attributes);
?>
<section class="content animated fadeInRight">
	<div class="card card-info">
		 <div class="card-header">
	        <h3 class="card-title"><?php echo get_msg('item_config_label')?></h3>
	    </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'item_type_id',
								'id' => 'item_type_id',
								'value' => 'accept',
								'checked' => set_checkbox('item_type_id', 1, ( @$item_config->item_type_id == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'car_type_label' ); ?>
							</label>
						</div>
					</div>					
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'discount_rate_by_percentage',
								'id' => 'discount_rate_by_percentage',
								'value' => 'accept',
								'checked' => set_checkbox('discount_rate_by_percentage', 1, ( @$item_config->discount_rate_by_percentage == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'discount_rate_by_percentage' ); ?>
							</label>
						</div>
					</div>
                    <div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'no_of_owner',
								'id' => 'no_of_owner',
								'value' => 'accept',
								'checked' => set_checkbox('no_of_owner', 1, ( @$item_config->no_of_owner == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'itm_no_of_owner' ); ?>
							</label>
						</div>
					</div>
                    <div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'trim_name',
								'id' => 'trim_name',
								'value' => 'accept',
								'checked' => set_checkbox('trim_name', 1, ( @$item_config->trim_name == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'itm_trim_name_label' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'plate_number',
								'id' => 'plate_number',
								'value' => 'accept',
								'checked' => set_checkbox('plate_number', 1, ( @$item_config->plate_number == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'plat_number_label' ); ?>
							</label>
						</div>
					</div>
                    <div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'engine_power',
								'id' => 'engine_power',
								'value' => 'accept',
								'checked' => set_checkbox('engine_power', 1, ( @$item_config->engine_power == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'engine_power_label' ); ?>
							</label>
						</div>
					</div>
                    <div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'year',
								'id' => 'year',
								'value' => 'accept',
								'checked' => set_checkbox('year', 1, ( @$item_config->year == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'year_label' ); ?>
							</label>
						</div>
					</div>  
				</div>
				<div class="col-md-6">                  
                    <div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'seller_type_id',
								'id' => 'seller_type_id',
								'value' => 'accept',
								'checked' => set_checkbox('seller_type_id', 1, ( @$item_config->seller_type_id == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'seller_name' ); ?>
							</label>
						</div>
					</div>
                    <div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'transmission_id',
								'id' => 'transmission_id',
								'value' => 'accept',
								'checked' => set_checkbox('transmission_id', 1, ( @$item_config->transmission_id == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'trans_name' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'video',
								'id' => 'video',
								'value' => 'accept',
								'checked' => set_checkbox('video', 1, ( @$item_config->video == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'item_video_label' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'video_icon',
								'id' => 'video_icon',
								'value' => 'accept',
								'checked' => set_checkbox('video_icon', 1, ( @$item_config->video_icon == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'item_video_icon_label' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'condition_of_item_id',
								'id' => 'condition_of_item_id',
								'value' => 'accept',
								'checked' => set_checkbox('condition_of_item_id', 1, ( @$item_config->condition_of_item_id == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'condition_of_item' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'highlight_info',
								'id' => 'highlight_info',
								'value' => 'accept',
								'checked' => set_checkbox('highlight_info', 1, ( @$item_config->highlight_info == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'prd_high_info' ); ?>
							</label>
						</div>
					</div>
				</div>
                
				<div class="col-6">
                    <legend class="mt-3"><?php echo get_msg('confi_info_lable')?></legend><hr>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'build_type_id',
								'id' => 'build_type_id',
								'value' => 'accept',
								'checked' => set_checkbox('build_type_id', 1, ( @$item_config->build_type_id == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'build_name' ); ?>
							</label>
						</div>
					</div>
                    <div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'no_of_doors',
								'id' => 'no_of_doors',
								'value' => 'accept',
								'checked' => set_checkbox('no_of_doors', 1, ( @$item_config->no_of_doors == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'itm_no_of_doors_label' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'max_passengers',
								'id' => 'max_passengers',
								'value' => 'accept',
								'checked' => set_checkbox('max_passengers', 1, ( @$item_config->max_passengers == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'itm_max_passengers_label' ); ?>
							</label>
						</div>
					</div>
                    <div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'color_id',
								'id' => 'color_id',
								'value' => 'accept',
								'checked' => set_checkbox('color_id', 1, ( @$item_config->color_id == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'color_name' ); ?>
							</label>
						</div>
					</div>
                    <div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'steering_position',
								'id' => 'steering_position',
								'value' => 'accept',
								'checked' => set_checkbox('steering_position', 1, ( @$item_config->steering_position == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'itm_steering_position' ); ?>
							</label>
						</div>
					</div>
				</div>
				<div class="col-6">
                    <legend class="mt-3"><?php echo get_msg('licence_info_lable')?></legend><hr>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'vehicle_id',
								'id' => 'vehicle_id',
								'value' => 'accept',
								'checked' => set_checkbox('vehicle_id', 1, ( @$item_config->vehicle_id == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'itm_vehicle_id_label' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'licence_expiration_date',
								'id' => 'licence_expiration_date',
								'value' => 'accept',
								'checked' => set_checkbox('licence_expiration_date', 1, ( @$item_config->licence_expiration_date == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'license_expiration_date_label' ); ?>
							</label>
						</div>
					</div>
                    <div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'licence_status',
								'id' => 'licence_status',
								'value' => 'accept',
								'checked' => set_checkbox('licence_status', 1, ( @$item_config->licence_status == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'itm_licence_status' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'business_mode',
								'id' => 'business_mode',
								'value' => 'accept',
								'checked' => set_checkbox('business_mode', 1, ( @$item_config->business_mode == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'itm_business_mode' ); ?> <?php echo get_msg( 'itm_show_shop' ) ?>
							</label>
						</div>
					</div>
				</div>
				<div class="col-6">
                    <legend class="mt-3"><?php echo get_msg('price')?></legend> <hr>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'item_price_type_id',
								'id' => 'item_price_type_id',
								'value' => 'accept',
								'checked' => set_checkbox('item_price_type_id', 1, ( @$item_config->item_price_type_id == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'price_type_label' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'price_unit',
								'id' => 'price_unit',
								'value' => 'accept',
								'checked' => set_checkbox('price_unit', 1, ( @$item_config->price_unit == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'itm_price_unit_label' ); ?>
							</label>
						</div>
					</div>
				</div>
                <div class="col-6">
                    <legend class="mt-3"><?php echo get_msg('performance_info_lable')?></legend><hr>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'fuel_type_id',
								'id' => 'fuel_type_id',
								'value' => 'accept',
								'checked' => set_checkbox('fuel_type_id', 1, ( @$item_config->fuel_type_id == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'fuel_name' ); ?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'mileage',
								'id' => 'mileage',
								'value' => 'accept',
								'checked' => set_checkbox('mileage', 1, ( @$item_config->mileage == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'itm_mileage_label' ); ?>
							</label>
						</div>
					</div>
				</div>
				<div class="col-12">
                    <legend class="mt-3"><?php echo get_msg('location_info')?></legend><hr>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<?php echo form_checkbox( array(
								'name' => 'address',
								'id' => 'address',
								'value' => 'accept',
								'checked' => set_checkbox('address', 1, ( @$item_config->address == 1 )? true: false ),
								'class' => 'form-check-input',
							));	?>
							<?php echo get_msg( 'itm_address_label' ); ?>
							</label>
						</div>
					</div>
				</div>
            </div>
            <div class="card-footer">
				<button type="submit" name="save" class="btn btn-sm btn-primary">
					<?php echo get_msg('btn_save')?>
				</button>
				<a href="<?php echo $module_site_url; ?>" class="btn btn-sm btn-primary">
					<?php echo get_msg('btn_cancel')?>
				</a>
			</div>
        </div>
    </div>
</section>
<?php echo form_close(); ?>