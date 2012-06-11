<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>每周话题——<?php echo @$news['title'];?></title>
<link type="text/css" rel="stylesheet" href="<?php echo site_url()?>theme/style/page.css" />
</head>

<body>
<div class="all">
	<div class="top">
    	<div class="top_up"> 
        	<div class="logo"><a href="<?php echo site_url($topic['id']);?>"></a></div>
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
    <div class="content_con">
    	<div class="top">
        	<div class="ls">
            	<div class="word" style="cursor: pointer;">跟踪报道</div>
            </div>
            <div class="title">
            	<div class="left"></div>
                <div class="title">
                	<?php 
	                	if ($this->basic->countstr($news['title'])>70)
	             		{
	             			$news['title']=$this->basic->utfSubstr($news['title'],0,70);
	             		}
             		?>
                	<div class="date"><?php echo @date("Y年m月d日",strtotime($news['post_time']));?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo @"作者：".$news['author']."&nbsp;&nbsp;&nbsp;&nbsp;浏览量：".$news['count'];?></div>
                    <div class="word"><a href="<?php echo @site_url('news/'.$news['id']);?>"><?php echo @$news['title'];?></a></div>
                </div>
            </div>
        </div>
        <div class="mid">
      			 <div class="news_content" >
            		<?php echo @$news['description'];?>
            	</div>
				<div style="text-align:right;width:935px;color:#5D5D5D;">编辑： <?php echo @$news['editor'];?></div>
				
         </div>
    </div>
    <div class="com">
   		<div class="top">
        	<div class="ls">
            	<div class="word" style="cursor: pointer;">话题热议</div>
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
        <table style="font-size:12px; text-align:center; margin-left:270px; font: '微软雅黑'; color:#707070">
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