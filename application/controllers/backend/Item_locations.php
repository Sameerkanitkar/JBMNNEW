<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Item Itemtype Controller
 */
class Item_locations extends BE_Controller {

	/**
	 * Construt required variables
	 */
	function __construct() {

		parent::__construct( MODULE_CONTROL, 'ITEM LOCATIONS' );
		$this->load->library('uploader');
		$this->load->library('csvimport');
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
		$conds['order_by'] = 1;
		$conds['order_by_field'] = "added_date";
		$conds['order_by_type'] = "desc";
		// get rows count
		$this->data['rows_count'] = $this->Itemlocation->count_all_by( $conds );
		
		// get Item locations
		$this->data['locations'] = $this->Itemlocation->get_all_by( $conds , $this->pag['per_page'], $this->uri->segment( 4 ) );
		// load index logic
		parent::index();
	}

	/**
	 * Searches for the first match.
	 */
	function search() {
		

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'location_search' );
		
		// condition with search term
		$conds = array( 'searchterm' => $this->searchterm_handler( $this->input->post( 'searchterm' )) );
		// no publish filter
		$conds['no_publish_filter'] = 1;
		$conds['order_by'] = 1;
		$conds['order_by_field'] = "added_date";
		$conds['order_by_type'] = "desc";


		// pagination
		$this->data['rows_count'] = $this->Itemlocation->count_all_by( $conds );

		// search data
		$this->data['locations'] = $this->Itemlocation->get_all_by( $conds, $this->pag['per_page'], $this->uri->segment( 4 ) );
		
