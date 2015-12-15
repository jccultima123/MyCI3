<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    function __construct()
    {
      // Call the Model constructor
      parent::__construct();
    }
    
    function login($username, $password)
    {
    	//login db function here
    	if (!isset($username) && !isset($password)) {
    		$error = "Required Fields are empty!";
    		return false;
    	} else {
    		$user_query = $this->db
                  			->select('*')
                  			->where('username', $username)
			                 	->get('users')
			                 	->row_array();
			   
			  if ($user_query != 1) {
			  	return false;
			  } else {
			  	/* Encrypting password using sha1 algorithm
	    		 * You may also use md5 if you want
	    		 */
	    		$hash = sha1($password);
	    		$password_query = $this->db
	                  					->select('*')
	                  					->where('user_password', $hash)
					                 		->get('users')
					                 		->result();
	        if ($hash == $password_query->user_password) {
	        	
	        	return true;
	        }
			  }
    	}
    }
    
    function logout($session)
    {
    	//logout using sesssion unset
    }

}