<?php
/*
Template Name:BM_2.2免费版
Description:因为简约，所以简单。
Version:2.2免费版
Author:麦特佐罗
Author Url:http://www.zorrorun.com
Sidebar Amount:1
ForEmlog:5.21
*/
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
require_once View::getView('module');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $site_title; ?></title>
    <meta name="keywords" content="<?php echo $site_key; ?>" />
    <meta name="description" content="<?php echo $site_description; ?>" />
    <link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
    <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
    <link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
    <link href="<?php echo TEMPLATE_URL; ?>zorro/main.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>zorro/jquery.min.js"></script>
    <?php doAction('index_head'); ?>
</head>
<body>		
    <div class="body">
	<div id="header">
	<!--LOGO高度在这里调整开始-->
    <span id="logo">
	<a title="<span class='posts'><?php echo $blogname; ?></span>" href="<?php echo BLOG_URL; ?>">
	<img src="<?php echo TEMPLATE_URL; ?>/zorro/images/logo.png" width="250px" height="80px" alt="<?php echo $blogname; ?>" />
	</a>
	</span>
	<!--LOGO高度在这里调整结束-->
	<!--调用说说公告开始-->
    <div class="tt">
	<img src="<?php $user_cache = Cache::getInstance()->readCache('user'); echo getGravatar($user_cache[1]['mail'],70);?>"/>
	<div class="content">
	<p class="arrow"></p>
	<p><?php global $CACHE;  $newtws = $CACHE->readCache('newtw');if(empty($newtws)){ echo "求知若饥，虚心若愚。";}else{echo subString(strip_tags($newtws[0]['content']),0,36);echo "
	<script type='text/javascript'>
	if ( (/MSIE 6.0/ig.test(navigator.appVersion))||(/MSIE 7.0/ig.test(navigator.appVersion))||(/MSIE 8.0/ig.test(navigator.appVersion)) ) {document.write('<font color=red>低版本者浏览器滚粗。</font>');}
	</script>" ;
	} ?></p>
	</div>
	</div>
	<!--调用说说公告结束-->
	<!--订阅开始-->
	<div id="social">
	<a class="rss" target="_blank" href="<?php echo BLOG_URL; ?>rss.php" title="<span class='posts'>订阅 <?php echo $blogname; ?></span>"></a>
	</div>
	<!--订阅结束-->
	<div id="menu">
	<?php blog_navi();?>
	<form name="keyform" method="get" id="searchform" action="<?php echo BLOG_URL; ?>index.php">
	<input type="text" name="keyword" class="search" value="搜搜更健康" onFocus="if (this.value == '搜搜更健康') {this.value = '';}" onBlur="if (this.value == '') {this.value = '搜搜更健康';}">
	</form>
	</div>
	</div>
	<div id="content">