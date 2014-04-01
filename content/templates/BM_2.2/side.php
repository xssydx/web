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
<dl id="sidebar">
    <?php
    $widgets = !empty($options_cache['widgets1']) ? unserialize($options_cache['widgets1']) : array();
    doAction('diff_side');
    foreach ($widgets as $val) {
        $widget_title = @unserialize($options_cache['widget_title']);
        $custom_widget = @unserialize($options_cache['custom_widget']);
        if (strpos($val, 'custom_wg_') === 0) {
            $callback = 'widget_custom_text';
            if (function_exists($callback)) {
                call_user_func($callback, htmlspecialchars($custom_widget[$val]['title']), $custom_widget[$val]['content']);
            }
        } else {
            $callback = 'widget_' . $val;
            if (function_exists($callback)) {
                preg_match("/^.*\s\((.*)\)/", $widget_title[$val], $matchs);
                $wgTitle = isset($matchs[1]) ? $matchs[1] : $widget_title[$val];
                call_user_func($callback, htmlspecialchars($wgTitle));
            }
        }
    }
    ?>
<!--广告图片开始-->
<!--广告图片替换zorro/images/side.jpg-->
<div id="box">
<div id="float" class="div1">
<a href="<?php echo BLOG_URL; ?>post/47" title="你能来看看我吗？"><img class="sideimg" src="<?php echo TEMPLATE_URL; ?>zorro/images/side.jpg" border="0" /></a>
<div class="clear"></div>
</div>
</div>
<script>
(function(){
    var oDiv=document.getElementById("float");
    var H=0,iE6;
    var Y=oDiv;
    while(Y){H+=Y.offsetTop;Y=Y.offsetParent};
    iE6=window.ActiveXObject&&!window.XMLHttpRequest;
    if(!iE6){
        window.onscroll=function()
        {
            var s=document.body.scrollTop||document.documentElement.scrollTop;
            if(s>H){oDiv.className="div1 div2";if(iE6){oDiv.style.top=(s-H)+"px";}}
            else{oDiv.className="div1";}
        };
    }

})();
</script>
<!--广告图片结束-->
</dl>
