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
		      	lat:{
                    blankCheck : ""
			    },
			    lng:{
			     blankCheck : ""
			    }
			},
			messages:{
				title:{
					blankCheck : "<?php echo get_msg( 'err_item_name' ) ;?>",
					minlength: "<?php echo get_msg( 'err_item_len' ) ;?>",
					remote: "<?php echo get_msg( 'err_item_exist' ) ;?>."
				},
				manufacturer_id:{
			       indexCheck: "<?php echo $this->lang->line('f_item_cat_required'); ?>"
			    },
			    model_id:{
			       indexCheck: "<?php echo $this->lang->line('f_item_subcat_required'); ?>"
			    },
			    lat:{
			     blankCheck : "<?php echo get_msg( 'err_lat' ) ;?>"
			    },
			    lng:{
			     blankCheck : "<?php echo get_msg( 'err_lng' ) ;?>"
			    }
			}

		});
		
		jQuery.validator.addMethod("indexCheck",function( value, element ) {
			
			   if(value == 0) {
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

	}

	$('input[name="price"]').keyup(function(e) {
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
?>