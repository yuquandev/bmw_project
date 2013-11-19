<?php $this->beginContent('//index/header'); ?>
<?php $this->endContent(); ?>
<!--图片欣赏-->
<script type="text/javascript"> 
//数据源 
var imgArray = []; //img数组 也就是数据来源 
var textArray = []; //img底下的文字和img对应
var srcArray = []; //超链接

<?php foreach ($all_img as $_key=>$_value){
    echo "textArray[{$_key}] = '{$_value['name']}';";
    echo "imgArray[{$_key}] = '{$_value['image_url']}';";
    echo "srcArray[{$_key}] = '/index.php/index/footerlg?id={$_value['id']},2';"; 
}
?>
</script> 
<!-- </volist> -->
<script type="text/javascript">
 window.onload = function () { 
//初始参数 
var reset = 0; //某些滚动条会触发三次scroll事件 用这个解决 
var surplusHeight = 800; //差值 
var imgWidth = "285px"; //img的宽度 
var imgHeight = "196px"; //img的高度 
var textHeight = 0; //文字高度 
var showTopButtonHeight = 500;//回到顶部按钮的距离 
var bigDivCount = 4; 
var div1 = $("one"); 
var div2 = $("two"); 
var div3 = $("three"); 
//var div4 = $("four"); 
var loading = $("loading"); 
var toTop = $("toTop"); 
//得到浏览器的名称 
var browser = getBrowser(); 

//if(document.getElementById("count").value%4==0){
//var bigCount  = document.getElementById("count").value/4 ; 
//}else{
//var bigCount  = document.getElementById("count").value/4 + 1; 
//}
var bigCount=8;
var loop=0;
var cou=0;
//初始化 
loadImg(); 
//主会场 
window.onscroll = fun_scroll; 
//滚动方法 
function fun_scroll() { 
//body的高度 
var topAll = (browser == "Firefox") ? document.documentElement.scrollHeight : document.body.scrollHeight; 
//卷上去的高度 
var top_top = document.body.scrollTop || document.documentElement.scrollTop; 
//回到顶部按钮操作 
if (top_top > showTopButtonHeight) 
toTop.style.display = "block"; 
else 
toTop.style.display = "none"; 
//控制滚动条次数以及判断是否到达底部 
if (reset == 0) { 
var topAll = (browser == "Firefox") ? document.documentElement.scrollHeight : document.body.scrollHeight; //body的高度 
var top_top = document.body.scrollTop || document.documentElement.scrollTop; //卷上去的高度 
var result = topAll - top_top; 
if (loop <=bigCount) { 
setTimeout(loadImg, 500); 
reset = 1; 
} 
} else { 
setTimeout(function () { reset = 0; }, 500); 
} 
} 
//加载图片 
function loadImg() { 
loading.style.display = "none";
loop=loop+1;
//alert(loop);alert(bigCount);
	if(loop <=bigCount){
//for (var i = 0; i < bigDivCount; i++) { 
if(imgArray[cou]!=undefined){div1.appendChild(addDiv(cou));}
if(imgArray[cou+1]!=undefined){div2.appendChild(addDiv(cou+1));} 
if(imgArray[cou+2]!=undefined){div3.appendChild(addDiv(cou+2));} 
//if(imgArray[cou+3]!=undefined){div4.appendChild(addDiv(cou+3));} 
//} 
cou =cou+3;
}
if(loop+1 <=bigCount){loading.style.display = "block";setTimeout(loadImg, 500);}
} 
//声明一个包含img和title的div 
function addDiv(j) { 
//数组下标的随机值 
//var ran = Math.round(Math.random() * (imgArray.length - 1)); 
//title层 
var small_div = document.createElement("div"); 
small_div.className="bot";
small_div.innerHTML = textArray[j]; 
//内部img 
var img = document.createElement("img"); 
img.alt = ""; 
img.src = imgArray[j]; 
img.className='aaa';
img.style.width = imgWidth; 
img.style.height = imgHeight; 
//内部超链接
var a = document.createElement("a"); 
a.href = srcArray[j];
a.target="_blank";
a.appendChild(img);
//包含img的层 
var div = document.createElement("div"); 
div.className = "content"; 
div.appendChild(a); 
div.appendChild(small_div); 
return div; 
} 
//通过id得到对象 
function $(id) { 
return document.getElementById(id); 
} 
//得到浏览器的名称 
function getBrowser() { 
var OsObject = ""; 
if (navigator.userAgent.indexOf("MSIE") > 0) { 
return "MSIE"; 
} 
if (isFirefox = navigator.userAgent.indexOf("Firefox") > 0) { 
return "Firefox"; 
} 
if (isSafari = navigator.userAgent.indexOf("Safari") > 0) { 
return "Safari"; 
} 
if (isCamino = navigator.userAgent.indexOf("Camino") > 0) { 
return "Camino"; 
} 
if (isMozilla = navigator.userAgent.indexOf("Gecko/") > 0) { 
return "Gecko"; 
} 
} 
//回到顶部 
toTop.onclick = function () { 
var count = 500; //每次的距离 
var speed = 200; //速度 
var timer = setInterval(function () { 
var top_top = document.body.scrollTop || document.documentElement.scrollTop; 
var tt = top_top - count; 
tt = (tt < 300) ? 0 : tt; 
if (top_top > 0) 
window.scrollTo(tt, tt); 
else 
clearInterval(timer); 
}, speed) 
}; 
} 
</script>
<!--图片欣赏-->
<div class="bm_index">
	<?php $this->beginContent('//index/nav'); ?>
    <?php $this->endContent(); ?>

    
    <!--作品展示-->
    <div class="bm_zpzs">
    	<div class="bm_zpzs_title">
        	<span>精彩图赏</span>
        	<a name="flow">
        </div>
        <!--图片欣赏-->
        <div class="bm_jcts_main">
        	<div class="ycsy_main" style="width:980px; margin:0 auto;overflow:hidden;">
<div class="ycsy_zj">
<div id="all" class="all"> 
<div id="one" class="number"> </div> 
<div id="two" class="number"> </div> 
<div id="three" class="number"> </div> 
<!-- <div id="four" class="number"> </div> --> 
</div> 
</div> 
<div id="loading" class="loading"> 
<img src="http://files.jb51.net/file_images/article/201211/200803131036175436.gif" /> 
</div> 
<div id="toTop"><span>△回顶部</span></div> 
</div>
</div>
</div>
        <!--图片欣赏-->
</div>
    
    
    
    <!--底部-->
     <?php $this->beginContent('//index/footer'); ?>
    <?php $this->endContent(); ?>
</div>
<!--上传图片-->
<div id="bg" class="bg" style="display:none;"></div>
<iframe id='popIframe' class='popIframe' frameborder='0' ></iframe>
</body>
</html>
