<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>话题添加——青春在线网站每周话题栏目</title>
<link  type="text/css" rel="stylesheet" href="<?php echo site_url()?>theme/admin/images/style.css">

<script type="text/javascript" src="<?php echo site_url()?>public/ueditor/editor_config.js"></script>
<script type="text/javascript" src="<?php echo site_url()?>public/ueditor/editor_all.js"></script>
<link rel="stylesheet" href="<?php echo site_url()?>public/ueditor/themes/default/ueditor.css"/>
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
    	<div class="content_con"  style="height:650px;_height:500px;">
    	<div style="height:auto;float:left;_height:100%;">
    		<div class="right_con" >
    			<div class="right">
    				<div class="right_title">
    				<a href=""></a></div>
    				<div class="right_content" >
    					
						<div class="post_form" style="height:auto;">
				           	<ul class="post">
			
				           		
			           		<?php if (isset($error)) { ?>
							<li><span class="post_t" style="color:red;width:200px;font-size:14px;"><?php  echo $error;?></span></li>
							<?php }?>
							<?php echo  form_open_multipart("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);?>
							<li><span class="post_t">话题标题：</span><span class="post_c"><?php echo form_input('title',set_value('title'),"style=\"width:400px;\""); ?><font size="-1" color="red">(*)</font><?php echo form_error('title');?></span></li>
							<li><span class="post_t">标题图片：</span><span class="post_c"><?php echo form_upload('topicbanner',set_value('topicbanner'),"style=\"width:150px;\""); ?><font size="-1" color="red">(*必填:话题首页话题图片300*240)</font><?php echo @$uploaderrors;?></span></li>
							<li><span class="post_t">投票标题：</span><span class="post_c"><?php echo form_input('votetitle',set_value('votetitle'),"style=\"width:400px;\""); ?><font size="-1" color="red">(*)</font><?php echo form_error('votetitle');?></span></li>
							<li><span class="post_t">投票选项&nbsp;&nbsp;</span></li>
							<li><span class="post_t">选项①：</span><span class="post_c"><?php echo form_input('op1',set_value('op1'),"style=\"width:200px;\""); ?><font size="-1" color="red">(*)</font><?php echo form_error('op1');?></span></li>
							<li><span class="post_t">选项②：</span><span class="post_c"><?php echo form_input('op2',set_value('op2'),"style=\"width:200px;\""); ?><font size="-1" color="red">(*)</font><?php echo form_error('op2');?></span></li>
							<li><span class="post_t">选项③：</span><span class="post_c"><?php echo form_input('op3',set_value('op3'),"style=\"width:200px;\""); ?><font size="-1" color="red">(*)</font><?php echo form_error('op3');?></span></li>
							<li><span class="post_t">话题背景：</span><span class="post_c"><?php echo form_textarea('description',set_value('description'),"style=\"width:498px;height:170px;\""); ?><?php echo form_error('description');?></span></li>
							<li style="margin-top:10px;"><span class="post_t">编者按：</span><span class="post_c"><?php echo form_textarea('comments',set_value('comments'),"style=\"width:498px;height:170px;\""); ?><?php echo form_error('comments');?></span></li>
							<li><span class="post_t"></span><span class="post_c" style="margin-top:5px;"><input type="checkbox" name="status"  <?php  if ($status=='1') {?> checked="checked"<?php } ?>/>是否审核&nbsp;<?php echo form_submit('submit','发布信息',"id=\"subBtn\" ");?></span></li>
							<?php echo form_close(); ?>
						</ul>
		           	</div>

    			</div>
	    		</div>
	    	</div>
    		<div class="left">
    			<ul>
    				<span class="li_titile" >话题管理</span>
    				<li><a href="<?php echo site_url('admin/topic/add');  ?>" class='nav_hover'>添加话题</a></li>
    				<li><a href="<?php echo site_url('admin/topic/check'); ?>">话题审核</a></li>
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
    				<li><a href="<?php echo site_url('admin/user/add');?>" >添加用户</a></li>
    				<li><a href="<?php echo site_url('admin/user/member'); ?>" >会员管理</a></li>
    				<li><a href="<?php echo site_url('admin/user/check'); ?>">会员认证</a></li>
    				<li style="height:0px;"></li>
    				<span class="li_titile" >广告管理</span>
    				<li><a href="<?php echo site_url('admin/ad/add');?>"  >添加广告</a></li>
    				<li><a href="<?php echo site_url('admin/ad/pass');?>"  >广告管理</a></li>
    			</ul>
    		</div>
        </div>
        </div>
    </div>
    <div class="foot"><?php echo @$this->config->item('copyright');?></div>
</div>
</body>
</html>
