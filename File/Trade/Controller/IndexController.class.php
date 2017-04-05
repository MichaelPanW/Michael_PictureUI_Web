<?php
	namespace Trade\Controller;
	use Think\Controller;
	class IndexController extends GlobalController {
		function _initialize()
		{
			parent::_initialize();
		} 
		
		public function index(){
			//var_dump(C());
			//根目錄

			$parent=(isset($_GET['parent']) && $_GET['parent']!='')?$_GET['parent']:1;
			//搜尋值
			$search=(isset($_GET['search']) && $_GET['search']!='')?$_GET['search']:'';
			//提示訊息
			$message=(isset($_GET['message']) && $_GET['message']!='')?$_GET['message']:'';
			//dump(D("file")->select());
			$backp = D('file')->field('parent')->where('id='.$parent)->select();
			$back=($backp[0]['parent']!='0')?($backp[0]['parent']):'1';
			
			$dex=$this->circleindex($parent);
			$field = "*";
			//搜尋狀況或瀏覽狀況
			if($search!=''){
				$where = "user_id=".Session('vipId')." and (name like '%".$search."%' or extension = '".$search."')";       
				$folderwhere = "user_id=".Session('vipId')." and type=0";
				}else{
				$where = "user_id=".Session('vipId')." and parent=".$parent;
				$folderwhere = "user_id=".Session('vipId')." and type='0' and (parent=".$parent." or id=".$parent.")";
				
			} 
			$order = "type asc,create_time desc";
			$bufAry_A = D('file')->field($field)->order($order)->where($where)->select();

			//檢查檔案是否存在
			foreach( $bufAry_A as $key=> $val) {
				if($val['type']==1){
					if(!file_exists(iconv("UTF-8", "BIG5",$val['path']))){
						D('file')->where('id='.$val['id'])->delete();
						unset($bufAry_A[$key]);
					}
				}
			}
			$folder = D('file')->field($field)->order($order)->where($folderwhere)->select();
			$this->assign('message',$message);
			$this->assign('back',$back);
			$this->assign('index',$dex);
			$this->assign('db_file',$bufAry_A);
			$this->assign('parent',$parent);
			$this->assign('folder',$folder);
			$this->display();
		}
		/***
			* upload
			* 上傳圖片
			*parent上傳目的 
		***/
		public function upload(){
			
			$parent=isset($_POST['parent'])?$_POST['parent']:1;
			
			$circle=UPLOAD_PATH.'/Files/'.Session('vipId').$this->circleindex($parent).'/';
			
			$upload = new \Org\Net\UploadFile();
			$upload->maxSize = 99999999 ;//預設無限
			$upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');
			$upload->savePath = $circle;
			$upload->saveRule = 'uniqid';
			$upload->upload();
			$uploadList = $upload->getUploadFileInfo();
			//dump($uploadList);exit;
			foreach( $uploadList as $key=> $val) {
				$data['path'] = $uploadList[$key]['savepath'] . $uploadList[$key]['savename'];
				$data['path_htumb'] = $uploadList[$key]['savepath'] . $uploadList[$key]['savename'];
				$data['create_time']= time();
				$data['name']= str_replace('.'.$uploadList[$key]['extension'],'',$uploadList[$key]['name']);
				$data['user_id']= Session('vipId');
				$data['parent']= $parent;
				$data['type']= '1';
				$data['size']= $uploadList[$key]['size'];
				$data['extension']= $uploadList[$key]['extension'];
				D('file')->data($data)->add();
			}
			
			redirect( U('Index/index/parent/'.$parent));
		}		
		/***
			* delete
			* 刪除檔案
			*id 刪除檔案代號
		***/
		public function delete(){
			$id=isset($_POST['id'])?$_POST['id']:'';
			if($id!=''){
				
				$sel=D('file')->where('id='.$id.' and user_id='.Session('vipId'))->limit(1)->select();
				//判斷是檔案還是資料夾
				if($sel[0]['type']==0){
					$this->circledelete($id);
					@rmdir(iconv("UTF-8", "BIG5", $sel[0]['path']));
					}else{
					D('file')->where('id='.$id.' and user_id='.Session('vipId'))->delete();
					@unlink(iconv("UTF-8", "BIG5",$sel[0]['path']));
				}
				
			}
		}
		/***
			* copy
			* 複製檔案
			* id複製檔案代號 parent複製目的
		***/
		public function copy(){
			$id=isset($_POST['id'])?$_POST['id']:'';
			$parent=isset($_POST['parent'])?$_POST['parent']:'';
			
			if($id!='' && $parent!=''){
				
				$ckBuf = D('file')->where('id='.$id.' and user_id='.Session('vipId'))->select();
				if(!empty($ckBuf)){
					$data=$ckBuf[0];
					$data['parent']= $parent;
					$data['create_time']= time();
					$oldpath=$data['path'];
					unset($data['id']);
					$data['path']=UPLOAD_PATH.'/Files/'.Session('vipId').$this->circleindex($parent).'/'.md5($data['name']).$data['create_time'].'.'.($data['extension']);
					@copy(iconv("UTF-8", "BIG5",$oldpath),iconv("UTF-8", "BIG5",$data['path']));
					D('file')->data($data)->add();
				}
				
				
			}
		}
		/***
			* move
			* 移動檔案
			*id移動檔案代號 parent移動目的代號 
		***/
		public function move(){
			$id=isset($_POST['id'])?$_POST['id']:'';
			$parent=isset($_POST['parent'])?$_POST['parent']:'';
			if($id!='' && $parent!=''){
				$sql = D('file')->where('id='.$id.' and user_id='.Session('vipId'))->select();
				if(!empty($sql)){
					$data=$sql[0];
					$oldpath=$data['path'];
					$data['parent']=$parent;
					$data['create_time']= time();
					$circle=UPLOAD_PATH.'/Files/'.Session('vipId').$this->circleindex($parent).'/';
					$data['path']=$circle.md5($data['name']).$data['create_time'].'.'.($data['extension']);
					$this->checkfolder($circle);
					@rename(iconv("UTF-8", "BIG5",$oldpath),iconv("UTF-8", "BIG5",$data['path']));
					$ckBuf = D('file')->where('id='.$id.' and user_id='.Session('vipId'))->data($data)->save();
				}
			}
		}
		/***
			* Newfolder
			* 新增資料夾
			*
		***/
		public function Newfolder(){
			
			$parent=isset($_POST['parent'])?$_POST['parent']:'';
			$foldername=isset($_POST['foldername'])?$_POST['foldername']:'';
			if(isset($_POST['foldername'])&&$foldername!=''){
				$sel=D('file')->where('parent='.$parent." and name='".$foldername."'")->select();
				if(empty($sel)){
					
					$data['create_time']= time();
					$data['name']= $foldername;
					$data['path']= UPLOAD_PATH.'/Files/'.Session('vipId').$this->circleindex($parent).'/'.$foldername;
					$data['user_id']= Session('vipId');
					$data['parent']= $parent;
					$data['type']= '0';
					D('file')->data($data)->add();
					$this->checkfolder($data['path']);
					redirect( U('Index/index/parent/'.$parent));
					}else{
					
					redirect( U('Index/index/parent/'.$parent."/message/名子重複了"));
				}
				}else{
				redirect( U('Index/index/parent/'.$parent."/message/名子是空的"));
				
			}
			
		}
		/***
			* renameimg
			* 改名
			*
		***/
		public function renameimg(){
			
			$id=isset($_POST['id'])?$_POST['id']:'';
			$parent=isset($_POST['parent'])?$_POST['parent']:'';
			$foldername=($_POST['foldername']);
			if($id!='' && $foldername!=''){
				
				$cha=D('file')->where('id='.$id.' and user_id='.Session('vipId'))->select();
				$sel=D('file')->where("parent=".$parent." and name='".$foldername."' and type=".$cha[0]['type'])->select();
				if(empty($sel)){
					
					$data['name']= $foldername;
					
					$sav=D('file')->where('id='.$id.' and user_id='.Session('vipId'))->data($data)->save();
					
					redirect( U('Index/index/parent/'.$parent));
					}else{
					
					redirect( U('Index/index/parent/'.$parent."/message/名子重複了"));
				}
				}else{
				redirect( U('Index/index/parent/'.$parent."/message/名子是空的"));
				
			}
			
		}
		
		/***
			* Downloadfile
			* 下載檔案
			*兩種傳法 get 檔案代號進來 或 get 標題跟parent進來
		***/
		public function Downloadfile(){
			
			$parent=isset($_GET['parent'])?$_GET['parent']:'';
			$title=isset($_GET['title'])?$_GET['title']:'';
			$id=isset($_GET['id'])?$_GET['id']:'';
			
			
			if($id!=''){
				$ckBuf = D('file')->where('id='.$id.' and user_id='.Session('vipId'))->select();
				
				header("Content-type: text/html; charset=utf-8");
				
				$file=$ckBuf[0]['path']; // 實際檔案的路徑+檔名
				
				$filename=$ckBuf[0]['name'].".".$ckBuf[0]['extension']; // 下載的檔名
				if($file!=''){
					//指定類型
					
					header("Content-type: application");
					
					//指定下載時的檔名
					
					header("Content-Disposition: attachment; filename=".$filename."");
					
					//輸出下載的內容。
					ob_clean();
					flush();
					readfile($file);
					
				}
				
				}else if($parent!='' && $title!=''){
				
				$ckBuf = D('file')->where("name='".$title."' and user_id=".Session('vipId')." and parent=".$parent)->select();
				
				header("Content-type: text/html; charset=utf-8");
				
				$file=$ckBuf[0]['path']; // 實際檔案的路徑+檔名
				$filename=$ckBuf[0]['name'].".".$ckBuf[0]['extension']; // 下載的檔名
				if($file!=''){
					//指定類型
					
					header("Content-type: application");
					
					//指定下載時的檔名
					header("Content-Disposition: attachment; filename=".$filename."");
					//輸出下載的內容。
					ob_clean();
					flush();
					readfile($file);
					
				}
				
				
			}
			$this->display();
			
			
			
		}
		//遞迴取目錄位置
		public function circleindex($paren){
			
			$ckBuf = D('file')->field('id,name,parent')->where('id='.$paren)->select();
			if(!empty($ckBuf) && $paren!='0' && ($ckBuf[0]['parent'])!='0' ){
				
				return $x=$this->circleindex($ckBuf[0]['parent']).'/'.$ckBuf[0]['name'];
				
				}else{
				return '';
			}
			
		}
		//遞迴刪檔案
		public function circledelete($paren){
			
			$ckBuf = D('file')->field('id,parent,path')->where('parent='.$paren)->select();
			foreach( $ckBuf as $key=> $val) {
				if($val['type']=='0'){
					rmdir(iconv("UTF-8", "BIG5", $val['path']));
					$this->circledelete($val['id']);
					}else{
					
					@unlink(iconv("UTF-8", "BIG5",$val['path']));
				}
			}
			$ckBuf = D('file')->where('parent='.$paren.' or id='.$paren)->delete();
			rmdir(iconv("UTF-8", "BIG5", $ckBuf[0]['path']));
			
		}
		public function checkfolder($uploads_dir){
			
			mkdir(iconv("UTF-8", "BIG5", $uploads_dir),0777,true);
			
		}
	}	