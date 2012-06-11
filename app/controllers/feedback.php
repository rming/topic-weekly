<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Feedback extends  CI_Controller{
	function __construct(){
		parent::__construct();


	}
	function index(){
		
		@$this->load->view('feedback',$data);
	}
	
}