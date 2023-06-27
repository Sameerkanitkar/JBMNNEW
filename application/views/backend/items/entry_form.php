<?php
	$attributes = array( 'id' => 'item-form', 'enctype' => 'multipart/form-data');
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
              <label><span style="font-size: 17px; color: red;">*</span>
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
                  set_value( 'manufacturer_id', show_data( @$item->manufacturer_id), false ),
                  'class="form-control form-control-sm mr-3" id="manufacturer_id"'
                );
              ?>
            </div>

            <div class="form-group">
              <label><span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('price')?>
              </label>

              <?php echo form_input( array(
                'name' => 'price',
                'value' => set_value( 'price', show_data( @$item->price), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('price'),
                'id' => 'price'
                
              )); ?>

            </div>

            <div class="form-group" id="discount_rate_by_percentage">
            <label>
              <?php echo get_msg('discount_rate_by_percentage')?>
            </label>

            <?php echo form_input( array(
              'name' => 'discount_rate_by_percentage',
              'value' => set_value( 'discount_rate_by_percentage', show_data( @$item->discount_rate_by_percentage), false )?set_value( 'discount_rate_by_percentage', show_data( @$item->discount_rate_by_percentage), false ):'0',
              'class' => 'form-control form-control-sm',
              'placeholder' => get_msg('discount_rate_by_percentage')                  
            )); ?>
          </div>

            <div class="form-group">
              <label>
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
                  'transmission_id',
                  $options,
                  set_value( 'transmission_id', show_data( @$item->transmission_id), false ),
                  'class="form-control form-control-sm mr-3" id="transmission_id"'
                );
              ?>
            </div>

            <div class="form-group">
              <label>
                <?php echo get_msg('plat_number_label')?>
              </label>

              <?php echo form_input( array(
                'name' => 'plate_number',
                'value' => set_value( 'plate_number', show_data( @$item->plate_number), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('plat_number_label'),
                'id' => 'plate_number'
                
              )); ?>

            </div>

            <div class="form-group">
              <label>
                <?php echo get_msg('year_label')?>
              </label>

              <?php echo form_input( array(
                'name' => 'year',
                'value' => set_value( 'year', show_data( @$item->year), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('year'),
                'id' => 'year'
                
              )); ?>

            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;"></span>
                <?php echo get_msg('prd_dynamic_link_label') ." : ".$item->dynamic_link; ?>
              </label>
            </div>

            <div class="form-group">
              <label>
                <?php echo get_msg('owner_of_item') ." : ".$this->User->get_one( $item->added_user_id )->user_name; ?>
              </label>
            </div>
            
          <!-- form group -->
          </div>

          <div class="col-md-6">

          <div class="form-group">
              <label><span style="font-size: 17px; color: red;">*</span>
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
                    set_value( 'model_id', show_data( @$item->model_id), false ),
                    'class="form-control form-control-sm mr-3" id="model_id"'
                  );

                } else {
                  $conds['manufacturer_id'] = $selected_manufacturer_id;
                  $options=array();
                  $options[0]=get_msg('select_model');

                  echo form_dropdown(
                    'model_id',
                    $options,
                    set_value( 'model_id', show_data( @$item->model_id), false ),
                    'class="form-control form-control-sm mr-3" id="model_id"'
                  );
                }
                
              ?>

          </div>

          <div class="form-group">
              <label><span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('item_description_label')?>
              </label>

              <?php echo form_textarea( array(
                'name' => 'description',
                'value' => set_value( 'description', show_data( @$item->description), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('item_description_label'),
                'id' => 'description',
                'rows' => "3"
              )); ?>

          </div>
            
          <div class="form-group">
            <label>
              <?php echo get_msg('engine_power_label')?>
            </label>

            <?php echo form_input( array(
              'name' => 'engine_power',
              'value' => set_value( 'engine_power', show_data( @$item->engine_power), false ),
              'class' => 'form-control form-control-sm',
              'placeholder' => get_msg('engine_power_label'),
              'id' => 'engine_power'
              
            )); ?>

          </div>

             <?php if ( !isset( $item )): ?>

              <div class="form-group">
                <span style="font-size: 17px; color: red;">*</span>
                <label><?php echo get_msg('item_img')?>
                  <a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('item_img')?>">
                    <span class='glyphicon glyphicon-info-sign menu-icon'>
                  </a>
                </label>

                <br/>

                <input class="btn btn-sm" type="file" name="cover" accept=".jpg,.jpeg,.png">
              </div>

              <?php else: ?>
              <span style="font-size: 17px; color: red;">*</span>
              <label><?php echo get_msg('item_img')?>
                <a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_photo_tooltips')?>">
                  <span class='glyphicon glyphicon-info-sign menu-icon'>
                </a>
              </label> 
              
              <div class="btn btn-sm btn-primary btn-upload pull-right" data-toggle="modal" data-target="#uploadImage">
                <?php echo get_msg('btn_replace_photo')?>
              </div>
              
              <hr/>
            
              <?php
                $conds = array( 'img_type' => 'item', 'img_parent_id' => $item->id, 'ordering' => '1' );
                $images = $this->Image->get_all_by( $conds )->result();
                $conds1 = array( 'img_type' => 'item', 'img_parent_id' => $item->id );
                $images1 = $this->Image->get_all_by( $conds1 )->result();
                
                if (!empty($images)) {
                  $img_path = $images[0]->img_path;
                } else if (!empty($images1)) {
                  $img_path = $images1[0]->img_path;
                } else {
                  $img_path = 'no_image.png';
                }
              ?>
                
                  <div class="col-md-4" style="height:100">

                    <div class="thumbnail">

                      <img src="<?php echo $this->ps_image->upload_thumbnail_url . $img_path; ?>">

                      <br/>
                      
                      <p class="text-center">
                        <?php if (!empty($images)) { ?>
                          <a data-toggle="modal" data-target="#deletePhoto" class="delete-img" id="<?php echo $images[0]->img_id; ?>"   
                            image="<?php echo $img->img_path; ?>">
                            <?php echo get_msg('remove_label'); ?>
                          </a>
                        <?php } else if (!empty($images1)) { ?>
                          <a data-toggle="modal" data-target="#deletePhoto" class="delete-img" id="<?php echo $images1[0]->img_id; ?>"   
                            image="<?php echo $img->img_path; ?>">
                            <?php echo get_msg('remove_label'); ?>
                          </a>
                        <?php } ?>    
                      </p>

                    </div>

                  </div>

            <?php endif; ?> 
            <!-- End Item default photo -->
            <!-- Item video upload -->
            <?php if ( !isset( $item )): ?>

              <div class="form-group">
                <label><?php echo get_msg('item_video_label')?>
                  <a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('item_video_label')?>">
                    <span class='fa fa-info-sign menu-icon'>
                  </a>
                </label>

                <br/>

                <input class="btn btn-sm" type="file" name="video" accept=".flv,.f4v,.f4p,.mp4">
              </div>

              <?php else: ?>
              <label><?php echo get_msg('item_video_label')?>
                <a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_photo_tooltips')?>">
                  <span class='fa fa-info-sign menu-icon'>
                </a>
              </label> 
              
              <div class="btn btn-sm btn-primary btn-upload pull-right" data-toggle="modal" data-target="#uploadvideo">
                <?php echo get_msg('btn_replace_video_label')?>
              </div>
              
              <hr/>

              <?php
                  $conds = array( 'img_type' => 'video', 'img_parent_id' => $item->id );
                  $videos = $this->Image->get_all_by($conds)->result();
                ?>
            
                <?php if ( count($videos) > 0 ): ?>
              
                    <div class="row">

                      <?php $i = 0; foreach ( $videos as $video ) :?>

                        <?php if ($i>0 && $i%3==0): ?>
                            
                        </div><div class='row'>
                        
                        <?php endif; ?>
                        
                        <div class="col-md-4">

                          <video width="320" height="240" controls>
                              <source src="<?php echo $this->ps_image->upload_url . $video->img_path; ?>" type="video/mp4" / >
                              This text displays if the video tag isn't supported.
                          </video>

                          <br/>
                            
                            <p class="text-center">
                              
                              <a data-toggle="modal" data-target="#deleteVideo" class="delete-video" id="<?php echo $video->img_id; ?>"   
                                image="<?php echo $video->img_path; ?>">
                                <?php echo get_msg('remove_label'); ?>
                              </a>
                            </p>

                        </div>

                      <?php $i++; endforeach; ?>

                    </div>
            
                  <?php endif; ?>
                
            <?php endif; ?> 
            <!-- End Item video -->

            <!-- End item cover photo -->
        <?php if ( !isset( $item )): ?>

          <div class="form-group">
            <label>
              <?php echo get_msg('item_video_icon_label')?> 
            </label>

            <br/>

            <input class="btn btn-sm" type="file" name="icon" id="icon" accept=".jpg,.jpeg,.png">
          </div>

        <?php else: ?>
          <label><?php echo get_msg('item_video_icon_label')?></label> 
          
          
          <div class="btn btn-sm btn-primary btn-upload pull-right" data-toggle="modal" data-target="#uploadIcon">
            <?php echo get_msg('btn_replace_icon')?>
          </div>
          
          <hr/>
          
          <?php

            $conds = array( 'img_type' => 'video-icon', 'img_parent_id' => $item->id );
            
            //print_r($conds); die;
            $images = $this->Image->get_all_by( $conds )->result();
          ?>
            
          <?php if ( count($images) > 0 ): ?>
            
            <div class="row">

            <?php $i = 0; foreach ( $images as $img ) :?>

              <?php if ($i>0 && $i%3==0): ?>
                  
              </div><div class='row'>
              
              <?php endif; ?>
                
              <div class="col-md-4" style="height:100">

                <div class="thumbnail">

                  <img src="<?php echo $this->ps_image->upload_thumbnail_url . $img->img_path; ?>" width="200" height="200">

                  <br/>
                  
                  <p class="text-center">
                    
                    <a data-toggle="modal" data-target="#deletePhoto" class="delete-img" id="<?php echo $img->img_id; ?>"   
                      image="<?php echo $img->img_path; ?>">
                      <?php echo get_msg('remove_label'); ?>
                    </a>
                  </p>

                </div>

              </div>

            <?php endforeach; ?>

            </div>
          
          <?php endif; ?>

        <?php endif; ?> 
    
                </div>
                <!--  col-md-6  -->
            <div class="form-group" style="padding-top: 30px;">
              <div class="form-check">

                <label>
                
                  <?php echo form_checkbox( array(
                    'name' => 'status',
                    'id' => 'status',
                    'value' => 'accept',
                    'checked' => set_checkbox('status', 1, ( @$item->status == 1 )? true: false ),
                    'class' => 'form-check-input'
                  )); ?>

                  <?php echo get_msg( 'status' ); ?>
                </label>
              </div>
            </div>

          </div>

          <div class="row">
            <legend><?php echo get_msg('other_info_lable')?></legend>
            <div class="col-md-6">
              <div class="form-group">
                <label> <span style="font-size: 17px; color: red;">*</span>
                  <?php echo get_msg('itm_title_label')?>
                </label>

                <?php echo form_input( array(
                  'name' => 'title',
                  'value' => set_value( 'title', show_data( @$item->title), false ),
                  'class' => 'form-control form-control-sm',
                  'placeholder' => get_msg('itm_title_label'),
                  'id' => 'title'
                  
                )); ?>

              </div>

              <div class="form-group">
                <label>
                  <?php echo get_msg('prd_high_info')?>
                </label>

                <?php echo form_textarea( array(
                  'name' => 'highlight_info',
                  'value' => set_value( 'info', show_data( @$item->highlight_info), false ),
                  'class' => 'form-control form-control-sm',
                  'placeholder' => "Please Highlight Information",
                  'id' => 'info',
                  'rows' => "3"
                )); ?>

              </div>

              <div class="form-group">
                <label>
                  <?php echo get_msg('itm_no_of_owner')?>
                </label>

                <?php echo form_input( array(
                  'name' => 'no_of_owner',
                  'value' => set_value( 'no_of_owner', show_data( @$item->no_of_owner), false ),
                  'class' => 'form-control form-control-sm',
                  'placeholder' => get_msg('itm_no_of_owner'),
                  'id' => 'no_of_owner'
                  
                )); ?>

              </div>

              <div class="form-group">
                <label>
                  <?php echo get_msg('itm_trim_name_label')?>
                </label>

                <?php echo form_input( array(
                  'name' => 'trim_name',
                  'value' => set_value( 'trim_name', show_data( @$item->trim_name), false ),
                  'class' => 'form-control form-control-sm',
                  'placeholder' => get_msg('itm_trim_name_label'),
                  'id' => 'trim_name'
                  
                )); ?>

              </div>

            </div>

            <div class="col-md-6">
            
              <div class="form-group">
                <label><span style="font-size: 17px; color: red;">*</span>
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
                    set_value( 'item_location_id', show_data( @$item->item_location_id), false ),
                    'class="form-control form-control-sm mr-3" id="item_location_id"'
                  );
                ?>
              </div>

              <div class="form-group">
                <label>
                  <?php echo get_msg('itm_select_location_township')?>
                </label>

                <?php
                  if(isset($item)) {
                    $options=array();
                    $options[0]=get_msg('itm_select_location_township');
                    $conds['city_id'] = $item->item_location_id;
                    $townships = $this->Item_location_township->get_all_by($conds);
                    foreach($townships->result() as $township) {
                      $options[$township->id]=$township->township_name;
                    }
                    echo form_dropdown(
                      'item_location_township_id',
                      $options,
                      set_value( 'item_location_township_id', show_data( @$item->item_location_township_id), false ),
                      'class="form-control form-control-sm mr-3" id="item_location_township_id"'
                    );

                  } else {
                    $conds['city_id'] = $selected_location_city_id;
                    $options=array();
                    $options[0]=get_msg('itm_select_location_township');

                    echo form_dropdown(
                      'item_location_township_id',
                      $options,
                      set_value( 'item_location_township_id', show_data( @$item->item_location_township_id), false ),
                      'class="form-control form-control-sm mr-3" id="item_location_township_id"'
                    );
                  }

                ?>

              </div>

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
                    set_value( 'seller_type_id', show_data( @$item->seller_type_id), false ),
                    'class="form-control form-control-sm mr-3" id="seller_type_id"'
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
                    set_value( 'item_type_id', show_data( @$item->item_type_id), false ),
                    'class="form-control form-control-sm mr-3" id="item_type_id"'
                  );
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
                    set_value( 'condition_of_item_id', show_data( @$item->condition_of_item_id), false ),
                    'class="form-control form-control-sm mr-3" id="condition_of_item_id"'
                  );
                ?>
              </div>

            </div>
          </div>

          <div class="row">
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
                    set_value( 'build_type_id', show_data( @$item->build_type_id), false ),
                    'class="form-control form-control-sm mr-3" id="build_type_id"'
                  );
                ?>
              </div>

              <div class="form-group">
                <label>
                  <?php echo get_msg('itm_no_of_doors_label')?>
                </label>

                <?php echo form_input( array(
                  'name' => 'no_of_doors',
                  'value' => set_value( 'no_of_doors', show_data( @$item->no_of_doors), false ),
                  'class' => 'form-control form-control-sm',
                  'placeholder' => get_msg('itm_no_of_doors_label'),
                  'id' => 'no_of_doors'
                  
                )); ?>

              </div>

              <div class="form-group">
                <label>
                  <?php echo get_msg('itm_max_passengers_label')?>
                </label>

                <?php echo form_input( array(
                  'name' => 'max_passengers',
                  'value' => set_value( 'max_passengers', show_data( @$item->max_passengers), false ),
                  'class' => 'form-control form-control-sm',
                  'placeholder' => get_msg('itm_max_passengers_label'),
                  'id' => 'max_passengers'
                  
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
                    set_value( 'color_id', show_data( @$item->color_id), false ),
                    'class="form-control form-control-sm mr-3" id="color_id"'
                  );
                ?>
              </div>

              <div class="form-group">
                <label>
                  <?php echo get_msg('itm_steering_position')?>
                </label>

                <?php echo form_input( array(
                  'name' => 'steering_position',
                  'value' => set_value( 'steering_position', show_data( @$item->steering_position), false ),
                  'class' => 'form-control form-control-sm',
                  'placeholder' => get_msg('itm_steering_position'),
                  'id' => 'steering_position'
                  
                )); ?>

              </div>
            </div>
          </div>
          <br>
          <div class="row">
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
                    set_value( 'fuel_type_id', show_data( @$item->fuel_type_id), false ),
                    'class="form-control form-control-sm mr-3" id="fuel_type_id"'
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
                  'value' => set_value( 'mileage', show_data( @$item->mileage), false ),
                  'class' => 'form-control form-control-sm',
                  'placeholder' => get_msg('itm_mileage_label'),
                  'id' => 'mileage'
                  
                )); ?>

              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <legend><?php echo get_msg('price_info_lable')?></legend>
            
            <div class="col-md-6">
              <div class="form-group">
                <label><span style="font-size: 17px; color: red;">*</span>
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
                    set_value( 'item_currency_id', show_data( @$item->item_currency_id), false ),
                    'class="form-control form-control-sm mr-3" id="item_currency_id"'
                  );
                ?>
              </div>

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
                    set_value( 'item_price_type_id', show_data( @$item->item_price_type_id), false ),
                    'class="form-control form-control-sm mr-3" id="item_price_type_id"'
                  );
                ?>
              </div>

            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>
                  <?php echo get_msg('itm_price_unit_label')?>
                </label>

                <?php echo form_input( array(
                  'name' => 'price_unit',
                  'value' => set_value( 'price_unit', show_data( @$item->price_unit), false ),
                  'class' => 'form-control form-control-sm',
                  'placeholder' => get_msg('itm_price_unit_label'),
                  'id' => 'price_unit'
                  
                )); ?>

              </div>
            </div>

          </div>
          <br>
          <div class="row">
            <legend><?php echo get_msg('licence_info_lable')?></legend>
            <div class="col-md-6">
              <div class="form-group">
                <label>
                  <?php echo get_msg('itm_vehicle_id_label')?>
                </label>

                <?php echo form_input( array(
                  'name' => 'vehicle_id',
                  'value' => set_value( 'vehicle_id', show_data( @$item->vehicle_id), false ),
                  'class' => 'form-control form-control-sm',
                  'placeholder' => get_msg('itm_vehicle_id_label'),
                  'id' => 'vehicle_id'
                  
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
                          'value' => set_value( 'license_expiration_date',  show_data( @$item->license_expiration_date), false ),
                          'class' => 'form-control',
                          'placeholder' => '',
                          'id' => 'license_expiration_date',
                          'size' => '30',
                          'readonly' => 'readonly'
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
                    'checked' => set_checkbox('licence_status', 1, ( @$item->licence_status == 1 )? true: false ),
                    'class' => 'form-check-input'
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
                    'checked' => set_checkbox('is_sold_out', 1, ( @$item->is_sold_out == 1 )? true: false ),
                    'class' => 'form-check-input'
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
                    'checked' => set_checkbox('business_mode', 1, ( @$item->business_mode == 1 )? true: false ),
                    'class' => 'form-check-input'
                  )); ?>

                  <?php echo get_msg( 'itm_business_mode' ); ?>
                  <br><?php echo get_msg( 'itm_show_shop' ) ?>
                  </label>
                </div>
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
                'value' => set_value( 'address', show_data( @$item->address), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('itm_address_label'),
                'id' => 'address',
                'rows' => "5"
              )); ?>

            </div>

          </div>

          <?php if (  @$item->lat !='0' && @$item->lng !='0' ):?>
          <div class="col-md-6">
            <div id="itm_location" style="width: 100%; height: 400px;"></div>
            <div class="clearfix">&nbsp;</div>
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_lat_label') ?>
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
                  'value' => set_value( 'lat', show_data( @$item->lat ), false ),
                ));
              ?>
            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_lng_label') ?>
                <a href="#" class="tooltip-ps" data-toggle="tooltip" 
                  title="<?php echo get_msg('city_lng_label')?>">
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
                  'value' =>  set_value( 'lng', show_data( @$item->lng ), false ),
                ));
              ?>
            </div>
            <!-- form group -->
          </div>

          <?php endif ?>
          
        </div>
        <!-- row -->
      

        <!-- Grid row -->
        <?php if ( isset( $item )): ?>
        <div class="gallery" id="gallery" style="margin-left: 15px; margin-bottom: 15px;">
          <?php
              $conds = array( 'img_type' => 'item', 'img_parent_id' => $item->id );
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
        <?php endif; ?>
        <!-- Grid row -->

      <div class="card-footer">
        <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 3px;">
          <?php echo get_msg('btn_save')?>
        </button>

        <button type="submit" name="gallery" id="gallery" class="btn btn-sm btn-primary" style="margin-top: 3px;">
          <?php echo get_msg('btn_save_gallery')?>
        </button>

        <button type="submit" name="promote" id="promote" class="btn btn-sm btn-primary" style="margin-top: 3px;">
          <?php echo get_msg('btn_promote')?>
        </button>

        <a href="<?php echo $module_site_url; ?>" class="btn btn-sm btn-primary" style="margin-top: 3px;">
          <?php echo get_msg('btn_cancel')?>
        </a>
      </div>
    </form>
  </div>
