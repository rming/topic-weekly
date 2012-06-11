<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Recent extends  CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('basic');
		$this->load->model('topic_model');
	}
	function index(){
		//分页
		$page=$this->uri->segment('2','1');
		$sql="SELECT COUNT(*) AS count FROM topic WHERE status=1";
		$result=@mysql_fetch_array(mysql_query($sql));
		$count=$result['count']; 
		$config['page_url'] = 'recent';  
		$config['page_size'] = 7 ;//每页几篇
		$config['rows_num'] = $count;  //一共多少文章
		$config['page_num'] = $page; //当前页页码
		$this->load->library('custom_pagination');  
		$this->custom_pagination->init($config);  
		$data['page_nav']=$this->custom_pagination->create_links();
		//查询往期话题
		$data['topics']=$this->topic_model->get_by_order(7,($page-1)*7);
		//查询热点话题
		$limit = '5';
		$offset = '0';
		$data['topic_hot'] = $this->topic_model->get_by_count($limit,$offset);
		//载入view
		@$this->load->view('recent',$data);
	}
	
}