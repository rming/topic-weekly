<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ad extends  CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('basic');
		$this->load->model('admin_user_model');
		$this->load->model('admin_ad_model');
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
			$this->form_validation->set_rules('link','link','');
			if ($this->form_validation->run()){
				//配置载入文件上传类
				$path='/uploads/images/banner_index/';
				$config['upload_path'] = BASE_PATH.$path;
				$config['allowed_types'] = 'gif|jpg|png|bmp';
				$config['max_size'] = '0';
				$config['max_width'] = '672';
				$config['max_height'] = '102';
				$config['file_name']=time().rand();
				$this->load->library('upload', $config);
				//返回上传错误
				if(!$this->upload->do_upload('banner')) {
	               $data['uploaderrors'] = $this->upload->display_errors();
				}
				//获取上传结果
				$upload=$this->upload->data('banner');
				if ($upload['orig_name']==''){
					$data['error'] = "广告图片错误！";
				}else {
					//数据准备
					$banner = $path.$upload['orig_name'];
					//数据库存储
					if ($this->admin_ad_model->ad_add($banner)){
						$data['error'] = "添加成功，正在跳转……";
						header("refresh:1;url=".site_url('admin/ad/pass'));
					}else {
						$data['error'] = "数据库操作失败！";
					};
				}
			}
			@$this->load->view('admin/admin_ad_add',$data);
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
				$ad=$this->admin_ad_model->get_all();
				//查询验证
				if (!isset($ad)){
					$data['error']="没有查询到相关数据。";
					$this->load->view('admin/admin_ad_pass',$data);
				}else{
				 	//从数组中转成前台代码
					foreach ($ad as $row)
					{
					//截取指定长度字符串
					if (isset($row['post_time'])){
						if ($this->basic->Counti($row['post_time'])>10){
							$row['post_time']=$this->basic->utfSubstr($row['post_time'],0,10);
						}
					}
					$str0="<tr height=\"26\" bgcolor=\"#f8f8f8\"> <td ><a href=\"".$row['banner']."\" rel=\"lightbox\" ><img src=\"".$row['banner']."\" width=\"250\" height=\"37\" style=\"border:1px solid #d1d1d1;\">"."</a></td>";
					$str1="<td align=\"center\" >"."<input value=\"".$row['link']."\" style=\"font-size:14px;\" readonly   ></td>";
					$str2="<td align=\"center\" >"."<div style=\"font-size:14px;\">".$row['count']."</div></td>";
					$str3="<td align=\"center\" >"."<div style=\"font-size:14px;\"><a href=".site_url('admin/user/member')."?name=".$row['name']." style=\"color: #555;\">".$row['author']."</a></div></td>";
					$str4="<td align=\"center\"><a href=\"".site_url('admin/ad/del')."?id=".$row['id']."&redirect=".current_url()."\"style=\"font-size:12px;color:#555;\">删除</a></td></tr>";
					//得到前台代码
					@$str=$str.$str0.$str1.$str2.$str3.$str4;
					
				};					
			}
			//加载文章
			if (isset($str)){
				$data['ad']=$str;
				$this->load->view('admin/admin_ad_pass',$data);
			}
		}
	}
	//
	function del(){
		if (!$this->admin_user_model->is_admin_login()){
			$data = array(
   				'error_title' =>"登陆失效",
   				'error' =>"登陆失效，请重新登陆。",
   			);
   			$this->load->view('admin/admin_error',$data);
   			header("refresh:1;url=".site_url('admin/login'));
   			
		}else {
			@$ad_id=$_GET['id'];
			@$redirect=$_GET['redirect'];
			if (isset($ad_id)){
			$ad_get=$this->admin_ad_model->get_by_id($ad_id);
			}
			if (isset($ad_get)){
					$result=$this->db->delete('ad', array('id' => $ad_id));	
				if ($redirect!=null){
					header("refresh:1;url=".$redirect);
				}else {
					header("refresh:1;url=".site_url('admin/ad/pass'));
				}
				$data['error']="删除成功！正在返回……<br>";
				$this->load->view('admin/admin_error',$data);
			}else {
				if ($redirect!=null){
					header("refresh:1;url=".$redirect);
				}else {
					header("refresh:1;url=".site_url('admin/ad/pass'));
				}
				$data['error']="没有权限或信息不存在！<br>";
				$this->load->view('admin/admin_error',$data);
			}
		}
	}
   
}