</section>


<script>
  <?php
      if (isset($item)) {
          $lat = $item->lat;
          $lng = $item->lng;
  ?>
          var itm_map = L.map('itm_location').setView([<?php echo $lat;?>, <?php echo $lng;?>], 5);
  <?php
      } else {
  ?>
          var itm_map = L.map('itm_location').setView([0, 0], 5);
  <?php
      }
  ?>

  const itm_attribution =
  '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
  const itm_tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
  const itm_tiles = L.tileLayer(itm_tileUrl, { itm_attribution });
  itm_tiles.addTo(itm_map);
  <?php if(isset($item)) {?>
      var itm_marker = new L.Marker(new L.LatLng(<?php echo $lat;?>, <?php echo $lng;?>));
      itm_map.addLayer(itm_marker);
      // results = L.marker([<?php echo $lat;?>, <?php echo $lng;?>]).addTo(mymap);

  <?php } else { ?>
      var itm_marker = new L.Marker(new L.LatLng(0, 0));
      //mymap.addLayer(marker2);
  <?php } ?>
  var itm_searchControl = L.esri.Geocoding.geosearch().addTo(itm_map);
  var results = L.layerGroup().addTo(itm_map);

  itm_searchControl.on('results',function(data){
      results.clearLayers();

      for(var i= data.results.length -1; i>=0; i--) {
          itm_map.removeLayer(itm_marker);
          results.addLayer(L.marker(data.results[i].latlng));
          var itm_search_str = data.results[i].latlng.toString();
          var itm_search_res = itm_search_str.substring(itm_search_str.indexOf("(") + 1, itm_search_str.indexOf(")"));
          var itm_searchArr = new Array();
          itm_searchArr = itm_search_res.split(",");

          document.getElementById("lat").value = itm_searchArr[0].toString();
          document.getElementById("lng").value = itm_searchArr[1].toString(); 
          
      }
  })
  var popup = L.popup();

  function onMapClick(e) {

      var itm = e.latlng.toString();
      var itm_res = itm.substring(itm.indexOf("(") + 1, itm.indexOf(")"));
      itm_map.removeLayer(itm_marker);
      results.clearLayers();
      results.addLayer(L.marker(e.latlng));   

      var itm_tmpArr = new Array();
      itm_tmpArr = itm_res.split(",");

      document.getElementById("lat").value = itm_tmpArr[0].toString(); 
      document.getElementById("lng").value = itm_tmpArr[1].toString();
  }

  itm_map.on('click', onMapClick);
</script>
