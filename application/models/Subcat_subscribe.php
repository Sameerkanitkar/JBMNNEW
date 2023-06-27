<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for touch table
 */
class Subcat_subscribe extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_subcat_subscribes', 'id', 'subcat_scr_' );
	}

	/**
	 * Implement the where clause
	 *
	 * @param      array  $conds  The conds
	 */
	function custom_conds( $conds = array())
	{
        // id condition
		if ( isset( $conds['id'] )) {
			$this->db->where( 'id', $conds['id'] );
		}

		// user_id condition
		if ( isset( $conds['user_id'] )) {
			$this->db->where( 'user_id', $conds['user_id'] );
		}

		// manufacturer_id condition
		if ( isset( $conds['manufacturer_id'] )) {
			$this->db->where( 'manufacturer_id', $conds['manufacturer_id'] );
		}

		// model_id condition
		if ( isset( $conds['model_id'] )) {
			$this->db->where( 'model_id', $conds['model_id'] );
		}

		// model_id_fe condition
		if ( isset( $conds['model_id_fe'] )) {
			$this->db->where( 'model_id', $conds['model_id_fe'] . '_FE' );
		}

		// model_id_mb condition
		if ( isset( $conds['model_id_mb'] )) {
			$this->db->where( 'model_id', $conds['model_id_mb'] . '_MB' );
		}

	}
}