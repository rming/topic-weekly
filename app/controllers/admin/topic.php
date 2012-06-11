<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Topic extends  CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('admin_user_model');
		$this->load->model('admin_topic_model');
		$this->load->model('basic');
	}
	function index(){
		redirect(site_url('admin/pass'));
	}

	function add(){
		
		if (!$this->admin_user_model->is_admin_login()){
			$data = array(
   				'error_title' =>"登陆失效",
   				'error' =>"登陆失效，请重新登陆。",
   			);
   			$this->load->view('admin/admin_error',$data);
   			header("refresh:1;url=".site_url('admin/login'));
		}else {
			$this->form_validation->set_rules('title','话题标题','required');
			$this->form_validation->set_rules('votetitle','投票标题','required');
			$this->form_validation->set_rules('comments','编者按','required');
			$this->form_validation->set_rules('op1','选项①','');
			$this->form_validation->set_rules('op2','选项②','');
			$this->form_validation->set_rules('op3','选项③','');
			$this->form_validation->set_rules('description', '话题背景','required');
			if ($this->form_validation->run()){
				//配置载入文件上传类
				$path='/uploads/images/banner/';
				$config['upload_path'] = BASE_PATH.$path;
				$config['allowed_types'] = 'gif|jpg|png|bmp';
				$config['max_size'] = '0';
				$config['max_width'] = '300';
				$config['max_height'] = '240';
				$config['file_name']=time().rand();
				$this->load->library('upload', $config);
				//返回上传错误
				if(!$this->upload->do_upload('topicbanner')) {
	               $data['uploaderrors'] = $this->upload->display_errors();
				}
				//获取上传结果
				$upload=$this->upload->data('topicbanner');
				//检查是否为重复发布
				if ($this->admin_topic_model->topic_check()==TRUE){
					$data['error'] = "请勿重复添加！";
				}else{
					if ($upload['orig_name']==''){
						$data['error'] = "标题图片错误！";
					}else {
						//数据准备
						$topicbanner = $path.$upload['orig_name'];
						@$status = $_POST['status']=='on'?1:0;
						
						//数据库存储
						if ($this->admin_topic_model->topic_add($topicbanner,$status)){
							$data['error'] = "话题添加成功！";
						}else {
							$data['error'] = "数据库操作失败！";
						};
					}
				}
			}
			@$this->load->view('admin/admin_topic_add',$data);
		}
	}
	
	function check(){
		if (!$this->admin_user_model->is_admin_login()){
			$data = array(
   				'error_title' =>"登陆失效",
   				'error' =>"登陆失效，请重新登陆。",
   			);
   			$this->load->view('admin/admin_error',$data);
   			header("refresh:1;url=".site_url('admin/login'));
   			
		}else {
			
			//根据page参数设置获得页码
			$status='0';
			$page = $this->uri->segment(4, 1);
			$topic=$this->admin_topic_model->get_by_status($status,15,15*($page-1));
			//查询验证
			if (!isset($topic)){
				$data['error']="没有查询到相关数据。";
				$this->load->view('admin/admin_topic_check',$data);
			}else{
				//分页
				$sql="SELECT COUNT(*) AS count FROM topic WHERE status=0";
				$result=mysql_fetch_array(mysql_query($sql));
				$count=$result['count']; 
				$config['page_url'] = 'admin/topic/check';  
				$config['page_size'] = 15 ;//每页几篇
				$config['rows_num'] = $count;  //一共多少文章
				$config['page_num'] = $page; //当前页页码
				$this->load->library('custom_pagination');  
				$this->custom_pagination->init($config);  
				$data['page_nav']=$this->custom_pagination->create_links();
			 	//从数组中转成前台代码
				foreach ($topic as $row)
				{
					//截取指定长度字符串
					if (isset($row['title'])){
						if ($this->basic->Counti($row['title'])>12){
							$row['title']=$this->basic->utfSubstr($row['title'],0,30);
						}
					}
					
					if (isset($row['post_time'])){
						if ($this->basic->Counti($row['post_time'])>10){
							$row['post_time']=$this->basic->utfSubstr($row['post_time'],0,10);
						}
					}
					
					$str0="<tr height=\"26\" bgcolor=\"#f8f8f8\"> <td ><a href=\"".site_url('admin/topic/edit')."?id=".$row['id']."\"style=\"color:#333;\">".$row['title']."</a></td>";
					$str1="<td align=\"center\" >"."<div style=\"font-size:14px;\">".$row['post_time']."</div></td>";
					$str1_1="<td align=\"center\" >"."<div style=\"font-size:14px;\">".$row['count']."</div></td>";
					$str2="<td align=\"center\" >"."<div style=\"font-size:14px;\"><a href=".site_url('admin/user/member')."?name=".$row['author']." style=\"color: #555;\">".$row['author']."</a></div></td>";
					$str3="<td align=\"center\"><a href=\"".site_url('admin/topic/edit')."?id=".$row['id']."\"style=\"font-size:12px;color:#555;\">编辑</a></td>";
					$str4="<td align=\"center\"><a href=\"".site_url('admin/topic/del')."?id=".$row['id']."&redirect=".current_url()."\"style=\"font-size:12px;color:#555;\">删除</a></td></tr>";
					//得到前台代码
					@$str=$str.$str0.$str1.$str1_1.$str2.$str3.$str4;
					
				};					
			}
			//加载文章
			if (isset($str)){
				$data['topic']=$str;
				$this->load->view('admin/admin_topic_check',$data);
			}
		}
	}
	function pass(){
		
		if (!$this->admin_user_model->is_admin_login()){
			$data = array(
   				'error_title' =>"登陆失效",
   				'error' =>"登陆失效，请重新登陆。",
   			);
   			$this->load->view('admin/admin_error',$data);
   			header("refresh:1;url=".site_url('admin/login'));
   		
		}else {
			if (isset($_GET['order'])){
				if ($_GET['order']=='2'){
					$order='count';
				}else {
					$order='post_time';
				}
			}else {
				$order='post_time';
			}
			//根据page参数设置获得页码
			$status='1';
			$page = $this->uri->segment(4, 1);
			
			$topic=$this->admin_topic_model->get_by_status($status,15,15*($page-1),$order);
			//查询验证
			
			if (!isset($topic)){
				$data['error']="没有查询到相关数据。";
				$this->load->view('admin/admin_topic_pass',$data);
			}else{
				//分页
				$sql="SELECT COUNT(*) AS count FROM topic WHERE status=1";
				$result=mysql_fetch_array(mysql_query($sql));
				$count=$result['count']; 
				$config['page_url'] = 'admin/topic/check';  
				$config['page_size'] = 15 ;//每页几篇
				$config['rows_num'] = $count;  //一共多少文章
				$config['page_num'] = $page; //当前页页码
				$this->load->library('custom_pagination');  
				$this->custom_pagination->init($config);  
				$data['page_nav']=$this->custom_pagination->create_links();
			 	//从数组中转成前台代码
			 	
				foreach ($topic as $row)
				{
					//截取指定长度字符串
					if (isset($row['title'])){
						if ($this->basic->Counti($row['title'])>12){
							$row['title']=$this->basic->utfSubstr($row['title'],0,30);
						}
					}
					
					if (isset($row['post_time'])){
						if ($this->basic->Counti($row['post_time'])>10){
							$row['post_time']=$this->basic->utfSubstr($row['post_time'],0,10);
						}
					}
					
					$str0="<tr height=\"26\" bgcolor=\"#f8f8f8\"> <td ><a href=\"".site_url('admin/topic/edit')."?id=".$row['id']."\"style=\"color:#333;\">".$row['title']."</a></td>";
					$str1="<td align=\"center\" >"."<div style=\"font-size:14px;\">".$row['post_time']."</div></td>";
					$str1_1="<td align=\"center\" >"."<div style=\"font-size:14px;\">".$row['count']."</div></td>";
					$str2="<td align=\"center\" >"."<div style=\"font-size:14px;\"><a href=".site_url('admin/user/member')."?name=".$row['name']."&&type=0  style=\"color: #555;\">".$row['author']."</a></div></td>";
					$str3="<td align=\"center\"><a href=\"".site_url('admin/topic/edit')."?id=".$row['id']."\"style=\"font-size:12px;color:#555;\">编辑</a></td>";
					$str4="<td align=\"center\"><a href=\"".site_url('admin/topic/del')."?id=".$row['id']."&redirect=".current_url()."\"style=\"font-size:12px;color:#555;\">删除</a></td></tr>";
					//得到前台代码
					@$str=$str.$str0.$str1.$str1_1.$str2.$str3.$str4;
					
				};					
			}
			//加载文章
			if (isset($str)){
				$data['topic']=$str;
				$this->load->view('admin/admin_topic_pass',$data);
			}
		}
	}
	
	function edit(){
		if (!$this->admin_user_model->is_admin_login()){
			$data = array(
   				'error_title' =>"登陆失效",
   				'error' =>"登陆失效，请重新登陆。",
   			);
   			$this->load->view('admin/admin_error',$data);
   			header("refresh:1;url=".site_url('admin/login'));
   			
		}else {
			//获取编辑信息id
			if (isset($_GET['id'])){
					$topic_id=$_GET['id'];
				}
			if (isset($topic_id)){
				$topic=$this->admin_topic_model->get_by_id($topic_id);
			}
			if (!isset($topic)){ 
				$data = array(
	   			'error_title' =>"编辑错误",
	   			'error' =>"没有权限或话题不存在。",
	   			);
	   			$this->load->view('admin/admin_error',$data);
	   			header("refresh:1;url=".site_url('admin/home'));
			}else {
				//设置表单验证的规则
				$this->form_validation->set_rules('title','话题标题','required');
				$this->form_validation->set_rules('votetitle','投票标题','required');
				$this->form_validation->set_rules('comments','编者按','required');
				$this->form_validation->set_rules('op1','选项①','');
				$this->form_validation->set_rules('op2','选项②','');
				$this->form_validation->set_rules('op3','选项③','');
				$this->form_validation->set_rules('description', '话题背景','required');
				//表单数据验证
				if ($this->form_validation->run()){
					//判断是否需要更改文章发布时间
					//获取编辑状态
					if (@$_POST['status']=='on'){
						$_POST['status']='1';
					}else {
						$_POST['status']='0';
					}
					//判断之前状态
					if ($topic['status']!='1'){
						$_POST['post_time']=date("Y-m-d G:i:s");
					}else {
						$_POST['post_time']=$topic['post_time'];
					}
					//配置载入文件上传类
					$path='/uploads/images/banner/';
					$config['upload_path'] = BASE_PATH.$path;
					$config['allowed_types'] = 'gif|jpg|png|bmp';
					$config['max_size'] = '0';
					$config['max_width'] = '300';
					$config['max_height'] = '240';
					$config['file_name']=time();
					$this->load->library('upload', $config);
					//返回上传错误
					if(!$this->upload->do_upload('topicbanner')) {
		               $data['uploaderrors'] = $this->upload->display_errors();
					}
					//获取上传结果
					$upload=$this->upload->data('topicbanner');
					if ($upload['orig_name']==''){
						@$topicbanner=$_POST['oldtopicbanner'];
					}else {
						//数据准备
						$topicbanner = "http://".$_SERVER['SERVER_NAME'].$path.$upload['orig_name'];
					}
					//
					if ($topicbanner==''){
						$data['error']= "编辑失败，标题图片上传失败!";
					}else {
						
						$_POST['author']=$topic['author'];
						if($this->admin_topic_model->topic_update($topicbanner)){
							$data['error']= "编辑成功！";
						}else {
							$data['error']= "编辑失败，请重试。";
						}
					}
					
				}
				$editdata=$this->admin_topic_model->get_by_id($topic_id);
				if (isset($data)){
					$editdata['error']=$data['error'];
					if (empty($_POST['oldtopicbanner']))
					@$editdata['uploaderrors']=$data['uploaderrors'];
				}
				$this->load->view('admin/admin_topic_edit',$editdata);
			}
		}
	}
	function recycle(){
		if (!$this->admin_user_model->is_admin_login()){
			$data = array(
   				'error_title' =>"登陆失效",
   				'error' =>"登陆失效，请重新登陆。",
   			);
   			$this->load->view('admin/admin_error',$data);
   			header("refresh:1;url=".site_url('admin/login'));
   		
		}else {
			if (isset($_GET['clean'])){
				if ($_GET['clean']=='1'){
					$this->db->delete('topic', array('status' =>'2')); 
				}
			}
			
			//根据page参数设置获得页码
			$status='2';
			$page = $this->uri->segment(4, 1);
			
			$topic=$this->admin_topic_model->get_by_status($status,15,15*($page-1));
			//查询验证
			
			if (!isset($topic)){
				$data['error']="没有查询到相关数据。";
				$this->load->view('admin/admin_topic_recycle',$data);
			}else{
				//分页
				$sql="SELECT COUNT(*) AS count FROM topic WHERE status=2";
				$result=mysql_fetch_array(mysql_query($sql));
				$count=$result['count']; 
				$config['page_url'] = 'admin/topic/check';  
				$config['page_size'] = 15 ;//每页几篇
				$config['rows_num'] = $count;  //一共多少文章
				$config['page_num'] = $page; //当前页页码
				$this->load->library('custom_pagination');  
				$this->custom_pagination->init($config);  
				$data['page_nav']=$this->custom_pagination->create_links();
			 	//从数组中转成前台代码
			 	
				foreach ($topic as $row)
				{
					//截取指定长度字符串
					if (isset($row['title'])){
						if ($this->basic->Counti($row['title'])>12){
							$row['title']=$this->basic->utfSubstr($row['title'],0,30);
						}
					}
					
					if (isset($row['post_time'])){
						if ($this->basic->Counti($row['post_time'])>10){
							$row['post_time']=$this->basic->utfSubstr($row['post_time'],0,10);
						}
					}
					
					$str0="<tr height=\"26\" bgcolor=\"#f8f8f8\"> <td ><a href=\"".site_url('admin/topic/edit')."?id=".$row['id']."\"style=\"color:#333;\">".$row['title']."</a></td>";
					$str1="<td align=\"center\" >"."<div style=\"font-size:14px;\">".$row['post_time']."</div></td>";
					$str1_1="<td align=\"center\" >"."<div style=\"font-size:14px;\">".$row['count']."</div></td>";
					$str2="<td align=\"center\" >"."<div style=\"font-size:14px;\"><a href=".site_url('admin/user/member')."?name=".$row['author'].">".$row['author']."</a></div></td>";
					$str3="<td align=\"center\"><a href=\"".site_url('admin/topic/edit')."?id=".$row['id']."\"style=\"font-size:12px;color:#555;\">编辑</a></td>";
					$str4="<td align=\"center\"><a href=\"".site_url('admin/topic/del')."?id=".$row['id']."&mod=1&redirect=".current_url()."\"style=\"font-size:12px;color:#555;\">彻底删除</a></td></tr>";
					//得到前台代码
					@$str=$str.$str0.$str1.$str1_1.$str2.$str3.$str4;
				};					
			}
			//加载文章
			if (isset($str)){
				$data['topic']=$str;
				$this->load->view('admin/admin_topic_recycle',$data);
			}
		}
	}
	function del(){
		if (!$this->admin_user_model->is_admin_login()){
			$data = array(
   				'error_title' =>"登陆失效",
   				'error' =>"登陆失效，请重新登陆。",
   			);
   			$this->load->view('admin/admin_error',$data);
   			header("refresh:1;url=".site_url('admin/login'));
   			
		}else {
			@$topic_id=$_GET['id'];
			@$redirect=$_GET['redirect'];
			@$mod=$_GET['mod'];
			if (isset($topic_id)){
			$topic_get=$this->admin_topic_model->get_by_id($topic_id);
			}
			if (isset($topic_get)){
				if ($mod=='1'){
					$result=$this->db->delete('topic', array('id' => $topic_id));	
				}else {
					$data['status']='2';
					$result=$this->db->update('topic',$data, array('id' => $topic_id));	
				}
				if ($redirect!=null){
					header("refresh:1;url=".$redirect);
				}else {
					header("refresh:1;url=".site_url('admin/topic/pass'));
				}
				$data['error']="删除成功！正在返回……<br>";
				$this->load->view('admin/admin_error',$data);
			}else {
				if ($redirect!=null){
					header("refresh:1;url=".$redirect);
				}else {
					header("refresh:1;url=".site_url('admin/topic/pass'));
				}
				$data['error']="没有权限或信息不存在！<br>";
				$this->load->view('admin/admin_error',$data);
			}
		}
	}
}