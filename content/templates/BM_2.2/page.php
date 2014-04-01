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
?>
<div id="main">
	<h2><?php echo $log_title; ?></h2>
	<div class="context"><?php echo $log_content; ?></div>
	<div id="comments">
	<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
    <?php if(empty($comnum)){ echo "<p style='margin-top:60px;'>这篇文章还没有收到评论，赶紧来抢沙发吧~</p>";}else{echo"<h3 style='margin-top:20px;'>已有";echo $comnum;echo"条评论</h3>";} ?>
    <?php blog_comments($comments,$params); ?>
	</div>
</div>
<?php
 include View::getView('side');
 include View::getView('footer');
?>