<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Likes Controller
 */

class Item_upload_configs extends BE_Controller {

		/**
	 * Construt required variables
	 */
	function __construct() {

		parent::__construct( MODULE_CONTROL, 'ITEM_UPLOAD_CONFIGS' );
		///start allow module check 
		$conds_mod['module_name'] = $this->router->fetch_class();
		$module_id = $this->Module->get_one_by($conds_mod)->module_id;
		
		$logged_in_user = $this->ps_auth->get_user_info();

		$user_id = $logged_in_user->user_id;
		if(empty($this->User->has_permission( $module_id,$user_id )) && $logged_in_user->user_is_sys_admin!=1){
			return redirect( site_url('/admin') );
		}
		///end check
	}

	/**
	 * Load About Entry Form
	 */

	function index( $id = "1" ) {

		if ( $this->is_POST()) {
		// if the method is post

			// server side validation
			//if ( $this->is_valid_input()) {

				// save user info
				$this->save( $id );
			//}
		}
		
		//Get About Object
		$this->data['item_config'] = $this->Item_upload_config->get_one( $id );

		$this->load_form($this->data);

	}

	/**
	 * Update the existing one
	 */
	function edit( $id = "1") {


		// load user
		$this->data['item_config'] = $this->Item_upload_config->get_one( $id );

		// call the parent edit logic
		parent::edit( $id );
	}

	/**
	 * Saving Logic
	 * 1) save about data
	 * 2) check transaction status
	 *
	 * @param      boolean  $id  The about identifier
	 */
	function save( $id = false ) {
	
		// prepare data for save
		$data = array();

		// id
		if ( $this->has_data( 'id' )) {
			$data['id'] = $this->get_data( 'id' );
		}

		// if item_price_type_id is checked,
		if ( $this->has_data( 'item_price_type_id' )) {
			$data['item_price_type_id'] = 1;
		}else{
			$data['item_price_type_id'] = 0;
		}

		// if item_type_id is checked,
		if ( $this->has_data( 'item_type_id' )) {
			$data['item_type_id'] = 1;
		}else{
			$data['item_type_id'] = 0;
		}

		// if discount_rate_by_percentage is checked,
		if ( $this->has_data( 'discount_rate_by_percentage' )) {
			$data['discount_rate_by_percentage'] = 1;
		}else{
			$data['discount_rate_by_percentage'] = 0;
		}

        // if no_of_owner is checked,
		if ( $this->has_data( 'no_of_owner' )) {
			$data['no_of_owner'] = 1;
		}else{
			$data['no_of_owner'] = 0;
		}

        // if trim_name is checked,
		if ( $this->has_data( 'trim_name' )) {
			$data['trim_name'] = 1;
		}else{
			$data['trim_name'] = 0;
		}

        // if plate_number is checked,
		if ( $this->has_data( 'plate_number' )) {
			$data['plate_number'] = 1;
		}else{
			$data['plate_number'] = 0;
		}

        // if engine_power is checked,
		if ( $this->has_data( 'engine_power' )) {
			$data['engine_power'] = 1;
		}else{
			$data['engine_power'] = 0;
		}

        // if year is checked,
		if ( $this->has_data( 'year' )) {
			$data['year'] = 1;
		}else{
			$data['year'] = 0;
		}

        // if seller_type_id is checked,
		if ( $this->has_data( 'seller_type_id' )) {
			$data['seller_type_id'] = 1;
		}else{
			$data['seller_type_id'] = 0;
		}

        // if transmission_id is checked,
		if ( $this->has_data( 'transmission_id' )) {
			$data['transmission_id'] = 1;
		}else{
			$data['transmission_id'] = 0;
		}

		// if condition_of_item_id is checked,
		if ( $this->has_data( 'condition_of_item_id' )) {
			$data['condition_of_item_id'] = 1;
		}else{
			$data['condition_of_item_id'] = 0;
		}

		// if highlight_info is checked,
		if ( $this->has_data( 'highlight_info' )) {
			$data['highlight_info'] = 1;
		}else{
			$data['highlight_info'] = 0;
		}
		
		// if video is checked,
		if ( $this->has_data( 'video' )) {
			$data['video'] = 1;
		}else{
			$data['video'] = 0;
		}

		// if video_icon is checked,
		if ( $this->has_data( 'video_icon' )) {
			$data['video_icon'] = 1;
		}else{
			$data['video_icon'] = 0;
		}

        // if build_type_id is checked,
		if ( $this->has_data( 'build_type_id' )) {
			$data['build_type_id'] = 1;
		}else{
			$data['build_type_id'] = 0;
		}

		// if no_of_doors is checked,
		if ( $this->has_data( 'no_of_doors' )) {
			$data['no_of_doors'] = 1;
		}else{
			$data['no_of_doors'] = 0;
		}

		// if max_passengers is checked,
		if ( $this->has_data( 'max_passengers' )) {
			$data['max_passengers'] = 1;
		}else{
			$data['max_passengers'] = 0;
		}

        // if color_id is checked,
		if ( $this->has_data( 'color_id' )) {
			$data['color_id'] = 1;
		}else{
			$data['color_id'] = 0;
		}

		// if steering_position is checked,
		if ( $this->has_data( 'steering_position' )) {
			$data['steering_position'] = 1;
		}else{
			$data['steering_position'] = 0;
		}
        
		// if vehicle_id is checked,
		if ( $this->has_data( 'vehicle_id' )) {
			$data['vehicle_id'] = 1;
		}else{
			$data['vehicle_id'] = 0;
		}

		// if licence_expiration_date is checked,
		if ( $this->has_data( 'licence_expiration_date' )) {
			$data['licence_expiration_date'] = 1;
		}else{
			$data['licence_expiration_date'] = 0;
		}

		// if licence_status is checked,
		if ( $this->has_data( 'licence_status' )) {
			$data['licence_status'] = 1;
		}else{
			$data['licence_status'] = 0;
		}

        // if business_mode is checked,
		if ( $this->has_data( 'business_mode' )) {
			$data['business_mode'] = 1;
		}else{
			$data['business_mode'] = 0;
		}

		// if price_unit is checked,
		if ( $this->has_data( 'price_unit' )) {
			$data['price_unit'] = 1;
		}else{
			$data['price_unit'] = 0;
		}

        // if fuel_type_id is checked,
		if ( $this->has_data( 'fuel_type_id' )) {
			$data['fuel_type_id'] = 1;
		}else{
			$data['fuel_type_id'] = 0;
		}

		// if mileage is checked,
		if ( $this->has_data( 'mileage' )) {
			$data['mileage'] = 1;
		}else{
			$data['mileage'] = 0;
		}

		// if address is checked,
		if ( $this->has_data( 'address' )) {
			$data['address'] = 1;
		}else{
			$data['address'] = 0;
		}

		if ( ! $this->Item_upload_config->save( $data, $id )) {
		// if there is an error in inserting user data,	

			// set error message
			$this->data['error'] = get_msg( 'err_model' );
			
			return;
		}

		// commit the transaction
		if ( ! $this->check_trans()) {
        	
			// set flash error message
			$this->set_flash_msg( 'error', get_msg( 'err_model' ));
		} else {

			if ( $id ) {
			// if user id is not false, show success_add message
				
				$this->set_flash_msg( 'success', get_msg( 'success_item_config_edit' ));
			} else {
			// if user id is false, show success_edit message

				$this->set_flash_msg( 'success', get_msg( 'success_item_config_add' ));
			}
		}

		redirect( site_url('/admin/item_upload_configs') );
	}
}