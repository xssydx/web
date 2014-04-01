<?php
/*
Plugin Name: 文章缩略图
Version: 1.2
Plugin URL:http://www.jinlin520.cn
Description: 给文章添加封面
Author: 悦宝盒
Author Email: 516293816@qq.com
Author URL: http://www.jinlin520.cn
*/
!defined('EMLOG_ROOT') && exit('access deined!');
/*
 * 检查字段是否存在,不存在则添加字段
 */
$DB = MySql::getInstance();
$is_exist_id_query = $DB->query('describe `'.DB_PREFIX.'blog` `cover`');
$is_exist_id = $DB->num_rows($is_exist_id_query);
if(!$is_exist_id){
	$DB->query("ALTER TABLE  `".DB_PREFIX."blog` ADD  `cover` varchar(300)  DEFAULT NULL");
}
include_once 'logCover.php';
function thumb_create($logid){
	global $logData, $Log_Model;
    $Log_Model = new Log_Model();
	$DB = MySql::getInstance();
    $thumbChecked = isset($_POST['thumbCheckbox']) ? trim($_POST['thumbCheckbox']) : '';
	$content = stripslashes( $logData['content']);
	$logData['content'] = stripslashes( $logData['content']);

    if(empty($thumbChecked)) {
    	return;
    }else{
		$thumbWidth = isset($_POST['thumbWidth']) ? trim($_POST['thumbWidth']) : '';
		$thumbHeight = isset($_POST['thumbHeight']) ? trim($_POST['thumbHeight']) : '';
		$thumbNumber = isset($_POST['thumbNumber']) ? trim($_POST['thumbNumber']) : 1;
		if(empty($thumbWidth) || empty($thumbHeight) || empty($thumbNumber)){
			return;
		}else{
			$img_array = array();
			preg_match_all("/<img([^>]+)src=\"([^>\"]+)\"?([^>]*)>/i",$content,$img_array);
			if(!empty($img_array)){
				if(!empty($img_array[$thumbNumber-1])){
				preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i',$img_array[$thumbNumber-1][0],$match);
				$cover_url = $match[1];
				$uppath = Option::UPLOADFILE_PATH . gmdate('Ym') . '/';
				$imgExt  = strtolower(substr(strrchr($cover_url, "."),1));
				preg_match('/\/([^\/]+\.[a-z]+)[^\/]*$/',$cover_url,$imgName); 
				$imgName = $imgName[1];
				//$imgName = substr($imgName,strpos($imgName,"-")+1);
                $fname = 'cover'.$imgName;
				echo $thumbCut;
				$resizeimage = new resizeimage($uppath.$imgName, $thumbWidth, $thumbHeight, "0",$uppath.$fname);
				$logData['cover']= BLOG_URL.'content/uploadfile/'.gmdate('Ym').'/'.$fname;
                $Log_Model->updateLog($logData,$logid);
				};
			}
		}
	}
}
function thumb_option()
{
?>
封面图<input type="checkbox" value="1" name="thumbCheckbox" checked="checked"/>
宽<input type="text" value="210" style="width:30px"  maxLength="3" name="thumbWidth"/>高<input type="text" value="150" style="width:30px" maxLength="3" name="thumbHeight"/>第<input type="text" style="width:30px" maxLength="3" value="1" name="thumbNumber">张

<?php
}	

  addAction('adm_writelog_head', 'thumb_option');
  addAction('save_log', 'thumb_create');
?>