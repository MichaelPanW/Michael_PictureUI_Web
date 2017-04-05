<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
	
	<head>
		
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
		<meta charset="utf-8">
		<!-- headerB start -->
		<link rel="shortcut icon" type="image/x-icon" href="/Public/images/folder.icon"/>
		<title>檔案管理系統</title>
		<link rel="stylesheet" href="/Public/css/reset.css">
		<link rel="stylesheet" href="/Public/css/color.css">
		<!--RWD設定--><!--電腦螢幕寬度1920px-1280px-->
		<link href="/Public/css/style.css" rel="stylesheet" type="text/css" />
		<!--1280以下--><!--ipad 橫放/電腦螢幕-->
		<link href="/Public/css/style-large.css" rel="stylesheet" type="text/css" media="screen and (min-width: 801px) and (max-width: 1279px)"  />
		<!--手機直立/手機橫放/ipad直立-->
		<link href="/Public/css/style-small.css" rel="stylesheet" type="text/css" media="screen and (min-width: 0px) and (max-width: 800px)" />
	  	<!--彈跳窗css-->
		<link rel="stylesheet" href="/Public/css/reveal.css">	
		<!--燈箱css-->
		<link href="/Public/css/jquery.fancybox.css?v=2.1.4" rel="stylesheet" type="text/css" media="screen" />
		<!--右鍵目錄css-->
		<link rel="stylesheet" href="/Public/css/jquery.contextmenu.css">
		
	</head>
	<body>
		<header class="window_color">
			<div class="first_bar">
				<div class="title">
					檔案管理員
				</div>
				<div class="right_search">
				
				<form method="get" action="<?php echo U('Index/index');?>">
					<input type="text" name="search" placeholder="搜尋" style="background-image:url('/Public/images/musica-searcher.png');" />
				</form>
				</div>
			</div>
			<div class="last_bar">
				<ul class="option">
					<li>
						<a id="upload"><div class="title" style="background-image:url('/Public/images/upload-to-cloud.png');" >上傳</div></a>
					</li>
					<li>
						<a  id="download"><div class="title" style="background-image:url('/Public/images/cloud-computing.png');" >下載</div></a>
					</li>
					<li>
						<a id="newfold"><div class="title" style="background-image:url('/Public/images/new-file.png');" >新資料夾</div></a>
					</li>

					<li>
						<a id="delete"><div class="title" style="background-image:url('/Public/images/rubbish-bin.png');" >刪除</div></a>
					</li>
					<li>
						<a id="copy"><div class="title" style="background-image:url('/Public/images/copy.png');" >複製</div></a>
					</li>
					<li>
					<a id="move"><div class="title" style="background-image:url('/Public/images/move.png');" >移動</div></a>
					</li>
					<li>
					<a id="rename"><div class="title" style="background-image:url('/Public/images/rename.png');" >重新命名</div></a>
					</li>
					<li>
					<a id="window" num="9"><div class="title" style="background-image:url('/Public/images/icon_picture.png');" >大圖示</div></a>
					</li>
					
					
				</ul>
			</div>
			<div class="path_bar">
				<a href="/index.php/Index/index/parent/<?php echo ($back); ?>"><img src='/Public/images/left-arrow.png' class="backbutton" /></a>
				<p>目錄</p>
				<input type="text" class="path_content" value="<?php echo ($index); ?>"  readonly="readonly" />
				
			</div>

		</header>																																								

<!--檔案區-->
<div  id="dropDIV" class="main" ondragover="dragoverHandler(event)" >
	<div id="upload_face" >上傳</div>
	<!--隱藏暫存區-->
	<div id="temp_space">
		<form id="upload_form" action="<?php echo U('Index/upload');?>" method="post" enctype="multipart/form-data">
			<input type="hidden" value='<?php echo ($parent); ?>' name="parent" id="myparent" />
			<input id="inputfile" type="file" name="photo[]" accept="image/jpeg,image/jpg,image/gif,image/png" multiple />
			
		</form>
	</div>
	
	
	<div class="top" >
		<p class="file_name">名稱</p>
		<div class="content">
			<p  class="tbsize" style="text-align:right">大小</p>
			<p class="tbext" >類型</p>
			
		</div>
	</div>
	
	<?php if(is_array($db_file)): $i = 0; $__LIST__ = $db_file;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo[type] == 0): ?><div class="folder obj" style="background-image:url('/Public/images/folder.png');" id='<?php echo ($vo["id"]); ?>'>
				<p class="file_name"><?php echo (mb_substr(htmlspecialchars($vo["name"]),0,30,'utf-8')); if(strlen($vo[name]) > 30): ?>...<?php endif; ?></p>
			</div>
			<?php else: ?>
			<a class="fancybox" href="/<?php echo ($vo["path"]); ?>" data-fancybox-group="gallery" title='<?php echo ($vo["name"]); ?>'>
				<div class="file obj"  style="background-image:url('/<?php echo ($vo["path"]); ?>');" id='<?php echo ($vo["id"]); ?>'>
					<p class="file_name"><?php echo (mb_substr(htmlspecialchars($vo["name"]),0,30,'utf-8')); if(strlen($vo[name]) > 30): ?>...<?php endif; ?></p>
					<div class="content">
						<p  class="tbsize" style="text-align:right"><?php echo ($vo["size"]); ?>KB</p>
						<p class="tbext" ><?php echo ($vo["extension"]); ?></p>
						
					</div>
				</div>
				
				
			</a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
	
	
