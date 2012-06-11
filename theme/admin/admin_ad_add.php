<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加广告——青春在线网站每周话题栏目</title>
<link  type="text/css" rel="stylesheet" href="<?php echo site_url()?>theme/admin/images/style.css">
<style type="text/css">
.right_content li {list-style:none;height:30px;}
</style>
<!--[if IE 6]>
<script src="<?php echo site_url() ?>theme/admin/images/DD_belatedPNG.js" language="javascript" type="text/javascript">
</script>
<script language="javascript" type="text/javascript">
  DD_belatedPNG.fix('*');
  function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<![endif]-->
</head>
<body>
<div class="main">
    <div class="head">
    	<div class="head_con">
        	<div class="logo"><a href="<?php echo site_url('admin/home')?>"></a></div>
        	        	<div class="my_link"><a href="<?php echo site_url();?>" target="_blank">首页<a href="<?php echo site_url('admin/logout')?>">退出&nbsp;|&nbsp;</a><a href="<?php echo site_url('admin/user/member')."?name=".$this->session->userdata['name'];?>"><?php echo $this->session->userdata['editname']?> &nbsp;</a></div>
        </div>
    </div>
    <div class="content">
    	<div class="content_con">
    		
    		<div class="right_con">
    			<div class="right">
    				<div class="right_title">
    					<div class="cateselect">
	    					
    					</div>
    				</div>
    				<div class="right_content" style="margin-top:5px;">
    					<?php if (isset($error)) { ?>
							<li><span class="post_t" style="color:red;width:200px;font-size:14px;"><?php  echo $error;?></span></li>
							<?php }?>
							<?php echo  form_open_multipart("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);?>
							<li><span class="post_t">广告图片：</span><span class="post_c"><?php echo form_upload('banner',set_value('banner'),"style=\"width:150px;\""); ?><font size="-1" color="red">【*支持gif,png,jpg图片(670*100)】</font><?php echo @$uploaderrors;?></span></li>
							<li><span class="post_t">链接地址：</span><span class="post_c"><?php echo form_input('link',set_value('link'),"style=\"width:400px;\""); ?><font size="-1" color="red">(*)</font><?php echo form_error('link');?></span></li>
							<li><span class="post_t"></span><span class="post_c" style="margin-top:5px;"><?php echo form_submit('submit','添加广告',"id=\"subBtn\" ");?></span></li>
							<?php echo form_close(); ?>
    				</div>
    			</div>
    		</div>
    		<div class="left">
    			<ul>
    				<span class="li_titile" >话题管理</span>
    				<li><a href="<?php echo site_url('admin/topic/add');  ?>" >添加话题</a></li>
    				<li><a href="<?php echo site_url('admin/topic/check'); ?>">话题审核</a></li>
    				<li><a href="<?php echo site_url('admin/topic/pass'); ?>"  >话题管理</a></li>
    				<li><a href="<?php echo site_url('admin/topic/recycle'); ?>" >话题回收站</a></li>
    				<li style="height:0px;"></li>
    				<span class="li_titile" >文章管理</span>
    				<li><a href="<?php echo site_url('admin/post/add');  ?>" >添加文章</a></li>
    				<li><a href="<?php echo site_url('admin/post/check'); ?>">文章审核</a></li>
    				<li><a href="<?php echo site_url('admin/post/pass'); ?>" >文章管理</a></li>
    				<li><a href="<?php echo site_url('admin/post/recycle'); ?>" >文章回收站</a></li>
    				<li style="height:0px;"></li>
    				<span class="li_titile" >用户管理</span>
    				<li><a href="<?php echo site_url('admin/user/add');?>" >添加用户</a></li>
    				<li><a href="<?php echo site_url('admin/user/member'); ?>" >会员管理</a></li>
    				<li><a href="<?php echo site_url('admin/user/check'); ?>">会员认证</a></li>
    				<li style="height:0px;"></li>
    				<span class="li_titile" >广告管理</span>
    				<li><a href="<?php echo site_url('admin/ad/add');?>"   class='nav_hover'>添加广告</a></li>
    				<li><a href="<?php echo site_url('admin/ad/pass');?>" >广告管理</a></li>
    				
    			</ul>
    		</div>
        </div>
    </div>
    <div class="foot"><?php echo @$this->config->item('copyright');?></div>
</div>
</body>
</html>
