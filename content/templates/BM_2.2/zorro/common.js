/*
Template Name:BM_2.2免费版
Description:因为简约，所以简单。
Version:2.2免费版
Author:麦特佐罗
Author Url:http://www.zorrorun.com
Sidebar Amount:1
ForEmlog:5.21
*/
jQuery(document).ready(function(){
$("#circletext").text("加载肿");
$(window).load(function() {
$("#circle").fadeOut(400);
$("#circle1").fadeOut(600);
$("#circletext").text("完成鸟").fadeOut(800);
});
});

function embedImage() {
	var URL = prompt('请输入图片的 URL 地址（禁止不良+无聊图片）:','http://');
	if (URL) {
		document.getElementById('comment').value = document.getElementById('comment').value + '[img]' + URL + '[/img]';
	}
}

jQuery(document).ready(function(){
$(".search").focus(function(){
$(this).stop(true,false).animate({width:"150px"},"slow");
})
.blur(function(){
$(this).animate({width:"68px"},"slow");
});
})

 $(function () {
    $("#btnOO").click(function () {
    $("body").toggleClass("body"); 
    if ($("#shadowDiv").attr("class") == "showDiv") {
    $("#shadowDiv").attr("class", "hidDiv");
    } else $("#shadowDiv").attr("class", "showDiv");
    });
    })
	function kaiguan(obj){
	if(obj.innerHTML == "关灯")
	{obj.innerHTML="开灯"}
	else{obj.innerHTML="关灯"}
}

function embedSmiley() {
	if($('.smilebg').css('display')=='none'){
		$('.smilebg').slideDown(200)
	}else{
		$('.smilebg').slideUp(200)
	}
}

function checkLength(which) {
	var maxChars = 250;
	if(which.value.length > maxChars){
		alert("您已经超出250个字数!");
		which.value = which.value.substring(0,maxChars);
		return false;
	}else{
		var curr = maxChars - which.value.length;
		document.getElementById("num").innerHTML = curr.toString();
		return true;
	}
}

$(document).ready(function() { 
$('#resizer li').click(function(){
var fontSize = 13;
var name = $(this).attr('id');
if (name == 'f_s') {
fontSize -= 2
} else if (name == 'f_l') {
fontSize += 2
} else if (name == 'f_m') {
fontSize == 13
}
$('.context').css('font-size', fontSize + 'px')
});
})

function comfocus(tid){
	if($('#rp_'+tid+' p.name').css('display')=='none'){
		comm('on',tid)
	}
}
function re(tid, rp){
    var rtext=document.getElementById("rtext_"+tid).value = rp;
    focusEle("rtext_"+tid);
}
function commentReply(pid,c){
	var response = document.getElementById('comment-post');
	c.style.display = 'none';
	document.getElementById('comment-pid').value = pid;
	document.getElementById('cancel-reply').style.display = '';
	document.getElementById('comment-post').style.display = 'none';
	c.parentNode.parentNode.appendChild(response);
	$('#comment-post').fadeIn(500)
}
function cancelReply(){
	$('#comment-post').fadeOut(500,function(){
		var commentPlace = document.getElementById('comment-place'),response = document.getElementById('comment-post');
		document.getElementById('comment-pid').value = 0;
		$('.reply a').css({'display':''})
		document.getElementById('cancel-reply').style.display = 'none';
		commentPlace.appendChild(response);
		$('#comment-post').slideDown();
	})
}

$(document).ready(function() {
$('h1 a').click(function(){
myloadoriginal = this.text;
$(this).text('文章加载肿~');
var myload = this;
setTimeout(function() { $(myload).text(myloadoriginal); }, 2011);
});
});

$(document).ready(function() {
$('#twitter li,#newlog li,#randlog li,#hotlog li,#record li,#blogsort li').hover(function(){
$(this).stop().animate({marginLeft:"5px"},300);
},function(){
$(this).stop().animate({marginLeft:"0px"},300);
});
});

$(document).ready(function() {
$('#link li').hover(function(){
$(this).stop().animate({marginLeft:"-5px"},300);
},function(){
$(this).stop().animate({marginLeft:"0px"},300);
});
});

$(document).ready(function() {
$('h1 a').hover(function(){
$(this).stop().animate({marginLeft:"5px"},300);
},function(){
$(this).stop().animate({marginLeft:"0px"},300);
});
});

$(document).ready(function(){
	$("div ul").show();
	$(".box h3").click(function(){
		$(this).next("ul").slideToggle("hide");
	})
});

$(function(){
$("a,div,h3,").each(function(b){
if (this.title){
var c = this.title;
var a = 30;
var z = 15;
$(this).mouseover(function(d){
this.title="";$("body").append('<div id="tooltip">'+c+"</div>");
$("#tooltip").css({left:(d.pageX - z)+"px",top: (d.pageY + a) + "px",opacity: "1"}).fadeIn(250)}).mouseout(function(){this.title = c;$("#tooltip").remove()})
.mousemove(function(d) {
$("#tooltip").css({left:(d.pageX-z)+"px",top:(d.pageY+a)+"px"})
})}})})

$(document).ready(function() {
	$('.open2').click(function(){
		$('.tijiao').slideDown(300);
	})
	$('.close2 a').click(function(){
		$('.tijiao').slideUp(300);
	})

})

jQuery(function () {
jQuery('img').hover(
function() {jQuery(this).fadeTo("slow", 0.8);},
function() {jQuery(this).fadeTo("slow", 1);
});
});