<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
function plugin_setting_view(){
	include_once(EMLOG_ROOT.'/content/plugins/water_mark/water_mark_config.php');
?>
<script>$("#water_mark").addClass('sidebarsubmenu1');</script>
<div class=containertitle><b>图片水印设置</b>
<?php if(isset($_GET['setting'])):?><span class="actived">图片水印设置成功</span><?php endif;?>
</div>
<div class=line></div>
<pre>插件说明：
1）仅支持jpg、jpeg、png、gif四种类型图片的水印；
2）仅支持图片水印，不支持文字水印；
3）水印图片必须是png类型，并且水印图片必须在同一个文件夹下；
4）加水印逻辑：将上传图片的尺寸和水印图片尺寸(三组)进行比对，按情况对原图加水印。
5）水印图片位置默认位于原图右下角。</pre>
<div class=line></div>
<div>
<form id="form1" name="form1" method="post" action="plugin.php?plugin=water_mark&action=setting&changeinfo=1">
<table width="970" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="150"><span>水印图片文件夹路径</span></td>
<td width="820"><input name="water_mark_image_path" type="text" id="wmip" style="width:180px;" value="<?php echo water_mark_image_path;?>"/>水印图片所在文件夹（只需要填相对根目录的路径，如：/admin/views/images/waterMark/）</td></tr><tr>
<td width="150"><span>水印图片1（大）的文件名</span></td>
<td width="820"><input name="water_mark_big_image_name" type="text" id="wmbin" style="width:180px;" value="<?php echo water_mark_big_image_name;?>"/>水印图片1的名称</td></tr><tr>
<td width="150"><span>水印图片1（大）的宽度</span></td>
<td width="820"><input name="water_mark_big_image_width" type="text" id="wmbw" style="width:180px;" value="<?php echo water_mark_big_image_width;?>"/>水印图片1的宽度</td></tr><tr>
<td width="150"><span>水印图片1（大）的高度</span></td>
<td width="820"><input name="water_mark_big_image_height" type="text" id="wmbh" style="width:180px;" value="<?php echo water_mark_big_image_height;?>"/>水印图片1的高度</td></tr><tr>
<td width="150"><span>水印图片2（中）的文件名</span></td>
<td width="820"><input name="water_mark_medium_image_name" type="text" id="wmmin" style="width:180px;" value="<?php echo water_mark_medium_image_name;?>"/>水印图片2的名称</td></tr><tr>
<td width="150"><span>水印图片2（中）的宽度</span></td>
<td width="820"><input name="water_mark_medium_image_width" type="text" id="wmmw" style="width:180px;" value="<?php echo water_mark_medium_image_width;?>"/>水印图片2的宽度</td></tr><tr>
<td width="150"><span>水印图片2（中）的高度</span></td>
<td width="820"><input name="water_mark_medium_image_height" type="text" id="wmmw" style="width:180px;" value="<?php echo water_mark_medium_image_height;?>"/>水印图片2的高度</td></tr><tr>
<td width="150"><span>水印图片3（小）的文件名</span></td>
<td width="820"><input name="water_mark_small_image_name" type="text" id="wmsin" style="width:180px;" value="<?php echo water_mark_small_image_name;?>"/>水印图片3的名称</td></tr><tr>
<td width="150"><span>水印图片3（小）的宽度</span></td>
<td width="820"><input name="water_mark_small_image_width" type="text" id="wmsw" style="width:180px;" value="<?php echo water_mark_small_image_width;?>"/>水印图片3的宽度</td></tr><tr>
<td width="150"><span>水印图片3（小）的高度</span></td>
<td width="820"><input name="water_mark_small_image_height" type="text" id="wmsh" style="width:180px;" value="<?php echo water_mark_small_image_height;?>"/>水印图片3的高度</td></tr><tr>
<td width="150"><span>水印范围</span></td>
<td width="820"><label><input type="radio" name="water_mark_place" value="log" <?php if(water_mark_place=='log') echo 'checked';?> />日志</label>&nbsp;<label><input type="radio" name="water_mark_place" value="kl_album" <?php if(water_mark_place=='kl_album') echo 'checked';?> />EM相册</label>&nbsp;<label><input type="radio" name="water_mark_place" value="log&kl_album" <?php if(water_mark_place=='log&kl_album') echo 'checked';?> />日志和EM相册</label>&nbsp;&nbsp;&nbsp;水印图片的范围</td></tr><tr>
<td width="150"><span>水印图片位置</span></td>
<td width="820"><label><input type="radio" name="water_mark_position" value="1" <?php if(water_mark_position=='1') echo 'checked';?> />左上角</label>&nbsp;<label><input type="radio" name="water_mark_position" value="2" <?php if(water_mark_position=='2') echo 'checked';?> />右上角</label>&nbsp;<label><input type="radio" name="water_mark_position" value="3" <?php if(water_mark_position=='3') echo 'checked';?> />左下角</label>&nbsp;<label><input type="radio" name="water_mark_position" value="4" <?php if(water_mark_position=='4') echo 'checked';?> />右下角</label>&nbsp;<label><input type="radio" name="water_mark_position" value="5" <?php if(water_mark_position=='5') echo 'checked';?> />中心</label>&nbsp;&nbsp;&nbsp;水印图片的位置</td></tr><tr>
<td height="37">&nbsp;</td>
<td><input name="Input" type="submit" value="提交" /> <input name="Input" type="reset" value="取消" /></td>
</tr>
</table>
</form>
</div>
<div class=line></div>
<?php
}
function plugin_setting()
{
	if(isset($_GET['changeinfo']))
	{
	    $water_mark_fp = fopen(EMLOG_ROOT.'/content/plugins/water_mark/water_mark_config.php','r');
		$water_mark_config = fread($water_mark_fp,filesize(EMLOG_ROOT.'/content/plugins/water_mark/water_mark_config.php'));
		fclose($water_mark_fp);  
		$water_mark_image_path = htmlspecialchars($_POST['water_mark_image_path'], ENT_QUOTES);
		$water_mark_big_image_name = htmlspecialchars($_POST['water_mark_big_image_name'], ENT_QUOTES);
		$water_mark_big_image_height = htmlspecialchars($_POST['water_mark_big_image_height'], ENT_QUOTES);
		$water_mark_big_image_width = htmlspecialchars($_POST['water_mark_big_image_width'], ENT_QUOTES);
        $water_mark_medium_image_name = htmlspecialchars($_POST['water_mark_medium_image_name'], ENT_QUOTES);
		$water_mark_medium_image_height = htmlspecialchars($_POST['water_mark_medium_image_height'], ENT_QUOTES);
		$water_mark_medium_image_width = htmlspecialchars($_POST['water_mark_medium_image_width'], ENT_QUOTES);
        $water_mark_small_image_name = htmlspecialchars($_POST['water_mark_small_image_name'], ENT_QUOTES);
		$water_mark_small_image_height = htmlspecialchars($_POST['water_mark_small_image_height'], ENT_QUOTES);
		$water_mark_small_image_width = htmlspecialchars($_POST['water_mark_small_image_width'], ENT_QUOTES);
        $water_mark_place = $_POST['water_mark_place'];
        $water_mark_position = $_POST['water_mark_position'];
		$water_mark_patt = array(
                                "/define\('water_mark_image_path',(.*)\)/",
                                "/define\('water_mark_big_image_name',(.*)\)/",
                                "/define\('water_mark_big_image_width',(.*)\)/",
                                "/define\('water_mark_big_image_height',(.*)\)/",
                                "/define\('water_mark_medium_image_name',(.*)\)/",
                                "/define\('water_mark_medium_image_width',(.*)\)/",
                                "/define\('water_mark_medium_image_height',(.*)\)/",
                                "/define\('water_mark_small_image_name',(.*)\)/",
                                "/define\('water_mark_small_image_width',(.*)\)/",
                                "/define\('water_mark_small_image_height',(.*)\)/",
                                "/define\('water_mark_place',(.*)\)/",
                                "/define\('water_mark_position',(.*)\)/",
                              );
		$water_mark_replace = array(
                                "define('water_mark_image_path','".$water_mark_image_path."')",
                                "define('water_mark_big_image_name','".$water_mark_big_image_name."')",
                                "define('water_mark_big_image_width','".$water_mark_big_image_width."')",
                                "define('water_mark_big_image_height','".$water_mark_big_image_height."')",
                                "define('water_mark_medium_image_name','".$water_mark_medium_image_name."')",
                                "define('water_mark_medium_image_width','".$water_mark_medium_image_width."')",
                                "define('water_mark_medium_image_height','".$water_mark_medium_image_height."')",
                                "define('water_mark_small_image_name','".$water_mark_small_image_name."')",
                                "define('water_mark_small_image_width','".$water_mark_small_image_width."')",
                                "define('water_mark_small_image_height','".$water_mark_small_image_height."')",
                                "define('water_mark_place','".$water_mark_place."')",
                                "define('water_mark_position','".$water_mark_position."')",
                             );
		$water_mark_new_config = preg_replace($water_mark_patt, $water_mark_replace, $water_mark_config);
		$water_mark_fp = @fopen(EMLOG_ROOT.'/content/plugins/water_mark/water_mark_config.php','w');
		@fwrite($water_mark_fp,$water_mark_new_config);
		@fclose($water_mark_fp);
	}
}
?>

