(function($){$.fn.jCarouselLite=function(o){o=$.extend({btnPrev:null,btnNext:null,btnGo:null,mouseWheel:false,auto:null,speed:1000,easing:null,vertical:false,circular:true,visible:3,start:0,scroll:3,beforeStart:null,afterEnd:null},o||{});return this.each(function(){var b=false,animCss=o.vertical?"top":"left",sizeCss=o.vertical?"height":"width";var c=$(this),ul=$("ul",c),tLi=$("li",ul),tl=tLi.size(),v=o.visible;if(o.circular){ul.prepend(tLi.slice(tl-v-1+1).clone()).append(tLi.slice(0,v).clone());o.start+=v}var f=$("li",ul),itemLength=f.size(),curr=o.start;c.css("visibility","visible");f.css({overflow:"hidden",float:o.vertical?"none":"left"});ul.css({margin:"0",padding:"0",position:"relative","list-style-type":"none","z-index":"1"});c.css({overflow:"hidden",position:"relative","z-index":"2",left:"0px"});var g=o.vertical?height(f):width(f);var h=g*itemLength;var j=g*v;f.css({width:f.width(),height:f.height()});ul.css(sizeCss,h+"px").css(animCss,-(curr*g));c.css(sizeCss,j+"px");if(o.btnPrev)$(o.btnPrev).click(function(){return go(curr-o.scroll)});if(o.btnNext)$(o.btnNext).click(function(){return go(curr+o.scroll)});if(o.btnGo)$.each(o.btnGo,function(i,a){$(a).click(function(){return go(o.circular?o.visible+i:i)})});if(o.mouseWheel&&c.mousewheel)c.mousewheel(function(e,d){return d>0?go(curr-o.scroll):go(curr+o.scroll)});if(o.auto)setInterval(function(){go(curr+o.scroll)},o.auto+o.speed);function vis(){return f.slice(curr).slice(0,v)};function go(a){if(!b){if(o.beforeStart)o.beforeStart.call(this,vis());if(o.circular){if(a<=o.start-v-1){ul.css(animCss,-((itemLength-(v*2))*g)+"px");curr=a==o.start-v-1?itemLength-(v*2)-1:itemLength-(v*2)-o.scroll}else if(a>=itemLength-v+1){ul.css(animCss,-((v)*g)+"px");curr=a==itemLength-v+1?v+1:v+o.scroll}else curr=a}else{if(a<0||a>itemLength-v)return;else curr=a}b=true;ul.animate(animCss=="left"?{left:-(curr*g)}:{top:-(curr*g)},o.speed,o.easing,function(){if(o.afterEnd)o.afterEnd.call(this,vis());b=false});if(!o.circular){$(o.btnPrev+","+o.btnNext).removeClass("disabled");$((curr-o.scroll<0&&o.btnPrev)||(curr+o.scroll>itemLength-v&&o.btnNext)||[]).addClass("disabled")}}return false}})};function css(a,b){return parseInt($.css(a[0],b))||0};function width(a){return a[0].offsetWidth+css(a,'marginLeft')+css(a,'marginRight')};function height(a){return a[0].offsetHeight+css(a,'marginTop')+css(a,'marginBottom')}})(jQuery);



$(function() {
$("#botton-scroll").jCarouselLite({
btnNext: ".next",
btnPrev: ".prev"
});
});

$(function () {
$('#top-menu li').hover(
function () {$('ul', this).slideDown(200);}, 
function () {$('ul', this).slideUp(200);
});
});

$(function () {
$(".click").click(function(){
$("#panel").slideToggle("slow");
$(this).toggleClass("active"); return false;
}); 
});

$(function () {
$('.fade').hover(
function() {$(this).fadeTo("slow", 0.5);},
function() {$(this).fadeTo("slow", 5);
});
});




$(function() {
$("#botton-scroll2").jCarouselLite({
btnNext: ".next2",
btnPrev: ".prev2"
});
});

$(function () {
$('#top-menu2 li').hover(
function () {$('ul', this).slideDown(200);}, 
function () {$('ul', this).slideUp(200);
});
});

$(function () {
$(".click2").click(function(){
$("#panel2").slideToggle("slow");
$(this).toggleClass("active"); return false;
}); 
});

$(function () {
$('.fade').hover(
function() {$(this).fadeTo("slow", 0.5);},
function() {$(this).fadeTo("slow", 5);
});
});



















function Show_menuTab012(menuTabid_num,menuTabnum){
	for(var i=0;i<3;i++){
		document.getElementById("menuTabcontent012_"+menuTabid_num+i).style.display="none";

		document.getElementById("menuTabmenu012_"+menuTabid_num+i).className="hymenuoff";
	}
	document.getElementById("menuTabmenu012_"+menuTabid_num+menuTabnum).className="hymenuon";
	document.getElementById("menuTabcontent012_"+menuTabid_num+menuTabnum).style.display="block";
}

function Show_menuTab013(menuTabid_num,menuTabnum){
	for(var i=0;i<3;i++){
		document.getElementById("menuTabcontent013_"+menuTabid_num+i).style.display="none";

		document.getElementById("menuTabmenu013_"+menuTabid_num+i).className="hymenuoff";
	}
	document.getElementById("menuTabmenu013_"+menuTabid_num+menuTabnum).className="hymenuon";
	document.getElementById("menuTabcontent013_"+menuTabid_num+menuTabnum).style.display="block";
}





/*������*/

$(function(){
	$("#a1").click(function(){
		$("#popDiv").hide();
		$("#bg").hide();
		$("#popIframe").hide();
	});
});
function showDiv(){
document.getElementById('popDiv').style.display='block';
document.getElementById('popIframe').style.display='block';
document.getElementById('bg').style.display='block';
}
function closeDiv(){
document.getElementById('popDiv').style.display='none';
document.getElementById('bg').style.display='none';
document.getElementById('popIframe').style.display='none';
}



$(function(){
	$("#a1").click(function(){
		$("#popDiv2").hide();
		$("#bg").hide();
		$("#popIframe").hide();
	});
});
function showDiv2(){
document.getElementById('popDiv2').style.display='block';
document.getElementById('popIframe').style.display='block';
document.getElementById('bg').style.display='block';
}
function closeDiv2(){
document.getElementById('popDiv2').style.display='none';
document.getElementById('bg').style.display='none';
document.getElementById('popIframe').style.display='none';
}


$(function(){
	$("#a1").click(function(){
		$("#popDiv3").hide();
		$("#bg").hide();
		$("#popIframe").hide();
	});
});
function showDiv3(){
document.getElementById('popDiv3').style.display='block';
document.getElementById('popIframe').style.display='block';
document.getElementById('bg').style.display='block';
}
function closeDiv3(){
document.getElementById('popDiv3').style.display='none';
document.getElementById('bg').style.display='none';
document.getElementById('popIframe').style.display='none';
}


function showDiv4(){
	document.getElementById('popDiv4').style.display='block';
	document.getElementById('popIframe').style.display='block';
	document.getElementById('bg').style.display='block';
	}
	function closeDiv4(){
	document.getElementById('popDiv4').style.display='none';
	document.getElementById('bg').style.display='none';
	document.getElementById('popIframe').style.display='none';
	}
