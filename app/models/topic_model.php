<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Topic_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	function get_by_id($id){
		$topic_get = $this->db->get_where('topic', array('id'=>$id),1, 0);
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
						'name'=>$row->name,
						'author'=>$row->author,
						'editor'=>$row->editor,
					 );
			}
		}
		if (isset($topic)){
			return $topic;
		}
		
	}
	function get_by_order($limit,$offset,$order='post_time'){
		if ($order=='post_time'){
			$this->db->order_by("post_time", "desc");
		}else {
			$this->db->order_by("count", "desc");
		}
		$topic_get = $this->db->get_where('topic', array('status'=>'1'), $limit, $offset);
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
						'author'=>$row->author,
						'editor'=>$row->editor,
					 );
					 $i++;
			}
		}
		if (isset($topic)){
			return $topic;
		}
		
	}
	
	function get_banner($limit,$offset){
		$ad_get = $this->db->get('ad', $limit, $offset);
		if (isset($ad_get)){
			$i=1;
			foreach ($ad_get->result() as $row)
				{
					$ad[$i] = array(
						'id' => $row->id,
						'link' =>$row->link,
						'banner'=>$row->banner,
						'post_time'=>$row->post_time,
						'count'=>$row->count,
						'name'=>$row->name,
						'author'=>$row->author,
						'editor'=>$row->editor,
					 );
					 $i++;
			}
		}
		if (isset($ad)){
			return $ad;
		}
	}
	function get_by_count($limit,$offset){
		$this->db->order_by("count", "desc");
		$topic_get = $this->db->get_where('topic', array('status'=>'1'), $limit, $offset);
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
						'author'=>$row->author,
					 );
					 $i++;
			}
		}
		if (isset($topic)){
			return $topic;
		}
		
	}
}
	

