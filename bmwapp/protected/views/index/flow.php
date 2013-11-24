<?php $this->beginContent('//index/header'); ?>

<?php $this->endContent(); ?>

<style>
.bmw_a_loading { display: block; background:url(/js/lazyload/grey.gif) no-repeat center center; }
</style>

<script type="text/javascript"> 

//数据源 

var imgArray  = []; //img数组 也就是数据来源 

var textArray = []; //img底下的文字和img对应

var srcArray  = []; //超链接

var descArray = []; //描述

<?php foreach ($all_img as $_key=>$_value){

    echo "textArray[{$_key}] = '{$_value['name']}';\n";

    echo "imgArray[{$_key}]  = '{$_value['image_url']}';\n";

    echo "srcArray[{$_key}]  = '/index.php/index/footerlg?id={$_value['id']},2';\n"; 

    echo "descArray[{$_key}] = '{$_value['description']}';\n";

}

?>

</script> 


<script type="text/javascript"> 
//数据源 
var imgArray = []; //img数组 也就是数据来源 
var textArray = []; //img底下的文字和img对应
var srcArray = []; //超链接
var descArray = []; //描述
//i=0;
</script>
<!-- <volist name="imgs" id="vo" key="k"> 
<input type="hidden" name=""id="src{$k-1}" value="{$vo.name}">
<input type="hidden" name=""id="title{$k-1}" value="{$vo.desc}">-->
<script type="text/javascript">
//textArray[i] = $("#title"+i).val(); 
//imgArray[i] = $("#src"+i).val();
//i++;
textArray[0] = "赛前培训营 北京"; 
textArray[1] = "赛前培训营 上海"; 
textArray[2] = "沙桐"; 
textArray[3] = "于嘉"; 
textArray[4] = "328Li"; 
textArray[5] = "宝马车主 Arthur Li"; 
textArray[6] = "宝马车主 Coco Yan"; 
textArray[7] = "宝马车主 Wennie Gao";  


descArray[0] = ""; 
descArray[1] = ""; 
descArray[2] = ""; 
descArray[3] = ""; 
descArray[4] = ""; 
descArray[5] = ""; 
descArray[6] = ""; 
descArray[7] = ""; 


imgArray[0] = "/pic/IMG_01.jpg"; 
imgArray[1] = "/pic/IMG_02.jpg"; 
imgArray[2] = "/pic/IMG_03.jpg"; 
imgArray[3] = "/pic/IMG_04.jpg"; 
imgArray[4] = "/pic/IMG_05.jpg"; 
imgArray[5] = "/pic/IMG_06.jpg"; 
imgArray[6] = "/pic/IMG_07.jpg"; 
imgArray[7] = "/pic/IMG_08.jpg"; 


srcArray[0] = "http://blu004150.chinaw3.com/ts/sctpx.html"; 
srcArray[1] = "http://blu004150.chinaw3.com/ts/sctpx2.html"; 
srcArray[2] = "http://blu004150.chinaw3.com/ts/sctpx3.html"; 
srcArray[3] = "http://blu004150.chinaw3.com/ts/sctpx4.html"; 
srcArray[4] = "http://blu004150.chinaw3.com/ts/sctpx5.html"; 
srcArray[5] = "http://blu004150.chinaw3.com/ts/sctpx6.html"; 
srcArray[6] = "http://blu004150.chinaw3.com/ts/sctpx7.html"; 
srcArray[7] = "http://blu004150.chinaw3.com/ts/sctpx8.html"; 

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



//描述

var desc_div = document.createElement("div"); 

desc_div.className="bot2";

desc_div.innerHTML = descArray[j]; 



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

a.className = 'bmw_a_loading';

a.target="_blank";

a.appendChild(img);

a.appendChild(small_div);

//包含img的层 

var div = document.createElement("div"); 

div.className = "content"; 

div.appendChild(a); 

div.appendChild(desc_div); 

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

</head>



<body>

<div class="bm_index">

	<?php $this->beginContent('//index/nav'); ?>

    <?php $this->endContent(); ?>



    

    <!--作品展示-->

    <div class="bm_zpzs">
<div class="bm_hd_title bm_hd_title2"><a name="flow"></a>
        	<ul>
        		<li><a href="javascript:;"  class="hymenuon" id=menuTabmenu013_11 onClick="setTimeout('Show_menuTab013(1,1)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico5.gif" /><span>精彩图赏</span></a></li>
            	<li><a href="javascript:;" class="hymenuoff" id=menuTabmenu013_10 onClick="setTimeout('Show_menuTab013(1,0)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico6.gif" /><span>精彩视频</span></a></li>
            </ul>
            <div class="bm_dl">
            	 <?php if (empty($this->userinfo)){?>
            	    <a href="javascript:com_dialog('login');">登陆 | </a><a href="javascript:com_dialog('reg');">注册</a>
                <?php }else { ?>
                    欢迎您，<?php echo $this->userinfo['username'] ?>&nbsp;<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/more?uuid=-1,<?php echo $this->userinfo['uid'];?>,2,center#works"><span style="color:red;">查看作品</span></a> | <a href='/index.php/user/logout'>退出</a>
                <?php }?>
            </div>
        </div>





        <div class="bm_jcts_main" >

        	<div class="ycsy_main"  id="menuTabcontent013_11">

<input type="hidden" name=""id="count"value="{$count}">

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

<!--<div id="toTop"><span>△回顶部</span></div> -->

</div>

		<div class="bj_jcts_main" id="menuTabcontent013_10" style="display:none">
         <?php if( $all_video ) :?>
             <?php foreach($all_video as $key=>$val):?>
             <div class="bm_spjj_list">
                  <ul>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/showvideo?sid=<?php echo $val['id']?>,video"><img src="<?php echo $val['img_url_path'];?>" width="290" height="205" />
                    </a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/showvideo?sid=<?php echo $val['id']?>,video"><?php echo $val['name'];?></a></li>
                  </ul>
            </div>
            <?php endforeach;?>
          <?php endif;?>
</div>
</div>
        </div>
        <div class="clear"></div>
    </div>
    <!--底部-->

    <?php $this->beginContent('//index/footer'); ?>
    <?php $this->endContent(); ?>

</div>

<!--上传图片-->
<span id="uplode_img"></span>
<input type="hidden" id="ty_id" value="2">
<!--注册账号-->
<div id="com_dialog"></div>
<!--登陆与注册-->
<!--投票成功-->
<span id="popmsg"></span>
<span id="popmsg2"></span>
<div id="bg" class="bg" style="display:none;"></div>
<iframe id='popIframe' class='popIframe' frameborder='0' ></iframe>

</body>

</html>

