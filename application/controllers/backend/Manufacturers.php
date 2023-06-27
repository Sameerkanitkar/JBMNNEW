<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Manufacturers Controller
 */
class Manufacturers extends BE_Controller {

	/**
	 * Construt required variables
	 */
	function __construct() {

		parent::__construct( MODULE_CONTROL, 'Manufacturers' );
		$this->load->library('uploader');
		$this->load->library('csvimport');
		$this->load->library('image_lib');
		$this->load->library( 'PS_Image' );

		///start allow module check 
		$conds_mod['module_name'] = $this->router->fetch_class();
		$module_id = $this->Module->get_one_by($conds_mod)->module_id;
		
		$logged_in_user = $this->ps_auth->get_user_info();

		$user_id = $logged_in_user->user_id;
		if(empty($this->User->has_permission( $module_id,$user_id )) && $logged_in_user->user_is_sys_admin!=1){
			return redirect( site_url('/admin/') );
		}
		///end check
	}

	/**
	 * List down the registered users
	 */
	function index() {
		
		// no publish filter
		$conds['no_publish_filter'] = 1;
		$conds['order_by_field'] = "added_date";
		$conds['order_by_type'] = "desc";
		// get rows count
		$this->data['rows_count'] = $this->Manufacturer->count_all_by( $conds );
		
		// get manufacturers
		$this->data['manufacturers'] = $this->Manufacturer->get_all_by( $conds , $this->pag['per_page'], $this->uri->segment( 4 ) );
		// load index logic
		parent::index();
	}

	/**
	 * Searches for the first match.
	 */
	function search() {
		

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'manu_search' );
		
		// condition with search term
		if($this->input->post('submit') != NULL ){
				
			if($this->input->post('searchterm') != "") {
				$conds['searchterm'] = $this->input->post('searchterm');
				$this->data['searchterm'] = $this->input->post('searchterm');
				$this->session->set_userdata(array("searchterm" => $this->input->post('searchterm')));
			} else {
				
				$this->session->set_userdata(array("searchterm" => NULL));
			}

			if($this->input->post('order_by') == "name_asc") {
					
				$conds['order_by_field'] = "name";
				$conds['order_by_type'] = "asc";

				$this->data['order_by'] = $this->input->post('order_by');
				$this->session->set_userdata(array("order_by" => $this->input->post('order_by')));
			
			}  

			if($this->input->post('order_by') == "name_desc") {
				
				$conds['order_by_field'] = "name";
				$conds['order_by_type'] = "desc";

				$this->data['order_by'] = $this->input->post('order_by');
				$this->session->set_userdata(array("order_by" => $this->input->post('order_by')));
			}	
			
		} else {
			//read from session value
			if($this->session->userdata('searchterm') != NULL){
				$conds['searchterm'] = $this->session->userdata('searchterm');
				$this->data['searchterm'] = $this->session->userdata('searchterm');
			}

			if($this->session->userdata('order_by') != NULL){
				$conds['order_by_field'] = "name";
				if($this->session->userdata('order_by') == "name_asc"){
					$conds['order_by_type'] = "asc";
				}else{
					$conds['order_by_type'] = "desc";
				}
				$this->data['order_by'] = $this->session->userdata('order_by');
			} 	
		}	
		
		// no publish filter
		$conds['no_publish_filter'] = 1;
		if ($conds['order_by_field'] == "" ){
			$conds['order_by_field'] = "added_date";
			$conds['order_by_type'] = "desc";
		}

		// pagination
		$this->data['rows_count'] = $this->Manufacturer->count_all_by( $conds );

		// search data
		$this->data['manufacturers'] = $this->Manufacturer->get_all_by( $conds, $this->pag['per_page'], $this->uri->segment( 4 ) );
		
