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
<div class="shuoshuo">
    <?php if(ROLE == 'admin' || ROLE == 'writer'): ?>
    <div class="top"><a href="<?php echo BLOG_URL . 'admin/twitter.php' ?>">写碎语</a></div>
    <?php endif; ?>
    <ul class="list">
    <?php 
    foreach($tws as $val):
    $author = $user_cache[$val['author']]['name'];
    $avatar = empty($user_cache[$val['author']]['avatar']) ? 
                BLOG_URL . 'admin/views/images/avatar.jpg' : 
                BLOG_URL . $user_cache[$val['author']]['avatar'];
    $tid = (int)$val['id'];
    $img = empty($val['img']) ? "" : '<a title="点击查看原图" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img style="border: 1px solid #EFEFEF;" src="'.BLOG_URL.$val['img'].'"/></a>';
    ?> 
    <li>
    <div class="avatar"><span></span><img src="<?php echo $avatar; ?>" width="50" height="50" /></div>
    <div class="content">
      <p class="arrow"></p>
      <p class="tit"><span><?php echo $author; ?></span><?php echo $val['t'].'<br/>'.$img;?></p>
      <p class="meta">
        <span class="act r"><a href="javascript:loadr('<?php echo DYNAMIC_BLOGURL; ?>?action=getr&tid=<?php echo $tid;?>','<?php echo $tid;?>');" id="<?php echo $tid;?>">评论<?php if ($val['replynum']>0):echo '(<span>'.$val['replynum'].'</span>)'; endif;?></a></span>
        <span class="timer"><?php echo $val['date'];?></span>
        <span class="arr"></span>
      </p>
      <ul id="r_<?php echo $tid;?>" class="comcont off"></ul>
      <?php if ($istreply == 'y'):?>
      <div class="huifu" id="rp_<?php echo $tid;?>">
        <p class="name"<?php if(ROLE == 'admin' || ROLE == 'writer'){echo ' style="display:none"';}?>><input type="text" id="rname_<?php echo $tid; ?>" value="" placeholder="昵称" /> 昵称(必填)</p>
        <p class="comm"><textarea id="rtext_<?php echo $tid; ?>" placeholder="评论内容" onfocus="comfocus(<?php echo $tid; ?>)"></textarea>
          <span id="ssface" class="no"></span>
        </p>
        <p class="btn">
          <span class="send r"><input class="button" type="button" onclick="reply('<?php echo DYNAMIC_BLOGURL; ?>index.php?action=reply',<?php echo $tid;?>);" value="回复" /></span>
          <span class="code"<?php if($reply_code == 'n'){echo ' style="display:none"';}?>><input type="text" id="rcode_<?php echo $tid; ?>" value="" /><?php echo $rcode; ?></span>
        </p>
        <p class="msg"><span id="rmsg_<?php echo $tid; ?>" style="color:#FF0000"></span></p>
        <br clear="all" />
      </div>
    <?php endif;?>
    </div>   	
    </li>
    <?php endforeach;?>
	<div id="pagenavi"><?php echo $pageurl;?></div>
    </ul>
</div>
</div>
<?php
 include View::getView('side');
 include View::getView('footer');
?>