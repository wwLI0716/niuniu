<?php
	class safetyCalls extends client{
		 
		function __construct(){
			  parent::__construct();
			  $this->functionstr='safetyCalls';
		} 
		/***
			主叫，被叫，唯一标识
			appId		必选	创建应用时系统分配的唯一标示，在“应用列表”中可以查询。
			caller		必选	主叫号码(必须为11位手机号，号码前加0086，如008613631686024)
			callee		必选	规则同caller
			dstVirtualNum		必选	分配的直呼虚拟中间保护号码
			bindId		必选	分配唯一针对中间号码与主被叫号码的唯一绑定Id
		**/
		function allocNumber($caller,$callee,$bindId)
		{
			$this->operation='allocNumber';
			$data=array(
				'appId'=>$GLOBALS['appId'],
				'caller'=>'0086'.$caller,
				'callee'=>'0086'.$callee, 
				'dstVirtualNum' => '02180259800',
				'bindId'=>$bindId,
				'maxAge'=>'1800',
				'cityId'=>'008621',
				'statusUrl'=>'http://weixin.yc-police.com/movecar/callback/index.html',
				'maxAllowTime'=>'1',//最大通话时长
			);
			return $this->post($data);
		}
		function freeNumber($bindId)
		{
			$this->operation='freeNumber';
			$data=array(
				'appId'=>$GLOBALS['appId'], 
				'bindId'=>$bindId, 
				'cityId'=>'008621' 
			); 
			return $this->post($data);
		}
		
	}
?>