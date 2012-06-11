<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Topic extends  CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('basic');
		$this->load->model('topic_model');
		$this->load->model('news_model');
	}
	function content(){
		$topic_id=$this->uri->segment('1','1');
		//判断是否存在录音文件
		$file = BASE_PATH."uploads/record/".$topic_id.".mp3";// 文件的真实地址（支持url,不过不建议用url）
		if (file_exists($file)) {
			$data['record']=TRUE;
		}else {
			$data['record']=FALSE;
		}
		//echo $topic_id."<br>";
		//计数
		$data['topic']=$this->topic_model->get_by_id($topic_id);
		$data['topic']['count']=$data['topic']['count']+1;
		$this->db->where('id', $topic_id);
		$this->db->update('topic',array('count'=>$data['topic']['count']));
		//
		$data['news']=$this->news_model->get_by_topic($topic_id);
		//print_r($data['news']);
		$data['topics']=$this->topic_model->get_by_order(6,0);
		@$this->load->view('topic',$data);
	}
	
}