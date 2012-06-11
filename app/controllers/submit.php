<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Submit extends  CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('news_model');
	}
	function index(){
		
		//获取话题目录并送往前台
		$topics = $this->news_model->get_topic_id_title();
		$data['topics']=$topics;
		
		//验证规则
		$this->form_validation->set_rules('title','文章标题','required');
		$this->form_validation->set_rules('tid','所属话题','required');
		$this->form_validation->set_rules('description', '文章内容','required');
		$this->form_validation->set_rules('author', '作者','required');
		$this->form_validation->set_rules('name', '联系方式','required');

		if ($this->form_validation->run()){
			if ($_POST['description']=="<p><br /></p>"||$_POST['description']==""){
				$data['error']="文章内容不能为空！";
			}else {
				//配置载入文件上传类
				$path='/uploads/images/t_images/';
				$config['upload_path'] = BASE_PATH.$path;
				$config['allowed_types'] ='gif|jpg|png|bmp';
				$config['max_size'] = '0';
				$config['max_width'] = '220';
				$config['max_height'] = '150';
				$config['file_name']=time().rand();
				$this->load->library('upload', $config);
				//上传
				$this->upload->do_upload('topicbanner');
				//获取上传结果
				$upload=$this->upload->data('topicbanner');
				//检查是否为重复发布
				if ($this->news_model->post_check()==TRUE){
					$data['error'] = "请勿重复投稿！";
				}else{
					//数据准备
					if ($upload['orig_name']==''){
						@$topicbanner='';
					}else {
						//数据准备
						$topicbanner = $path.$upload['orig_name'];
					}
					
					//数据库存储
					if ($this->news_model->post_add($topicbanner)){
						$data['error'] = "投稿成功！";
					}else {
						$data['error'] = "数据库操作失败！";
					};
				}
			}
		}
		//print_r($data['topics']);
		@$this->load->view('submit',$data);
			
	}
	
}