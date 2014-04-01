<?php
/*
Plugin Name: 图片加水印
Version:1.2
Plugin URL:http://codespeaking.com/?post=75
Description: 上传图片时给图片加水印(会影响缩略图)
Author:roberson
Author Email: coderzheng@foxmail.com
Author URL: http://codespeaking.com
*/

if(!defined('EMLOG_ROOT')) {exit('error!');};
include_once(EMLOG_ROOT.'/content/plugins/water_mark/water_mark_config.php');

function water_mark_menu()//写入插件导航
{
	echo '<div class="sidebarsubmenu" id="water_mark"><a href="./plugin.php?plugin=water_mark">图片水印设置</a></div>';
}
addAction('adm_sidebar_ext', 'water_mark_menu');

$choose = water_mark_position;

function getPosition($xy, $src_w, $src_h, $des_w, $des_h, $choose) {
    global $choose;
	switch ($choose) {
		case '1': // 左上角
			$pos = 0;
			break;
		case '2': // 右上角
			$pos = ($xy=='x'?$src_w-$des_w:0);
			break;
		case '3': // 左下角
			$pos = ($xy=='x'?0:$src_h-$des_h);
			break;
		case '4': // 右下角
			$pos = ($xy=='x'?$src_w-$des_w:$src_h-$des_h);
			break;
		case '5': // 中心
			$pos = ($xy=='x'?($src_w-$des_w)/2:($src_h-$des_h)/2); 
			break;
		default:
			$pos = ($xy=='x'?$src_w-$des_w:$src_h-$des_h);
			break;
	}
	return $pos;
}

function add_water_mark_2image(&$tmpFile) {
    global $isIcon;
 
    $tmpFileInfo = getimagesize($tmpFile);
    if ($tmpFileInfo[2]<=0 || $tmpFileInfo[2]>=4) {
           return false;
    }
	if (!function_exists('ImageCreate')) {
		return false;
	}
    if ($isIcon) {
        return false;
    }
    $waterImgsPath = EMLOG_ROOT.water_mark_image_path;
    
    // 载入图像
    switch ($tmpFileInfo[2]) { 
        case 1: 
            $imagen1 = imagecreatefromgif($tmpFile); 
            break; 
        case 2: 
            $imagen1 = imagecreatefromjpeg($tmpFile); 
            break; 
        case 3: 
            $imagen1 = imagecreatefrompng($tmpFile); 
            break;
        default:
            break;
    }

    // 设置一组信息以便于后续判断
    $w = $tmpFileInfo[0];
    $x1 = $w - water_mark_big_image_width;
    $x2 = $w - water_mark_medium_image_width;
    $x3 = $w - water_mark_small_image_width;
    $h = $tmpFileInfo[1];
    $y1 = $h - water_mark_big_image_height;
    $y2 = $h - water_mark_medium_image_height;
    $y3 = $h - water_mark_small_image_height;

    // 获取水印图像并加水印
    if ($x1>=0 && $y1>=0) {
    	$imagen2 = imagecreatefrompng($waterImgsPath.water_mark_big_image_name);
    	imagecopy($imagen1, $imagen2, getPosition('x',$w,$h,water_mark_big_image_width,water_mark_big_image_height,$choose), getPosition('y',$w,$h,water_mark_big_image_width,water_mark_big_image_height,$choose), 0, 0, water_mark_big_image_width, water_mark_big_image_height); // 将$imagen2图像的一部分, 复制到$imagen1中
    } elseif ($x2>=0 && $y2>=0) {
    	$imagen2 = imagecreatefrompng($waterImgsPath.water_mark_medium_image_name);
    	imagecopy($imagen1, $imagen2, getPosition('x',$w,$h,water_mark_medium_image_width,water_mark_medium_image_height,$choose), getPosition('y',$w,$h,water_mark_medium_image_width,water_mark_medium_image_height,$choose), 0, 0, water_mark_medium_image_width, water_mark_medium_image_height);
    } else {
    	$imagen2 = imagecreatefrompng($waterImgsPath.water_mark_small_image_name);
    	imagecopy($imagen1, $imagen2, getPosition('x',$w,$h,water_mark_small_image_width,water_mark_small_image_height,$choose), getPosition('y',$w,$h,water_mark_small_image_width,water_mark_small_image_height,$choose), 0, 0, water_mark_small_image_width, water_mark_small_image_height);
    }
    
    // 覆盖原图片
    switch ($tmpFileInfo[2]) {
        case 1:
            imagegif($imagen1, $tmpFile);
            break;
        case 2:
            imagejpeg($imagen1, $tmpFile);
            break;
        case 3: 
            imagepng($imagen1, $tmpFile);
            break;
        default:
            break;
    }
    
    // 释放内存
    imagedestroy($imagen2);
    imagedestroy($imagen1);
    return true;
}

switch(water_mark_place){
	case 'log':
		addAction('attach_upload', 'add_water_mark_2image');
		break;
	case 'kl_album':
		addAction('kl_album_upload', 'add_water_mark_2image');
		break;
	case 'log&kl_album':
		addAction('attach_upload', 'add_water_mark_2image');
		addAction('kl_album_upload', 'add_water_mark_2image');
		break;
	default:
		break;
}
