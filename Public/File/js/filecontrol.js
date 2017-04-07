$(document).ready(function() {
	
	var ctr=false;
	//點擊上傳檔案按鈕
	$('.option #upload').click(function(){
		$('#inputfile').click();
	});	
	//點擊新增資料夾按鈕
	$('.option #newfold').click(function(){
		$('#backcover').fadeIn();
		$('#newfolder').fadeIn();
		$( "#newfolder .foldervalue" ).focus();
	});
	//點擊下載按鈕
	$('.option #download').click(function(){
		$('.choice').each(function(){
			window.open("/index.php/Index/Downloadfile/id/"+$(this).attr('id'));
		});
		
	});
	//點擊刪除按鈕
	$('.option #delete').click(function(){
		var filename='';
		$('.choice').each(function(){
			filename+=$(this).children('.file_name').html()+"<br>";
		});
		$('.choicespc').html(filename);
		if(filename!=''){
			
			$('#backcover').fadeIn();
			$('#delimg').fadeIn();
			}else{
			alert('還沒選擇檔案歐');
		}
		
		
	});
	//點擊複製按鈕
	$('.option #copy').click(function(){
		var filename=linkchoice();
		if(filename!=''){
			$('#backcover').fadeIn();
			$('#copyimg').fadeIn();
			}else{
			alert('還沒選擇檔案歐');
		}
		
		
	});
	//點擊移動按鈕
	$('.option #move').click(function(){
		var filename=linkchoice();
		if(filename!=''){
			$('#backcover').fadeIn();
			$('#moveimg').fadeIn();
			}else{
			alert('還沒選擇檔案歐');
		}
		
		
	});
	//點擊重新命名按鈕
	$('.option #rename').click(function(){
		$('#backcover').fadeIn();
		$('#renameimg').fadeIn();
		$('#renameimg .myname').html($('.choice .file_name').first().html()+"改為");
		$('#renameimg .id').val($('.choice').first().attr('id'));
		$('#renameimg .foldervalue').val($('.choice .file_name').first().html());
		$( ".foldervalue" ).focus();
	});
	//點擊換瀏覽模式
	$('.option #window').click(function(){
		var num=parseInt($(this).attr('num'))+1;
		if(num>2)num=1;
		if (num==1){
			$(this).children('.title').css('background-image','url(/Public/File/images/list.png)');
			$(this).children('.title').html('清單');
			$('.obj').addClass('objlist');
			$('.obj .content').css('display','block');
			$('.top').css('display','block');
			}else{
			$(this).children('.title').css('background-image','url(/Public/File/images/icon_picture.png)');
			$(this).children('.title').html('大圖示');
			$('.objlist').removeClass('objlist');
			$('.obj .content').css('display','none');
			$('.top').css('display','none');
		}
		$(this).attr('num',num);
	});
	//點擊確定複製
	$('#copyimg .button').click(function(){
		$('.file.choice').each(function(){
			
			// 取得下一個項目的資料
			$.ajax({
				url:"/index.php/Index/copy",
				data:{id:$(this).attr('id'),parent:$('#copyopt').val()},
				type:"POST",
				dataType:'text',
				error:function(xhr, ajaxOptions, thrownError){ 
					
				}
				
			});
		});
		javascript:window.location="/index.php/Index/index/parent/"+$('#copyopt').val();
	});
	//點擊確定移動
	$('#moveimg .button').click(function(){
		$('.file.choice').each(function(){
			
			
			// 取得下一個項目的資料
			$.ajax({
				url:"/index.php/Index/move",
				data:{id:$(this).attr('id'),parent:$('#moveopt').val()},
				type:"POST",
				dataType:'text',
				error:function(xhr, ajaxOptions, thrownError){ 
					
				}
				
			});
			
		});
		javascript:window.location="/index.php/Index/index/parent/"+$('#moveopt').val();
	});
	//點擊確定刪除
	$('#delimg .button').click(function(){
		$('.choice').each(function(){
			
			// 取得下一個項目的資料
			$.ajax({
				url:"/index.php/Index/delete",
				data:{id:$(this).attr('id')},
				type:"POST",
				dataType:'text',
				error:function(xhr, ajaxOptions, thrownError){ 
				}
				
			});
			
		});
		javascript:window.location.reload();
	});
	//選完檔案後上傳
	$(document).on('change','#inputfile',function(){
		var file = this.File[0]; //定義file=發生改的file
		
		type = file.type; //type=檔案型態
		if(file.type != 'image/png' && file.type != 'image/jpg'
		
		&& !file.type != 'image/gif' && file.type != 'image/jpeg' ) { //假如檔案格式不等於 png 、jpg、gif、jpeg
			alert("檔案格式不符合: png, jpg or gif"); //顯示警告
			$(this).val(''); //將檔案欄設為空
			}else{
			
			$('#upload_form').submit();
		}
	});
	//拖曳上傳完背景消失
	$('#upload_face').click(function(){
		$('#upload_face').css('display','none');
	});
	
	//點選檔案
	$('#dropDIV').on('click','.obj',function(){
		
		$(this).addClass('choice');
		
	});
	//右鍵點擊檔案
	$('.obj').mousedown(function(e){ 
		if(3 == e.which){ 
			
			$(this).addClass('choice');
			
		} 
	});

	//雙擊檔案
	$('#dropDIV .file').dblclick(function(){
		$(this).parent('a').click();
		$('.fancybox-wrap').append('<img src="/Public/File/images/download-arrow.png" id="fancydownload" />');
	});
	//點擊燈箱下載紐
	$(document).on('click','#fancydownload',function(event){
		
		window.open("/index.php/Index/Downloadfile/title/"+$('.fancybox-skin .child').html()+"/parent/"+$('#myparent').val());
	});
	//雙擊檔案
	$('#dropDIV .folder').dblclick(function(){
		location.assign("/index.php/Index/index/parent/"+$(this).attr('id'));
	});
	//點背景消失
	$('#backcover').click(function(){
		$(this).fadeOut();
		$('.reveal-modal').fadeOut();
	});
	//ctrl事件
	$('html').keydown(function(event){
		var key_code = event.keyCode;
		if(key_code=='17'){
			ctr=true;
			
		}
	});
	//鍵盤事件
	$('html').keyup(function(event){
		var key_code = event.keyCode;
		if(key_code=='17'){
			ctr=false;
		}else if(key_code=='46' || key_code=='8'){
			$('#delete').click();
		}
	});
	
	//抓所有目前所有的資料
	function linkchoice(){
		var filename='';
		$('.file.choice').each(function(){
			filename+=$(this).children('.file_name').html()+"<br>";
		});
		$('.choicespc').html(filename);
		return filename;
	}
	//移出刪除
	$("#temp_space").hover(function(){
		$(this).css("display","none");
		$("#temp_space").css("display","none");
		
		},function(){
		
	});
	//框選
	
	$( "#dropDIV" ).selectable({
		filter:".obj",
		
		stop: function() {
			$( ".ui-selected", this ).addClass('choice');
		},
		unselected:function(){
			$(".obj").removeClass("choice");
		}
	});
	
	//換圖時換下載連結
	$(document).on('click','.fancybox-nav',function(event){
		$('.fancybox-wrap').append('<img src="/Public/File/images/download-arrow.png" id="fancydownload" />');
	});
	$('#upload_face').hover(function(){
		$(this).css('display','none');
	});
	
	//右鍵目錄
	$('#dropDIV').contextPopup({
		
		
		items: [
			
			{label:'下載',icon:'/Public/File/images/cloud-computing.png',action:function(){$('#download').click();}},
			{label:'刪除',icon:'/Public/File/images/rubbish-bin.png',action:function(){$('#delete').click();}},
			{label:'複製',icon:'/Public/File/images/copy.png',action:function(){$('#copy').click();}},
			{label:'移動',icon:'/Public/File/images/move.png',action:function(){$('#move').click();}},
			{label:'全選',icon:'/Public/File/images/folder-icon.png',action:function(){$('.obj').addClass('choice');}},
			{label:'重新命名',icon:'/Public/File/images/rename.png',action:function(){$('#rename').click();}},
			{label:'重新整理',icon:'/Public/File/images/rename.png',action:function(){javascript:window.location.reload();}}
		]
	});
});
