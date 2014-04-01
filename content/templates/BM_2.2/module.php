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
<?php
//图片链接
function pic_thumb($content){
    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
    $imgsrc = !empty($img[1]) ? $img[1][0] : '';
	if($imgsrc):
		return $imgsrc;
	endif;
}
?>
<?php
//格式化内容工具
function blog_tool_purecontent($content, $strlen = null){
        $content = str_replace('继续阅读&gt;&gt;', '', strip_tags($content));
        if ($strlen) {
            $content = subString($content, 0, $strlen);
        }
        return $content;
}
?>
<?php
//获取分类名
function getBlogSort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
	<a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>" title="查看分类“<?php echo $log_cache_sort[$blogid]['name']; ?>”下的内容"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
	<?php else: ?>
	<?php echo "未分类"; ?>
	<?php endif;?>
<?php }?>
<?php
//评论输出等级
function echo_levels($comment_author_email,$comment_author_url){
  $DB = MySql::getInstance();
  $vip_list = array('"SB@qq.com"');
  if(in_array($comment_author_email,$vip_list)){echo '特邀作者';}
  $adminEmail = '"1315800105@qq.com"';
  if($comment_author_email==$adminEmail){echo '丐帮帮主';}  
  $sql = "SELECT cid as author_count FROM emlog_comment WHERE mail = ".$comment_author_email;
  $res = $DB->query($sql);
  $author_count = mysql_num_rows($res);
  if($author_count>=5 && $author_count<10 && $comment_author_email!=$adminEmail)
    echo '幼儿园';
  else if($author_count>=10 && $author_count<20 && $comment_author_email!=$adminEmail)
    echo '学前班';
  else if($author_count>=20 && $author_count<40 && $comment_author_email!=$adminEmail)
    echo '小学生';
  else if($author_count>=40 && $author_count<80 && $comment_author_email!=$adminEmail)
    echo '初中生';
  else if($author_count>=80 &&$author_count<160 && $comment_author_email!=$adminEmail)
    echo '高中生';
  else if($author_count>=160 && $author_coun<320 && $comment_author_email!=$adminEmail)
    echo '大学生';
  else if($author_count>=320 && $comment_author_email!=$adminEmail)
    echo '研究生';
}
?>
<?php
//文章分享
function share() {
	echo '
<a title="分享文章" href="javascript:"><li class="opener">分享</li></a>
<div class="zorroer">
<p class="closeer">分享到各大社区<a href="javascript:;" title="关闭"></a><br/><span>尊重他人劳动，你我共同努力。</span></p>
<a class="Ashare A_qzone"></a>
<a class="Ashare A_tqq"></a>
<a class="Ashare A_xiaoyou"></a>
<a class="Ashare A_sina"></a>
<a class="Ashare A_renren"></a>
<a class="Ashare A_kaixin"></a>
</div>
<div class="bodyer"></div>
';
} ?>
<?php
//widget：读书墙
function widget_blogger($title){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['mail'] != '' ? "<a href=\"mailto:".$user_cache[1]['mail']."\">".$user_cache[1]['name']."</a>" : $user_cache[1]['name'];?>
	<div class="box">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="bloggerinfo">
	<?php
	$DB = MySql :: getInstance();
	$time_side = strtotime('this month',strtotime(date('m/01/y')));
	$sql = "SELECT count(*) AS comment_nums,poster,mail,url FROM ".DB_PREFIX."comment where date > $time_side   and mail != '1315800105@qq.com' and poster != '$userName' and hide ='n' group by mail order by comment_nums DESC limit 0,12";
	$result = $DB -> query( $sql );
	while( $row = $DB -> fetch_array( $result ) )
	{$img = "<a rel=\"external nofollow\" target=\"_blank\" href=\"" . $row[ 'url' ] . "\" title=\"" . $row[ 'poster' ] ." (赐教" . $row[ 'comment_nums' ] . "次)\"><img class=\"avatarc\" src=\"" . getGravatar( $row[ 'mail' ]) . "\" /></a>";
	if( $row[ 'url' ] )
	{$tmp = "<a rel=\"external nofollow\" target=\"_blank\" href=\"" . $row[ 'url' ] . "\" title=\"" . $row[ 'poster' ] ." (赐教" . $row[ 'comment_nums' ] . "次)\"><img class=\"avatarc\" src=\"" . getGravatar( $row[ 'mail' ]) . "\"/></a>";
	}
	else
	{$tmp = $img;}
	$output .= $tmp;}
     $output = ' '. $output .' ';echo $output ;?>
	</ul>
	</div>
<?php }?>
<?php
//widget：日历
function widget_calendar($title){ ?>
	<div class="box">
	<h3><span><?php echo $title; ?></span></h3>
	<ul>
	<div id="calendar">
	</div>
	<script>sendinfo('<?php echo Calendar::url(); ?>','calendar');</script>
	</ul>
	</div>
<?php }?>
<?php
//widget：标签
function widget_tag($title){
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');?>
	<div class="box">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="blogtags">
	<?php shuffle($tag_cache);$tag_cache = array_shift(array_chunk($tag_cache,40));shuffle($tag_cache);foreach($tag_cache as $value): $color = dechex(rand(1200000,16777215));?>
		<span style="background-color:#<?php echo $color;?>;">
		<a href="<?php echo Url::tag($value['tagurl']); ?>"   title="<span style='color:#00ccff'>“<?php if(empty($value['tagname'])){ echo "无标签";}else{echo $value['tagname'];}?>”</span> <?php echo $value['usenum']; ?>篇文章">
		<?php if(empty($value['tagname'])){ echo "无标签";}else{echo $value['tagname'];}?></a>
		</span>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：分类
function widget_sort($title){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort'); ?>
	<div class="box">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="blogsort">
	<?php foreach($sort_cache as $value): ?>
	<li>
	<a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a>
	</li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：最新碎语
function widget_twitter($title){
	global $CACHE; 
	$newtws_cache = $CACHE->readCache('newtw');
	$istwitter = Option::get('istwitter');
	?>
	<div class="box">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="twitter">
	<?php foreach($newtws_cache as $value): ?>
	<?php $img = empty($value['img']) ? "" : '<a title="查看图片" class="t_img" href="'.BLOG_URL.str_replace('thum-', '', $value['img']).'" target="_blank">&nbsp;</a>';?>
	<li><?php echo $value['t']; ?><?php echo $img;?><p><?php echo smartDate($value['date']); ?></p></li>
	<?php endforeach; ?>
    <?php if ($istwitter == 'y') :?>
	<p><a href="<?php echo BLOG_URL . 't/'; ?>">更多&raquo;</a></p>
	<?php endif;?>
	</ul>
	</div>
<?php }?>
<?php
//widget：最新评论
function widget_newcomm($title){
	global $CACHE; 
	$com_cache = $CACHE->readCache('comment');
	$b=array("zorro/logcmt/01.jpg"=>"01","zorro/logcmt/02.jpg"=>"02","zorro/logcmt/03.jpg"=>"03","zorro/logcmt/04.jpg"=>"04","zorro/logcmt/05.jpg"=>"05","zorro/logcmt/06.jpg"=>"06","zorro/logcmt/07.jpg"=>"07","zorro/logcmt/08.jpg"=>"08","zorro/logcmt/09.jpg"=>"09","zorro/logcmt/10.jpg"=>"10","zorro/logcmt/11.jpg"=>"11","zorro/logcmt/12.jpg"=>"12","zorro/logcmt/13.jpg"=>"13","zorro/logcmt/14.jpg"=>"14");
	?>
	<div class="box">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="newcomment">
	<?php
	foreach($com_cache as $value):
	$url = Url::comment($value['gid'], $value['page'], $value['cid']);
	?>
	<li id="comment">
	  <a title="<span style='color:#00ccff'><?php echo $value['name']; ?></span> 于<?php echo date('Y年m月d日',$value['date']); ?>华山论剑" href="<?php echo $url; ?>"><img class="trans" src="<?php if(empty($value['mail'])){ echo TEMPLATE_URL;echo array_rand($b);}else{echo getGravatar($value['mail']);} ?>"/></a>
	  <h4><?php echo $value['name']; ?></h4>
      <div class="content"><?php echo subString(strip_tags($value['content']),0,15); ?></div>
	</li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：最新日志
function widget_newlog($title){
	global $CACHE; 
	$newLogs_cache = $CACHE->readCache('newlog');
	?>
	<div class="box">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="newlog">
    <?php $i=1;
    foreach($newLogs_cache as $value){?>
	<li>
    <?php if($i==1){?><em class="hotone"><?php echo $i;?></em>
	<?php }else if($i==2){ ?><em class="hottwo"><?php echo $i;?></em>
	<?php }else if($i==3){ ?><em class="hotthree"><?php echo $i;?></em>
	<?php }else{ ?><em class="hotSoSo"><?php echo $i;?></em><?php }?>
    <a title="<?php echo $value['title']; ?>" href="<?php echo Url::log($value['gid']); ?>"><?php echo subString(strip_tags($value['title']),0,16); ?></a></li>
	<?php $i++;
     }  ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：热门日志
function widget_hotlog($title){
	$index_hotlognum = Option::get('index_hotlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getHotLog($index_hotlognum);?>
	<div class="box">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="hotlog">
	<?php $i=1;
    foreach($randLogs as $value){?>
	<li>
    <?php if($i==1){?><em class="hotone"><?php echo $i;?></em>
	<?php }else if($i==2){ ?><em class="hottwo"><?php echo $i;?></em>
	<?php }else if($i==3){ ?><em class="hotthree"><?php echo $i;?></em>
	<?php }else{ ?><em class="hotSoSo"><?php echo $i;?></em><?php }?>
    <a title="<?php echo $value['title']; ?>" href="<?php echo Url::log($value['gid']); ?>"><?php echo subString(strip_tags($value['title']),0,16); ?></a></li>
	<?php $i++;
     }  ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：随机日志
function widget_random_log($title){
	$index_randlognum = Option::get('index_randlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getRandLog($index_randlognum);?>
	<div class="box">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="randlog">
	<?php $i=1;
    foreach($randLogs as $value){?>
	<li>
    <?php if($i==1){?><em class="hotone"><?php echo $i;?></em>
	<?php }else if($i==2){ ?><em class="hottwo"><?php echo $i;?></em>
	<?php }else if($i==3){ ?><em class="hotthree"><?php echo $i;?></em>
	<?php }else{ ?><em class="hotSoSo"><?php echo $i;?></em><?php }?>
    <a title="<?php echo $value['title']; ?>" href="<?php echo Url::log($value['gid']); ?>"><?php echo subString(strip_tags($value['title']),0,16); ?></a></li>
	<?php $i++;
     }  ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：搜索
function widget_search($title){ ?>
	<div class="box">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="logserch">
	<form name="keyform" method="get" id="searchform" action="<?php echo BLOG_URL; ?>index.php">
	<input type="text" name="keyword" class="search" placeholder="搜搜更健康">
	</form>
	</ul>
	</div>
<?php } ?>
<?php
//widget：归档
function widget_archive($title){
	global $CACHE; 
	$record_cache = $CACHE->readCache('record');
	?>
	<div class="box">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="record">
	<?php foreach($record_cache as $value): ?>
	<li><a href="<?php echo Url::record($value['date']); ?>"><?php echo $value['record']; ?>(<?php echo $value['lognum']; ?>)</a></li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php } ?>
<?php
//widget：自定义组件
function widget_custom_text($title, $content){ ?>
	<div class="box">
	<h3><span><?php echo $title; ?></span></h3>
	<ul>
	<?php echo $content; ?>
	</ul>
	</div>
<?php } ?>
<?php
//widget：链接
function widget_link($title){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
	?>
	<div class="box">
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="link">
	<?php foreach($link_cache as $value): ?>
	<li><a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank">
	<img class="favicon" src="http://www.google.com/s2/favicons?domain=<?php echo $value['url']; ?>"><?php echo subString(strip_tags($value['link']),0,12); ?>
	</a></li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
<?php
//blog：导航
function blog_navi(){
	global $CACHE;
	$navi_cache = $CACHE->readCache('navi');
	?>
	<ul>
	<?php
	foreach($navi_cache as $value):
		if($value['url'] == 'admin' && (ROLE == 'admin' || ROLE == 'writer')):
			?>
			<?php
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
		$value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
		$current_tab = (BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url']) ? 'current' : 'common';
		?>
		<li class="<?php echo $current_tab;?>"><a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a></li>
		<?php endforeach; ?>
	</ul>
<?php }?>
<?php
//blog：置顶
function topflg($istop){
	$topflg = $istop == 'y' ? "<span class=\"label-important\">推荐</span><i class=\"label-arrow\"></i>" : '';
	echo $topflg;
}
?>
<?php
//blog：编辑
function editflg($logid,$author){
	$editflg = ROLE == 'admin' || $author == UID ? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'">编辑</a>' : '';
	echo $editflg;
}
?>
<?php
//blog：分类
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
	<a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>" title="查看<?php echo $log_cache_sort[$blogid]['name']; ?>下的全部文章"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
	<?php else: ?>
	<?php echo "未分类"; ?>
	<?php endif;?>
<?php }?>
<?php
//blog：日志标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= " <a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'  </a>';
		}
		echo $tag;
	}
	else {$tag = '这篇文章木有标签';
		echo $tag;}
}
?>
<?php
//blog：日志作者
function blog_author($uid){
	global $CACHE;
	$user_cache = Cache::getInstance()->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	if($mail!==($user_cache[1]['mail'])){ $title = !empty($mail) || !empty($des) ? "title=\"特邀作者\"" : '';}else{$title = !empty($mail) || !empty($des) ? "title=\"丐帮帮主\"" : '';}
	echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
?>
<?php
//blog：相邻日志
function neighbor_log($neighborLog){
	extract($neighborLog);?>
	<?php if($prevLog):?>
	<span class="neigh"><a href="<?php echo Url::log($prevLog['gid']) ?>">&laquo;<?php echo $prevLog['title'];?></a></span>
	<?php endif;?>
	<?php if($nextLog && $prevLog):?>|
	<?php endif;?>
	<?php if($nextLog):?>
	<span class="neigh"><a href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title'];?>&raquo;</a></span>
	<?php endif;?>
<?php }?>
<?php
//blog：评论列表
function blog_comments($comments,$params){
    extract($comments);
    if($commentStacks): ?>
	<a name="comments"></a>
	<?php endif; ?>
	<div class="commentlist">
	<?php if(empty($comments)){;}else{echo '
	<div class="timeline_container">
    <div class="timeline">
    <div class="plus"></div>
    <div class="plus2"></div>
    </div>
	</div>';} ?>
    <?php
	$isGravatar = Option::get('isgravatar');
	$comnum = count($comments);
	foreach($comments as $value){
	if($value['pid'] != 0){
	$comnum--;
	}
	}
	$pageKey=array_search('comment-page',$params); 
	if ($pageKey===false){ 
		$page=1; 
	} 
	else{ 
		$pageKey++; 
		$page = isset($params[$pageKey])?intval($params[$pageKey]):1; 
	}
	$i= $comnum - ($page - 1)*Option::get('comment_pnum');
	foreach($commentStacks as $cid):
	$comment = $comments[$cid];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	$b=array("zorro/logcmt/01.jpg"=>"01","zorro/logcmt/02.jpg"=>"02","zorro/logcmt/03.jpg"=>"03","zorro/logcmt/04.jpg"=>"04","zorro/logcmt/05.jpg"=>"05","zorro/logcmt/06.jpg"=>"06","zorro/logcmt/07.jpg"=>"07","zorro/logcmt/08.jpg"=>"08","zorro/logcmt/09.jpg"=>"09","zorro/logcmt/10.jpg"=>"10","zorro/logcmt/11.jpg"=>"11","zorro/logcmt/12.jpg"=>"12","zorro/logcmt/13.jpg"=>"13","zorro/logcmt/14.jpg"=>"14");
	$comment['content'] = preg_replace("/\[F(([1-4]?[0-9])|50)\]/",'<img class="facer" src="http://www.zorrorun.com/content/templates/BM_2.2/zorro/face/$1.gif" alt="" />',$comment['content']);
	$comment['content'] = preg_replace("/\[img=?\]*(.*?)(\[\/img)?\]/e", '"<img class=\"contimg\" src=\"$1\" alt=\"" . basename("$1") . "\" />"', $comment['content']);
	?>
	<div class="comment" id="comment-<?php echo $comment['cid']; ?>">
      <div class="comment-body">
	  <a name="<?php echo $comment['cid']; ?>"></a>
      <?php if($isGravatar == 'y'): ?>
	  <img width="160px" height="160px" src="<?php if(empty($comment['mail'])){ echo TEMPLATE_URL;echo array_rand($b);}else{echo getGravatar($comment['mail']);} ?>" class="avatar" />
	  <?php endif; ?>
	  <h4><?php echo $comment['poster']; ?></h4>
	  <div class="timer">
	  <?php echo $comment['date']; ?>
	  <b><?php if($i>3) echo ''.$i.'楼';elseif($i==3) echo '地板';elseif($i==2) echo '板凳';elseif($i==1)echo '沙发'; ?></b>
	  </div>
      <div class="content"><?php echo $comment['content']; ?></div>
	  <div class="reply">
	  <a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">[回复]</a>
	  </div>
	  <span></span>
	  <a title="<?php echo $comment['date']; ?>"><em></em></a>
      </div>
	  <?php blog_comments_children($comments, $comment['children']); $ii=0;?>
	</div>
	<div style="clear:both;"></div>
	<?php $i--;endforeach; ?>
	</div>
    <div id="pagenavi">
	<?php echo $commentPageUrl;?>
    </div>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	foreach($children as $child):
	$comment = $comments[$child];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank" rel="nofollow">'.$comment['poster'].'</a>' : $comment['poster'];
	$b=array("zorro/logcmt/01.jpg"=>"01","zorro/logcmt/02.jpg"=>"02","zorro/logcmt/03.jpg"=>"03","zorro/logcmt/04.jpg"=>"04","zorro/logcmt/05.jpg"=>"05","zorro/logcmt/06.jpg"=>"06","zorro/logcmt/07.jpg"=>"07","zorro/logcmt/08.jpg"=>"08","zorro/logcmt/09.jpg"=>"09","zorro/logcmt/10.jpg"=>"10","zorro/logcmt/11.jpg"=>"11","zorro/logcmt/12.jpg"=>"12","zorro/logcmt/13.jpg"=>"13","zorro/logcmt/14.jpg"=>"14");
	$comment['content'] = preg_replace("/\[F(([1-4]?[0-9])|50)\]/",'<img class="facer" src="http://www.zorrorun.com/content/templates/BM_2.2/zorro/face/$1.gif" alt="" />',$comment['content']);
	$comment['content'] = preg_replace("/\[img=?\]*(.*?)(\[\/img)?\]/e", '"<img class=\"contimg\" src=\"$1\" alt=\"" . basename("$1") . "\" />"', $comment['content']);
	?>
	<div class="comment comment-children<?php if($ii==0):?> first<?php $ii++; endif; ?>" id="comment-<?php echo $comment['cid']; ?>">
      <div class="comment-body">
	  <a name="<?php echo $comment['cid']; ?>"></a>
      <?php if($isGravatar == 'y'): ?>
	  <img src="<?php if(empty($comment['mail'])){ echo TEMPLATE_URL;echo array_rand($b);}else{echo getGravatar($comment['mail']);} ?>" class="avatar" />
	  <?php endif; ?>
	  <h4><?php echo $comment['poster']; ?></h4>
	  <div class="timer"><?php echo $comment['date']; ?></div>
      <div class="content"><?php echo $comment['content']; ?></div>
	  <div class="reply">
	  <a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">[回复]</a>
	  </div> 
	  <span></span>	
	  <a title="<?php echo $comment['date']; ?>"><em></em></a>
      </div>
	  <?php blog_comments_children($comments, $comment['children']); $ii++;?>
	</div>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
	<div id="comment-place">
	<div class="comment-post" id="comment-post">
		<div class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()">[取消回复]</a></div>
		<h3 style="margin-bottom:-15px"><?php if(empty($ckname)){ echo "你肿么看？";}else if($ckname=='匿名'){ echo "匿名评论&nbsp;请叫我雷锋~";}else{echo $ckname;echo "大神&nbsp;好厉害啊~";} ?> <a title="大神们都肿么看？" style="color:#606060" id="go-comment-place">↓</a><a name="respond"></a></h3>
		<form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
			<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
			<?php if(ROLE == 'visitor'): ?>
			<?php endif; ?>
			<p class="num">你还可以输入 <i id="num">250</i>/250 个字</p>
			<p><textarea onkeyup="checkLength(this);" name="comment" id="comment" class="post-area" rows="10" tabindex="4" placeholder="让评论变得如此简单。"></textarea></p>
			<div class="smilebg"><div class="smile"><div class="arrow"></div><?php include View::getView('smiley');?></div></div>
			<div class="sbsb">
			<div title="插入表情" onclick="embedSmiley()" class="face"></div>
			<div title="插入图片" onclick="embedImage()" class="imge"></div>
			<?php echo $verifyCode; ?> 
			<button class="open2" type="button" id="submit" tabindex="6">提交评论</button>
			<button type="reset"  id="reset" name="reset" tabindex="7" />清除</button>
			</div>
			<div class="tijiao">
			<p style="margin-top:-5px;" class="close2">评论信息框<a href="javascript:;" title="关闭"></a></p>
			<div id="guest_avatar">
			<img src="<?php echo getGravatar($ckmail, 80); ?>" id="realtime_avatar" class="avatar" />
			</div>
			<p>
			<input class="tex" type="text" name="comname" maxlength="49" value="<?php if(empty($ckname)){ echo "匿名";}else{echo $ckname;} ?>" size="22" tabindex="1" placeholder="必填">
			<label for="author">名字:</label>
			</p>
			<p>
			<input class="tex" type="email" name="commail" id="email" maxlength="128"  value="<?php echo $ckmail; ?>" size="22" tabindex="2" placeholder="选填">
			<label for="email">邮箱:</label>
			</p>
			<p>
			<input class="tex" type="text" id="comurl" name="comurl" maxlength="128" class="respondtext" value="<?php echo $ckurl; ?>" size="22" tabindex="3" placeholder="选填" pattern="((http|https)://|)+([\w-]+\.)+[\w-]+(/[\w- ./?%&=]*)?"/>
			<label for="url">网址:</label>
			</p>
			<p><button type="submit" id="usb" tabindex="6">发表评论</button></p>
			</div>
			<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
		</form>
	</div>
	</div>
	<?php endif; ?>
<?php }?>