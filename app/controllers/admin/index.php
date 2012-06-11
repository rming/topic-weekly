<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index extends  CI_Controller{
	function __construct(){
		parent::__construct();
		
	}
	//文章列表功能
   	function index(){
   		/*
   		//定时任务//定时清理回收站
   		  set_time_limit(0);   
		  ignore_user_abort(true);   
		　$i=1;
		  while($i){   
		 	sleep(604800);   
		  }   
		  exit; 
		  */  
   		redirect(site_url('admin/login'));
	}


}