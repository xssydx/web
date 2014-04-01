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
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="main">
    <div>
    <p class="date r">
    <span class="m"><?php echo gmdate('M', $date); ?></span>
	<span class="d"><?php echo gmdate('d', $date); ?></span>
    <span class="y"><?php echo gmdate('Y', $date); ?></span>
    </p>
    <h1><span><?php topflg($top); ?><?php echo $log_title; ?></span></h1>
    </div>	
	<p class="metaa">
	<a href="<?php echo BLOG_URL;?>" title="返回首页">首页</a> &raquo; <?php getBlogSort($logid);?> &raquo; <?php echo $log_title; ?>&nbsp;&nbsp;&nbsp;<?php editflg($logid,$author); ?>
	<div id="shadowDiv" class="hidDiv"></div>
	<ul id="resizer">
	<a title="开/关灯" href="javascript:"><li id="btnOO" onclick="kaiguan(this)">关灯</li></a>
	<a title="字体变小" href="javascript:"><li id="f_s">小</li></a>
	<a title="字体中等" href="javascript:"><li id="f_m">中</li></a>
	<a title="字体变大" href="javascript:"><li id="f_l">大</li></a>
	</ul>
	</p>
    <div>
    <div class="context"><?php echo $log_content; ?></div>
	<div class="cut_line"><span>正文部分到此结束</span></div>
	<div class="post_copyright">
	<p><b>文章标签：</b><?php blog_tag($logid);?></p>
	<p><b>版权声明：</b>若无特殊注明，本文皆为( <?php blog_author($author); ?> )原创，转载请保留文章出处。</p>
	<p><b>也许喜欢：</b><?php neighbor_log($neighborLog); ?></p>
	</div>
    </div>
	<?php doAction('log_related', $logData); ?>
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