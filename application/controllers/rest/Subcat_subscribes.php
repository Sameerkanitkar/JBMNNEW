<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for Favourites
 */
class Subcat_subscribes extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		// call the parent
		parent::__construct( 'Subcat_subscribe' );
	}

    /**
     * Subcategory subscribe
     */
    function subcategory_subscribe_post(){
        
        // validation rules for chat history
		$rules = array(
			array(
	        	'field' => 'user_id',
	        	'rules' => 'required|callback_id_check[User]'
            ),
            array(
	        	'field' => 'manufacturer_id',
	        	'rules' => 'required|callback_id_check[Manufacturer]'
	        )
        );
        
        $model_ids = $this->post('model_ids');

        // exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;

        foreach($model_ids as $model_id){
            $data = array(
                'user_id' => $this->post('user_id'),
                'manufacturer_id' => $this->post('manufacturer_id'),
                'model_id' => $model_id
            );
            
            if(!$this->Subcat_subscribe->exists($data)){
                // model subscribe
                if(!$this->Subcat_subscribe->save($data)){
                    $this->error_response( get_msg( 'err_subcat_subscribe_save' ), 500);
                }
            }else{
                // model unsubscribe
                if(!$this->Subcat_subscribe->delete_by($data)){
                    $this->error_response( get_msg( 'err_subcat_subscribe_delete' ), 500);
                }
            }            
            
        }
        $this->success_response( get_msg( 'success_subcat_subscribe' ), 201);
    }

}