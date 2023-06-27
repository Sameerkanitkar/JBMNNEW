<?php
  $attributes = array( 'id' => 'soldoutitem-form', 'enctype' => 'multipart/form-data');
  echo form_open( '', $attributes);
?>

<section class="content animated fadeInRight">
        
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title"><?php echo get_msg('prd_info')?></h3>
    </div>

    <form role="form">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('model_search_manu')?>
              </label>

              <?php
                $options=array();
                $conds['status'] = 1;
                $options[0]=get_msg('model_search_manu');
                $manufacturers = $this->Manufacturer->get_all_by($conds);
                foreach($manufacturers->result() as $manu) {
                    $options[$manu->id]=$manu->name;
                }

                echo form_dropdown(
                  'manufacturer_id',
                  $options,
                  set_value( 'manufacturer_id', show_data( @$soldoutitem->manufacturer_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="manufacturer_id"'
                );
              ?>
            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('select_model')?>
              </label>

              <?php
                if(isset($item)) {
                  $options=array();
                  $options[0]=get_msg('select_model');
                  $conds['manufacturer_id'] = $item->manufacturer_id;
                  $models = $this->Model->get_all_by($conds);
                  foreach($models->result() as $model) {
                    $options[$model->id]=$model->name;
                  }
                  echo form_dropdown(
                    'model_id',
                    $options,
                    set_value( 'model_id', show_data( @$soldoutitem->model_id), false ),
                    'class="form-control form-control-sm mr-3" disabled="disabled" id="model_id"'
                  );

                } else {
                  $conds['manufacturer_id'] = $selected_manufacturer_id;
                  $options=array();
                  $options[0]=get_msg('select_model');

                  echo form_dropdown(
                    'model_id',
                    $options,
                    set_value( 'model_id', show_data( @$soldoutitem->model_id), false ),
                    'class="form-control form-control-sm mr-3" disabled="disabled" id="model_id"'
                  );
                }
                
              ?>

            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('price')?>
              </label>

              <?php echo form_input( array(
                'name' => 'price',
                'value' => set_value( 'price', show_data( @$soldoutitem->price), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('price'),
                'id' => 'price',
                'readonly' => 'true'
              )); ?>

            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('item_description_label')?>
              </label>

              <?php echo form_textarea( array(
                'name' => 'description',
                'value' => set_value( 'description', show_data( @$soldoutitem->description), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('item_description_label'),
                'id' => 'description',
                'rows' => "3",
                'readonly' => 'true'
              )); ?>

            </div>
          <!-- form group -->
          </div>

          <div class="col-md-6">

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('plat_number_label')?>
              </label>

              <?php echo form_input( array(
                'name' => 'plat_number',
                'value' => set_value( 'plat_number', show_data( @$soldoutitem->plat_number), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('plat_number_label'),
                'id' => 'plat_number',
                'readonly' => 'true'
              )); ?>

            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('engine_power_label')?>
              </label>

              <?php echo form_input( array(
                'name' => 'engine_power',
                'value' => set_value( 'engine_power', show_data( @$soldoutitem->engine_power), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('engine_power_label'),
                'id' => 'engine_power',
                'readonly' => 'true'
              )); ?>

            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('year_label')?>
              </label>

              <?php echo form_input( array(
                'name' => 'year',
                'value' => set_value( 'year', show_data( @$soldoutitem->year), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('year'),
                'id' => 'year',
                'readonly' => 'true'
              )); ?>

            </div>


            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_select_transmission')?>
              </label>

              <?php
              
                $options=array();
                $options[0]=get_msg('itm_select_transmission');
                $transmissions = $this->Transmission->get_all();
                foreach($transmissions->result() as $trans) {
                  $options[$trans->id]=$trans->name;
                }

                echo form_dropdown(
                  'seller_type_id',
                  $options,
                  set_value( 'seller_type_id', show_data( @$soldoutitem->seller_type_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="seller_type_id"'
                );
              ?>
            </div>

          </div>

          <legend><?php echo get_msg('other_info_lable')?></legend>
          <div class="col-md-6">
            <div class="form-group">
              <label>
                <?php echo get_msg('itm_title_label')?>
              </label>

              <?php echo form_input( array(
                'name' => 'title',
                'value' => set_value( 'title', show_data( @$soldoutitem->title), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('itm_title_label'),
                'id' => 'title',
                'readonly' => 'true'
              )); ?>

            </div>

            <div class="form-group">
              <label>
                <?php echo get_msg('prd_high_info')?>
              </label>

              <?php echo form_textarea( array(
                'name' => 'highlight_info',
                'value' => set_value( 'info', show_data( @$soldoutitem->highlight_info), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => "Please Highlight Information",
                'id' => 'info',
                'rows' => "3",
                'readonly' => 'true'
              )); ?>

            </div>

            <div class="form-group">
              <label>
                <?php echo get_msg('itm_no_of_owner')?>
              </label>

              <?php echo form_input( array(
                'name' => 'no_of_owner',
                'value' => set_value( 'no_of_owner', show_data( @$soldoutitem->no_of_owner), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('itm_no_of_owner'),
                'id' => 'no_of_owner',
                'readonly' => 'true'
              )); ?>

            </div>

            <div class="form-group">
              <label>
                <?php echo get_msg('itm_trim_name_label')?>
              </label>

              <?php echo form_input( array(
                'name' => 'trim_name',
                'value' => set_value( 'trim_name', show_data( @$soldoutitem->trim_name), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('itm_trim_name_label'),
                'id' => 'trim_name',
                'readonly' => 'true'
              )); ?>

            </div>

          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>
                <?php echo get_msg('itm_select_seller_type')?>
              </label>

              <?php
              
                $options=array();
                $options[0]=get_msg('itm_select_seller_type');
                $sellertypes = $this->Sellertype->get_all();
                foreach($sellertypes->result() as $seller) {
                  $options[$seller->id]=$seller->seller_type;
                }

                echo form_dropdown(
                  'seller_type_id',
                  $options,
                  set_value( 'seller_type_id', show_data( @$soldoutitem->seller_type_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="seller_type_id"'
                );
              ?>
            </div>

            <div class="form-group">
              <label>
                <?php echo get_msg('itm_select_type')?>
              </label>

              <?php
              
                $options=array();
                $options[0]=get_msg('itm_select_type');
                $types = $this->Itemtype->get_all();
                foreach($types->result() as $typ) {
                    $options[$typ->id]=$typ->name;
                }

                echo form_dropdown(
                  'item_type_id',
                  $options,
                  set_value( 'item_type_id', show_data( @$soldoutitem->item_type_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="item_type_id"'
                );
              ?>
            </div>

            <div class="form-group">
              <label>
                <?php echo get_msg('itm_select_location')?>
              </label>

              <?php
              
                $options=array();
                $options[0]=get_msg('itm_select_location');
                $locations = $this->Itemlocation->get_all();
                foreach($locations->result() as $location) {
                    $options[$location->id]=$location->name;
                }

                echo form_dropdown(
                  'item_location_id',
                  $options,
                  set_value( 'item_location_id', show_data( @$soldoutitem->item_location_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="item_location_id"'
                );
              ?>
            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_select_location_township')?>
              </label>

              <?php
                if(isset($soldoutitem)) {
                  $options=array();
                  $options[0]=get_msg('itm_select_location_township');
                  $conds['city_id'] = $soldoutitem->item_location_id;
                  $townships = $this->Item_location_township->get_all_by($conds);
                  foreach($townships->result() as $township) {
                    $options[$township->id]=$township->township_name;
                  }
                  echo form_dropdown(
                    'item_location_township_id',
                    $options,
                    set_value( 'item_location_township_id', show_data( @$soldoutitem->item_location_township_id), false ),
                    'class="form-control form-control-sm mr-3" disabled="disabled" id="item_location_township_id"'
                  );

                } else {
                  $conds['city_id'] = $selected_location_city_id;
                  $options=array();
                  $options[0]=get_msg('itm_select_location_township');

                  echo form_dropdown(
                    'item_location_township_id',
                    $options,
                    set_value( 'item_location_township_id', show_data( @$soldoutitem->item_location_township_id), false ),
                    'class="form-control form-control-sm mr-3" disabled="disabled" id="item_location_township_id"'
                  );
                }
                
              ?>

            </div>

            <div class="form-group">
              <label>
                <?php echo get_msg('itm_select_condition_of_item')?>
              </label>

              <?php
                $options=array();
                $conds['status'] = 1;
                $options[0]=get_msg('condition_of_item');
                $conditions = $this->Condition->get_all_by($conds);
                foreach($conditions->result() as $cond) {
                    $options[$cond->id]=$cond->name;
                }

                echo form_dropdown(
                  'condition_of_item_id',
                  $options,
                  set_value( 'condition_of_item_id', show_data( @$soldoutitem->condition_of_item_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="condition_of_item_id"'
                );
              ?>
            </div>

          </div>

          <legend><?php echo get_msg('confi_info_lable')?></legend>
          <div class="col-md-6">
            <div class="form-group">
              <label>
                <?php echo get_msg('itm_select_build')?>
              </label>

              <?php
              
                $options=array();
                $options[0]=get_msg('itm_select_build');
                $builds = $this->Buildtype->get_all();
                foreach($builds->result() as $build) {
                  $options[$build->id]=$build->car_type;
                }

                echo form_dropdown(
                  'build_type_id',
                  $options,
                  set_value( 'build_type_id', show_data( @$soldoutitem->build_type_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="build_type_id"'
                );
              ?>
            </div>

            <div class="form-group">
              <label>
                <?php echo get_msg('itm_no_of_doors_label')?>
              </label>

              <?php echo form_input( array(
                'name' => 'no_of_doors',
                'value' => set_value( 'no_of_doors', show_data( @$soldoutitem->no_of_doors), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('itm_no_of_doors_label'),
                'id' => 'no_of_doors',
                'readonly' => 'true'
              )); ?>

            </div>

            <div class="form-group">
              <label>
                <?php echo get_msg('itm_max_passengers_label')?>
              </label>

              <?php echo form_input( array(
                'name' => 'max_passengers',
                'value' => set_value( 'max_passengers', show_data( @$soldoutitem->max_passengers), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('itm_max_passengers_label'),
                'id' => 'max_passengers',
                'readonly' => 'true'
              )); ?>

            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <label>
                <?php echo get_msg('itm_select_color')?>
              </label>

              <?php
              
                $options=array();
                $options[0]=get_msg('itm_select_color');
                $colors = $this->Color->get_all();
                foreach($colors->result() as $col) {
                    $options[$col->id]=$col->color_value;
                }

                echo form_dropdown(
                  'color_id',
                  $options,
                  set_value( 'color_id', show_data( @$soldoutitem->color_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="color_id"'
                );
              ?>
            </div>

            <div class="form-group">
              <label>
                <?php echo get_msg('itm_steering_position')?>
              </label>

              <?php echo form_input( array(
                'name' => 'steering_position',
                'value' => set_value( 'steering_position', show_data( @$soldoutitem->steering_position), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('itm_steering_position'),
                'id' => 'steering_position',
                'readonly' => 'true'
              )); ?>

            </div>
          </div>

          <legend><?php echo get_msg('performance_info_lable')?></legend>
          <div class="col-md-6">
            <div class="form-group">
              <label>
                <?php echo get_msg('itm_select_fuel')?>
              </label>

              <?php
              
                $options=array();
                $options[0]=get_msg('itm_select_fuel');
                $fuels = $this->Fueltype->get_all();
                foreach($fuels->result() as $fuel) {
                  $options[$fuel->id]=$fuel->fuel_name;
                }

                echo form_dropdown(
                  'fuel_type_id',
                  $options,
                  set_value( 'fuel_type_id', show_data( @$soldoutitem->fuel_type_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="fuel_type_id"'
                );
              ?>
            </div>
            
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>
                <?php echo get_msg('itm_mileage_label')?>
              </label>

              <?php echo form_input( array(
                'name' => 'mileage',
                'value' => set_value( 'mileage', show_data( @$soldoutitem->mileage), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('itm_mileage_label'),
                'id' => 'mileage',
                'readonly' => 'true'
              )); ?>

            </div>
          </div>

          <legend><?php echo get_msg('price_info_lable')?></legend>
          <div class="col-md-6">
            <div class="form-group">
              <label>
                <?php echo get_msg('itm_select_price')?>
              </label>

              <?php
                $options=array();
                $conds['status'] = 1;
                $options[0]=get_msg('itm_select_price');
                $pricetypes = $this->Pricetype->get_all_by($conds);
                foreach($pricetypes->result() as $price) {
                    $options[$price->id]=$price->name;
                }

                echo form_dropdown(
                  'item_price_type_id',
                  $options,
                  set_value( 'item_price_type_id', show_data( @$soldoutitem->item_price_type_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="item_price_type_id"'
                );
              ?>
            </div>

            <div class="form-group">
              <label>
                <?php echo get_msg('itm_price_unit_label')?>
              </label>

              <?php echo form_input( array(
                'name' => 'price_unit',
                'value' => set_value( 'price_unit', show_data( @$soldoutitem->price_unit), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('itm_price_unit_label'),
                'id' => 'price_unit',
                'readonly' => 'true'
              )); ?>

            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>
                <?php echo get_msg('itm_select_currency')?>
              </label>

              <?php
                $options=array();
                $conds['status'] = 1;
                $options[0]=get_msg('itm_select_currency');
                $currency = $this->Currency->get_all_by($conds);
                foreach($currency->result() as $curr) {
                    $options[$curr->id]=$curr->currency_short_form;
                }

                echo form_dropdown(
                  'item_currency_id',
                  $options,
                  set_value( 'item_currency_id', show_data( @$soldoutitem->item_currency_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="item_currency_id"'
                );
              ?>
            </div>

          </div>

          <legend><?php echo get_msg('licence_info_lable')?></legend>
          <div class="col-md-6">
            <div class="form-group">
              <label>
                <?php echo get_msg('itm_vehicle_id_label')?>
              </label>

              <?php echo form_input( array(
                'name' => 'vehicle_id',
                'value' => set_value( 'vehicle_id', show_data( @$soldoutitem->vehicle_id), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('itm_vehicle_id_label'),
                'id' => 'vehicle_id',
                'readonly' => 'true'
              )); ?>

            </div>

            <div class="form-group">
              <label> 
                <?php echo get_msg('license_expiration_date_label')?>
              </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-calendar"></i>
                  </span>
                </div>
                 <?php echo form_input(array(
                        'name' => 'license_expiration_date',
                        'value' => set_value( 'license_expiration_date',  show_data( @$soldoutitem->license_expiration_date), false ),
                        'class' => 'form-control',
                        'placeholder' => '',
                        'id' => 'license_expiration_date',
                        'size' => '30',
                        'readonly' => 'readonly',
                      )); ?>

              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <div class="form-check">
                <label>
                
                <?php echo form_checkbox( array(
                  'name' => 'licence_status',
                  'id' => 'licence_status',
                  'value' => 'accept',
                  'checked' => set_checkbox('licence_status', 1, ( @$soldoutitem->licence_status == 1 )? true: false ),
                  'class' => 'form-check-input',
                  'readonly' => 'true'
                )); ?>

                <?php echo get_msg( 'itm_licence_status' ); ?>

                </label>
              </div>
            </div>

            <div class="form-group">
              <div class="form-check">
                <label>
                
                <?php echo form_checkbox( array(
                  'name' => 'is_sold_out',
                  'id' => 'is_sold_out',
                  'value' => 'accept',
                  'checked' => set_checkbox('is_sold_out', 1, ( @$soldoutitem->is_sold_out == 1 )? true: false ),
                  'class' => 'form-check-input',
                  'readonly' => 'true'
                )); ?>

                <?php echo get_msg( 'itm_is_sold_out' ); ?>

                </label>
              </div>
            </div>

            <div class="form-group">
              <div class="form-check">
                <label>
                
                <?php echo form_checkbox( array(
                  'name' => 'business_mode',
                  'id' => 'business_mode',
                  'value' => 'accept',
                  'checked' => set_checkbox('business_mode', 1, ( @$soldoutitem->business_mode == 1 )? true: false ),
                  'class' => 'form-check-input',
                  'readonly' => 'true'
                )); ?>

                <?php echo get_msg( 'itm_business_mode' ); ?>
                <br><?php echo get_msg( 'itm_show_shop' ) ?>
                </label>
              </div>
            </div>
          </div>

          <div class="col-md-6">

            <br><br>
            <legend><?php echo get_msg('location_info_label'); ?></legend>
            <div class="form-group">
              <label>
                <?php echo get_msg('itm_address_label')?>
              </label>

              <?php echo form_textarea( array(
                'name' => 'address',
                'value' => set_value( 'address', show_data( @$soldoutitem->address), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('itm_address_label'),
                'id' => 'address',
                'rows' => "5",
                'readonly' => 'true'
              )); ?>

            </div>

          </div>

          <?php if (  @$soldoutitem->lat !='0' && @$soldoutitem->lng !='0' ):?>
          <div class="col-md-6">
            <div id="soldoutitem_map" style="width: 100%; height: 300px; pointer-events: none;"></div>
            <div class="clearfix">&nbsp;</div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label><?php echo get_msg('itm_lat_label') ?>
                <a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('city_lat_label')?>">
                  <span class='glyphicon glyphicon-info-sign menu-icon'>
                </a>
              </label>

              <br>

              <?php 
                echo form_input( array(
                  'type' => 'text',
                  'name' => 'lat',
                  'id' => 'lat',
                  'class' => 'form-control',
                  'placeholder' => '',
                  'value' => set_value( 'lat', show_data( @$soldoutitem->lat), false ),
                  'readonly' => 'true'
                ));
              ?>
            </div>

            <div class="form-group">
              <label><?php echo get_msg('itm_lng_label') ?>
                <a href="#" class="tooltip-ps" data-toggle="tooltip" 
                  title="<?php echo get_msg('city_lng_tooltips')?>">
                  <span class='glyphicon glyphicon-info-sign menu-icon'>
                </a>
              </label>

              <br>

              <?php 
                echo form_input( array(
                  'type' => 'text',
                  'name' => 'lng',
                  'id' => 'lng',
                  'class' => 'form-control',
                  'placeholder' => '',
                  'value' => set_value( 'lng', show_data( @$soldoutitem->lng), false ),
                  'readonly' => 'true'
                ));
              ?>
            </div>
            <!-- form group -->
          </div>
          <?php endif ?>
          
        </div>
        <!-- row -->
      </div>

        <!-- Grid row -->
        <div class="gallery" id="gallery" style="margin-left: 15px; margin-bottom: 15px;">
          <?php
              $conds = array( 'img_type' => 'item', 'img_parent_id' => $soldoutitem->id );
              $images = $this->Image->get_all_by( $conds )->result();
          ?>
          <?php $i = 0; foreach ( $images as $img ) :?>
            <!-- Grid column -->
            <div class="mb-3 pics animation all 2">
              <a href="#<?php echo $i;?>"><img class="img-fluid" src="<?php echo img_url('/' . $img->img_path); ?>" alt="Card image cap"></a>
            </div>
            <!-- Grid column -->
          <?php $i++; endforeach; ?>

          <?php $i = 0; foreach ( $images as $img ) :?>
            <a href="#_1" class="lightbox trans" id="<?php echo $i?>"><img src="<?php echo img_url('/' . $img->img_path); ?>"></a>
          <?php $i++; endforeach; ?>
        </div>
        <!-- Grid row -->

    </form>
  </div>
</section>

<script>

  function runAfterJQ() {

    $('#us3').locationpicker({
            location: {latitude:  '<?php echo $soldoutitem->lat;?>', longitude: '<?php echo $soldoutitem->lng;?>'},
            radius: 300,
            inputBinding: {
                latitudeInput: $('#lat'),
                longitudeInput: $('#lng'),
                radiusInput: $('#us3-radius')
            },
            enableAutocomplete: true,
            onchanged: function (currentLocation, radius, isMarkerDropped) {
                // Uncomment line below to show alert on each Location Changed event
                //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
            }
        });
  }

</script>

<!-- popular item map-->
<script>

    <?php
        if (isset($soldoutitem)) {
            $lat = $soldoutitem->lat;
            $lng = $soldoutitem->lng;
    ?>
            var soldoutitem_map = L.map('soldoutitem_map').setView([<?php echo $lat;?>, <?php echo $lng;?>], 5);
    <?php
        } else {
    ?>
            var soldoutitem_map = L.map('soldoutitem_map').setView([0, 0], 5);
    <?php
        }
    ?>

    const soldoutitem_attribution =
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
    const soldoutitem_tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    const soldoutitem_tiles = L.tileLayer(soldoutitem_tileUrl, { soldoutitem_attribution });
    soldoutitem_tiles.addTo(soldoutitem_map);
    <?php if(isset($soldoutitem)) {?>
        var soldoutitem_marker = new L.Marker(new L.LatLng(<?php echo $lat;?>, <?php echo $lng;?>));
        soldoutitem_map.addLayer(soldoutitem_marker);
        // results = L.marker([<?php echo $lat;?>, <?php echo $lng;?>]).addTo(mymap);

    <?php } else { ?>
        var soldoutitem_marker = new L.Marker(new L.LatLng(0, 0));
        //mymap.addLayer(marker2);
    <?php } ?>
    var results = L.layerGroup().addTo(soldoutitem_map);
    
    var popup = L.popup();

    function onMapClick(e) {

        var soldoutitem = e.latlng.toString();
        var soldoutitem_res = soldoutitem.substring(soldoutitem.indexOf("(") + 1, soldoutitem.indexOf(")"));
        soldoutitem_map.removeLayer(soldoutitem_marker);
        results.clearLayers();
        results.addLayer(L.marker(e.latlng));   

        var soldoutitem_tmpArr = new Array();
        soldoutitem_tmpArr = soldoutitem_res.split(",");

        document.getElementById("lat").value = soldoutitem_tmpArr[0].toString(); 
        document.getElementById("lng").value = soldoutitem_tmpArr[1].toString();
    }

    soldoutitem_map.on('click', onMapClick);
</script>
