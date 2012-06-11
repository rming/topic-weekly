<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>每周话题——<?php echo @$topic['title'];?></title>
<link type="text/css" rel="stylesheet" href="<?php echo site_url()?>theme/style/topic.css" />
</head>

<body>
<div class="all">
	<div class="top">
    	<div class="top_up"> 
        	<div class="logo"><a href="<?php echo @site_url($topic['id']);?>" ></a></div>
            <div class="title">
            	<ul>
                	<li>
                    	<a href="<?php echo site_url();?>">网站首页</a>
                    </li>
                    <li>
                    	<a href="<?php echo site_url('recent');?>">往期话题</a>
                    </li>
                    <li>
                    	<a href="<?php echo site_url('submit');?>">话题投稿</a>
                    </li>
                    <li>
                    	<a href="<?php echo site_url('feedback');?>">意见反馈</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="head">
            <div class="syn">
            	<div class="up">
            	<?php 
	                if ($this->basic->countstr($topic['title'])>36)
	             	{
	             		$topic['l_title']=$this->basic->utfSubstr($topic['title'],0,36);
	             	}else {
	             		$topic['l_title']=$topic['title'];
	             	}
	             	$topic['description']=strip_tags($topic['description']);
              		if ($this->basic->countstr($topic['description'])>190)
             			{
             				$topic['description']=$this->basic->utfSubstr($topic['description'],0,190);
             			}
             		if ($this->basic->countstr($topic['comments'])>190)
             		{
             			$topic['comments']=$this->basic->utfSubstr($topic['comments'],0,190);
             		}
             	?>
                	<div class="name">点击：<span><?php echo @$topic['count']; ?></span>&nbsp;次&nbsp;本期责编：<span><?php echo @$topic['editor'];?></span></div>
                    <div class="title"><a href="<?php echo site_url($topic['id']);?>"><?php echo @$topic['l_title'];?></a></div>
                </div>
                <div class="mid"><p style="word-wrap: break-word; word-break: normal;"><?php echo $topic['description'];?><a href="<?php echo site_url('info/'.$topic['id'])?>" target="_blank">【详细】</a></p></div>
                <div class="bot"><p style="word-wrap: break-word; word-break: normal;"><?php echo $topic['comments'];?><a href="<?php echo site_url('info/'.$topic['id'])?>" target="_blank">【详细】</a></p></div>
            </div>
            <div class="img">
            	<div class="image">
                	<img src="<?php echo @$topic['topicbanner'];?>" width="300" height="240" />
                </div>
                <div class="title"><a href="<?php echo site_url($topic['id']);?>" ><?php echo @$topic['l_title'];?></a></div>
            </div>
        </div>
    </div>
    <div class="mid">

   			 <?php 
   			 		$news=array_values($news);
	                if ($this->basic->countstr($news['0']['title'])>46)
	             	{
	             		$news['0']['l_title']=$this->basic->utfSubstr($news['0']['title'],0,46);
	             	}else {
	             		$news['0']['l_title']=$news['0']['title'];
	             	}
	             	if ($this->basic->countstr($news['0']['title'])>20)
	             	{
	             		$news['0']['ll_title']=$this->basic->utfSubstr($news['0']['title'],0,20);
	             	}else {
	             		$news['0']['ll_title']=$news['0']['title'];
	             	}
	             	$news['0']['description']=$this->basic->ClearHtml($news['0']['description']);
              		if ($this->basic->countstr($news['0']['description'])>630)
             			{
             				$news['0']['description']=$this->basic->utfSubstr($news['0']['description'],0,630);
             			}
             		
             	?>
    	<div class="content">
        	<div class="top">
            	<div class="ls">
                	<div class="word"><a >跟踪报道</a></div>
                </div>
                <div class="title"><a href="<?php echo @site_url('news/'.$news['0']['id']);?>" target="_blank"><?php echo @$news['0']['l_title'];?></a></div>
            </div>
            <!-- rming 2012.4.17  -->
            <div class="news_top_content">
            		<div class="img">
                            <img src="<?php echo @$news['0']['topicbanner'];?>" width="220" height="150"/>
                       	<a href="<?php echo @site_url('news/'.$news['0']['id']);?>"><?php echo @$news['0']['ll_title'];?></a>
                    </div>
                    <?php echo @$news['0']['description'];?>
            </div>
            <!-- rming 2012.4.17 end -->
            <div class="bot">
            	<div>
                	<ol>
                	<?php $i=1;$news= array_splice($news, 1);foreach ($news as $row){?>
                    	<li>
                        	<div class="ol_<?php echo $i;?>"></div>
                            <div class="ol_1_name">
                            	<a href="<?php echo @site_url('news/'.$row['id']);?>" target="_blank"><?php echo @$row['title'];?></a>
                            </div>
                        </li>
                        <?php $i++;}?>
                    </ol>
                </div>
            </div>
        </div>
        <?php if ($record==FALSE){?>
        <div class="wb">
        	<iframe width="270px" height="478px" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&width=270&height=478&fansRow=1&ptype=1&speed=0&skin=1&isTitle=1&noborder=1&isWeibo=1&isFans=0&uid=2133884844&verifier=1cf05faa&dpc=1"></iframe>
        </div>
        <?php }else {?>
        <div style="float:left;margin-left: 6px;">
        	<embed src="public/flash/player.swf?soundFile=<?php echo site_url('record')."?id=".$topic['id'];?>&amp;playerID=10&amp;bg=0xeeeeee&amp;leftbg=0x357dce&amp;lefticon=0xFFFFFF&amp;rightbg=0xf06a51&amp;rightbghover=0xaf2910&amp;righticon=0xFFFFFF&amp;righticonhover=0xffffff&amp;text=0×666666&amp;slider=0×666666&amp;track=0xFFFFFF&amp;border=0×666666&amp;loader=0x9FFFB8&amp;loop=no&amp;autostart=yes"type="application/x-shockwave-flash" wmode="transparent" height="40" width="270" /> </embed>
        </div>
        <div class="wb" style="height:438px;">
        	<iframe width="270px" height="438px" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&width=270&height=438&fansRow=1&ptype=1&speed=0&skin=1&isTitle=1&noborder=1&isWeibo=1&isFans=0&uid=2133884844&verifier=1cf05faa&dpc=1"></iframe>
        </div> 
        
          
        <?php }?>
        
    </div>
    <div class="vote">
    	<div class="top">
        	<div class="ls">
            	<div class="word"><a>欢迎投票</a></div>
            </div>
            <div class="title">欢迎参与投票，投票结果将被反映到相关部门。</div>
        </div>
        <div class="bot">
        	<img src="<?php echo site_url();?>/theme/images/vote_03.jpg" />
        </div>
    </div>
    <div class="new">
    	<div class="top">
        	<div class="ls"></div>
            <div class="title"><a   href="<?php echo site_url('recent');?>" >最近话题</a></div>
        </div>
        <div class="bot">
        <?php foreach ($topics as $row){
        
        	if ($this->basic->countstr($row['title'])>20){
        		$row['title']=$this->basic->utfSubstr($row['title'],0,20);
        	}
        	?>
        	<div class="l_topic">
            	<div class="l_topic_img" >
                	<a href="<?php echo @site_url($row['id'])?>" target="_blank"><img src="<?php echo @$row['topicbanner'];?>" width="140" height="110" /></a>
                </div>
                <div class="l_topic_name"><a href="<?php echo @site_url($row['id'])?>" target="_blank"><?php echo @$row['title'];?></a></div>
            </div>
            <?php  }?>
           
           
        </div>
    </div>
    <div class="com">
   		<div class="top">
        	<div class="ls">
            	<div class="word">话题热议</div>
            </div>
            <div class="title">欢迎对本期话题发表意见建议。</div>
        </div>
        <div class="bot">
        	<!-- PingLun.La Begin -->
			<div id="pinglunla_here"></div><a href="http://pinglun.la/" id="logo-pinglunla">评论啦</a><script type="text/javascript" src="http://static.pinglun.la/md/pinglun.la.js" charset="utf-8"></script>
			<!-- PingLun.La End -->
        </div>
    </div>
    <div class="bot">
        <table style="font-size:12px; text-align:center; margin-left:270px; font-family: '微软雅黑'; color:#707070">
            <tr>
                <td>山东理工大学 学生工作部（处） 青春在线网站 版权所有  鲁ICP备 06001272 号</td>
            </tr>
            <tr>
                <td>Copyright © 2001-2012 All Rrights Reserved</td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
