<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户编辑——青春在线网站每周话题栏目</title>
<link  type="text/css" rel="stylesheet" href="<?php echo site_url()?>theme/admin/images/style.css">
<script type="text/javascript" src="<?php echo site_url()?>public/ueditor/editor_config.js"></script>
<script type="text/javascript" src="<?php echo site_url()?>public/ueditor/editor_all.js"></script>
<link rel="stylesheet" href="<?php echo site_url()?>public/ueditor/themes/default/ueditor.css"/>
<script language="javascript" type="text/javascript" src="<?php echo site_url()?>public/WdatePicker/js/WdatePicker.js"></script>
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
    	<div class="content_con" >
    		<div class="right_con" >
    			<div class="right">
    				<div class="right_title">
    				<a href=""></a></div>
    				<div class="right_content" >
    					
						<div class="post_form" style="height:auto;">
				           	<ul class="post">
			
				           		
			           		<?php if (isset($error)) { ?>
							<li><span class="post_t" style="color:red;width:250px;font-size:14px;"><?php  echo $error;?></span></li>
							<?php }?>
							<?php echo  form_open("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);?>
							<li><span class="post_t">用户名：</span><span class="post_c"><?php echo form_input('name',@$name); ?><?php echo form_error('name');?><font size="-1" color="red">(*)</font></span></li>
							<li><span class="post_t">编辑昵称：</span><span class="post_c"><?php echo form_input('editname',@$editname); ?><?php echo form_error('editname');?><font size="-1" color="red">(*)</font></span></li>
							<li><span class="post_t">真实姓名：</span><span class="post_c"><?php echo form_input('realname',@$realname); ?><?php echo form_error('realname');?><font size="-1" color="red">(*)</font></span></li>
							<li><span class="post_t">邮箱：</span><span class="post_c"><?php echo form_input('email',@$email); ?><?php echo form_error('email');?><font size="-1" color="red">(*)</font></span></li>
							<li><span class="post_t">密码：</span><span class="post_c"><?php echo form_password('password'); ?><?php echo form_error('password');?><font color="red" size="-1">(保留原密码请留空)</font></span></li>
							<li ><span class="post_t" ><script language="javascript" type="text/javascript" src="<?php echo  site_url()?>imgauthcode/show_script/"></script></span><span class="post_c" ><?php echo form_input('captcha')?><?php echo @$captcha_error; ?><font size="-1" color="red">(*)</font></span></li>
							<li><span class="post_t"></span><select name="status">
							<option value="0" <?php if (@$status==0){?> selected="selected" <?php }?>>未认证会员</option>
							<option value="1" <?php if (@$status==1){?> selected="selected" <?php }?>>普通会员</option>
							<option value="2"  <?php if (@$status==2){?> selected="selected" <?php }?>>网站管理员</option>
							</select><?php echo form_error('status');?>
							&nbsp;<?php echo form_submit('submit','更新用户信息 ',"id=\"subBtn\" ");?></span></li>
							<?php echo form_close(); ?>
						</ul>
		           	</div>

    			</div>
	    		</div>
	    	</div>
    		<div class="left">
    			<ul>
        			<span class="li_titile" >话题管理</span>
    				<li><a href="<?php echo site_url('admin/topic/add');  ?>" >添加话题</a></li>
    				<li><a href="<?php echo site_url('admin/topic/check'); ?>" >话题审核</a></li>
    				<li><a href="<?php echo site_url('admin/topic/pass'); ?>" >话题管理</a></li>
    				<li><a href="<?php echo site_url('admin/topic/recycle'); ?>" >话题回收站</a></li>
    				<li style="height:0px;"></li>
    				<span class="li_titile" >文章管理</span>
    				<li><a href="<?php echo site_url('admin/post/add');  ?>" >添加文章</a></li>
    				<li><a href="<?php echo site_url('admin/post/check'); ?>">文章审核</a></li>
    				<li><a href="<?php echo site_url('admin/post/pass'); ?>" >文章管理</a></li>
    				<li><a href="<?php echo site_url('admin/post/recycle'); ?>" >文章回收站</a></li>
    				<li style="height:0px;"></li>
    				<span class="li_titile" >用户管理</span>
    				<li><a href="<?php echo site_url('admin/user/add');?>"  >添加用户</a></li>
    				<li><a href="<?php echo site_url('admin/user/member'); ?>"  <?php if (@$_GET['from']=='member'){?>class="nav_hover" <?php }?>>会员管理</a></li>
    				<li><a href="<?php echo site_url('admin/user/check'); ?>"  <?php if (@$_GET['from']=='check'){?>class="nav_hover" <?php }?>>会员认证</a></li>
    				<li style="height:0px;"></li>
    				<span class="li_titile" >广告管理</span>
    				<li><a href="<?php echo site_url('admin/ad/add');?>"  >添加广告</a></li>
    				<li><a href="<?php echo site_url('admin/ad/pass');?>"  >广告管理</a></li>
    			</ul>
    		</div>
        </div>
    </div>
    <div class="foot"><?php echo @$this->config->item('copyright');?></div>
</div>
</body>
</html>
