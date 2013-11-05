<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="<?php echo Yii::app()->params['jspath'];?>jquery-1.7.1.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>

<script>
function top_vote(wid,num)
{
	var url = '/index.php/api/vote';
	$.ajax({'url':url,'async':false,'data':{'wid':wid},'dataType':'json',
	'success':function(rs){
	    if(rs == 1){

            $('#vote_'+wid).html(parseInt(num) + 1);
            alert('投票成功');
            
    	}else if(rs == 2){
	    	alert('投票失败');
	    }else{
            alert('一个IP只能投一次票');
	    }
	}
	});
	  
}
</script>

</head>

<body>
<table width="443" height="311" border="1">
  <tr>
    <td height="25"><a href="">首页</a></td>
    <td><a href="">微直播</a></td>
    <td><a href="">X1</a></td>
    <td><a href="">3系</a></td>
    <td><a href="">5系</a></td>
    <td><a href="">进入官网</a></td>
    <td><a href="">更多活动</a></td>
  </tr>
  
</table> 
<tr>作品展示</tr>  
<tr>
  
<?php foreach($works as $key=>$val):?>
     <td><img width="100" height="120" src="<?php echo $val['image_url']?>" alt="<?php echo $val['imgname']?>"></td>
     <td><?php echo $val['name']?>|<span  id="vote_<?php echo $val['id']?>"><?php echo $val['vote_num']?></span></td>
     <td><a href="javascript:void(0);" onclick="top_vote(<?php echo $val['id']?>,<?php echo $val['vote_num']?>);">投票</a></td>
<?php endforeach;?>
</tr>  

</body>
</html>
