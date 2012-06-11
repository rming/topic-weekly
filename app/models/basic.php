<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Basic extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	/*
	//获取地址前缀
	public function user_url()
	{
		$host = $_SERVER['HTTP_HOST'];
		$user_url = substr($host, 0, strpos($host, '.'));
		return $user_url;
	}
	function now(){
		return  date("Y-m-d G:i:s",time()+8*3600);
	}
	public  function get_time($time) {
	    $ntime=time()- strtotime($time);
	    if ($ntime<60) {
	        return("刚才");
	    } elseif ($ntime<3600) {
	        return(intval($ntime/60)."分钟前");
	    } elseif ($ntime<3600*24) {
	        return(intval($ntime/3600)."小时前");
	    } else {
	        return(gmdate('Y-m-d H:i',$time));
    	}         
	}
	*/
	//html占位计算
	function countstr($str){
		preg_match_all("/[0-9]{1}/",$str,$arrNum);
		preg_match_all("/[a-zA-Z]{1}/",$str,$arrAl);
		preg_match_all("/([\x{4e00}-\x{9fa5}]){1}/u",$str,$arrCh);
		
		$num=count($arrNum[0])+count($arrAl[0])+2*count($arrCh[0]);
		return $num;
	}
	public function Counti($string){
		$ch_amont = 0;
		$en_amont = 0;
		$string = preg_replace("/(　| ){1,}/", " ", $string);
		for($i=0;$i<strlen($string);$i++)
		{
			$ord = ord($string{$i});    
			if($ord > 128)
				$ch_amont++;
			else
				$en_amont++;
		}
		return ($ch_amont/3) + $en_amont;
	}
	/********************************** 
	  * 截取字符串(UTF-8)
	  *
	  * @param string $str 原始字符串
	  * @param $position 开始截取位置
	  * @param $length 需要截取的偏移量
	  * @return string 截取的字符串
	  * $type=1 等于1时末尾加'...'不然不加
	 *********************************/ 
	 function utfSubstr($str, $position, $length,$type=1){
	  $startPos = strlen($str);
	  $startByte = 0;
	  $endPos = strlen($str);
	  $count = 0;
	  for($i=0; $i<strlen($str); $i++){
	   if($count>=$position && $startPos>$i){
	    $startPos = $i;
	    $startByte = $count;
	   }
	   if(($count-$startByte) >= $length) {
	    $endPos = $i;
	    break;
	   }    
	   $value = ord($str[$i]);
	   if($value > 127){
	    $count++;
	    if($value>=192 && $value<=223) $i++;
	    elseif($value>=224 && $value<=239) $i = $i + 2;
	    elseif($value>=240 && $value<=247) $i = $i + 3;
	    else return self::raiseError("\"$str\" Not a UTF-8 compatible string", 0, __CLASS__, __METHOD__, __FILE__, __LINE__);
	   }
	   $count++;
	
	  }
	  if($type==1 && ($endPos-6)>$length){
	   return substr($str, $startPos, $endPos-$startPos)."…"; 
	       }else{
	   return substr($str, $startPos, $endPos-$startPos);     
	    }
	  
	 }
	Function ClearHtml($content) {  
		$content = preg_replace("/<span[^>]*>/i", "", $content);  
	   $content = preg_replace("/<\/span>/i", "", $content); 
		$content = preg_replace("/<img[^>]*>/i", "", $content);  
	   $content = preg_replace("/<\/img>/i", "", $content);   
	   $content = preg_replace("/<a[^>]*>/i", "", $content);  
	   $content = preg_replace("/<\/a>/i", "", $content);   
	   $content = preg_replace("/<div[^>]*>/i", "", $content);  
	   $content = preg_replace("/<\/div>/i", "", $content);      
	   $content = preg_replace("/<!--[^>]*-->/i", "", $content);//注释内容  
	   $content = preg_replace("/style=.+?['|\"]/i",'',$content);//去除样式  
	   $content = preg_replace("/class=.+?['|\"]/i",'',$content);//去除样式  
	   $content = preg_replace("/id=.+?['|\"]/i",'',$content);//去除样式     
	   $content = preg_replace("/lang=.+?['|\"]/i",'',$content);//去除样式      
	   $content = preg_replace("/width=.+?['|\"]/i",'',$content);//去除样式   
	   $content = preg_replace("/height=.+?['|\"]/i",'',$content);//去除样式   
	   $content = preg_replace("/border=.+?['|\"]/i",'',$content);//去除样式   
	   $content = preg_replace("/face=.+?['|\"]/i",'',$content);//去除样式   
	   $content = preg_replace("/face=.+?['|\"]/",'',$content);//去除样式 只允许小写 正则匹配没有带 i 参数
	   return $content;
	}
}

