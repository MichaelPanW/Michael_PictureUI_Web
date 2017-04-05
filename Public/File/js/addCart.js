function setBag( INmodel, INproId, INnum, INnotShow )
{
	var optCk = "CkBuy";
	var saveBuf = INmodel +":"+ INproId +":"+ INnum;
	
	// re check
	var re = (getCookie(optCk)?getCookie(optCk).split('#'):null);
	for(var chk in re){
		var buf = re[chk].split(':');
		if( (buf[0]==INmodel)&&(buf[1]==INproId) ){ alert("已加入此商品!");return; }
	}
	
	setCookie( optCk, saveBuf );

	if(!INnotShow){
		alert("加入商品!");
	}

	// 微美用動畫
	var bag = document.getElementById('Bag');
    bag.innerHTML = parseInt(bag.innerHTML)+1;
}

function delBagItem( INmodel, INproId )
{
	var optCk = "CkBuy";
	var ckAry = (getCookie(optCk)?getCookie(optCk).split('#'):null);
	
	// 清空暫存
	delCookie( optCk );
	
	if( ckAry ){
		for(var i=0; i<ckAry.length; i++){
			var ckDetail = ckAry[i].split(':');    
			if( (ckDetail[0]!=INmodel)||(ckDetail[1]!=INproId) ){
				setCookie( optCk, ckAry[i] );
			}
		}//end for
	}//end if
	
	window.location.reload();
} 

function BagNum()
{
	var optCk = "CkBuy";
	return (getCookie(optCk)?getCookie(optCk).split('#').length:0);
}



/***
 *
 * Cookie V1.0
 * 2016/3/27
 *
 ***/
function setCookie( INkey, INvalue )
{
	expire_days = 1; // 過期日期(天)
	var day = new Date();
	day.setTime(day.getTime() + (expire_days * 24 * 60 * 60 * 1000));
	var expires = "expires=" + day.toGMTString();
	// get value of old cookie
	var oldVal = getCookie( INkey );
	document.cookie = INkey + "=" + (oldVal?oldVal+"#":"")+INvalue + "; " + expires + "; domain=" + location.host + "; path=/";
}

function delCookie( INkey )
{
	var day = new Date();
	day.setTime( day.getTime()-1 );
	var expires = "expires=" + day.toGMTString();
	document.cookie = INkey + "=; expires=" + expires + "; domain="+location.host+"; path=/";
}

function getCookie( INkey )
{
	var buf = (document.cookie?document.cookie.split(';'):[]);
	for(var key in buf){
        var checkAry = (buf[key]).replace(/ /g,'').split('=');
		if( (checkAry[0]).localeCompare(INkey)==0 ){ return checkAry[1]; }
    }
	return null;
}