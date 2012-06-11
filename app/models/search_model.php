<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	function search($keyword,$limit,$offset) {
		//一共多少信息 分页用
		$countsql="SELECT COUNT(*) AS count from `topic` where  `title`  LIKE  '%".$keyword."%' OR `description`  LIKE  '%".$keyword."%' OR `comments`  LIKE  '%".$keyword."%'";
		$result=@mysql_fetch_array(mysql_query($countsql));
		$data['count']=$result['count'];
		//从话题信息中查找
		$sql="select * from `topic` where  `title`  LIKE  '%".$keyword."%' OR `description`  LIKE  '%".$keyword."%' OR `comments`  LIKE  '%".$keyword."%' LIMIT ".$offset." , ".$limit;
		$topic_get = $this->db->query($sql);
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
			 	if (!isset($topics)){
			 		$topics=array();
			 	}
			 	$topics=array_merge($topics,array($topic));
			 	
			}
		@$topics=$this->clearBlank($topics);
		if (!empty($topics)){
			$data['topics']= $topics;
			return $data;
		}else {
			return false;
		}
	}
	//去除数组中的空元素
	private function clearBlank($arr)
	{
	        function odd($var)
	        {
	               return($var<>'');
	        }
	        return @(array_filter($arr,"odd"));
	}
}
	

