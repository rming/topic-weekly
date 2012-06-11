<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index extends  CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('basic');
		$this->load->model('topic_model');
	}
	function index(){
		/*
		echo dirname(dirname(dirname(__file__)));
		echo BASE_PATH;
		echo $this->config->item('db_name');
		*/
		/*
		$user_url = $this->basic->user_url();
		if ($user_url=='topic'){
			echo "ssss";
			$this->load->view('index');
		}else {
			echo $user_url;
		}
		*/
		//获取话题列表并送往view
		$limit = '15';
		$offset = '0';
		$order = 'post_time';
		$topics = $this->topic_model->get_by_order($limit,$offset,$order);
		$data['topics'] = $topics;
		//获取banner图片送往view
		$limit = '5';
		$offset = '0';
		$banner = $this->topic_model->get_banner($limit,$offset);
		$data['banner'] = $banner;
		//获取topic_hot送往view
		$limit = '5';
		$offset = '0';
		$topic_hot = $this->topic_model->get_by_count($limit,$offset);
		$data['topic_hot'] = $topic_hot;
		$this->load->view('index',$data);
	}
	
}