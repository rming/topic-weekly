<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>每周话题，做你身边最真实的讨论。</title>
<link href="<?php echo site_url()?>theme/style/css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo site_url()?>theme/style/div.css" rel="stylesheet" type="text/css" />
<script src="<?php echo site_url()?>public/flash/swfobject.js" type="text/javascript"></script>
<script type="text/javascript">
function search1()
{
    var url1=document.getElementById("searchtext").value;
    if(url1.length == 0)
    {alert("请输入搜索内容！");
        return(false); }  
    else
        window.open("<?php echo site_url('search');?>?keyword="+url1);
}
</script>
</head>

<body>
	<div id="topup">
	  <div id="top">
        <a href="<?php echo  site_url();?>" ><img src="<?php echo site_url()?>theme/images/logo.gif" width="267" height="75" alt="logo" /></a>
        <div id="top_txt">每周话题，做你身边最真实的讨论。</div>
      </div>
    </div>
    <div id="navi">	    
        <div id="nav">
          <ul>
            <li class="nav_li_hover"><a href="<?php echo  site_url();?>">首页</a></li>
            <li><a href="<?php echo  site_url('recent');?>">往期题话</a></li>
            <li><a href="<?php echo site_url('prize') ;?>">参与有奖</a></li>
           
            <li><a href="<?php echo site_url('submit');?>">话题投稿</a></li>
            <li><a href="<?php echo site_url('feedback');?>">意见反馈</a></li>
          </ul>
        </div>
    </div>
    </div>
	<div id="container">	 
      <div id="main">
        <div id="main_top">
          <div id="title_bar">
            <div id="latest_topic">
              <div id="square"></div>
              <a   href="<?php echo site_url('recent');?>" class="latest_topic_link">最近话题</a>
            </div>
          </div>
          
              <?php $i=1; foreach ($topics As $row){?>
             <?php  
             	$row['or_title']=$row['title'];
             	if ($this->basic->countstr($row['title'])>36)
             			{
             				$row['title']=$this->basic->utfSubstr($row['title'],0,40);
             			}
              	if ($this->basic->countstr($row['title'])>18)
             			{
             				$row['l_title']=$this->basic->utfSubstr($row['title'],0,18);
             			}else {
             				$row['l_title']=$row['title'];
             			}
             	$row['description']=strip_tags($row['description']);
              	if ($this->basic->countstr($row['description'])>210)
             			{
             				$row['description']=$this->basic->utfSubstr($row['description'],0,234);
             			}
             	?>
              <div class="content">
              <div class="content_img">
               <a href="<?php echo @site_url($row['id']);?>" target="_blank" ><img src="<?php echo @$row['topicbanner']?>" width="173" height="119" alt="<?php echo @$row['or_title']?>"  style="border:1px #E0E0E0 solid;"/></a>
                <div class="img_txt"><a href="<?php echo @site_url($row['id']);?>" target="_blank" class="img_txt_link"><?php echo @$row['l_title']?></a></div>
              </div>
              <div class="date"><?php echo @date('Y/m/d',strtotime($row['post_time']));?></div>
              <div class="title"><a href="<?php echo @site_url($row['id']);?>" target="_blank" class="content_link"><?php echo @$row['title']?></a></div>
              <div class="contents"><p style="word-wrap: break-word; word-break: normal;"><?php echo @$row['description']?><a href="<?php echo @site_url($row['id']);?>"  target="_blank">>>详细</a></p></div>
	           <hr size="1" noshade="noshade"/>
            </div>
             <?php $i++;if ($i==4){break;}?>
            <?php }?>
        </div>
        <div id="banner">
			<SCRIPT type="text/javascript">
				var xmlData="<list><?php if (isset($banner)){?><?php foreach ($banner as $row){echo "<item><img>".$row['banner']."</img><url>".$row['link']."</url></item>";}}?></list>";
				var flashvars = {xmlData:xmlData};
				var params = {menu:false,wmode:"opaque"};
				var attributes = {};
				swfobject.embedSWF("<?php echo site_url();?>public/flash/flash.swf", "banner", "670", "100", "9","expressInstall.swf", flashvars, params, attributes);
			</SCRIPT>
				
        </div>
        <!--往期话题-->
        <div id="main_bottom">
          <div id="lated_bar">
            <div id="lated_img">
              <img src="<?php echo site_url()?>theme/images/angle.jpg" width="25" height="25" alt="angle" />
            </div> 
            <div id="lated_txt"><a  href="<?php echo site_url('recent');?>" target="_blank" class="lated_txt_link">往期话题</div></a> 
          </div>
         
          <?php $i=1;foreach ($topics As $row){?>
          <?php $i++;if ($i>4){?>
           <?php
			if ($this->basic->countstr($row['title'])>16)
             {
             	$row['l_title']=$this->basic->utfSubstr($row['title'],0,16);
             }else {
             	$row['l_title']=$row['title'];
             }
          ?>
            <div class="lated_topics">
              <div class="lated_topics_img"><a href="<?php echo @site_url($row['id']);?>" target="_blank"><img src="<?php echo  @$row['topicbanner'];?>" width="144" height="111" alt="<?php echo @$row['title'];?>"  style="border:1px #E0E0E0 solid;"/></a></div>
              <div class="lated_topics_title"><a href="<?php echo @site_url($row['id']);?>" target="_blank"><?php echo @$row['l_title']?></a></div>
            </div>
        <?php }}?>
        
        </div>
      </div>
      <div id="side">
        <div id="search">
          <div id="search_frame">
            <input name="keyword" id="searchtext"/>
          </div>
          <div id="search_button"><a  class="search"  id="search1"  onclick="search1()">搜索</a></div>
        </div>
        
          <div id="submit">
            <div class="side_img">
              <img src="<?php echo site_url()?>theme/images/submit.gif" alt="submit buttion"/>
            </div>
            <div class="side_txt1"><a href="<?php echo site_url('submit');?>" target="_blank">话题投稿</a></div>
            <div class="side_txt2">你对哪些话题比较感兴趣呢？</div>
          </div>
       
        <div id="feedback">
          <div class="side_img">
            <img src="<?php echo site_url()?>theme/images/feedback.gif" alt="feedback buttion"/>
          </div>
          <div class="side_txt1"> <a href="<?php echo site_url('feedback');?>" target="_blank">意见反馈</a> </div>
          <div class="side_txt2">您对我们的栏目有什么意见么？</div>          
        </div> 
        
        <div id="hot">
          <div id="hot_title">
            <div id="hot_title_img"><img src="<?php echo site_url()?>theme/images/angle.jpg" alt="logo"></div>
            <div id="hot_title_txt">热点话题</div>
          </div>
          	<?php $i=1;if (isset($topic_hot)){
          		foreach ($topic_hot as $row){
          			if ($this->basic->countstr($row['title'])>22)
             			{
             				$row['title']=$this->basic->utfSubstr($row['title'],0,22);
             			}
             ?>
            <div class="hot_topic">
              <div class="hot_num"><?php echo $i;?></div>
              <div class="click_count">点击：<?php echo @$row['count'];?>次</div>
              <div class="hot_topic_title"><a href="<?php echo site_url($row['id']);?>" target="_blank" class="hot_link"><?php echo @$row['title'];?></a></div>
              <div class="hot_hr"><img src="<?php echo site_url()?>theme/images/hr.gif"/></div>
            </div>
            <?php $i++; }}else{echo "db error!";}?>
            
        </div> 
        <div id="weibo" style="height:380px;">
          <iframe width="270" height="380" class="share_self"  frameborder="0" scrolling="no" src=   "http://widget.weibo.com/weiboshow/index.php?language=&width=270&height=380&fansRow=1&ptype=1&speed=0&skin=1&isTitle=1&noborder=1&isWeibo=1&isFans=0&uid=2133884844&verifier=1cf05faa&dpc=1"></iframe>
        </div>
        <div id="contact">
            <div id="contact_txt">    <font color="#9B784C"> 版权声明：</font>本站原内容均为青春在线网站原创报道，转载须注明，欢迎转载评论。
              <p><font color="#7A4C11">电话：</font>0533-2786633</p><font color="#7A4C11">Email：</font>r.ming@qq.com
            </div>
        </div>  
      </div>
      <div id="footer">山东理工大学 学生工作部（处） 青春在线网站 版权所有  鲁ICP备 06001272 号<br/>
                             Copyright © 2001-2012 All Rrights Reserved </div>
	</div>
    
</body>
</html>