		// load add list
		parent::search();
	}

	/**
	 * Create new one
	 */
	function add() {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'manu_add' );

		// call the core add logic
		parent::add();
	}

	/**
	 * Update the existing one
	 */
	function edit( $id ) {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'manu_edit' );

		// load user
		$this->data['manufacturer'] = $this->Manufacturer->get_one( $id );

		// call the parent edit logic
		parent::edit( $id );
	}

	/**
	 * Saving Logic
	 * 1) upload image
	 * 2) save Manufacturer
	 * 3) save image
	 * 4) check transaction status
	 *
	 * @param      boolean  $id  The user identifier
	 */
	function save( $id = false ) {
		// start the transaction
		$this->db->trans_start();
		
		/** 
		 * Insert Manufacturer Records 
		 */
		$data = array();

		// prepare name
		if ( $this->has_data( 'name' )) {
			$data['name'] = $this->get_data( 'name' );
		}

		// set timezone

		if($id == "") {
			//save
			$data['added_date'] = date("Y-m-d H:i:s");

		} else {
			//edit
			unset($data['added_date']);
			$data['updated_date'] = date("Y-m-d H:i:s");
		}


		// save Manufacturer
		if ( ! $this->Manufacturer->save( $data, $id )) {
		// if there is an error in inserting user data,	

			// rollback the transaction
			$this->db->trans_rollback();

			// set error message
			$this->data['error'] = get_msg( 'err_model' );
			
			return;
		}

		/** 
		 * Upload Image Records 
		 */
		if ( !$id ) {
			if ( ! $this->insert_icon_images( $_FILES, 'manufacturer', $data['id'], "cover" )) {
				// if error in saving image

					// commit the transaction
					$this->db->trans_rollback();
					
					return;
				}
			if ( ! $this->insert_icon_images( $_FILES, 'manufacturer-icon', $data['id'], "icon" )) {
				// if error in saving image

					// commit the transaction
					$this->db->trans_rollback();
					
					return;
				}	
		}

		/** 
		 * Check Transactions 
		 */

		// commit the transaction
		if ( ! $this->check_trans()) {
        	
			// set flash error message
			$this->set_flash_msg( 'error', get_msg( 'err_model' ));
		} else {

			if ( $id ) {
			// if user id is not false, show success_add message
				
				$this->set_flash_msg( 'success', get_msg( 'success_manu_edit' ));
			} else {
			// if user id is false, show success_edit message

				$this->set_flash_msg( 'success', get_msg( 'success_manu_add' ));
			}
		}

		redirect( $this->module_site_url());
	}


	

	/**
	 * Delete the record
	 * 1) delete Manufacturer
	 * 2) delete image from folder and table
	 * 3) check transactions
	 */
	function delete( $manufacturer_id ) {

		// start the transaction
		$this->db->trans_start();

		// check access
		$this->check_access( DEL );
		
		// delete categories and images
		if ( !$this->ps_delete->delete_manufacturer( $manufacturer_id )) {

			// set error message
			$this->set_flash_msg( 'error', get_msg( 'err_model' ));

			// rollback
			$this->trans_rollback();

			// redirect to list view
			redirect( $this->module_site_url());
		}
			
		/**
		 * Check Transcation Status
		 */
		if ( !$this->check_trans()) {

			$this->set_flash_msg( 'error', get_msg( 'err_model' ));	
		} else {
        	
			$this->set_flash_msg( 'success', get_msg( 'success_manu_delete' ));
		}
		
		redirect( $this->module_site_url());
	}


	/**
	 * Delete all the news under manufacturer
	 *
	 * @param      integer  $manufacturer_id  The manufacturer identifier
	 */
	function delete_all( $manufacturer_id = 0 )
	{
		// start the transaction
		$this->db->trans_start();

		// check access
		$this->check_access( DEL );
		
		// delete manufacturer and images
		$enable_trigger = true; 
		
		$type = "manufacturer";

		/** Note: enable trigger will delete news under manufacturer and all news related data */
		if ( !$this->ps_delete->delete_history( $manufacturer_id, $type, $enable_trigger )) {
		// if error in deleting manufacturer,

			// set error message
			$this->set_flash_msg( 'error', get_msg( 'err_model' ));

			// rollback
			$this->trans_rollback();

			// redirect to list view
			redirect( $this->module_site_url());
		}
			
		/**
		 * Check Transcation Status
		 */
		if ( !$this->check_trans()) {

			$this->set_flash_msg( 'error', get_msg( 'err_model' ));	
		} else {
        	
			$this->set_flash_msg( 'success', get_msg( 'success_manu_delete' ));
		}
		
		redirect( $this->module_site_url());
	}

	
	/**
	 * Determines if valid input.
	 *
	 * @return     boolean  True if valid input, False otherwise.
	 */
	function is_valid_input( $id = 0 ) {
		
		$rule = 'required|callback_is_valid_name['. $id  .']';

		$this->form_validation->set_rules( 'name', get_msg( 'name' ), $rule);

		if ( $this->form_validation->run() == FALSE ) {
		// if there is an error in validating,

			return false;
		}

		return true;
	}

	/**
	 * Determines if valid name.
	 *
	 * @param      <type>   $name  The  name
	 * @param      integer  $id     The  identifier
	 *
	 * @return     boolean  True if valid name, False otherwise.
	 */
	function is_valid_name( $name, $id = 0 )
	{		

		 $conds['name'] = $name;

		 	if( $id != "") {
		 	
				if ( strtolower( $this->Manufacturer->get_one( $id )->name ) == strtolower( $name )) {
				// if the name is existing name for that user id,
					return true;
				} else if ( $this->Manufacturer->exists( ($conds ))) {
				// if the name is existed in the system,
					$this->form_validation->set_message('is_valid_name', get_msg( 'err_dup_name' ));
					return false;
				}
			} else {
				// echo "aaaa";die;
				if ( $this->Manufacturer->exists( ($conds ))) {
				// if the name is existed in the system,
					$this->form_validation->set_message('is_valid_name', get_msg( 'err_dup_name' ));
					return false;
				}
			}
			return true;
	}

	/**
	 * Check Manufacturer name via ajax
	 *
	 * @param      boolean  $cat_id  The cat identifier
	 */
	function ajx_exists( $id = false )
	{
		// get Manufacturer name
		$name = $_REQUEST['name'];

		if ( $this->is_valid_name( $name, $id )) {

		// if the Manufacturer name is valid,
			
			echo "true";
		} else {
		// if invalid Manufacturer name,
			
			echo "false";
		}
	}

	/**
	 * Publish the record
	 *
	 * @param      integer  $manufacturer_id  The Manufacturer identifier
	 */
	function ajx_publish( $manufacturer_id = 0 )
	{
		// check access
		$this->check_access( PUBLISH );
		
		// prepare data
		$manufacturer_data = array( 'status'=> 1 );
			
		// save data
		if ( $this->Manufacturer->save( $manufacturer_data, $manufacturer_id )) {
			echo 'true';
		} else {
			echo 'false';
		}
	}
	
	/**
	 * Unpublish the records
	 *
	 * @param      integer  $manufacturer_id  The manufacturer identifier
	 */
	function ajx_unpublish( $manufacturer_id = 0 )
	{
		// check access
		$this->check_access( PUBLISH );
		
		// prepare data
		$manufacturer_data = array( 'status'=> 0 );
			
		// save data
		if ( $this->Manufacturer->save( $manufacturer_data, $manufacturer_id )) {
			echo 'true';
		} else {
			echo 'false';
		}
	}

	/**
	 * CSV file upload with image
	 */
	function upload() {
		
		if ( $this->is_POST()) {

			$file = $_FILES['file']['name'];
			$ext = substr(strrchr($file, '.'), 1);
			
			if(strtolower($ext) == "csv") {

        	 	$upload_data = $this->uploader->upload($_FILES);
				
				if (!isset($upload_data['error'])) {
					foreach ($upload_data as $upload) {
						
						$file_data = $this->upload->data();
		            	$file_path =  './uploads/'.$file_data['file_name'];

		            	if ($this->csvimport->get_array($file_path)) {

							//get data from imported csv file
			                $csv_array = $this->csvimport->get_array($file_path);
			                $i = 0; $s = 0; $f=0;
			                $fail_records = "";

			                foreach ($csv_array as $row) {
			                    
								// Get manufacturer data
								$name = trim($row['manufacturer_name']);
								$status = $row['status'];
								$photo_name = $row['photo_name'];
								$icon_name = $row['icon_name'];
								
			                    if($name != '') {
									
									//Get Image Info 
									$data_img = getimagesize(base_url() . "uploads/" . $photo_name);
									$data_icon = getimagesize(base_url() . "uploads/" . $icon_name);
									
									if( count($data_img) != 1 ) {
										
										if( count($data_icon) != 1 ) {

											$data = array(
												'name' => $name,
												'status' => $status,
											);

											// check manufacturer is already existed or not
											$conds['name'] = $name;
											$conds['no_publish_filter'] = 1;

											if($this->Manufacturer->count_all_by($conds) > 0){
												$f++; $i++;
												$fail_records .= " - " . $name . " " .get_msg( 'already_existed' ) . "<br>";
												continue;
											}

											$id = false;
											
											if($this->Manufacturer->save($data, $id)) {
												
												$id = ( !$id )? $data['id']: $id ;
												
												$image = array(
													'img_parent_id' => $id,
													'img_type' 		=> "manufacturer",
													'img_desc' 		=> "",
													'img_path' 		=> $photo_name,
													'img_width'     => $data_img[0],
													'img_height'    => $data_img[1]
												);
												
												//cover photo path
												$path = "uploads/" . $photo_name;
												$this->ps_image->create_thumbnail($path);

												$image_icon = array(
													'img_parent_id' => $id,
													'img_type' 		=> "manufacturer-icon",
													'img_desc' 		=> "",
													'img_path' 		=> $icon_name,
													'img_width'     => $data_icon[0],
													'img_height'    => $data_icon[1]
												);

												//icon photo path
												$path_icon = "uploads/" . $icon_name;
												$this->ps_image->create_thumbnail($path_icon);
												$this->Image->save($image_icon);
												
												if($this->Image->save($image)) {
													//both success
													$s++;
												}

											} else {
												$f++;
												$fail_records .= " - " . $name . " " .get_msg( 'db_err' ) . "<br>";
											}	

										} else {
											//icon at uploads missing 
											$f++;
				                			$fail_records .= " - " . $name . " " . get_msg( 'miss_manu_icon' ) . "<br>";
										}

									} else {
										//image at uploads missing 
										$f++;
				                		$fail_records .= " - " . $name . " " . get_msg( 'miss_manu_img' ) . "<br>";
									}
									
			                	} else {
									// manufacturer name missing
			                		$f++;
			                		$fail_records .= " - " . get_msg( 'miss_manu' ) . ".<br>";
			                	}

			                	$i++;

			                }

			                $result_str = get_msg( 'total_manu' ) .' ' . $i . "<br>";
			                $result_str .= get_msg( 'success_manu' ) . ' ' . $s . "<br>";
			                $result_str .= get_msg( 'fail_manu' ) . ' ' . $f .  "<br>" . $fail_records;

			                $this->data['message'] = $result_str;
			                $this->set_flash_msg( 'success', $result_str);

			            	redirect( $this->module_site_url());
							
			            } else {

			            	$this->set_flash_msg( 'error', get_msg( 'something_wrong_upload' ));
			            	redirect( $this->module_site_url());

			            }
					}
				} else {

					$this->set_flash_msg( 'error', $upload_data['error']);
					redirect( $this->module_site_url());
				}

			} else {

				$this->set_flash_msg( 'error',  get_msg( 'pls_upload_csv' ));
				redirect( $this->module_site_url());
			}

		} else {
			redirect( $this->module_site_url());
		}
	}
}