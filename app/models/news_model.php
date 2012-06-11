<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	function get_by_topic($tid){
		$this->db->order_by("topicbanner", "desc");
		$this->db->order_by("post_time", "desc");
		$post_get = $this->db->get_where('post', array('tid'=>$tid,'status'=>'1'),6, 0);
		if (isset($post_get)){
			$i=1;
			foreach ($post_get->result() as $row)
				{
					$news[$i] = array(
						'id' => $row->id,
						'tid' => $row->tid,
						'title' =>$row->title,
						'topicbanner'=>$row->topicbanner,
						'description' => $row->description,
						'status'=>$row->status,
						'post_time' => $row->post_time ,
						'count'=>$row->count,
						'name'=>$row->name,
						'author'=>$row->author,
						'editor'=>$row->editor,
					 );
					 $i++;
			}
		}
		if (isset($news)){
			return $news;
		}
		
	}
	
 	function get_by_id($id){
		$post_get = $this->db->get_where('post', array('id'=>$id,'status'=>'1'),1, 0);
		if (isset($post_get)){
			foreach ($post_get->result() as $row)
				{
					$post = array(
						'id' => $row->id,
						'tid' => $row->tid,
						'title' =>$row->title,
						'topicbanner'=>$row->topicbanner,
						'description' => $row->description,
						'status'=>$row->status,
						'post_time' => $row->post_time ,
						'count'=>$row->count,
						'name'=>$row->name,
						'author'=>$row->author,
						'editor'=>$row->editor,
					 );
			}
		}
		if (isset($post)){
			return $post;
		}
		
	}
	//为发布文章获取目录
	function get_topic_id_title(){
		$query="SELECT `id`, `title` FROM `topic` WHERE `status`='0' ORDER BY  `post_time` DESC ";
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
	function post_add($topicbanner){
		$post = array(
			'tid' =>$_POST['tid'],
			'title' =>$_POST['title'],
			'topicbanner'=>$topicbanner,
			'description' => $_POST['description'],
			'status' =>'0',
			'post_time'=> date("Y-m-d G:i:s"),
			'name'=>$_POST['name'],
			'author'=>$_POST['author'],
			'editor'=>'',
			 );
		if ($this->db->insert('post', $post)){
			return TRUE;
		}else {
			return FALSE;
		}; 
	}
}
	