</div>


<!--彈跳區-->
<div id="backcover"></div>
<!--彈跳窗區-圖片-->
<div id="viewimg" class="reveal-modal">
	<div id="modalimg" ></div>
	<p  id="modalp"></p>
</div>
<!--彈跳窗區-新資料夾-->
<div id="newfolder" class="reveal-modal">
	<form method="post" action="<?php echo U('Index/Newfolder');?>">
		<div class="title">建立新資料夾</div><br>
		<input type="hidden" value='<?php echo ($parent); ?>' name="parent" />
		<input type="text" name="foldername" class="foldervalue" placeholder="新資料夾" />
		<input type="submit" />
	</form>
</div>
<!--彈跳窗區-確定刪除-->
<div id="delimg" class="reveal-modal">
	<div class="title">確定刪除</div><br>
	<div class="choicespc"></div>
	<input class="button" type="button" value="確定" />
	
</div>
<!--彈跳窗區-複製-->
<div id="copyimg" class="reveal-modal">
	<div class="title">複製</div>
	<div class="choicespc"></div>
	複製到哪一個資料夾<br>
	<select id="copyopt"  name="folder">
		<?php if($parent != 1): ?><option value="<?php echo ($back); ?>">上一層</option><?php endif; ?>
		<?php if(is_array($folder)): $i = 0; $__LIST__ = $folder;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value='<?php echo ($vo["id"]); ?>'><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	</select>
	<input class="button" type="button" value="確定" />
</div>
<!--彈跳窗區-移動-->
<div id="moveimg" class="reveal-modal">
	<div class="title">移動</div>
	<div class="choicespc"></div>
	移動到哪一個資料夾<br>
	<select id="moveopt"  name="folder">
		<?php if($parent != 1): ?><option value="<?php echo ($back); ?>">上一層</option><?php endif; ?>
		<?php if(is_array($folder)): $i = 0; $__LIST__ = $folder;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value='<?php echo ($vo["id"]); ?>'><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	</select>
	<input class="button" type="button" value="確定" />
</div>
<!--彈跳窗區-新資料夾-->
<div id="renameimg" class="reveal-modal">
	<form method="post" action="<?php echo U('Index/renameimg');?>">
		<div class="title">重新命名</div><br>
		<div class="myname"></div><br>
		<input type="hidden"  value='<?php echo ($parent); ?>'  name="parent" />
		<input type="hidden"  name="id" class='id'  />
		<input type="text" name="foldername" class="foldervalue" placeholder="新檔案" />
		<input type="submit" />
	</form>
</div>
<script>
	if('<?php echo ($message); ?>'!='')alert('<?php echo ($message); ?>');
	<!--移入顯示上傳-->
	function dragoverHandler(evt) {
		evt.preventDefault();
		document.getElementById("upload_face").style.display="block";
		document.getElementById("temp_space").style.display="block";
	}
	
</script>
<!-- footer start -->
<footer _height="none" class="window_color">
	
	<div class="copyright">
		傳訊光科技股份有限公司 版權所有 Copyrightc2012 All Rights Reserved . Designed by PHOTNIC<?=date('Y',time())?>  
	</div>
</footer>



</body>
<script type="text/javascript" src="/Public/js/jquery-1.12.4.min.js"></script>

<script type="text/javascript" src="/Public/js/fancybox/jquery.fancybox.js?v=2.1.4"></script>
<!-- fancybox控制設定 -->
<script type="text/javascript" src="/Public/js/fancybox.js"></script>
<script type="text/javascript" src="/Public/js/filecontrol.js"></script>
<script type="text/javascript" src="/Public/js/jquery-ui.js"></script>
<script type="text/javascript" src="/Public/js/jquery.contextmenu.js"></script>
</html>