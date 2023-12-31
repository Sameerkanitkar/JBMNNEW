<script>
	<?php if ( $this->config->item( 'client_side_validation' ) == true ): ?>

	function jqvalidate() {

		$('#item-form').validate({
			rules:{
				title:{
					blankCheck : "",
					minlength: 3,
					remote: "<?php echo $module_site_url .'/ajx_exists/'.@$item->id; ?>"
				},
				manufacturer_id: {
		       		indexCheck : ""
		      	},
		      	model_id: {
		       		indexCheck : ""
		      	},
				item_location_id: {
		       		indexCheck : ""
		      	},
				price:{
                    blankCheck : "",
                    indexCheck : ""
			    },
				item_currency_id: {
		       		indexCheck : ""
		      	},
				description:{
                    blankCheck : ""
			    },
				cover:{
                    required : true
			    },
				lat:{
                    blankCheck : "",
                    indexCheck : "",
                    validChecklat : ""
			    },
			    lng:{
			     	blankCheck : "",
			     	indexCheck : "",
			     	validChecklng : ""
			    }
			},
			messages:{
				title:{
					blankCheck : "<?php echo get_msg( 'err_item_name' ) ;?>",
					minlength: "<?php echo get_msg( 'err_item_len' ) ;?>",
					remote: "<?php echo get_msg( 'err_item_exist' ) ;?>."
				},
			    price:{
			     	blankCheck : "<?php echo get_msg( 'err_price' ) ;?>",
			     	indexCheck : "<?php echo get_msg( 'price_cannot_zero' ) ;?>"
			    },
				description:{
			     	blankCheck : "<?php echo get_msg( 'err_purchase_description' ) ;?>",
			    },
				manufacturer_id:{
			       indexCheck: "<?php echo get_msg('err_manu_name'); ?>"
			    },
			    model_id:{
			       indexCheck: "<?php echo get_msg('err_model_name'); ?>"
			    },
				item_location_id:{
			       indexCheck: "<?php echo get_msg('err_location_name'); ?>"
			    },
				item_currency_id:{
			       indexCheck: "<?php echo get_msg('err_currency_name'); ?>"
			    },
				cover:{
			       required: "<?php echo get_msg('err_image'); ?>"
			    },
				lat:{
			     	blankCheck : "<?php echo get_msg( 'err_lat' ) ;?>",
			     	indexCheck : "<?php echo get_msg( 'err_lat_lng' ) ;?>",
			     	validChecklat : "<?php echo get_msg( 'lat_invlaid' ) ;?>"
			    },
			    lng:{
			     	blankCheck : "<?php echo get_msg( 'err_lng' ) ;?>",
			     	indexCheck : "<?php echo get_msg( 'err_lat_lng' ) ;?>",
			     	validChecklng : "<?php echo get_msg( 'lng_invlaid' ) ;?>"
			    },
			},

			submitHandler: function(form) {
		        if ($("#item-form").valid()) {
		            form.submit();
		        }
		    }

		});
		
		jQuery.validator.addMethod("indexCheck",function( value, element ) {
			
			   if(value == 0 || value == '') {
			    	return false;
			   } else {
			    	return true;
			   };
			   
		});

		jQuery.validator.addMethod("blankCheck",function( value, element ) {
			
			   if(value == "") {
			    	return false;
			   } else {
			   	 	return true;
			   }
		});

		jQuery.validator.addMethod("validChecklat",function( value, element ) {
			    if (value < -90 || value > 90) {
			    	return false;
			    } else {
			   	 	return true;
			    }
		});

		jQuery.validator.addMethod("validChecklng",function( value, element ) {
			    if (value < -180 || value > 180) {
			    	return false;
			   } else {
			   	 	return true;
			   }
		});
			

	}

	<?php endif; ?>
	function runAfterJQ() {

		$('#manufacturer_id').on('change', function() {

			var value = $('option:selected', this).text().replace(/Value\s/, '');

			var manuId = $(this).val();

			$.ajax({
				url: '<?php echo $module_site_url . '/get_all_model/';?>' + manuId,
				method: 'GET',
				dataType: 'JSON',
				success:function(data){
					$('#model_id').html("");
					$.each(data, function(i, obj){
					    $('#model_id').append('<option value="'+ obj.id +'">' + obj.name+ '</option>');
					});
					$('#name').val($('#name').val() + " ").blur();
					$('#model_id').trigger('change');
				}
			});
		});

		$('#item_location_id').on('change', function() {

			var value = $('option:selected', this).text().replace(/Value\s/, '');

			var city_id = $(this).val();

			$.ajax({
				url: '<?php echo $module_site_url . '/get_all_location_townships/';?>' + city_id,
				method: 'GET',
				dataType: 'JSON',
				success:function(data){
					$('#item_location_township_id').html("");
					$.each(data, function(i, obj){
					    $('#item_location_township_id').append('<option value="'+ obj.id +'">' + obj.township_name+ '</option>');
					});
					$('#township_name').val($('#township_name').val() + " ").blur();
					$('#item_location_township_id').trigger('change');
				}
			});
		});
		
	    $("#license_expiration_date").datepicker({format: 'yyyy-mm-dd 00:00:00'});

		 $(function() {
			var selectedClass = "";
			$(".filter").click(function(){
			selectedClass = $(this).attr("data-rel");
			$("#gallery").fadeTo(100, 0.1);
			$("#gallery div").not("."+selectedClass).fadeOut().removeClass('animation');
			setTimeout(function() {
			$("."+selectedClass).fadeIn().addClass('animation');
			$("#gallery").fadeTo(300, 1);
			}, 300);
			});
		});
        
         $('.delete-img').click(function(e){
			e.preventDefault();

			// get id and image
			var id = $(this).attr('id');

			// do action
			var action = '<?php echo $module_site_url .'/delete_cover_photo/'; ?>' + id + '/<?php echo @$item->id; ?>';
			console.log( action );
			$('.btn-delete-image').attr('href', action);
		});


		$('.delete-video').click(function(e){
			e.preventDefault();

			// get id and image
			var id = $(this).attr('id');

			// do action
			var action = '<?php echo $module_site_url .'/delete_video/'; ?>' + id + '/<?php echo @$item->id; ?>';
			console.log( action );
			$('.btn-delete-video').attr('href', action);
		});
	}

	$('input[name="price"]').keyup(function(e) {
		  if (/[^\d.-]/g.test(this.value))
		  {
		    // Filter non-digits from input value.
		    this.value = this.value.replace(/[^\d.-]/g, '');
		  }
	});

	$('input[name="discount_rate_by_percentage"]').keyup(function(e) {
		  if (/[^\d.-]/g.test(this.value))
		  {
		    // Filter non-digits from input value.
		    this.value = this.value.replace(/[^\d.-]/g, '');
		  }
	});

	$('input[name="year"]').keyup(function(e) {
		  if (/[^\d.-]/g.test(this.value))
		  {
		    // Filter non-digits from input value.
		    this.value = this.value.replace(/[^\d.-]/g, '');
		  }
	});

	$('input[name="no_of_owner"]').keyup(function(e) {
		  if (/[^\d.-]/g.test(this.value))
		  {
		    // Filter non-digits from input value.
		    this.value = this.value.replace(/[^\d.-]/g, '');
		  }
	});

	$('input[name="no_of_doors"]').keyup(function(e) {
		  if (/[^\d.-]/g.test(this.value))
		  {
		    // Filter non-digits from input value.
		    this.value = this.value.replace(/[^\d.-]/g, '');
		  }
	});

	$('input[name="max_passengers"]').keyup(function(e) {
		  if (/[^\d.-]/g.test(this.value))
		  {
		    // Filter non-digits from input value.
		    this.value = this.value.replace(/[^\d.-]/g, '');
		  }
	});

	


</script>
<?php 
	// replace cover photo modal
	$data = array(
		'title' => get_msg('upload_photo'),
		'img_type' => 'item',
		'img_parent_id' => @$item->id
	);

	$this->load->view( $template_path .'/components/photo_upload_modal', $data );

	// delete cover photo modal
	$this->load->view( $template_path .'/components/delete_cover_photo_modal' ); 
	// replace and delete video icon

	$data = array(
		'title' => get_msg('upload_photo'),
		'img_type' => 'video-icon',
		'img_parent_id' => @$item->id
	);


	$this->load->view( $template_path .'/components/icon_upload_modal', $data );

	$this->load->view( $template_path .'/components/delete_cover_photo_modal' ); 

	// replace and delete video
	$data = array(
		'title' => get_msg('upload_video'),
		'img_type' => 'video',
		'img_parent_id' => @$item->id
	);

	$this->load->view( $template_path .'/components/video_upload_modal', $data );

	// delete cover photo modal
	$this->load->view( $template_path .'/components/delete_video_modal' );
?>