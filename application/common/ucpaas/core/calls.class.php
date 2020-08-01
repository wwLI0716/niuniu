<?php
	class calls extends client{
		 
		function __construct(){
			  parent::__construct();
			  $this->functionstr='Calls';
		} 
		function callBack()
		{
			$data=array(
				'appId'=>$GLOBALS['appId'],
				
			);
		}
	}
?>