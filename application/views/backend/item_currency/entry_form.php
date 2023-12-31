
<?php
	$attributes = array( 'id' => 'currency-form', 'enctype' => 'multipart/form-data');
	echo form_open( '', $attributes);
?>
	
<section class="content animated fadeInRight">
	<div class="col-md-6">
	<div class="card card-info">
	    <div class="card-header">
	        <h3 class="card-title"><?php echo get_msg('currency_info')?></h3>
	    </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
             	<div class="col-md-12">
            		<div class="form-group">
                   		<label>
                   			<span style="font-size: 17px; color: red;">*</span>
							<?php echo get_msg('currency_short_form')?>
							<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
								<span class='glyphicon glyphicon-info-sign menu-icon'>
							</a>
						</label>

						<?php echo form_input( array(
							'name' => 'currency_short_form',
							'value' => set_value( 'currency_short_form', show_data( @$currency->currency_short_form ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'currency_short_form' ),
							'id' => 'currency_short_form'
						)); ?>
              		</div>

                </div>

                <div class="col-md-12">
            		<div class="form-group">
                   		<label>
                   			<span style="font-size: 17px; color: red;">*</span>
							<?php echo get_msg('currency_symbol')?>
							<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
								<span class='glyphicon glyphicon-info-sign menu-icon'>
							</a>
						</label>

						<?php echo form_input( array(
							'name' => 'currency_symbol',
							'value' => set_value( 'currency_symbol', show_data( @$currency->currency_symbol ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'currency_symbol' ),
							'id' => 'currency_symbol'
						)); ?>
              		</div>

              		<?php if ($currency->is_default == 0) { ?>
              		<div class="form-group" style="padding-top: 30px; padding-right: 5px;">
			            <div class="form-check">

			                <label>
			                
			                  <?php echo form_checkbox( array(
			                    'name' => 'is_default',
			                    'id' => 'is_default',
			                    'value' => 'accept',
			                    'checked' => set_checkbox('is_default', 1, ( @$currency->is_default == 1 )? true: false ),
			                    'class' => 'form-check-input'
			                  )); ?>

			                  <?php echo get_msg( 'is_default' ); ?>
			                </label>
		              	</div>
		            </div>
              		
              		<?php } else { ?>

						<label>
			                
							<?php echo form_checkbox( array(
							  'name' => 'is_default',
							  'type' => 'hidden',
							  'id' => 'is_default',
							  'value' => 'accept',
							  'checked' => set_checkbox('is_default', 1, ( @$currency->is_default == 1 )? true: false ),
							  'class' => 'form-check-input'
							)); ?>

						  </label>

			  		<?php } ?>

                </div>

                  	

            </div>
            <!-- /.row -->
        </div>
        <!-- /.card-body -->

		<div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary">
				<?php echo get_msg('btn_save')?>
			</button>

			<a href="<?php echo $module_site_url; ?>" class="btn btn-sm btn-primary">
				<?php echo get_msg('btn_cancel')?>
			</a>
        </div>
       
    </div>
    <!-- card info -->
</section>
				

	
	

<?php echo form_close(); ?>