<script>

	<?php if ( $this->config->item( 'client_side_validation' ) == true ): ?>

	function jqvalidate() {

		$('#in-app-purchases-form').validate({
			rules:{
				in_app_purchase_prd_id:{
					blankCheck : ""
				},
				day:{
					blankCheck : ""
				},
				description:{
					blankCheck : ""
				},
				type:{
					indexCheck : ""
				}
			},
			messages:{
				in_app_purchase_prd_id:{
					blankCheck : "<?php echo get_msg( 'err_purchase_id' ) ;?>"
				},
				day:{
					blankCheck : "<?php echo get_msg( 'err_purchase_day' ) ;?>"
				},
				description :{
					blankCheck : "<?php echo get_msg( 'err_purchase_description' ) ;?>"
				},
				type:{
					indexCheck : "<?php echo get_msg( 'err_type_name' ) ;?>"
				}
			}
		});

		$('input[name="day"]').keyup(function(e)
                                {
		  if (/[^\d.-]/g.test(this.value))
		  {
		    // Filter non-digits from input value.
		    this.value = this.value.replace(/[^\d.-]/g, '');
		  }
		});

		// custom validation
		jQuery.validator.addMethod("blankCheck",function( value, element ) {
			
			   if(value == "") {
			    	return false;
			   } else {
			    	return true;
			   }
		});

		jQuery.validator.addMethod("indexCheck",function( value, element ) {
			
			if(value == 0) {
				 return false;
			} else {
				 return true;
			}
	 })
	}

	<?php endif; ?>


</script>