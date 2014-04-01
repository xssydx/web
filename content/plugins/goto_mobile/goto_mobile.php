<?php
/*
Plugin Name: 手机访问自动跳插件
Version: 1.0
Plugin URL: http://blog.4a8a.com/post-69.html
Description: 当手机访问网站时自动跳转到网站/M手机版页面
Author: 海盗船博客
Author Email: 89539644@qq.com
Author URL: http://blog.4a8a.com
*/

!defined('EMLOG_ROOT') && exit('access deined!');

function goto_mobile_headjs(){
echo '<script language="javascript" src="'.BLOG_URL.'content/plugins/goto_mobile/uaredirect.js" /></script>';
echo '<script type="text/javascript">uaredirect("'.BLOG_URL.'m");</script>';
}
addAction('index_head','goto_mobile_headjs');
?>