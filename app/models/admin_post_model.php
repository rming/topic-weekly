<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_post_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	//为发布文章获取目录
	function get_topic_id_title(){
		$query="SELECT `id`, `title` FROM `topic` WHERE `status`='1' ORDER BY  `post_time` DESC ";
		$topic_title_id=$this->db->query($query);
		if (isset($topic_title_id)){
			$i=1;
			foreach ($topic_title_id->result() as $row)
				{
					$topic[$i] = array(
						'id' => $row->id,
						'title' =>$row->title,
					 );
					 $i++;

			}
		}
		if (isset($topic)){
			return $topic;
		}
	}
	
	//检查是否为重复发布
	function post_check(){
		$query="select * from `post` where title='".$_POST['title']."'";
		$post=$this->db->query($query);
		if (isset($post)){
			if ($post->num_rows()>0){
				return TRUE;
			}else {
				return FALSE;
			}
		}
	}
	
	
	function post_add($topicbanner,$status){
		$post = array(
			'tid' =>$_POST['tid'],
			'title' =>$_POST['title'],
			'topicbanner'=>$topicbanner,
			'description' => $_POST['description'],
			'status' =>$status,
			'post_time'=> date("Y-m-d G:i:s"),
			'name'=>$this->session->userdata['name'],
			'author'=>$this->session->userdata['realname'],
			'editor'=>$this->session->userdata['editname'],
			 );
		if ($this->db->insert('post', $post)){
			return TRUE;
		}else {
			return FALSE;
		}; 
	}
	function post_update($topicbanner){
		$post = array(
			'tid' =>$_POST['tid'],
			'title' =>$_POST['title'],
			'topicbanner'=>$topicbanner,
			'description' => $_POST['description'],
			'status' =>$_POST['status'],
			'post_time'=> $_POST['post_time'],
			'name'=>$_POST['name'],
			'author'=>$_POST['author'],
			'editor'=>$this->session->userdata['editname'],
			 );
		$this->db->where('id',$_POST['id']); 
		if ($this->db->update('post', $post)){
			return TRUE;
		}else {
			return FALSE;
		}; 
	}
	
	function get_by_status($status,$limit,$offset,$tid='all'){
		$this->db->order_by("post_time", "desc");
		if ($tid=='all'){
			$post_get = $this->db->get_where('post', array('status'=>$status), $limit, $offset);
		}else {
			$post_get = $this->db->get_where('post', array('status'=>$status,'tid'=>$tid), $limit, $offset);
		}
		if (isset($post_get)){
			$i=1;
			foreach ($post_get->result() as $row)
				{
					$post[$i] = array(
						'id' => $row->id,
						'tid' =>$row->tid,
						'title' =>$row->title,
						'topicbanner'=>$row->topicbanner,
						'description' => $row->description,
						'status' =>$row->status,
						'post_time'=>$row->post_time,
						'count'=>$row->count,
						'name'=>$row->name,
						'author'=>$row->author,
					 );
					 $i++;

			}
		}
		if (isset($post)){
			return $post;
		}
		
	}
	function get_by_id($topic_id){
		$post_get = $this->db->get_where('post', array('id'=>$topic_id));
		if (isset($post_get)){
			foreach ($post_get->result() as $row)
				{
					$post = array(
						'id' => $row->id,
						'tid' =>$row->tid,
						'title' =>$row->title,
						'topicbanner'=>$row->topicbanner,
						'description' => $row->description,
						'status' =>$row->status,
						'post_time'=>$row->post_time,
						'count'=>$row->count,
						'name'=>$row->name,
						'author'=>$row->author,
					 );

			}
		}
		if (isset($post)){
			return $post;
		}
	}
	function get_by_user($user,$table,$limit, $offset){
		$user=strtolower($user);
		$this->db->order_by("post_time", "desc");
		$post_get = $this->db->get_where($table, array('name'=>$user,'status'=>'1'), $limit, $offset);
		if (isset($post_get)){
			$i=1;
			foreach ($post_get->result() as $row)
				{
					$post[$i] = array(
						'id' => $row->id,
						'title' =>$row->title,
						'topicbanner'=>$row->topicbanner,
						'description' => $row->description,
						'status' =>$row->status,
						'post_time'=>$row->post_time,
						'count'=>$row->count,
						'name'=>$row->name,
						'author'=>$row->author,
					 );
					 $i++;

			}
		}
		if (isset($post)){
			return $post;
		}
	}
	
}
	

