<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search extends  CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('basic');
		$this->load->model('topic_model');
		$this->load->model('search_model');
	}
	function index(){
		if (isset($_GET['keyword'])&&!empty($_GET['keyword'])){
			$keyword = $_GET['keyword'];
		}else {
			redirect(site_url('recent'));
		}
		if (isset($_GET['page'])){
			$page=$_GET['page'];
		}else {
			$page="1";
		}
		$limit="7";
		$offset=7*($page-1);
		$search_result = $this->search_model->search($keyword,$limit,$offset);
		if ($search_result==false){
			$data['searcherror']="没有查询到相关话题。";
		}else {
			$data['topics']=$search_result['topics'];
		}
		//分页
		$count = $search_result['count'];
   		$config['page_url'] = site_url('search')."?keyword=".$keyword.'&page=';  
   		$config['page_size'] = 7 ;//每页几篇
		$config['rows_num'] = $count;  //一共多少文章
		$config['page_num'] = $page; //当前页页码
		$this->load->library('pagina');
		$this->pagina->init($config);  
		$data['page_nav']=$this->pagina->create_links();  
		//查询热点话题
		$limit = '5';
		$offset = '0';
		$data['topic_hot'] = $this->topic_model->get_by_count($limit,$offset);
		//送入视图
		@$this->load->view('search',$data);
	}
}