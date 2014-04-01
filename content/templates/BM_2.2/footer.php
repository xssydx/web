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
</div>
<div class="clear"></div>
<div id="footer">
<!--更改2013-05-01建站日期即可-->
<div class="copyright">
©2012-<?php echo date('Y',time())?> <?php echo $blogname; ?> 
<?php echo $footer_info; ?> 网站已安全运行<?php echo floor((time()-strtotime("2013-05-01"))/86400); ?>天 <a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $icp; ?></a> <?php doAction('index_footer'); ?> <div style="float:right">由<span class="footera"><a href="http://www.emlog.net" target="_blank">EMLOG</a></span>强力驱动 主题由<span class="footera"><a href="http://www.zorrorun.com" target="_blank">麦特佐罗</a></span>设计</div>
</div>
</div>
</div>
<div id="circle"></div>
<div id="circletext"></div>
<div id="circle1"></div>
<script>
$(function() {          
$("img").not(".grid img,#sidebar img").lazyload({
placeholder:"<?php echo TEMPLATE_URL; ?>zorro/images/image-pending.gif",
effect:"fadeIn"
});
});
</script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>zorro/common.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>zorro/lazyload.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>zorro/realgravatar.js"></script>
</body>
</html>