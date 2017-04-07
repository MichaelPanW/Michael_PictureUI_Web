<?php if (!defined('THINK_PATH')) exit();?>
<body style="background-color:#e8e8e8;">


      <!--依slide為一個單位-->
      <div class="slide">
        <div class="Main_scroll">
          <div class="Main">
            <div class="titleA">Login<span></span></div>
            <div class="adminMain"> 
            <form id="loginForm" action="<?php echo U('Login/doLogin');?>" enctype="multipart/form-data" method="post" onSubmit="javascript:if($('#id_fb').val()==''){if(($('#verifyCode').val()=='')||($('#login_ac').val()=='')||($('#login_pw').val()=='')){alert('資料輸入不完整, 請再確認');return false;}}" >
              <!--1-->
              <li >
                <div class="textA">會員帳號</div>
                <div class="textB">請以E-MAIL登入</div>
                <input id="login_ac" type="text" name="login_ac" placeholder="請輸入帳號" value="" />
              </li>
              
              <!--1-->
              <li>
                <div class="textA">會員密碼</div>
                <input id="login_pw" type="password" name="login_pw" placeholder="請輸入密碼" value="" />
              </li>

              
              <!--1-->
              <li >
                <input class="btn_rwd" type="submit" value="確認送出" />
                <!--跳出視窗-->
                <a class="fancybox fancybox.iframe" href="<?php echo U('Login/forgot');?>"><input class="btn_rwd" type="button" value="忘記密碼" onClick="" /></a>
                <!--<input class="btn_rwd" type="button" value="忘記密碼" onClick="self.location.href='<?php echo U('Login/forgot');?>'" />-->
                <input class="btn_rwd" type="button" value="加入會員" onClick="self.location.href='<?php echo U('Join/gojoin');?>'" />
                <!--fb id-->
                <input id="id_fb" type="hidden" name="fb_count"/>
              </li>
              
            </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!--container end--> 
</div>
</body>

<!-- footer start -->
<footer _height="none" class="window_color">
	
	<div class="copyright">
		潘嶧德 版權所有 Copyrightc2012 All Rights Reserved . Designed by Michael <?=date('Y',time())?>  
	</div>
</footer>



</body>
<script type="text/javascript" src="/Public/File/js/jquery-1.12.4.min.js"></script>

<script type="text/javascript" src="/Public/File/js/fancybox/jquery.fancybox.js?v=2.1.4"></script>
<!-- fancybox控制設定 -->
<script type="text/javascript" src="/Public/File/js/fancybox.js"></script>
<script type="text/javascript" src="/Public/File/js/filecontrol.js"></script>
<script type="text/javascript" src="/Public/File/js/jquery-ui.js"></script>
<script type="text/javascript" src="/Public/File/js/jquery.contextmenu.js"></script>
</html>



</html>