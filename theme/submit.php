<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>话题投稿——每周话题，做你身边最真实的讨论。</title>
<link href="<?php echo site_url()?>theme/style/css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo site_url()?>theme/style/div.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo site_url()?>public/ueditor/editor_config.js"></script>
<script type="text/javascript" src="<?php echo site_url()?>public/ueditor/editor_all.js"></script>
<link rel="stylesheet" href="<?php echo site_url()?>public/ueditor/themes/default/ueditor.css"/>
<script src="<?php echo site_url()?>public/flash/swfobject.js" type="text/javascript"></script>
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
            <li><a href="<?php echo  site_url();?>">首页</a></li>
            <li><a href="<?php echo  site_url('recent');?>">往期题话</a></li>
            <li><a href="<?php echo site_url('prize') ;?>">参与有奖</a></li>
           
            <li  class="nav_li_hover"><a href="<?php echo site_url('submit');?>">话题投稿</a></li>
            <li ><a href="<?php echo site_url('feedback');?>">意见反馈</a></li>
          </ul>
        </div>
    </div>
    </div>
	<div id="container">	 
      <div id="main">
        <div id="main_top" style="height:auto;float:left;">
          <div id="title_bar">
            <div id="latest_topic">
              <div id="square"></div>
              <a   href="<?php echo site_url('feedback');?>" class="latest_topic_link">话题投稿</a>
            </div>
          </div>
          
             
             <div class="content" style="height:auto;float:left;">
             	<p style="text-align:left;margin:20px 0;">&nbsp;欢迎投稿，投稿前请先仔细查看<a href="#" style="color:#9a0d11;">《投稿注意事项》</a></p>
             
            </div>
             <div class="content" style="min-height:780px;">
             
				
	           	<?php if (isset($error)) { ?>
				<p style="text-align:left;color:red;width:200px;font-size:14px;"><?php  echo $error;?></p>
				
				<?php }?>
				<div style="text-align:center;color:red;font-size:14px;"><?php echo validation_errors(); ?></div>
				<?php echo  form_open_multipart("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);?>
				<table width="640" border="0">
				  <tr style="height:25px;">
				    <td colspan="1" width="80" align="right">文章标题：</td>
				    <td colspan="3" width="550" align="left" ><?php echo form_input('title',set_value('title'),"style=\"width:400px;background:#fff;height:20px;\""); ?><font size="-1" color="red">(*)</font></td>
				  </tr>
				  <tr style="height:25px;">
				    <td colspan="1"  align="right">所属话题：</td>
				    <td colspan="3" align="left" style="width:500px;overflow: hidden;">
					    <select name="tid" style="font-size:14px;">
								<?php 
									foreach ($topics as $row)
										{
											echo "<p>";
											echo "<option value=\"".($row['id'])."\">".($row['title'])."</option>";
											echo "</p>";
										}
								?>
						</select><font size="-1" color="red">(*)</font>
					</td>
				  </tr>
				  <tr style="height:25px;">
				    <td colspan="1"  align="right">标题图片：</td>
				    <td colspan="3" align="left" ><?php echo form_upload('topicbanner',set_value('topicbanner'),"style=\"width:150px;font-size:14px;\""); ?><font size="-1" color="red">(220*150)</font><?php echo @$uploaderrors;?></td>
				  </tr>
				  <tr>
				    <td colspan="1"  align="right">文章内容：</td>
				    <td colspan="3" align="left">
				    	<?php echo form_textarea('description',set_value('description')," id=\"myEditor\" ");?>
						<script type="text/javascript">
							var option = {
								    textarea: 'description' ,//设置提交时编辑器内容的名字
								    minFrameHeight: 480,               //最小高度
				    			toolbars: [
								// 这里定义的toolbars并不是对应多多行，而是在renderToolbarBoxHtml中去放到相应的位置去
								['FontFamily','FontSize','Bold','Italic','Underline','ForeColor','BackColor','|','JustifyLeft','JustifyCenter','JustifyRight','InsertOrderedList','InsertUnorderedList','Emoticon','Image','PlaceName','Link','Unlink','RemoveFormat','|','Undo','Redo',
								 '|','InsertImage','Emotion','InsertVideo','GMap','HighlightCode','|','Source','FullScreen']
								],
							};
							var editor = new baidu.editor.ui.Editor(option);
						    editor.render("myEditor");
						</script>
					</td>
				  </tr>
				  <tr style="height:25px;">
				    <td width="80" align="right">作者：</td>
				    <td width="100" align="left" ><?php echo form_input('author',set_value('author'),"style=\"width:200px;background:#fff;height:20px;\""); ?><font size="-1" color="red">(*)</font></td>
				    <td width="80" align="right">联系方式：</td>
				    <td width="200" align="left" ><?php echo form_input('name',set_value('name'),"style=\"width:200px;background:#fff;height:20px;\""); ?><font size="-1" color="red">(*)</font></td>
				  </tr>
				  <tr>
				    <td colspan="1"  align="right">&nbsp;</td>
				    <td colspan="3"><?php echo form_submit('submit','点击投稿',"id=\"subBtn\"  style=\"width: 100px;height: 24px;background-color: #F2F6FB;font-size: 14px;margin-top:8px;\" ");?></td>
				  </tr>
				</table>
				<?php echo form_close(); ?>
				
            </div>
        </div>
    
      
      </div>
      <div id="side">
        <div id="search">
          <div id="search_frame">
            <input name="keyword"/>
          </div>
          <div id="search_button"><a href="#" target="_blank" class="search">搜索</a></div>
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
        

        <div id="weibo">
          <iframe width="270" height="420" class="share_self"  frameborder="0" scrolling="no" src=   "http://widget.weibo.com/weiboshow/index.php?language=&width=270&height=420&fansRow=1&ptype=1&speed=0&skin=1&isTitle=1&noborder=1&isWeibo=1&isFans=0&uid=2133884844&verifier=1cf05faa&dpc=1"></iframe>
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
