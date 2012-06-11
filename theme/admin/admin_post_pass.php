<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文章管理——青春在线网站每周话题栏目</title>
<link  type="text/css" rel="stylesheet" href="<?php echo site_url()?>theme/admin/images/style.css">
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
	    					<select name="select" onchange="location.href=this.options[this.selectedIndex].value;" >
	    					<option value="<?php echo  site_url('admin/post/pass');?>">——————————话题选择——————————</option>
	    					<?php 
	    						foreach ($topics as $row)
									{
										echo "<option value=\"".site_url('admin/post/pass')."?tid=".($row['id'])."\"";
										if (isset($_GET['tid'])){
											if ($_GET['tid']==$row['id']){
												echo "selected=\"selected\"";
											}
										};
										echo ">".($row['title'])."</option>";
									}
	    					?>
	    					</select>
    					</div>
    				</div>
    				<div class="right_content">
    					<table width="600" border="0" >
						  <tr style="background:#eee;">
						    <th width="266" scope="col">文章标题</th>
						    <th width="70" scope="col">发布时间</th>
						    <th width="60" scope="col">访问量</th>
						    <th width="40" scope="col">作者</th>
						    <th width="40" scope="col">编辑</th>
						    <th width="40" scope="col">删除</th>
						  </tr>
						 <?php echo @$post; ?>
						</table>
						<div class="pagenav"><?php  echo @$page_nav; ?></div>
    					<div class="admin_error"><?php echo  @$error;?></div>
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
    				<li><a href="<?php echo site_url('admin/post/check'); ?>" >文章审核</a></li>
    				<li><a href="<?php echo site_url('admin/post/pass'); ?>"  class='nav_hover'>文章管理</a></li>
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
    <div class="foot"><?php echo @$this->config->item('copyright');?></div>
</div>
</body>
</html>