		// load add list
		parent::search();
	}

	/**
	 * Create new one
	 */
	function add() {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'location_add' );

		// call the core add logic
		parent::add();
	}

	/**
	 * Update the existing one
	 */
	function edit( $id ) {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'location_edit' );

		// load user
		$this->data['location'] = $this->Itemlocation->get_one( $id );

		// call the parent edit logic
		parent::edit( $id );
	}

	/**
	 * Saving Logic
	 * 1) upload image
	 * 2) save Itemlocation
	 * 3) save image
	 * 4) check transaction status
	 *
	 * @param      boolean  $id  The user identifier
	 */
	function save( $id = false ) {
		// start the transaction
		$this->db->trans_start();
		
		/** 
		 * Insert Itemlocation Records 
		 */
		$data = array();

		// prepare name
		if ( $this->has_data( 'name' )) {
			$data['name'] = $this->get_data( 'name' );
		}

		// prepare ordering
		if ( $this->has_data( 'ordering' )) {
			$data['ordering'] = $this->get_data( 'ordering' );
		}

		// prepare lat
		if ( $this->has_data( 'lat' )) {
			$data['lat'] = $this->get_data( 'lat' );
		}

		// prepare lng
		if ( $this->has_data( 'lng' )) {
			$data['lng'] = $this->get_data( 'lng' );
		}

		$data['status'] = 1;

		// save Itemlocation
		if ( ! $this->Itemlocation->save( $data, $id )) {
		// if there is an error in inserting user data,	

			// rollback the transaction
			$this->db->trans_rollback();

			// set error message
			$this->data['error'] = get_msg( 'err_model' );
			
			return;
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
				
				$this->set_flash_msg( 'success', get_msg( 'success_location_edit' ));
			} else {
			// if user id is false, show success_edit message

				$this->set_flash_msg( 'success', get_msg( 'success_location_add' ));
			}
		}

		redirect( $this->module_site_url());
	}

	/**
	 * Delete the record
	 * 1) delete Itemtype
	 * 2) delete image from folder and table
	 * 3) check transactions
	 */
	function delete( $location_id ) {

		// start the transaction
		$this->db->trans_start();

		// check access
		$this->check_access( DEL );
		
		// delete location and images
		if ( !$this->ps_delete->delete_location( $location_id )) {

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
        	
			$this->set_flash_msg( 'success', get_msg( 'success_location_delete' ));
		}
		
		redirect( $this->module_site_url());
	}

	
	/**
	 * upload csv file
	 */
	function upload() {
		
		if ( $this->is_POST()) {
		
			$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
			
        	if(!empty($_FILES['file']['name']) && strtolower($extension) == "csv") {
				
        	 	$upload_data = $this->uploader->upload($_FILES);
				
				if (!isset($upload_data['error'])) {
					foreach ($upload_data as $upload) {
						
						$file_data = $this->upload->data();
		            	$file_path =  './uploads/'.$file_data['file_name'];

						// Open file in read mode
						$csvFile = fopen($_FILES['file']['tmp_name'], 'r');
						$data = fgetcsv($csvFile); // Skipping header row
						
		            	if ($this->csvimport->get_array($file_path)) {
							
			                $i = 0; $s = 0; $f=0; $fail_records = "";
			                while (($row = fgetcsv($csvFile)) !== FALSE) {
								
			                    if( $row[0] != '') {
			                     	//Get location name 
									$name =  ucwords(trim($row[0]));
									$ordering =  $row[1];
									$lat =  $row[2];
									$lng =  $row[3];
									$status =  $row[4];

									$data = array(
										'name'=> htmlspecialchars_decode($name),
										'ordering' => htmlspecialchars_decode($ordering),
										'lat' => htmlspecialchars_decode($lat),
										'lng' => htmlspecialchars_decode($lng),
										'status' => htmlspecialchars_decode($status) 
								   	);

									$conds['name'] = htmlspecialchars_decode($name);
									$conds['no_publish_filter'] = 1;
									$id=false;
									if( $this->Itemlocation->count_all_by($conds) > 0 ) {
										$f++; $i++;
										$fail_records .= " - <b>" . $row[0] . '</b> ' . get_msg( 'city_existed' ) . ", ";
										continue;
									}

									if($this->Itemlocation->save($data, $id = false)) {
											$s++;
									} else {
										$f++;
										$fail_records .= " - <b>" . $row[0] . '</b> ' . get_msg( 'because_db_err' ) . ", ";
									}
			               		}else {
									//location city Missing
									$f++;
									$fail_records .= " - <b>" . $row[0] . '</b> ' . get_msg( 'because_miss_city' ) . ", ";
								}
								
								$i++;
								
			            	}
							$result_str .= get_msg( 'total_city' ) . ' ' . $i . "<br>";
							$result_str .= get_msg( 'success_total_city' ) . ' ' . $s . "<br>";
							$result_str .= get_msg( 'fail_total_city' ) . ' ' . $f . " " . $fail_records;

							$this->data['message'] = $result_str;
							$this->set_flash_msg( 'success', $result_str);

							redirect( $this->module_site_url());

						}else {
			            	$this->set_flash_msg( 'error', get_msg( 'something_wrong_upload' ));
			            	redirect( $this->module_site_url());
			            }
					}
				}else {
					$this->set_flash_msg( 'error', $upload_data['error']);
					redirect( $this->module_site_url());
				}
			} else {
				$this->set_flash_msg( 'error',  get_msg( 'pls_upload_csv' ));
				redirect( $this->module_site_url());
			}
        }else{
			redirect( $this->module_site_url());
		}		
	}

	/**
	 * Determines if valid input.
	 *
	 * @return     boolean  True if valid input, False otherwise.
	 */
	function is_valid_input( $id = 0 ) {

		$rule = 'required|callback_is_valid_name['. $id  .']';

		$this->form_validation->set_rules( 'name', get_msg( 'type_name' ), $rule);

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

		 	if ( trim(strtolower( $this->Itemlocation->get_one( $id )->name ) ) == trim(strtolower( $name )) ) {
			// if the name is existing name for that user id,
				return true;
			} else if ( $this->Itemlocation->exists( ($conds ))) {
			// if the name is existed in the system,
				$this->form_validation->set_message('is_valid_name', get_msg( 'err_dup_name' ));
				return false;
			}
			return true;
	}

	/**
	 * Check location name via ajax
	 *
	 * @param      boolean  $cat_id  The cat identifier
	 */
	function ajx_exists( $id = false )
	{

		// get location name

		$name = $_REQUEST['name'];

		if ( $this->is_valid_name( $name, $id )) {

		// if the location name is valid,
			
			echo "true";
		} else {
		// if invalid location name,
			
			echo "false";
		}
	}
	/**
	 * Publish the record
	 *
	 * @param      integer  Itemlocation  The location identifier
	 */
	function ajx_publish( $id = 0 )
	{
		// check access
		$this->check_access( PUBLISH );
		
		// prepare data
		$type_data = array( 'status'=> 1 );
			
		// save data
		if ( $this->Itemlocation->save( $type_data, $id )) {
			echo 'true';
		} else {
			echo 'false';
		}
	}
	
	/**
	 * Unpublish the records
	 *
	 * @param      integer  Itemlocation  The Itemlocation identifier
	 */
	function ajx_unpublish( $id = 0 )
	{
		// check access
		$this->check_access( PUBLISH );
		
		// prepare data
		$type_data = array( 'status'=> 0 );
		// save data
		if ( $this->Itemlocation->save( $type_data, $id )) {
			echo 'true';
		} else {
			echo 'false';
		}
	}
}