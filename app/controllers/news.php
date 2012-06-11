<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News extends  CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('basic');
		$this->load->model('topic_model');
		$this->load->model('news_model');
	}
	function index(){
		redirect(site_url('recent'));
	}
	function content(){
		//获取post包含tid并计数
		$news_id=$this->uri->segment('2','1');
		$data['news']=$this->news_model->get_by_id($news_id);
		$data['news']['count']=$data['news']['count']+1;
		$this->db->where('id', $news_id);
		$this->db->update('post',array('count'=>$data['news']['count']));
		
		//获取topic并计数
		$topic_id=$data['news']['tid'];
		$data['topic']=$this->topic_model->get_by_id($topic_id);
		$data['topic']['count']=$data['topic']['count']+1;
		$this->db->where('id', $topic_id);
		$this->db->update('topic',array('count'=>$data['topic']['count']));
		//送入视图
		@$this->load->view('news',$data);
	}
	
}