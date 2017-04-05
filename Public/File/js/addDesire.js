
/***
 *
 * Desire V1.0
 * 2016/6/30
 *
 ***/
function putDesire( INkey, INmodel, INproId )
{
	if( INkey&&INmodel&&INproId ){
		$.ajax({
			url: "{:U('Vip/insert_desire')}",
			data:{
				key: INkey,
				model: INmodel,
				proId: INproId
			},
			type: "POST",
			dataType: "text",
			success: function(msg){
				//alert( msg );
				if(msg==1){
					alert("已加入清單");
				}else{
					alert("伺服器忙碌中, 請稍候再試");
				}
			},
			error:function(xhr, ajaxOptions, thrownError){
				alert("伺服器忙碌中, 請稍候再試");
			}
		});
	}
}

function delDesire( INkey, INmodel, INproId, INelem )
{
	if( INkey&&INmodel ){
		$.ajax({
			url: "{:U('Vip/del_desire')}",
			data:{
				key: INkey,
				model: INmodel,
				proId: INproId
			},
			type: "POST",
			dataType: "text",
			success: function(msg){
				//alert( msg );
				if(msg==1){
					INelem.innerHTML = "";
				}else{
					alert("伺服器忙碌中, 請稍候再試");
				}
			},
			error:function(xhr, ajaxOptions, thrownError){
				alert("伺服器忙碌中, 請稍候再試");
			}
		});
	}
}