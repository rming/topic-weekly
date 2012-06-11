<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_topic_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	function topic_check(){
		$query="select * from `topic` where title='".$_POST['title']."'";
		$topic=$this->db->query($query);
		if (isset($topic)){
			if ($topic->num_rows()>0){
				return TRUE;
			}else {
				return FALSE;
			}
		}
	}
	function topic_add($topicbanner,$status){
		$topic = array(
			'title' =>$_POST['title'],
			'topicbanner'=>$topicbanner,
			'description' => $_POST['description'],
			'comments'=>$_POST['comments'],
			'votetitle' =>  $_POST['votetitle'],
			'op1' => $_POST['op1'],
			'op2' => $_POST['op2'],
			'op3' => $_POST['op3'],
			'status' =>$status,
			'post_time'=> date("Y-m-d G:i:s"),
			'name'=>$this->session->userdata['name'],
			'author'=>$this->session->userdata['realname'],
			'editor'=>$this->session->userdata['editname'],
			 );
		if ($this->db->insert('topic', $topic)){
			return TRUE;
		}else {
			return FALSE;
		}; 
	}
	function topic_update($topicbanner){
		$topic = array(
			'title' =>$_POST['title'],
			'topicbanner'=>$topicbanner,
			'description' => $_POST['description'],
			'comments'=>$_POST['comments'],
			'votetitle' =>  $_POST['votetitle'],
			'op1' => $_POST['op1'],
			'op2' => $_POST['op2'],
			'op3' => $_POST['op3'],
			'status' =>$_POST['status'],
			'post_time'=>$_POST['post_time'],
			'author'=>$_POST['author'],
			'editor'=>$this->session->userdata['editname'],
			 );
		$this->db->where('id',$_POST['id']); 
		if ($this->db->update('topic', $topic)){
			return TRUE;
		}else {
			return FALSE;
		}; 
	}
	
	function get_by_status($status,$limit,$offset,$order='post_time'){
		if ($order=='post_time'){
			$this->db->order_by("post_time", "desc");
		}else {
			$this->db->order_by("count", "desc");
		}
		$topic_get = $this->db->get_where('topic', array('status'=>$status), $limit, $offset);
		if (isset($topic_get)){
			$i=1;
			foreach ($topic_get->result() as $row)
				{
					$topic[$i] = array(
						'id' => $row->id,
						'title' =>$row->title,
						'topicbanner'=>$row->topicbanner,
						'description' => $row->description,
						'comments'=>$row->comments,
						'votetitle' => $row->votetitle ,
						'op1' =>$row->op1 ,
						'op2' =>$row->op2 ,
						'op3' =>$row->op3 ,
						'status' =>$row->status,
						'post_time'=>$row->post_time,
						'count'=>$row->count,
						'name'=>$row->name,
						'editor'=>$row->editor,
						'author'=>$row->author,
					 );
					 $i++;

			}
		}
		if (isset($topic)){
			return $topic;
		}
		
	}
	function get_by_id($topic_id){
		$topic_get = $this->db->get_where('topic', array('id'=>$topic_id));
		if (isset($topic_get)){
			foreach ($topic_get->result() as $row)
				{
					$topic = array(
						'id' => $row->id,
						'title' =>$row->title,
						'topicbanner'=>$row->topicbanner,
						'description' => $row->description,
						'comments'=>$row->comments,
						'votetitle' => $row->votetitle ,
						'op1' =>$row->op1 ,
						'op2' =>$row->op2 ,
						'op3' =>$row->op3 ,
						'status' =>$row->status,
						'post_time'=>$row->post_time,
						'count'=>$row->count,
						'author'=>$row->author,
					 );

			}
		}
		if (isset($topic)){
			return $topic;
		}
	}
}
	

