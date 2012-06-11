<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Record extends  CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function index(){
		if (isset($_GET['id'])){
			$fileid=$_GET['id'];
			$file = BASE_PATH."uploads/record/".$fileid.".mp3";// 文件的真实地址（支持url,不过不建议用url）
			if (file_exists($file)) {   
			    header('Content-Description: File Transfer');   
			    header('Content-Type: application/octet-stream');   
			    header('Content-Disposition: attachment; filename='.basename($file));   
			    header('Content-Transfer-Encoding: binary');   
			    header('Expires: 0');   
			    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');   
			    header('Pragma: public');   
			    header('Content-Length:'. filesize($file));   
			    ob_clean();   
			    flush();   
			    readfile($file);   
			    exit;   
			}   
		}else {
			echo "false";
		}
	}

}


