//投票
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
            alert('你已经投过该作品了');
	    }
	}
	});
}
