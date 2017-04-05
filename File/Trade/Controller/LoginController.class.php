<?php
namespace Trade\Controller;
use Think\Controller;
class LoginController extends Controller {

    public function login()
	{
		$this->display();
	}
	
	public function login_fb()
	{
		$this->display();
	}
	
	public function doLogin()
	{
		$this->assign('jumpUrl', 'login');
		if( !empty($_POST['login_ac'])&&!empty($_POST['login_pw']) ){

			// 驗證資料
			$acBuf = D('Vip')->where('account="'. $_POST['login_ac'] .'"')->limit(1)->select();

			(count($acBuf)<1) && $this->error('查無此帳號');
			(md5($_POST['login_pw'])!=$acBuf[0]['passwords']) && $this->error('密碼錯誤');
			(($acBuf[0]['status']==0)&&($acBuf[0]['update_time']==0)) && $this->error('請先至信箱開通帳號');
			(($acBuf[0]['status']==0)&&($acBuf[0]['update_time']!=0)) && $this->error('該帳號被管制中, 詳細請洽客服');
			
			//$this->login_record($acBuf[0]['id']);
			
			// 儲存會員資訊
			Session('vipId', $acBuf[0]['id']);
			Session('vipName', $acBuf[0]['name']);
			Session('vipPic', $acBuf[0]['pic']);
			Session('vipLevel', $acBuf[0]['level']);
			Session('vipRule', $acBuf[0]['ruleck']);
			Session('vipFb', $acBuf[0]['fb_count']);
			
			$this->assign('jumpUrl', U('Index/index'));
			$gretting = array('看到您真好''好久不見', '又見到你了', '安安');

			$this->success('親愛的 '. $acBuf[0]['name'] .' , '.$gretting[rand(0,4)]);
			
			exit;
		}else if( !empty($_POST['fb_count']) ){
			// 驗證資料
			$acBuf = D('Vip')->where('fb_count='.$_POST['fb_count'])->limit(1)->select();
			if( $acBuf ){
				if($acBuf[0]['fb_count']==$_POST['fb_count']){
					(($acBuf[0]['status']==0)&&($acBuf[0]['update_time']==0)) && $this->error('請先至信箱開通帳號');
			        (($acBuf[0]['status']==0)&&($acBuf[0]['update_time']!=0)) && $this->error('該帳號被管制中, 詳細請洽客服');
			
			        // 儲存會員資訊
			        Session('vipId', $acBuf[0]['id']);
			        Session('vipName', $acBuf[0]['name']);
			        Session('vipPic', $acBuf[0]['pic']);
			        Session('vipLevel', $acBuf[0]['level']);
					Session('vipRule', $acBuf[0]['ruleck']);
					Session('vipFb', $acBuf[0]['fb_count']);
					
					$this->assign('jumpUrl', U('Index/index'));
					$gretting = array('看到您真好', '歡迎回來2535', '好久不見', '又見到你了', '安安');
					$this->success('親愛的 '. $acBuf[0]['name'] .' , '.$gretting[rand(0,4)]);
				}
			}else{
				$this->assign('jumpUrl', U('Join/gojoin', array('logid'=>$_POST['fb_count'])));
				$this->success("請先加入會員!");
			}
		}
		
		$this->error('資料輸入錯誤');
	}
	
	public function logout()
	{
		$this->display();
	}
	
	public function doLogout()
	{
	    echo "<script type='text/javascript'>parent.$.fancybox.close();window.parent.location.href='/index.php';</script>";
		$name = Session::get('vipName');
		@session_destroy();
		$this->assign('jumpUrl', U('Index/index'));
		$this->success('登出成功, 期待再次見到您 '. $name);
		
	}
}