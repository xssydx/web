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
	<?php 
	if (!empty($logs)):
	foreach($logs as $value):
	 preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $value['content'], $img);
	$imgsrcb = !empty($img[1]) ? $img[1][0] : '';
	preg_match_all("|<embed[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $value['content'], $embed);
	$embedsrc = !empty($embed[1]) ? $embed[1][0] : '';
	preg_match_all("|<iframe[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $value['content'], $iframe);
	$iframesrc = !empty($iframe[1]) ? $iframe[1][0] : '';
	preg_match_all("|<video[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $value['content'], $video);
	$videosrc = !empty($video[1]) ? $video[1][0] : '';
	$logdes = blog_tool_purecontent($value['content'], 200);
	if(pic_thumb($value['content'])){
	$imgsrc = pic_thumb($value['content']);
	}else
	$imgsrc = TEMPLATE_URL.'zorro/random/tb'.rand(1,40).'.jpg';
	?>
	<h1><?php topflg($value['top']); ?><a title="<?php echo $value['log_title']; ?>" href="<?php echo $value['log_url']; ?>"><?php echo $value['log_title']; ?></a>
	</h1>
	<p class="metab">
	<span class="pauthor"></span><?php blog_author($value['author']); ?>&nbsp;&nbsp;&nbsp;
	<span class="pcata"></span><?php blog_sort($value['logid']); ?>&nbsp;&nbsp;&nbsp;
	<span class="pview"></span><?php echo $value['views']; ?>次查看&nbsp;&nbsp;&nbsp;
	<span class="pcomm"></span><?php if($value['comnum']=="0"){ echo '<a title="抢沙发" href="'.$value['log_url'].'#respond">抢沙发</a>'; }else{ echo  '<a title="《'.$value['log_title'].'》上的评论" href="'.$value['log_url'].'#comments">'.$value['comnum'].'条评论</a>'; } ?>&nbsp;&nbsp;&nbsp;
	<span class="ptime"></span><?php echo date('Y年m月d日',$value['date']); ?>
	<?php editflg($value['logid'],$value['author']); ?>
	</p>	
	<a href="<?php echo $value['log_url']; ?>">
    <div title='<?php if($imgsrcb): ?>
	<span class="posts">有图有真相</span>
	<?php elseif($embedsrc||$iframesrc||$videosrc):?>
	<span class="posts">有视频有真相</span>
	<?php endif; ?>' class="logdes">
	<img src="<?php echo $imgsrc; ?>" />
    </div>
	</a>
	<p class="logs"><?php echo $logdes; ?></p>
    <div class="clear"></div>		
    <div class="goon r">
	<a href="<?php echo $value['log_url']; ?>">继续阅读&raquo;</a>
	</div>
	<div class="line"></div>
    <?php endforeach; else: ?>
    <p><center>^_^ 关键词“<?php echo urldecode($params[2]);?>”的搜索结果肿么能木有呢？</center></p>
    <?php endif; ?>
    <div id="pagenavi"><?php echo $page_url; ?></div>
</div>
<?php
include View::getView('side');
include View::getView('footer');
?>