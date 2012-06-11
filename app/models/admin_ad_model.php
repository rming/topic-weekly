<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_ad_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	function ad_add($banner){
		$ad = array(
			'link' =>$_POST['link'],
			'banner'=>$banner,
			'post_time'=> date("Y-m-d G:i:s"),
			'name'=>$this->session->userdata['name'],
			'author'=>$this->session->userdata['realname'],
			'editor'=>$this->session->userdata['editname'],
			 );
		if ($this->db->insert('ad', $ad)){
			return TRUE;
		}else {
			return FALSE;
		}; 
	}

	function get_all(){
		$ad_get = $this->db->get('ad', 15, 0);
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

	function get_by_id($ad_id){
		$ad_get = $this->db->get_where('ad', array('id'=>$ad_id));
		if (isset($ad_get)){
			foreach ($ad_get->result() as $row)
				{
					$ad = array(
						'id' => $row->id,
						'link' =>$row->link,
						'banner'=>$row->banner,
						'post_time'=>$row->post_time,
						'count'=>$row->count,
						'name'=>$row->name,
						'author'=>$row->author,
						'editor'=>$row->editor,
					 );

			}
		}
		if (isset($ad)){
			return $ad;
		}
	}

}