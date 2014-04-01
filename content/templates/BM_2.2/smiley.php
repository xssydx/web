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
?>
<script type="text/javascript" language="javascript">
    function grin(tag) {
    	var myField;
    	tag = '' + tag + '';
        if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
    		myField = document.getElementById('comment');
    	} else {
    		return false;
    	}
    	if (document.selection) {
    		myField.focus();
    		sel = document.selection.createRange();
    		sel.text = tag;
    		myField.focus();
    	}
    	else if (myField.selectionStart || myField.selectionStart == '0') {
    		var startPos = myField.selectionStart;
    		var endPos = myField.selectionEnd;
    		var cursorPos = endPos;
    		myField.value = myField.value.substring(0, startPos)
    					  + tag
    					  + myField.value.substring(endPos, myField.value.length);
    		cursorPos += tag.length;
    		myField.focus();
    		myField.selectionStart = cursorPos;
    		myField.selectionEnd = cursorPos;
    	}
    	else {
    		myField.value += tag;
    		myField.focus();
    	}
    }
</script>
<a href="javascript:grin('[F1]')" title="微笑"><img src="<?php echo TEMPLATE_URL; ?>zorro/face/1.gif" alt="微笑"/></a>
<a href="javascript:grin('[F2]')" title="大笑"><img src="<?php echo TEMPLATE_URL; ?>zorro/face/2.gif" alt="大笑"/></a>
<a href="javascript:grin('[F3]')" title="拽"><img src="<?php echo TEMPLATE_URL; ?>zorro/face/3.gif" alt="拽"/></a>
<a href="javascript:grin('[F4]')" title="大哭"><img src="<?php echo TEMPLATE_URL; ?>zorro/face/4.gif" alt="大哭"/></a>
<a href="javascript:grin('[F5]')" title="亲亲"><img src="<?php echo TEMPLATE_URL; ?>zorro/face/5.gif" alt="亲亲"/></a>
<a href="javascript:grin('[F6]')" title="流汗"><img src="<?php echo TEMPLATE_URL; ?>zorro/face/6.gif" alt="流汗"/></a>
<a href="javascript:grin('[F7]')" title="喷血"><img src="<?php echo TEMPLATE_URL; ?>zorro/face/7.gif" alt="喷血"/></a>
<a href="javascript:grin('[F8]')" title="奸笑"><img src="<?php echo TEMPLATE_URL; ?>zorro/face/8.gif" alt="奸笑"/></a>
<a href="javascript:grin('[F9]')" title="囧"><img src="<?php echo TEMPLATE_URL; ?>zorro/face/9.gif" alt="囧"/></a>
<a href="javascript:grin('[F10]')" title="不爽"><img src="<?php echo TEMPLATE_URL; ?>zorro/face/10.gif" alt="不爽"/></a>
<a href="javascript:grin('[F11]')" title="晕"><img src="<?php echo TEMPLATE_URL; ?>zorro/face/11.gif" alt="晕"/></a>
<a href="javascript:grin('[F12]')" title="示爱"><img src="<?php echo TEMPLATE_URL; ?>zorro/face/12.gif" alt="示爱"/></a>
<a href="javascript:grin('[F13]')" title="害羞"><img src="<?php echo TEMPLATE_URL; ?>zorro/face/13.gif" alt="害羞"/></a>
<a href="javascript:grin('[F14]')" title="吃惊"><img src="<?php echo TEMPLATE_URL; ?>zorro/face/14.gif" alt="吃惊"/></a>
<a href="javascript:grin('[F15]')" title="惊叹"><img src="<?php echo TEMPLATE_URL; ?>zorro/face/15.gif" alt="惊叹"/></a>
<a href="javascript:grin('[F16]')" title="爱你"><img src="<?php echo TEMPLATE_URL; ?>zorro/face/16.gif" alt="爱你"/></a>
<a href="javascript:grin('[F17]')" title="吓死了"><img src="<?php echo TEMPLATE_URL; ?>zorro/face/17.gif" alt="吓死了"/></a>
<a href="javascript:grin('[F18]')" title="呵呵"><img src="<?php echo TEMPLATE_URL; ?>zorro/face/18.gif" alt="呵呵"/></a>